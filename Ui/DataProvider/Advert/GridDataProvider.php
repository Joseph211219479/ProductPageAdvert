<?php
namespace Sozo\ProductPageAdvert\Ui\DataProvider\Advert;

use Magento\Framework\View\Element\UiComponent\DataProvider\DataProvider;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\View\Element\UiComponent\DataProvider\ReportingFactory;

//todo delete, dont need it anymore, using virtual types
class GridDataProvider extends DataProvider
{
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        ReportingFactory $reportingFactory,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        FilterBuilder $filterBuilder,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $reportingFactory->create(),
            $searchCriteriaBuilder,
            $filterBuilder,
            $meta,
            $data
        );
    }

    public function getData()
    {
        if (!$this->getCollection()->isLoaded()) {
            $this->getCollection()->load();
        }
        return $this->getCollection()->toArray();
    }

}
