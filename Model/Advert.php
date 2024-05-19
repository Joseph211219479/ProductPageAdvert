<?php
namespace Sozo\ProductPageAdvert\Model;

use Magento\Framework\Model\AbstractModel;
use Sozo\ProductPageAdvert\Model\ResourceModel\Advert as AdvertResourceModel;
use Sozo\ProductPageAdvert\Api\Data\AdvertInterface;

class Advert extends AbstractModel implements AdvertInterface
{
    protected function _construct()
    {
        $this->_init(AdvertResourceModel::class);
    }

    public function getHeading()
    {
        // TODO: Implement getHeading() method.
    }

    public function setHeading($heading)
    {
        // TODO: Implement setHeading() method.
    }

    public function getMessage()
    {
        // TODO: Implement getMessage() method.
    }

    public function setMessage($message)
    {
        // TODO: Implement setMessage() method.
    }
}
