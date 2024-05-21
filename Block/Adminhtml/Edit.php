<?php
namespace Sozo\ProductPageAdvert\Block\Adminhtml;

use Magento\Backend\Block\Template;

//todo delete , does not use it anymore.
class Edit extends Template
{
    protected $existingData;

    public function __construct(
        Template\Context $context,
        array $data = [],
        array $existingData = []
    ) {
        parent::__construct($context, $data);
        $this->existingData = $existingData;
    }

    public function getExistingData()
    {
        return $this->existingData;
    }
}
