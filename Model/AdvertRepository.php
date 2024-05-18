<?php
namespace Sozo\ProductPageAdvert\Model;

use Sozo\ProductPageAdvert\Api\AdvertRepositoryInterface;
use Sozo\ProductPageAdvert\Model\ResourceModel\Advert as AdvertResource;
use Sozo\ProductPageAdvert\Model\AdvertFactory;
use Sozo\ProductPageAdvert\Api\Data\AdvertInterface;
use Sozo\ProductPageAdvert\Model\ResourceModel\Advert\CollectionFactory;

class AdvertRepository implements AdvertRepositoryInterface
{
    protected $advertResource;
    protected $advertFactory;
    protected $advertCollectionFactory;

    public function __construct(
        AdvertResource $advertResource,
        AdvertFactory $advertFactory,
        CollectionFactory $advertCollectionFactory
    ) {
        $this->advertResource = $advertResource;
        $this->advertFactory = $advertFactory;
        $this->advertCollectionFactory = $advertCollectionFactory;
    }

    public function getById($advertId)
    {
        $advert = $this->advertFactory->create();
        $this->advertResource->load($advert, $advertId);
        return $advert;
    }

    public function save(AdvertInterface $advert)
    {
        $this->advertResource->save($advert);
        return $advert;
    }

    public function delete(AdvertInterface $advert)
    {
        $this->advertResource->delete($advert);
    }

    public function getList()
    {
        return $this->advertCollectionFactory->create()->getItems();
    }
}
