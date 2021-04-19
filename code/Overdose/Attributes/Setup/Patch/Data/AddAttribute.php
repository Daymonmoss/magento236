<?php

namespace Overdose\Attributes\Setup\Patch\Data;

use Magento\Catalog\Model\Product;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Overdose\Attributes\Model\Attribute\Backend\Rating as Backend;
use Overdose\Attributes\Model\Attribute\Frontend\Rating as Frontend;

class AddAttribute implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory $eavSetupFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * @inheritdoc
     */
    public function apply()
    {
        $this->moduleDataSetup->startSetup();
        $eavSetup = $this->eavSetupFactory->create();
        $eavSetup->addAttribute(Product::ENTITY, 'overdose_product_rating', [
            'type' => 'decimal',
            'label' => 'Overdose Product Rating',
            'input' => 'text',
            'backend' => Backend::class,
            'frontend' => Frontend::class,
            "required" => false,
            'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
            'visible' => true,
            'is_used_in_grid' => true,
            'is_visible_in_grid' => true,
            'user_defined' => true,
            'searchable' => true,
            'filterable' => true,
            'filterable_in_search' => true,
            'is_filterable_in_grid' => true,
            'comparable' => true,
            'visible_on_front' => true,
            'used_in_product_listing' => true,
            'is_html_alowed_on_front' => true,
            'unique' => false
        ]);

        $eavSetup->addAttributeToGroup(
            Product::ENTITY,
            'Default',
            'Product Details',
            'overdose_product_rating',
            17
        );

        $eavSetup->addAttributeToGroup(
            Product::ENTITY,
            'Bottom',
            'Product Details',
            'overdose_product_rating',
            17
        );
        $this->moduleDataSetup->endSetup();
    }

    /**
     * @inheritdoc
     */
    public static function getDependencies(): array
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function getAliases(): array
    {
        return [];
    }
}
