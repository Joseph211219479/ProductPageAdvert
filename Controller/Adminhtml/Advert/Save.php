<?php

namespace Sozo\ProductPageAdvert\Controller\Adminhtml\Advert;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Sozo\ProductPageAdvert\Model\AdvertFactory;
use Sozo\ProductPageAdvert\Model\ResourceModel\Advert as AdvertResource;

class Save extends Action
{
    protected $advertFactory;
    protected $advertResource;

    public function __construct(
        Context $context,
        AdvertFactory $advertFactory,
        AdvertResource $advertResource
    ) {
        parent::__construct($context);
        $this->advertFactory = $advertFactory;
        $this->advertResource = $advertResource;
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        if (!$data) {
            $this->_redirect('*/*/');
            return;
        }

        $id = $this->getRequest()->getParam('id');

        try {
            $model = $this->advertFactory->create();
            if ($id) {
                $this->advertResource->load($model, $id);
                if (!$model->getId()) {
                    throw new NoSuchEntityException(__('The advert no longer exists.'));
                }
            }

            $model->setData($data);

            $this->advertResource->save($model);
            $this->messageManager->addSuccessMessage(__('The advert has been saved.'));
            $this->_getSession()->setFormData(false);

            if ($this->getRequest()->getParam('back')) {
                $this->_redirect('*/*/edit', ['id' => $model->getId()]);
                return;
            }

            $this->_redirect('*/*/');
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('Something went wrong while saving the advert.'));
        }

        $this->_getSession()->setFormData($data);
        $this->_redirect('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
    }
}
