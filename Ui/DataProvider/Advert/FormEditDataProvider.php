<?php

namespace Sozo\ProductPageAdvert\Ui\DataProvider\Advert;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Sozo\ProductPageAdvert\Api\AdvertRepositoryInterface;
use Sozo\ProductPageAdvert\Model\ResourceModel\Advert\CollectionFactory;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\UiComponent\DataProvider\DataProvider;

class FormEditDataProvider extends AbstractDataProvider
{
    protected $loadedData;
    protected $request;
    protected $advertRepository;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        RequestInterface $request,
        AdvertRepositoryInterface $advertRepository,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        $this->request = $request;
        $this->advertRepository = $advertRepository;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $advertId = $this->request->getParam('entity_id');

        if ($advertId) {
            $advert = $this->advertRepository->getById($advertId);
            $this->loadedData[$advert->getId()] = $advert->getData();
            $this->loadedData[$advert->getId()]['advert'] = $advert->getData();
        }

        return $this->loadedData;
    }
}
