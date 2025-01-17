<?php
namespace Joseph\ProductPageAdvert\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Advert extends AbstractDb
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('joseph_pdp_advert', 'entity_id');
    }
}
