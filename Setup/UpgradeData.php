<?php


namespace Sozo\ProductPageAdvert\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Catalog\Model\Product;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;


class UpgradeData implements UpgradeDataInterface
{
    /**
     * Target module version for this upgrade script
     */
    const TARGET_VERSION = '0.0.2';

    /**
     * @var EavSetup
     */
    private $eavSetup;

    public function __construct(
        EavSetup $eavSetup
    )
    {
        $this->eavSetup = $eavSetup;
    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), self::TARGET_VERSION, '<')) {
            $this->addPdpAdvertIdAttribute($setup);
        }

        $setup->endSetup();
    }

    /**
     * @return void
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Validator\ValidateException
     */
    private function addPdpAdvertIdAttribute()
    {
        $this->eavSetup->addAttribute(
            Product::ENTITY,
            'pdp_advert_id',
            [
                'type' => 'int',
                'label' => 'PDP Advert Id',
                'input' => 'text',
                'required' => false,
                'sort_order' => 50,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                'group' => 'General',
                'visible' => true,
                'user_defined' => true,
                'is_unique' => false,
                'frontend_class' => 'validate-number',
            ]
        );
    }

}
