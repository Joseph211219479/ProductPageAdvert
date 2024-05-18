<?php
namespace Sozo\ProductPageAdvert\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Advert extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('sozo_pdp_advert', 'entity_id');
    }
}
