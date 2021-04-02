<?php

namespace Overdose\Attributes\Setup\Patch\Data;

use Magento\Catalog\Model\Product;
use Magento\Eav\Model\Entity\Attribute\Source\Table;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Eav\Model\Entity\Attribute\OptionLabel;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Overdose\Attributes\Model\Attribute\Backend\Color as Backend;
use Overdose\Attributes\Model\Attribute\Frontend\Color as Frontend;
//use Overdose\Attributes\Model\Attribute\Source\Color as Source;

class AddColorAttribute implements DataPatchInterface
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
     * @var OptionLabel
     */
    private $optionLabelFactory;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param EavSetupFactory $eavSetupFactory
     * @param OptionLabel $optionLabelFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory $eavSetupFactory,
        OptionLabel $optionLabelFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
        $this->optionLabelFactory = $optionLabelFactory;
    }

    /**
     * @inheritdoc
     */
    public function apply()
    {
        $this->moduleDataSetup->startSetup();
        $eavSetup = $this->eavSetupFactory->create();
        $eavSetup->addAttribute(Product::ENTITY, 'overdose_color', [
            'type' => 'int',
            'label' => 'Overdose Product Color',
            'input' => 'select',
            'frontend' => Frontend::class,
            'backend' => Backend::class,
            'source' => Table::class,
            'required' => false,
            'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
            'visible' => true,
            'is_used_in_grid' => true,
            'is_visible_in_grid' => true,
            'is_filterable_in_grid' => true,
            'user_defined' => true,
            'searchable' => true,
            'filterable' => true,
            'comparable' => true,
            'visible_on_front' => true,
            'used_in_product_listing' => true,
            'is_html_alowed_on_front' => true,
            'unique' => false,
            'option' => ['values' => ['Obsidian', 'Pure', 'Crimson', 'Emerald', 'Ametyst']],
            'default' => '1'
        ]);

//        $optionLabel = $this->optionLabelFactory->create();
//        $optionLabel->setStoreId(0);
//        $optionLabel->setLabel($label);
//
//        $option = $this->optionFactory->create();
//        $option->setLabel($optionLabel);
//        $option->setStoreLabels([$optionLabel]);
//        $option->setSortOrder(0);
//        $option->setIsDefault(true);
//
//        $this->attributeOptionManagement->add(
//            \Magento\Catalog\Model\Product::ENTITY,
//            $this->getAttribute('overdose_color')->getAttributeId(),
//            $option
//        );

        $eavSetup->addAttributeToGroup(
            \Magento\Catalog\Model\Product::ENTITY,
            'Default',
            'Product Details',
            'overdose_color',
            18
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
