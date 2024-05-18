<?php
namespace Sozo\ProductPageAdvert\Api;

use Sozo\ProductPageAdvert\Api\Data\AdvertInterface;

interface AdvertRepositoryInterface
{
    /**
     * Get advert by ID
     *
     * @param int $advertId
     * @return \Sozo\ProductPageAdvert\Api\Data\AdvertInterface
     */
    public function getById($advertId);

    /**
     * Save advert
     *
     * @param \Sozo\ProductPageAdvert\Api\Data\AdvertInterface $advert
     * @return \Sozo\ProductPageAdvert\Api\Data\AdvertInterface
     */
    public function save(AdvertInterface $advert);

    /**
     * Delete advert
     *
     * @param \Sozo\ProductPageAdvert\Api\Data\AdvertInterface $advert
     * @return void
     */
    public function delete(AdvertInterface $advert);
}
