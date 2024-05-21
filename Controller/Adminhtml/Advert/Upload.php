<?php

namespace Sozo\ProductPageAdvert\Controller\Adminhtml\Advert;

use Magento\Backend\App\Action\Context;
use Sozo\ProductPageAdvert\Model\ImageUploader;
use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;

class Upload extends Action
{
    protected $imageUploader;

    protected $uploaderFactory;


    public function __construct(
        Context $context,
        ImageUploader $imageUploader,
        \Magento\MediaStorage\Model\File\UploaderFactory $uploaderFactory,
    ) {
        parent::__construct($context);
        $this->imageUploader = $imageUploader;

        $this->uploaderFactory = $uploaderFactory;
    }

    public function execute()
    {
        try {
            $fileId = "imagePath";

            if (!isset($_FILES[$fileId])) {
                //this is done because magento core expects data in strings but ui uploader returns it in arrays
                $_FILES[$fileId] = [
                    'name' => $_FILES["advert"]['name']['imagePath'],
                    'type' => $_FILES["advert"]['type']['imagePath'],
                    'tmp_name' => $_FILES["advert"]['tmp_name']['imagePath'],
                    'error' => $_FILES["advert"]['error']['imagePath'],
                    'size' => $_FILES["advert"]['size']['imagePath'],
                    'full_path' => $_FILES["advert"]['full_path']['imagePath']
                ];
            }

            $result = $this->imageUploader->upload($fileId);

            $result['cookie'] = [
                'name' => $this->_getSession()->getName(),
                'value' => $this->_getSession()->getSessionId(),
                'path' => $this->_getSession()->getCookiePath(),
                'domain' => $this->_getSession()->getCookieDomain()
            ];

        } catch (\Exception $e) {
            $result = ['error' => $e->getMessage(), 'errorcode' => $e->getCode()];
        }

        $response = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        return $response->setData($result);
    }
}
