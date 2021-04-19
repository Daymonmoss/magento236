<?php

namespace Overdose\Attributes\Setup\Patch\Data;

use Magento\Framework\Setup;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Overdose\Attributes\Setup\SwatchesInstaller;


class AddColorAttribute implements DataPatchInterface
{
    /**
     * @var Setup\SampleData\Executor
     */
    protected $executor;

    /**
     * @var SwatchesInstaller
     */
    protected $installer;

    /**
     * InstallSwatchesSampleData constructor.
     * @param Setup\SampleData\Executor $executor
     * @param SwatchesInstaller $installer
     */
    public function __construct(
        Setup\SampleData\Executor $executor,
        SwatchesInstaller $installer
    ) {
        $this->executor = $executor;
        $this->installer = $installer;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        $this->executor->exec($this->installer);
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}
//namespace Overdose\Attributes\Setup\Patch\Data;
//
//use Magento\Catalog\Model\Product;
//use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
//use Magento\Eav\Model\Entity\Attribute\Source\Table;
//use Magento\Eav\Setup\EavSetupFactory;
//use Magento\Catalog\Model\ResourceModel\Eav\AttributeFactory;
//use Magento\Catalog\Api\ProductAttributeRepositoryInterface;
//use Magento\Framework\Setup\ModuleDataSetupInterface;
//use Magento\Framework\Setup\Patch\DataPatchInterface;
////use Magento\Swatches\Model\Swatch;
//use Overdose\Attributes\Model\Attribute\Backend\Color as Backend;
//use Overdose\Attributes\Model\Attribute\Frontend\Color as Frontend;
//
////use Magento\Swatches\Model\Swatch;
////use Overdose\Attributes\Model\Attribute\Source\Color as Source;
//
//class AddColorAttribute implements DataPatchInterface
//{
//    /**
//     * @var ModuleDataSetupInterface
//     */
//    private $moduleDataSetup;
//
//    /**
//     * @var EavSetupFactory
//     */
//    private $eavSetupFactory;
//
//    /**
//     * @var AttributeFactory
//     */
//    private $attributeFactory;
//
//    /**
//     * @var ProductAttributeRepositoryInterface
//     */
//    private $attributeRepository;
//
//    /**
//     * @param ModuleDataSetupInterface $moduleDataSetup
//     * @param EavSetupFactory $eavSetupFactory
//     * @param AttributeFactory $attributeFactory
//     * @param ProductAttributeRepositoryInterface $attributeRepository
//     */
//    public function __construct(
//        ModuleDataSetupInterface $moduleDataSetup,
//        EavSetupFactory $eavSetupFactory,
//        AttributeFactory $attributeFactory,
//        ProductAttributeRepositoryInterface $attributeRepository
//    ) {
//        $this->moduleDataSetup = $moduleDataSetup;
//        $this->eavSetupFactory = $eavSetupFactory;
//        $this->attributeFactory = $attributeFactory;
//        $this->attributeRepository = $attributeRepository;
//    }
//
//    /**
//     * @inheritdoc
//     */
//    public function apply()
//    {
//        $this->moduleDataSetup->startSetup();
//        $eavSetup = $this->eavSetupFactory->create();
////        $eavSetup->addAttribute(Product::ENTITY, 'overdose_color', [
////            'type' => 'int',
////            'label' => 'Overdose Product Color',
////            'input' => 'select',
////            'frontend' => Frontend::class,
////            'backend' => Backend::class,
////            'source' => Table::class,
////            'required' => false,
////            'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
////            'visible' => true,
////            'is_used_in_grid' => true,
////            'is_visible_in_grid' => true,
////            'user_defined' => true,
////            'searchable' => true,
////            'filterable' => true,
////            'filterable_in_search' => true,
////            'is_filterable_in_grid' => true,
////            'comparable' => true,
////            'visible_on_front' => true,
////            'used_in_product_listing' => true,
////            'is_html_alowed_on_front' => true,
////            'unique' => false,
////            'used_for_sort_by' => false,
////            'swatch_input_type' => 'visual',
////            'swatching' => [
////                'value' => [
////                    'option_1' => '#3a322d',
////                    'option_2' => '#dc143c',
////                    'option_3' => '#50c878',
////                    'option_4' => '#9966cc',
////                    'option_5' => '#0000ff'
////                ],
////            ],
////            'optionals' => [
////                'value' => [
////                    'option_1' => ['Obsidian'],
////                    'option_2' => ['Crimson'],
////                    'option_3' => ['Emerald'],
////                    'option_4' => ['Amethyst'],
////                    'option_5' => ['Pure']
////                ],
////            ],
////            'options' => [
////                'option' => [
////                    ['label' => 'Obsidian', 'value' => 'option_1'],
////                    ['label' => 'Crimson', 'value' => 'option_2'],
////                    ['label' => 'Emerald', 'value' => 'option_3'],
////                    ['label' => 'Amethyst', 'value' => 'option_4'],
////                    ['label' => 'Pure', 'value' => 'option_5'],
////                ],
////            ],
////            'swatchvisual' => ['values' => ['#3a322d', '#0000ff', '#dc143c', '#50c878', '#9966cc']],
////            'optionvisual' => ['values' => ['Obsidian', 'Pure', 'Crimson', 'Emerald', 'Ametyst']],
////            'option' => ['values' => ['Obsidian', 'Pure', 'Crimson', 'Emerald', 'Ametyst']],
////            'default' => '1'
////        ]);
//        if (!$attributeFactory->loadByCode($entityType, 'visual_swatch_attribute')->getAttributeId()) {
//            $attributeFactory->setData(
//                [
//                    'frontend_label' => ['Visual swatch attribute'],
//                    'entity_type_id' => ProductAttributeInterface::ENTITY_TYPE_CODE,
//                    'frontend_input' => 'select',
//                    'backend_type' => 'int',
//                    'is_required' => '0',
//                    'attribute_code' => 'visual_swatch_attribute',
//                    'is_global' => '1',
//                    'is_user_defined' => 1,
//                    'is_unique' => '0',
//                    'is_searchable' => '0',
//                    'is_comparable' => '0',
//                    'is_filterable' => '1',
//                    'is_filterable_in_search' => '0',
//                    'is_used_for_promo_rules' => '0',
//                    'is_html_allowed_on_front' => '1',
//                    'used_in_product_listing' => '1',
//                    'used_for_sort_by' => '0',
//                    'swatch_input_type' => 'visual',
//                    'swatchvisual' => [
//                        'value' => [
//                            'option_1' => '#555555',
//                            'option_2' => '#aaaaaa',
//                            'option_3' => '#ffffff',
//                        ],
//                    ],
//                    'optionvisual' => [
//                        'value' => [
//                            'option_1' => ['option 1'],
//                            'option_2' => ['option 2'],
//                            'option_3' => ['option 3']
//                        ],
//                    ],
//                    'options' => [
//                        'option' => [
//                            ['label' => 'Option 1', 'value' => 'option_1'],
//                            ['label' => 'Option 2', 'value' => 'option_2'],
//                            ['label' => 'Option 3', 'value' => 'option_3'],
//                        ],
//                    ],
//                ]
//            );
//            $attributeRepository->save($attribute);
//
//            $eavSetup->addAttributeToGroup(
//            Product::ENTITY,
//            'Default',
//            'Product Details',
//            'overdose_color',
//            18
//        );
//
//            $eavSetup->addAttributeToGroup(
//            Product::ENTITY,
//            'Bottom',
//            'Product Details',
//            'overdose_color',
//            18
//        );
//            $this->moduleDataSetup->endSetup();
//        }
//    }
//
//    /**
//     * @inheritdoc
//     */
//    public static function getDependencies(): array
//    {
//        return [];
//    }
//
//    /**
//     * @inheritdoc
//     */
//    public function getAliases(): array
//    {
//        return [];
//    }
//}

//namespace Overdose\Brands\Setup\Patch\Data;
//
//use Magento\Catalog\Model\Product;
//use Magento\Catalog\Model\Product\Type;
//use Magento\Catalog\Model\ResourceModel\Eav\Attribute as eavAttribute;
//use Magento\Eav\Model\Config;
//use Magento\Eav\Model\ResourceModel\Entity\Attribute\Option\CollectionFactory;
//use Magento\Eav\Setup\EavSetupFactory;
//use Magento\Framework\Setup\ModuleDataSetupInterface;
//use Magento\Framework\Setup\Patch\DataPatchInterface;
//
//class AddColorAttribute implements DataPatchInterface
//{
//    /**
//     * @var ModuleDataSetupInterface
//     */
//    private $moduleDataSetup;
//
//    /**
//     * @var EavSetupFactory
//     */
//    private $eavSetupFactory;
//
//    /**
//     * @var CollectionFactory
//     */
//    private $attrOptionCollectionFactory;
//
//    /**
//     * @var Config
//     */
//    private $eavConfig;
//
//    protected $colorMap = [
//        'Obsidian' => '#3a322d',
//        'Crimson' => '#dc143c',
//        'Emerald' => '#50c878',
//        'Ametyst' => '#9966cc',
//        'Pure' => '#0000ff',
//    ];
//
//    /**
//     * @param ModuleDataSetupInterface $moduleDataSetup
//     * @param Config $eavConfig
//     * @param EavSetupFactory $eavSetupFactory
//     * @param CollectionFactory $attrOptionCollectionFactory
//     */
//    public function __construct(
//        ModuleDataSetupInterface $moduleDataSetup,
//        EavSetupFactory $eavSetupFactory,
//        Config $eavConfig,
//        CollectionFactory $attrOptionCollectionFactory
//    ) {
//        $this->moduleDataSetup = $moduleDataSetup;
//        $this->eavConfig = $eavConfig;
//        $this->eavSetupFactory = $eavSetupFactory;
//        $this->attrOptionCollectionFactory = $attrOptionCollectionFactory;
//    }
//
//    public function apply()
//    {
//        $this->moduleDataSetup->startSetup();
//        $eavSetup = $this->eavSetupFactory->create();
//
//        $eavSetup->addAttribute(
//            Product::ENTITY,
//            'overdose_color',
//            [
//                    'type' => 'int',
//                    'label' => 'Overdose Product Color',
//                    'input' => 'select',
//                    'required' => false,
//                    'user_defined' => true,
//                    'searchable' => true,
//                    'filterable' => true,
//                    'comparable' => true,
//                    'visible_in_advanced_search' => true,
//                    'apply_to' => implode(',', [Type::TYPE_SIMPLE, Type::TYPE_VIRTUAL]),
//                    'is_used_in_grid' => true,
//                    'is_visible_in_grid' => false,
//                    'option' => [
//                        'values' => [
//                            'Obsidian',
//                            'Crimson',
//                            'Emerald',
//                            'Ametyst',
//                            'Pure'
//                        ]
//                    ]
//                ]
//        );
//        $this->eavConfig->clear();
//        $attribute = $this->eavConfig->getAttribute('catalog_product', 'overdose_color');
//        if (!$attribute) {
//            return;
//        }
//        $attributeData['option'] = $this->addExistingOptions($attribute);
//        $attributeData['frontend_input'] = 'select';
//        $attributeData['swatch_input_type'] = 'visual';
//        $attributeData['update_product_preview_image'] = 1;
//        $attributeData['use_product_image_for_swatch'] = 0;
//        $attributeData['optionvisual'] = $this->getOptionSwatch($attributeData);
//        $attributeData['defaultvisual'] = $this->getOptionDefaultVisual($attributeData);
//        $attributeData['swatchvisual'] = $this->getOptionSwatchVisual($attributeData);
//        $attribute->addData($attributeData);
//        $attribute->save();
//
//        $eavSetup->addAttributeToGroup(
//            Product::ENTITY,
//            'Default',
//            'Product Details',
//            'overdose_color',
//            18
//        );
//
//        $eavSetup->addAttributeToGroup(
//            Product::ENTITY,
//            'Bottom',
//            'Product Details',
//            'overdose_color',
//            18
//        );
//        $this->moduleDataSetup->endSetup();
//    }
//
//    protected function getOptionSwatch(array $attributeData)
//    {
//        $optionSwatch = ['order' => [], 'value' => [], 'delete' => []];
//        $i = 0;
//        foreach ($attributeData['option'] as $optionKey => $optionValue) {
//            $optionSwatch['delete'][$optionKey] = '';
//            $optionSwatch['order'][$optionKey] = (string)$i++;
//            $optionSwatch['value'][$optionKey] = [$optionValue, ''];
//        }
//        return $optionSwatch;
//    }
//
//    private function getOptionSwatchVisual(array $attributeData)
//    {
//        $optionSwatch = ['value' => []];
//        foreach ($attributeData['option'] as $optionKey => $optionValue) {
//            if (substr($optionValue, 0, 1) == '#' && strlen($optionValue) == 7) {
//                $optionSwatch['value'][$optionKey] = $optionValue;
//            } elseif ($this->colorMap[$optionValue]) {
//                $optionSwatch['value'][$optionKey] = $this->colorMap[$optionValue];
//            } else {
//                $optionSwatch['value'][$optionKey] = $this->colorMap['White'];
//            }
//        }
//        return $optionSwatch;
//    }
//
//    private function getOptionDefaultVisual(array $attributeData)
//    {
//        $optionSwatch = $this->getOptionSwatchVisual($attributeData);
//        if (isset(array_keys($optionSwatch['value'])[0])) {
//            return [array_keys($optionSwatch['value'])[0]];
//        } else {
//            return [''];
//        }
//    }
//
//    private function addExistingOptions(eavAttribute $attribute)
//    {
//        $options = [];
//        $attributeId = $attribute->getId();
//        if ($attributeId) {
//            $this->loadOptionCollection($attributeId);
//            foreach ($this->optionCollection[$attributeId] as $option) {
//                $options[$option->getId()] = $option->getValue();
//            }
//        }
//        return $options;
//    }
//
//    private function loadOptionCollection($attributeId)
//    {
//        if (empty($this->optionCollection[$attributeId])) {
//            $this->optionCollection[$attributeId] = $this->attrOptionCollectionFactory->create()
//                ->setAttributeFilter($attributeId)
//                ->setPositionOrder('asc', true)
//                ->load();
//        }
//    }
//
//    /**
//     * @inheritdoc
//     */
//    public static function getDependencies(): array
//    {
//        return [];
//    }
//
//    /**
//     * @inheritdoc
//     */
//    public function getAliases(): array
//    {
//        return [];
//    }
//}
