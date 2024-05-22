<?php
namespace Sozo\ProductPageAdvert\Controller\Adminhtml\Advert;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Sozo\ProductPageAdvert\Model\AdvertFactory;
use Sozo\ProductPageAdvert\Api\AdvertRepositoryInterface ;


class Edit extends Action
{
    /**
     * @var PageFactory
     */
    protected PageFactory $resultPageFactory;

    /**
     * @var AdvertFactory
     */
    protected AdvertFactory $advertFactory;

    /**
     * @var AdvertRepositoryInterface
     */
    protected AdvertRepositoryInterface $advertRepository;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param AdvertFactory $advertFactory
     * @param AdvertRepositoryInterface $advertRepository
     */
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

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Sozo_ProductPageAdvert::pdp');
        $resultPage->getConfig()->getTitle()->prepend(__('Edit Advert'));

        return $resultPage;
    }
}
