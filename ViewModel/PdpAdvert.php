<?php
namespace Sozo\ProductPageAdvert\ViewModel;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Sozo\ProductPageAdvert\Api\AdvertRepositoryInterface ;
use Sozo\ProductPageAdvert\Helper\Config;

class PdpAdvert implements ArgumentInterface
{
    /**
     * @var ProductRepositoryInterface
     */
    private ProductRepositoryInterface $productRepository;

    /**
     * @var Config
     */
    private Config $pdpAdvertConfig;

    /**
     * @var AdvertRepositoryInterface
     */
    protected AdvertRepositoryInterface $advertRepository;

    /**
     * @param ProductRepositoryInterface $productRepository
     * @param AdvertRepositoryInterface $advertRepository
     * @param Config $pdpAdvertConfig
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        AdvertRepositoryInterface $advertRepository,
        Config $pdpAdvertConfig
    ) {
        $this->productRepository = $productRepository;
        $this->advertRepository = $advertRepository;
        $this->pdpAdvertConfig = $pdpAdvertConfig;
    }

    /**
     * @param $productId
     * @return array
     */
    public function getProductPageAdvertData($productId)
    {
        try {
            $product = $this->productRepository->getById($productId);
        } catch (NoSuchEntityException $e) {

            return [];
        }
        $advertId = $product->getData('pdp_advert_id');

        if($advertId == '0'){
            return [];
        }

        $advert =  $this->advertRepository->getById($advertId);

        return [
            'heading' => $advert->getHeading(),
            'message' => $advert->getMessage(),
            'imagePath' => $advert->getImagePath(),
            'url_link' => $advert->getUrlLink()
        ];
    }

    /**
     * @return bool
     */
    public function isPdpAdvertsEnabled(){
        return $this->pdpAdvertConfig->isModuleEnabled();
    }
}
