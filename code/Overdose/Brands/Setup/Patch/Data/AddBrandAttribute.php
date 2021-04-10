<?php

namespace Overdose\Brands\Setup\Patch\Data;

use Magento\Catalog\Model\Product;
use Magento\Eav\Model\Entity\Attribute\Source\Table;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Eav\Model\Entity\Attribute\OptionLabel;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Overdose\Brands\Model\Attribute\Backend\Brand as Backend;
use Overdose\Brands\Model\Attribute\Frontend\Brand as Frontend;
use Overdose\Brands\Model\Attribute\Source\Brand as Source;

class AddBrandAttribute implements DataPatchInterface
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
        $eavSetup->addAttribute(Product::ENTITY, 'overdose_brand', [
            'type' => 'varchar',
            'label' => 'Overdose Product Brand',
            'input' => 'select',
            'frontend' => Frontend::class,
            'backend' => Backend::class,
            'source' => Source::class,
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
            'unique' => true
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
            'overdose_brand',
            19
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
