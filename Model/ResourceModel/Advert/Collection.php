<?php
namespace Joseph\ProductPageAdvert\Model\ResourceModel\Advert;

use Magento\Framework\Api\Search\SearchResultInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Joseph\ProductPageAdvert\Model\Advert;
use Joseph\ProductPageAdvert\Model\ResourceModel\Advert as AdvertResource;

class Collection extends AbstractCollection implements SearchResultInterface
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(Advert::class, AdvertResource::class);
    }

    /**
     * @return \Magento\Framework\Api\Search\SearchCriteriaInterface|SearchCriteriaInterface|null
     */
    public function getSearchCriteria()
    {
        return $this->_searchCriteria;
    }

    /**
     * @param SearchCriteriaInterface|null $searchCriteria
     * @return $this|Collection
     */
    public function setSearchCriteria(SearchCriteriaInterface $searchCriteria = null)
    {
        $this->_searchCriteria = $searchCriteria;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalCount()
    {
        return $this->getSize();
    }

    /**
     * @param $totalCount
     * @return $this|Collection
     */
    public function setTotalCount($totalCount)
    {
        $this->_totalRecords = $totalCount;
        return $this;
    }

    /**
     * @param array|null $items
     * @return $this|Collection
     * @throws \Exception
     */
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
