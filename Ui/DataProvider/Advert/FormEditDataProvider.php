<?php

namespace Joseph\ProductPageAdvert\Ui\DataProvider\Advert;

use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\ReportingInterface;
use Magento\Framework\Api\Search\SearchCriteria;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;
use Magento\Framework\Api\Search\SearchResultInterface;
use Magento\Framework\View\Element\UiComponent\DataProvider\DataProviderInterface;
use Joseph\ProductPageAdvert\Api\AdvertRepositoryInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Filesystem\Io\File;

class FormEditDataProvider implements  DataProviderInterface
{
    /**
     * Data Provider name
     *
     * @var string
     */
    protected $name;

    /**
     * Data Provider Primary Identifier name
     *
     * @var string
     */
    protected $primaryFieldName;

    /**
     * Data Provider Request Parameter Identifier name
     *
     * @var string
     */
    protected $requestFieldName;

    /**
     * @var array
     */
    protected $meta = [];

    /**
     * Provider configuration data
     *
     * @var array
     */
    protected $data = [];

    /**
     * @var ReportingInterface
     */
    protected $reporting;

    /**
     * @var FilterBuilder
     */
    protected $filterBuilder;

    /**
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var SearchCriteria
     */
    protected $searchCriteria;
    /**
     * @var
     */
    protected $loadedData;

    /**
     * @var AdvertRepositoryInterface
     */
    protected AdvertRepositoryInterface $advertRepository;

    /**
     * @var File
     */
    protected File $file;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param ReportingInterface $reporting
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param RequestInterface $request
     * @param FilterBuilder $filterBuilder
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        ReportingInterface $reporting,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        RequestInterface $request,
        FilterBuilder $filterBuilder,
        AdvertRepositoryInterface $advertRepository,
        File $file,

        array $meta = [],
        array $data = []
    ) {
        $this->request = $request;
        $this->filterBuilder = $filterBuilder;
        $this->name = $name;
        $this->primaryFieldName = $primaryFieldName;
        $this->requestFieldName = $requestFieldName;
        $this->reporting = $reporting;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->meta = $meta;
        $this->data = $data;
        $this->advertRepository = $advertRepository;
        $this->file = $file;


        $this->prepareUpdateUrl();
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

            $this->loadedData[$advertId]['advert'] = $advert->getData();

            if($advert->getImagePath() !== '' && $advert->getImagePath() !== null ){
                $file_path =  $advert->getImagePath();
                $pathInfo = $this->file->getPathInfo($file_path);


                if(!isset($pathInfo['extension'])){
                    //the data loaded is not a image
                    return $this->loadedData;
                }

                 $imageData = getimagesize($file_path);

                $image = [];
                $image[0]['name'] = $pathInfo['basename'];
                $image[0]['url']  = $file_path;
                $image[0]['previewType']  = 'image';
                $image[0]['type']  = $imageData['mime'];
                $image[0]['size']  = $imageData['bits'];

                $this->loadedData[$advertId]['advert']['imagePath'] = $image;
            }
        }else{
            $image = [];
            $image[0]['name'] ;
            $image[0]['url'] ;
            $image[0]['previewType']  ;
            $image[0]['type']  ;
            $image[0]['size']  ;

            $this->loadedData[$advertId]['advert']['imagePath'] = $image;
        }

        return $this->loadedData;
    }

    /**
     * @return void
     */
    protected function prepareUpdateUrl()
    {
        if (!isset($this->data['config']['filter_url_params'])) {
            return;
        }
        foreach ($this->data['config']['filter_url_params'] as $paramName => $paramValue) {
            if ('*' == $paramValue) {
                $paramValue = $this->request->getParam($paramName);
            }
            if ($paramValue) {
                $this->data['config']['update_url'] = sprintf(
                    '%s%s/%s/',
                    $this->data['config']['update_url'],
                    $paramName,
                    $paramValue
                );
                $this->addFilter(
                    $this->filterBuilder->setField($paramName)->setValue($paramValue)->setConditionType('eq')->create()
                );
            }
        }
    }

    /**
     * Get Data Provider name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get primary field name
     *
     * @return string
     */
    public function getPrimaryFieldName()
    {
        return $this->primaryFieldName;
    }

    /**
     * Get field name in request
     *
     * @return string
     */
    public function getRequestFieldName()
    {
        return $this->requestFieldName;
    }

    /**
     * @return array
     */
    public function getMeta()
    {
        return $this->meta;
    }

    /**
     * Get field Set meta info
     *
     * @param string $fieldSetName
     * @return array
     */
    public function getFieldSetMetaInfo($fieldSetName)
    {
        return $this->meta[$fieldSetName] ?? [];
    }

    /**
     * @param string $fieldSetName
     * @return array
     */
    public function getFieldsMetaInfo($fieldSetName)
    {
        return $this->meta[$fieldSetName]['children'] ?? [];
    }

    /**
     * @param string $fieldSetName
     * @param string $fieldName
     * @return array
     */
    public function getFieldMetaInfo($fieldSetName, $fieldName)
    {
        return $this->meta[$fieldSetName]['children'][$fieldName] ?? [];
    }

    /**
     * @inheritdoc
     */
    public function addFilter(\Magento\Framework\Api\Filter $filter)
    {
        $this->searchCriteriaBuilder->addFilter($filter);
    }

    /**
     * self::setOrder() alias
     *
     * @param string $field
     * @param string $direction
     * @return void
     */
    public function addOrder($field, $direction)
    {
        $this->searchCriteriaBuilder->addSortOrder($field, $direction);
    }

    /**
     * Set Query limit
     *
     * @param int $offset
     * @param int $size
     * @return void
     */
    public function setLimit($offset, $size)
    {
        $this->searchCriteriaBuilder->setPageSize($size);
        $this->searchCriteriaBuilder->setCurrentPage($offset);
    }

    /**
     * @param SearchResultInterface $searchResult
     * @return array
     */
    protected function searchResultToOutput(SearchResultInterface $searchResult)
    {
        $arrItems = [];

        $arrItems['items'] = [];
        foreach ($searchResult->getItems() as $item) {
            $itemData = [];
            foreach ($item->getCustomAttributes() as $attribute) {
                $itemData[$attribute->getAttributeCode()] = $attribute->getValue();
            }
            $arrItems['items'][] = $itemData;
        }

        $arrItems['totalRecords'] = $searchResult->getTotalCount();

        return $arrItems;
    }

    /**
     * Returns search criteria
     *
     * @return \Magento\Framework\Api\Search\SearchCriteria
     */
    public function getSearchCriteria()
    {
        if (!$this->searchCriteria) {
            $this->searchCriteria = $this->searchCriteriaBuilder->create();
            $this->searchCriteria->setRequestName($this->name);
        }
        return $this->searchCriteria;
    }

    /**
     * Get config data
     *
     * @return array
     */
    public function getConfigData()
    {
        return $this->data['config'] ?? [];
    }

    /**
     * Set data
     *
     * @param mixed $config
     * @return void
     */
    public function setConfigData($config)
    {
        $this->data['config'] = $config;
    }

    /**
     * Returns Search result
     *
     * @return SearchResultInterface
     */
    public function getSearchResult()
    {
        return $this->reporting->search($this->getSearchCriteria());
    }
}
