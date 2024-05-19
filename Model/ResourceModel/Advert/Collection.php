<?php
namespace Sozo\ProductPageAdvert\Model\ResourceModel\Advert;

use Magento\Framework\Api\Search\SearchResultInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Sozo\ProductPageAdvert\Model\Advert;
use Sozo\ProductPageAdvert\Model\ResourceModel\Advert as AdvertResource;

class Collection extends AbstractCollection implements SearchResultInterface
{


    protected function _construct()
    {
        $this->_init(Advert::class, AdvertResource::class);
    }

    public function getSearchCriteria()
    {
        return $this->_searchCriteria;
    }

    public function setSearchCriteria(SearchCriteriaInterface $searchCriteria = null)
    {
        $this->_searchCriteria = $searchCriteria;
        return $this;
    }

    public function getTotalCount()
    {
        return $this->getSize();
    }

    public function setTotalCount($totalCount)
    {
        $this->_totalRecords = $totalCount;
        return $this;
    }

    public function setItems(array $items = null)
    {
        $this->clear();
        if (is_array($items)) {
            foreach ($items as $item) {
                $this->addItem($item);
            }
        }
        return $this;
    }

    /**
     * Get items
     *
     * @return \Magento\Framework\Api\ExtensibleDataInterface[]
     */
    public function getItems()
    {
        return $this->_items;
    }

    /**
     * @return \Magento\Framework\Api\Search\AggregationInterface
     */
    public function getAggregations()
    {
        return $this->aggregations;
    }

    /**
     * Set aggregations
     *
     * @param \Magento\Framework\Api\Search\AggregationInterface $aggregations
     * @return $this
     */
    public function setAggregations($aggregations)
    {
        $this->aggregations = $aggregations;
        return $this;
    }
}
