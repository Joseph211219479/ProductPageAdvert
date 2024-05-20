<?php

namespace Sozo\ProductPageAdvert\Controller\Adminhtml\Advert;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Filesystem\DirectoryList;

class Upload extends Action
{
    protected $uploaderFactory;
    protected $filesystem;

    public function __construct(
        Action\Context $context,
        \Magento\MediaStorage\Model\File\UploaderFactory $uploaderFactory,
        \Magento\Framework\Filesystem $filesystem
    ) {
        parent::__construct($context);
        $this->uploaderFactory = $uploaderFactory;
        $this->filesystem = $filesystem;
    }

    public function execute()
    {
        try {
            $uploader = $this->uploaderFactory->create(['fileId' => 'image_path']);
            $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
            $uploader->setAllowRenameFiles(true);
            $uploader->setFilesDispersion(true);

            $mediaDirectory = $this->filesystem->getDirectoryRead(DirectoryList::MEDIA);
            $target = $mediaDirectory->getAbsolutePath('pdpadvert/images');

            // Ensure the directory exists
            if (!is_dir($target)) {
                mkdir($target, 0775, true);
            }

            $result = $uploader->save($target);

            if ($result['file']) {
                $result['url'] = $this->_url->getBaseUrl(['_type' => \Magento\Framework\UrlInterface::URL_TYPE_MEDIA]) . 'pdpadvert/images' . $result['file'];
                $result['cookie'] = [
                    'name' => $this->_getSession()->getName(),
                    'value' => $this->_getSession()->getSessionId(),
                    'path' => $this->_getSession()->getCookiePath(),
                    'domain' => $this->_getSession()->getCookieDomain()
                ];
            }
        } catch (\Exception $e) {
            $result = ['error' => $e->getMessage(), 'errorcode' => $e->getCode()];
        }

        $response = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        return $response->setData($result);
    }
}
