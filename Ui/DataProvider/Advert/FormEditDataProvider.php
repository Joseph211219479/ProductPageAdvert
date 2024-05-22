<?php

namespace Sozo\ProductPageAdvert\Ui\DataProvider\Advert;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Sozo\ProductPageAdvert\Api\AdvertRepositoryInterface;
use Sozo\ProductPageAdvert\Model\ResourceModel\Advert\CollectionFactory;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Element\UiComponent\DataProvider\DataProvider;
use Magento\Framework\Filesystem\Io\File;


class FormEditDataProvider extends AbstractDataProvider
{
    /**
     * @var
     */
    protected $loadedData;

    /**
     * @var RequestInterface
     */
    protected RequestInterface $request;

    /**
     * @var AdvertRepositoryInterface
     */
    protected AdvertRepositoryInterface $advertRepository;

    /**
     * @var File
     */
    protected File $file;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        RequestInterface $request,
        AdvertRepositoryInterface $advertRepository,
        File $file,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        $this->request = $request;
        $this->advertRepository = $advertRepository;
        $this->file = $file;

        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $advertId = $this->request->getParam('entity_id');

        if ($advertId) {

            $advert = $this->advertRepository->getById($advertId);

            $advertData = $advert->getData();
            if($advertData == null){
                return $this->loadedData;
            }

           // $this->loadedData[$advert->getId()] = $advert->getData();
            $this->loadedData[$advertId]['advert'] = $advert->getData();

            if($advert->getImagePath() !== ''){
                $file_path =  $advert->getImagePath();
                $pathInfo = $this->file->getPathInfo($file_path);


                if(!isset($pathInfo['extension'])){
                    //the data loaded is not a image
                    return $this->loadedData;
                }

         /*       $this->loadedData[$advertId]['advert']['imagePath'] = [
                    'url' => $file_path,
                    'name' => $pathInfo['basename'],
                    'type' => $pathInfo['extension'],
                    'size' => 3000,


                    'name' => 'pp.jpg',
                    'type' => 'image/jpeg',
                    'path' => '/var/www/html/websites/friendlychef/pub/media/pdpadvert/images',
                    'file' => '/p/p/pp.jpg',
                    'previewType' => 'image',
                    'imageDimensions' => [0 => 96, 1 => 96],
                    'id' => 'cHAuanBn'
                ];

                $this->loadedData[$advertId]['imagePath'] = [
                    'url' => $file_path,
                    'name' => $pathInfo['basename'],
                    'type' => $pathInfo['extension'],
                    'size' => 3000,


                    'name' => 'pp.jpg',
                    'type' => 'image/jpeg',
                    'path' => '/var/www/html/websites/friendlychef/pub/media/pdpadvert/images',
                    'file' => '/p/p/pp.jpg',
                    'previewType' => 'image',
                    'imageDimensions' => [0 => 96, 1 => 96],
                    'id' => 'cHAuanBn'
                ];

                $this->loadedData[$advertId]['advert']['imagePath'][0] = [
                    'url' => $file_path,
                    'name' => $pathInfo['basename'],
                    'type' => $pathInfo['extension'],
                    'size' => 3000,


                    'name' => 'pp.jpg',
                    'type' => 'image/jpeg',
                    'path' => '/var/www/html/websites/friendlychef/pub/media/pdpadvert/images',
                    'file' => '/p/p/pp.jpg',
                    'previewType' => 'image',
                    'imageDimensions' => [0 => 96, 1 => 96],
                    'id' => 'cHAuanBn'
                ];

                $this->loadedData['imagePath'] =[
                    'url' => $file_path,
                    'name' => $pathInfo['basename'],
                    'type' => $pathInfo['extension'],
                    'size' => 3000,


                    'name' => 'pp.jpg',
                    'type' => 'image/jpeg',
                    'path' => '/var/www/html/websites/friendlychef/pub/media/pdpadvert/images',
                    'file' => '/p/p/pp.jpg',
                    'previewType' => 'image',
                    'imageDimensions' => [0 => 96, 1 => 96],
                    'id' => 'cHAuanBn'
                ];

                $this->loadedData['advert']['imagePath'][0] = [
                    'url' => $file_path,
                    'name' => $pathInfo['basename'],
                    'type' => $pathInfo['extension'],
                    'size' => 3000,


                    'name' => 'pp.jpg',
                    'type' => 'image/jpeg',
                    'path' => '/var/www/html/websites/friendlychef/pub/media/pdpadvert/images',
                    'file' => '/p/p/pp.jpg',
                    'previewType' => 'image',
                    'imageDimensions' => [0 => 96, 1 => 96],
                    'id' => 'cHAuanBn'
                ];*/

             /*   $_FILES["advert"]['name']['imagePath'] = $pathInfo['basename'];
                $_FILES["advert"]['type']['imagePath'] =  $pathInfo['extension'];
                $_FILES["advert"]['tmp_name']['imagePath'] = '';
                $_FILES["advert"]['error']['imagePath'] = '';
                $_FILES["advert"]['size']['imagePath'] = 57671 ;
                $_FILES["advert"]['full_path']['imagePath'] = '';*/

                /*
                                results from image upload when creating ->
                [advert][imagePage][0]
                                name = 'pp.jpg'
                                type = 'image/jpeg'
                                tmp_name =
                                error
                                size
                                full_path
                                path = '/var/www/html/websites/friendlychef/pub/media/pdpadvert/images'
                                file = '/p/p/pp.jpg'
                                [imageDimensions][0] = 96
                                [imageDimensions][1] = 96
                                previewType = 'image'
                                id = 'cHAuanBn'
                */


            }
        }

        return $this->loadedData;
    }
}
