<?php
namespace Sozo\ProductPageAdvert\Ui\DataProvider\Advert;

use Sozo\ProductPageAdvert\Model\ResourceModel\Advert\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;

class FormDataProvider extends AbstractDataProvider
{
    protected $collection;
    protected $dataPersistor;
    protected $loadedData;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $advert) {
            $this->loadedData[$advert->getId()] = $advert->getData();
        }
        $data = $this->dataPersistor->get('sozo_productpageadvert_advert');
        if (!empty($data)) {
            $advert = $this->collection->getNewEmptyItem();
            $advert->setData($data);
            $this->loadedData[$advert->getId()] = $advert->getData();
            $this->dataPersistor->clear('sozo_productpageadvert_advert');
        }
        return $this->loadedData;
    }
}
