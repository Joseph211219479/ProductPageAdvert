<?php

namespace Sozo\ProductPageAdvert\Model;

use Magento\Framework\Filesystem;
use Magento\Framework\File\UploaderFactory;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\UrlInterface;

class ImageUploader
{
    protected $uploaderFactory;
    protected $filesystem;
    protected $urlBuilder;

    public function __construct(
        UploaderFactory $uploaderFactory,
        Filesystem $filesystem,
        UrlInterface $urlBuilder
    ) {
        $this->uploaderFactory = $uploaderFactory;
        $this->filesystem = $filesystem;
        $this->urlBuilder = $urlBuilder;

    }

    public function upload($fileId)
    {
        try {
            $uploader = $this->uploaderFactory->create(['fileId' => $fileId]);

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
                $result['url'] = $this->urlBuilder->getBaseUrl(['_type' => UrlInterface::URL_TYPE_MEDIA]) . 'pdpadvert/images' . $result['file'];
            }

            return $result;
        } catch (\Exception $e) {
            throw new \Magento\Framework\Exception\LocalizedException(__($e->getMessage()));
        }
    }

    /**
     * @return string
     */
    public function getBaseTmpPath()
    {
        return $this->baseTmpPath;
    }

}
