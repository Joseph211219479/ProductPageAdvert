<?php
namespace Joseph\ProductPageAdvert\Controller\Adminhtml\Advert;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Joseph\ProductPageAdvert\Api\AdvertRepositoryInterface;
use Joseph\ProductPageAdvert\Model\AdvertFactory;

class Delete extends Action
{
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
     * @param AdvertFactory $advertFactory
     * @param AdvertRepositoryInterface $advertRepository
     */
    public function __construct(
        Context $context,
        AdvertFactory $advertFactory,
        AdvertRepositoryInterface $advertRepository
    ) {
        parent::__construct($context);
        $this->advertFactory = $advertFactory;
        $this->advertRepository = $advertRepository;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $advertId = $this->getRequest()->getParam('id');
        if ($advertId) {
            try {
                $advert = $this->advertRepository->getById($advertId);
                $this->advertRepository->delete($advert);
                $this->messageManager->addSuccessMessage(__('Advert has been deleted.'));
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('An error occurred while deleting the advert.'));
            }
        }

        return $this->_redirect('pdpadvert/advert/index');
    }
}
