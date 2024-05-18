<?php
namespace Sozo\ProductPageAdvert\Model;

use Magento\Framework\Model\AbstractModel;

class Advert extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(ResourceModel\Advert::class);
    }
}
