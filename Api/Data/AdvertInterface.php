<?php
namespace Sozo\ProductPageAdvert\Api\Data;

interface AdvertInterface
{
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

}
