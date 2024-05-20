<?php
namespace Sozo\ProductPageAdvert\Block\Adminhtml\Advert;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class DeleteButton
 */
class DeleteButton extends GenericButton  implements ButtonProviderInterface
{
    public function getButtonData()
    {
        return [
            'label' => __('Delete Advert'),
            'class' => 'delete',
            'on_click' => 'deleteConfirm(\'' . __(
                    'Are you sure you want to do this?'
                ) . '\', \'' . $this->getDeleteUrl() . '\')',
            'sort_order' => 20,
        ];
    }

    public function getDeleteUrl()
    {
        return $this->getUrl('*/*/delete', ['id' => $this->getAdvertId()]);
    }
}