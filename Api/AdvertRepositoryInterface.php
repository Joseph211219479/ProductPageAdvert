<?php
namespace Joseph\ProductPageAdvert\Api;

use Joseph\ProductPageAdvert\Api\Data\AdvertInterface;

interface AdvertRepositoryInterface
{
    /**
     * Get advert by ID
     *
     * @param int $advertId
     * @return AdvertInterface
     */
    public function getById($advertId);

    /**
     * Save advert
     *
     * @param AdvertInterface $advert
     * @return AdvertInterface
     */
    public function save(AdvertInterface $advert);

    /**
     * Delete advert
     *
     * @param AdvertInterface $advert
     * @return void
     */
    public function delete(AdvertInterface $advert);
}
