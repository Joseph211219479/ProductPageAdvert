<?php
namespace Sozo\ProductPageAdvert\Model;

use Sozo\ProductPageAdvert\Api\AdvertRepositoryInterface;
use Sozo\ProductPageAdvert\Model\ResourceModel\Advert as AdvertResource;
use Sozo\ProductPageAdvert\Api\Data\AdvertInterface;
use Sozo\ProductPageAdvert\Model\ResourceModel\Advert\CollectionFactory;

class AdvertRepository implements AdvertRepositoryInterface
{
    /**
     * @var AdvertResource
     */
    protected AdvertResource $advertResource;

    /**
     * @var AdvertFactory
     */
    protected AdvertFactory $advertFactory;

    /**
     * @var CollectionFactory
     */
    protected CollectionFactory $advertCollectionFactory;

    /**
     * @param AdvertResource $advertResource
     * @param AdvertFactory $advertFactory
     * @param CollectionFactory $advertCollectionFactory
     */
    public function __construct(
        AdvertResource $advertResource,
        AdvertFactory $advertFactory,
        CollectionFactory $advertCollectionFactory
    ) {
        $this->advertResource = $advertResource;
        $this->advertFactory = $advertFactory;
        $this->advertCollectionFactory = $advertCollectionFactory;
    }

    /**
     * @param $advertId
     * @return AdvertInterface
     */
    public function getById($advertId)
    {
        $advert = $this->advertFactory->create();
        $this->advertResource->load($advert, $advertId);
        return $advert;
    }

    /**
     * @param AdvertInterface $advert
     * @return AdvertInterface
     */
    public function save(AdvertInterface $advert)
    {
        try {
            $this->advertResource->save($advert);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $advert;
    }

    /**
     * @param AdvertInterface $advert
     * @return void
     * @throws \Exception
     */
    public function delete(AdvertInterface $advert)
    {
        $this->advertResource->delete($advert);
    }

    /**
     * @return \Magento\Framework\Api\ExtensibleDataInterface[]
     */
    public function getList()
    {
        return $this->advertCollectionFactory->create()->getItems();
    }
}
