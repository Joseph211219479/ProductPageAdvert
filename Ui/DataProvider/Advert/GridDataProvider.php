<?php
namespace Sozo\ProductPageAdvert\Ui\DataProvider\Advert;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Sozo\ProductPageAdvert\Model\ResourceModel\Advert\CollectionFactory;

class GridDataProvider extends AbstractDataProvider
{
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        return $this->collection->getData();
    }
}
