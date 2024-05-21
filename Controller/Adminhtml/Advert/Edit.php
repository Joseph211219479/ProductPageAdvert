<?php
namespace Sozo\ProductPageAdvert\Controller\Adminhtml\Advert;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Sozo\ProductPageAdvert\Model\AdvertFactory;
use Sozo\ProductPageAdvert\Api\AdvertRepositoryInterface ;


class Edit extends Action
{
    protected $resultPageFactory;
    protected $registry;
    protected $advertFactory;

    protected AdvertRepositoryInterface $advertRepository;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        AdvertFactory $advertFactory,
        AdvertRepositoryInterface $advertRepository

    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->advertFactory = $advertFactory;
        $this->advertRepository = $advertRepository;

    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        // Load existing data based on $id
        $existingData = $this->advertRepository->getById($id);
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('Edit Entity'));
        $resultPage->addBreadcrumb(__('Edit Entity'), __('Edit Entity'));
        $resultPage->addContent(
            $resultPage->getLayout()->createBlock(
                \Sozo\ProductPageAdvert\Block\Adminhtml\Edit::class
            )->setData('existing_data', $existingData)
        );
        return $resultPage;
    }
}
