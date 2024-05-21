<?php

namespace Sozo\ProductPageAdvert\Controller\Adminhtml\Advert;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Sozo\ProductPageAdvert\Model\AdvertFactory;
use Sozo\ProductPageAdvert\Api\AdvertRepositoryInterface ;

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

        $id = $this->getRequest()->getParam('id');

        try {
            $model = $this->advertFactory->create();

            //todo do not need this anymore, handle edit in its own class
           /* if ($id) {
                $model = $this->advertRepository->getById($id);
                if (!$model->getId()) {
                    throw new NoSuchEntityException(__('The advert no longer exists.'));
                    $this->_redirect('pdpadvert/advert/index');
                    return;
                }
            }*/

            //$model->setData($data['advert']);
            // todo move to private function.
            $model->setHeading($data['advert']['heading']);
            $model->setMessage($data['advert']['message']);
            //non required fields
            if(isset($data['advert']['imagePath'])){
                $model->setImagePath($data['advert']['imagePath'][0]['url']);
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
       // $this->_getSession()->setFormData($data);
       // $this->_redirect('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
    }
}
