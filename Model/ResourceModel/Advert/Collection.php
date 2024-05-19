<?php
namespace Sozo\ProductPageAdvert\Model\ResourceModel\Advert;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Sozo\ProductPageAdvert\Model\Advert;
use Sozo\ProductPageAdvert\Model\ResourceModel\Advert as AdvertResource;

class Collection extends AbstractCollection
{

    //protected $_idFieldName = 'entity_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(Advert::class, AdvertResource::class);
    }
}
