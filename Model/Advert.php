<?php
namespace Sozo\ProductPageAdvert\Model;

use Magento\Framework\Model\AbstractModel;
use Sozo\ProductPageAdvert\Api\Data\AdvertInterface;

class Advert extends AbstractModel implements AdvertInterface
{
    protected function _construct()
    {
        $this->_init('Sozo\ProductPageAdvert\Model\ResourceModel\Advert');
    }

    /**
     * @return |string|null
     */
    public function getHeading()
    {
        return $this->getData(self::HEADING);
    }

    public function setHeading($heading)
    {
        $this->setData(self::HEADING, $heading);
    }

    public function getMessage()
    {
        return $this->getData(self::MESSAGE);

    }

    public function setMessage($message)
    {
        $this->setData(self::MESSAGE, $message);
    }

    public function getImagePath()
    {
        return $this->getData(self::IMAGE_PATH);
    }

    public function setImagePath($imagePath)
    {
        $this->setData(self::IMAGE_PATH, $imagePath);
    }

    public function getUrlLink()
    {
        return $this->getData(self::URL_LINK);
    }

    public function setUrlLink($url_link)
    {
        $this->setData(self::URL_LINK, $url_link);
    }

}
