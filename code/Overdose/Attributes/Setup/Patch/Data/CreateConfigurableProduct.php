<?php

namespace Overdose\Attributes\Setup\Patch\Data;

use Magento\Catalog\Api\CategoryLinkManagementInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\Product\Option;
use Magento\Catalog\Model\ProductFactory;
use Magento\ConfigurableProduct\Helper\Product\Options\Factory as OptionsFactory;
use Magento\ConfigurableProduct\Model\Product\Type\Configurable;
use Magento\ConfigurableProduct\Model\Product\Type\Configurable\Attribute;
use Magento\Eav\Model\Config;
use Magento\Framework\App\State;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Filesystem\DirectoryList;
use Magento\Framework\Module\Dir\Reader;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class CreateConfigurableProduct implements DataPatchInterface
{
    /**
     * @var ProductFactory
     */
    protected $product;

    /**
     * @var State
     */
    protected $state;

    /**
     * @var Option
     */
    protected $option;

    /**
     * @var ProductRepositoryInterface
     */
    protected $productrepo;

    /**
     * @var CategoryLinkManagementInterface
     */
    protected $categoryLinkManagement;

    /**
     * @var Config
     */
    protected $eavConfig;

    /**
     * @var Attribute
     */
    protected $attributeModel;

    /**
     * @var Reader
     */
    protected $moduleReader;

    /**
     * @var DirectoryList
     */
    protected $mediaDIR;

    /**
     * @var OptionsFactory
     */
    protected $optionsFactory;

    /**
     * CreateSimpleProducts constructor.
     * @param Attribute $attributeModel
     * @param ProductFactory $product
     * @param State $state
     * @param ProductRepositoryInterface $productrepo
     * @param Option $option
     * @param CategoryLinkManagementInterface $categoryLinkManagement
     * @param Config $eavConfig
     * @param Reader $moduleReader
     * @param DirectoryList $mediaDIR
     * @param OptionsFactory $optionsFactory
     */
    public function __construct(
        Attribute $attributeModel,
        ProductFactory $product,
        State $state,
        ProductRepositoryInterface $productrepo,
        Option $option,
        CategoryLinkManagementInterface $categoryLinkManagement,
        Config $eavConfig,
        Reader $moduleReader,
        DirectoryList $mediaDIR,
        OptionsFactory $optionsFactory
    ) {
        $this->attributeModel = $attributeModel;
        $this->product = $product;
        $this->productrepo = $productrepo;
        $this->state = $state;
        $this->option = $option;
        $this->categoryLinkManagement = $categoryLinkManagement;
        $this->eavConfig = $eavConfig;
        $this->moduleReader = $moduleReader;
        $this->mediaDIR = $mediaDIR;
        $this->optionsFactory = $optionsFactory;
    }

    /**
     * @inheritdoc
     */
    public function apply()
    {
        try {
            $this->state->getAreaCode();
        } catch (LocalizedException $e) {
            $this->state->setAreaCode('adminhtml');
        }

        $product = $this->product->create();

        $attributeSetId = $product->getDefaultAttributeSetId();

        $attribute = $this->eavConfig->getAttribute(Product::ENTITY, 'overdose_color');
        $attributeOptions = $attribute->getSource()->getAttribute()->getOptions();
        array_shift($attributeOptions);

        /**
         * Note:
         *
         * If the product IDs defined below in the associatedProducts array
         * are present in the database, then those products will get updated
         *
         * If the product IDs are not present in the database
         * then new products will be added with the IDs specified
         */
        $osp1 = $this->productrepo->get('osp1-SKU');
        $osp2 = $this->productrepo->get('osp2-SKU');
        $osp3 = $this->productrepo->get('osp3-SKU');

        $associatedProducts = [$osp1, $osp2, $osp3];
        $associatedProductsIds = [$osp1->getId(), $osp2->getId(), $osp3->getId()];

        /**
         * Create/Update Associated Simple Products
         *
         * We have defined 2 associated products above
         * So, we will only use the first 2 options of the attribute
         * We will link the attribute option to the product
         */
        try {
            foreach ($attributeOptions as $key => $attributeOption) {
                if ($key == count($associatedProducts)) {
                    break;
                }
                $product = $associatedProducts[$key];
                $productName = $product->getName();
                $product->setStoreId(0)
                        ->setName($productName . " " . $attributeOption->getLabel())
                        ->setData('overdose_color', $attributeOption->getValue());

                $product = $this->productrepo->save($product);

                $msg = 'Created/Updated Simple Product. Product ID: ' . $product->getId();
                echo $msg . "\n";

                $attributeValues[] = [
                    'label' => $attribute->getStoreLabel(),
                    'attribute_id' => $attribute->getId(),
                    'value_index' => $attributeOption->getValue(),
                ];
            }

            $configurableAttributesData = [
                [
                    'attribute_id' => $attribute->getId(),
                    'code' => $attribute->getAttributeCode(),
                    'label' => $attribute->getStoreLabel(),
                    'position' => '0',
                    'values' => $attributeValues,
                ],
            ];
        } catch (Exception $e) {
            echo "<pre>";
            print_r($e->getMessage());
        }

        /**
         * Create new configurable product
         *
         * The simple products created above
         * will get associated with the newly created configurable product.
         */

        $product = $this->product->create();
        $configurableOptions = $this->optionsFactory->create($configurableAttributesData);

        $extensionConfigurableAttributes = $product->getExtensionAttributes();
        $extensionConfigurableAttributes->setConfigurableProductOptions($configurableOptions);
        $extensionConfigurableAttributes->setConfigurableProductLinks($associatedProductsIds);

        $product->setExtensionAttributes($extensionConfigurableAttributes);

        $viewDir = $this->moduleReader->getModuleDir(
            \Magento\Framework\Module\Dir::MODULE_VIEW_DIR,
            'Overdose_Attributes'
        );
        copy($viewDir . '/frontend/web/img/cp.jpg', $this->mediaDIR->getPath('media') . 'cp.jpg');
        $imagePath = 'cp.jpg';

        try {
            $product->setStoreId(0)
            ->setTypeId(Configurable::TYPE_CODE)
            ->setAttributeSetId($attributeSetId)
            ->setWebsiteIds([1])
            ->setName('Overdose Configurable Product')
            ->setSku('ocp-SKU')
            ->setPrice(100)
            ->addImageToMediaGallery($imagePath, ['image', 'small_image', 'thumbnail'], false, false)
            ->setUrlKey('overdose-configurable-product')
            ->setVisibility(4)
            ->setStatus(1)
            ->setStockData(
                [
                        'use_config_manage_stock' => 0,
                        'manage_stock' => 1,
                        'min_sale_qty' => 1,
                        'max_sale_qty' => 2,
                        'is_in_stock' => 1,
                        'qty' => 100
                    ]
            );

            $product = $this->productrepo->save($product);

            // Adding Custom option to product
            $options = [
                [
                    "sort_order" => 1,
                    "title" => "Custom Configurable Option 1",
                    "price_type" => "fixed",
                    "price" => "10",
                    "type" => "field",
                    "is_require" => 0
                ],
                [
                    "sort_order" => 2,
                    "title" => "Custom Configurable Option 2",
                    "price_type" => "fixed",
                    "price" => "20",
                    "type" => "field",
                    "is_require" => 0
                ]
            ];

            foreach ($options as $arrayOption) {
                $product->setHasOptions(1);
                $product->getResource()->save($product);
                $option = $this->option;
                $option->setProductId($product->getId())
                    ->setStoreId($product->getStoreId())
                    ->addData($arrayOption);
                $option->save();
                $product->addOption($option);
            }

            $this->categoryLinkManagement->assignProductToCategories(
                $product->getSku(),
                [2,11,13,18]
            );

            $msg = 'Created Configurable Product. Product ID: ' . $product->getId();
            echo $msg . "\n";
        } catch (Exception $e) {
            echo "<pre>";
            print_r($e->getMessage());
        }
    }

    /**
     * @inheritdoc
     */
    public static function getDependencies(): array
    {
        return [
            \Overdose\Attributes\Setup\Patch\Data\CreateSimpleProducts::class
        ];
    }

    /**
     * @inheritdoc
     */
    public function getAliases(): array
    {
        return [];
    }
}
