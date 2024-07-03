<?php
namespace Joseph\ProductPageAdvert\Model;

use Magento\Framework\Model\AbstractModel;
use Joseph\ProductPageAdvert\Api\Data\AdvertInterface;

class Advert extends AbstractModel implements AdvertInterface
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Joseph\ProductPageAdvert\Model\ResourceModel\Advert');
    }

    /**
     * @return |string|null
     */
    public function getHeading()
    {
        return $this->getData(self::HEADING);
    }

    /**
     * @param $heading
     * @return Advert|void
     */
    public function setHeading($heading)
    {
        $this->setData(self::HEADING, $heading);
    }

    /**
     * @return array|mixed|string|null
     */
    public function getMessage()
    {
        return $this->getData(self::MESSAGE);

    }

    /**
     * @param $message
     * @return Advert|void
     */
    public function setMessage($message)
    {
        $this->setData(self::MESSAGE, $message);
    }

    /**
     * @return array|mixed|null
     */
    public function getImagePath()
    {
        return $this->getData(self::IMAGE_PATH);
    }

    /**
     * @param $imagePath
     * @return mixed|void
     */
    public function setImagePath($imagePath)
    {
        $this->setData(self::IMAGE_PATH, $imagePath);
    }

    /**
     * @return array|mixed|null
     */
    public function getUrlLink()
    {
        return $this->getData(self::URL_LINK);
    }

    /**
     * @param $url_link
     * @return mixed|void
     */
    public function setUrlLink($url_link)
    {
        $this->setData(self::URL_LINK, $url_link);
    }

}
