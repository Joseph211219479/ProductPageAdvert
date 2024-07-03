<?php

namespace Joseph\ProductPageAdvert\Controller\Adminhtml\Advert;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Joseph\ProductPageAdvert\Model\AdvertFactory;
use Joseph\ProductPageAdvert\Api\AdvertRepositoryInterface ;

class Save extends Action
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
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     * @throws NoSuchEntityException
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        if (!$data || !isset($data['advert']) ) {
            throw new NoSuchEntityException(__('Unabele to save Advert.'));
            $this->_redirect('*/*/');
            return;
        }

        try {
            $model = $this->advertFactory->create();

            if ($data['advert']['entity_id']  !== '') {
                $model = $this->advertRepository->getById($data['advert']['entity_id']);
                if (!$model->getId()) {
                    throw new NoSuchEntityException(__('The advert no longer exists.'));
                    $this->_redirect('pdpadvert/advert/index');
                    return;
                }
            }

            $model->setHeading($data['advert']['heading']);
            $model->setMessage($data['advert']['message']);

            //non required fields
            if(isset($data['advert']['imagePath'])){
              //  if(!isset($data['advert']['entity_id'])){//todo this is just to test updates while the image uploader does not populate saved image.
                if(isset( $data['advert']['imagePath'][0]['url'])){
                    $model->setImagePath($data['advert']['imagePath'][0]['url']);
                }
                //}
            }
            if(isset($data['advert']['url_link'])){
                $model->setUrlLink($data['advert']['url_link']);
            }

            $this->advertRepository->save($model);
            $this->messageManager->addSuccessMessage(__('The advert has been saved.'));

            $this->_redirect('pdpadvert/advert/index');
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('Something went wrong while saving the advert.'));
        }
    }
}
