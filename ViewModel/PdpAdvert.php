<?php
namespace Sozo\ProductPageAdvert\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Sozo\ProductPageAdvert\Api\AdvertRepositoryInterface ;
use Sozo\ProductPageAdvert\Helper\Config;


//todo create model to do the tasks.

class PdpAdvert implements ArgumentInterface
{

    private $productRepository;
    private $pdpAdvertConfig;

    /**
     * @var AdvertRepositoryInterface
     */
    protected AdvertRepositoryInterface $advertRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        AdvertRepositoryInterface $advertRepository,
        Config $pdpAdvertConfig
    ) {
        $this->productRepository = $productRepository;
        $this->advertRepository = $advertRepository;
        $this->pdpAdvertConfig = $pdpAdvertConfig;
    }

    public function getProductPageAdvertData($productId)
    {
        $product = $this->productRepository->getById($productId);
        $advertId = $product->getData('pdp_advert_id');

        if($advertId == '0'){
            return [];
        }

        $advert =  $this->advertRepository->getById($advertId);

        return [
            'heading' => $advert->getHeading(),
            'message' => $advert->getMessage(),
            'image_path' => $advert->getImagePath(),
            'url_link' => $advert->getUrlLink()
        ];

    }


    public function getProductPageAdvertList()
    {
        //todo might not need this
    }

    public function isPdpAdvertsEnabled(){
        return $this->pdpAdvertConfig->isModuleEnabled();
    }
}
