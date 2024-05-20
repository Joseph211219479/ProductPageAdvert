<?php
namespace Sozo\ProductPageAdvert\Controller\Adminhtml\Advert;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Registry;
use Sozo\ProductPageAdvert\Model\AdvertFactory;

class Edit extends Action
{
    protected $resultPageFactory;
    protected $registry;
    protected $advertFactory;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        Registry $registry,
        AdvertFactory $advertFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->registry = $registry;
        $this->advertFactory = $advertFactory;
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $model = $this->advertFactory->create();

        if ($id) {
            $model = $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This advert no longer exists.'));
                return $this->_redirect('*/*/');
            }
        }

        $this->registry->register('advert', $model);

        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? __('Edit Advert') : __('New Advert'));

        return $resultPage;
    }
}
