<?php
namespace Joseph\ProductPageAdvert\Api\Data;

interface AdvertInterface
{
    const ADVERT_ID = 'entity_id';
    const HEADING = 'heading';
    const MESSAGE = 'message';
    const IMAGE_PATH = 'imagePath';
    const URL_LINK = 'url_link';

    /**
     * Get Advert ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Set Advert ID
     *
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * Get Advert Heading
     *
     * @return string|null
     */
    public function getHeading();

    /**
     * Set Advert Heading
     *
     * @param string $heading
     * @return $this
     */
    public function setHeading($heading);

    /**
     * Get Advert Message
     *
     * @return string|null
     */
    public function getMessage();

    /**
     * Set Advert Message
     *
     * @param string $message
     * @return $this
     */
    public function setMessage($message);


    /**
     * @return mixed
     */
    public function getImagePath();

    /**
     * @param $imagePath
     * @return mixed
     */
    public function setImagePath($imagePath);

    /**
     * @return mixed
     */
    public function getUrlLink();

    /**
     * @param $url_link
     * @return mixed
     */
    public function setUrlLink($url_link);

}
