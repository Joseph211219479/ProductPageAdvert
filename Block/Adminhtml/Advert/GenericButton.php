<?php

namespace Sozo\ProductPageAdvert\Block\Adminhtml\Advert;

use Magento\Backend\Block\Widget\Context;

class GenericButton
{
    protected $context;

    public function __construct(Context $context)
    {
        $this->context = $context;
    }

    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }

    public function getAdvertId()
    {
        return $this->context->getRequest()->getParam('id');
    }
}
