<?php

namespace Overdose\Attributes\Setup\Patch\Data;

use Magento\Catalog\Api\CategoryLinkManagementInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\Product\Option;
use Magento\Catalog\Model\ProductFactory;
use Magento\Framework\App\State;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Filesystem\DirectoryList;
use Magento\Framework\Module\Dir;
use Magento\Framework\Module\Dir\Reader;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class CreateSimpleProducts implements DataPatchInterface
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
     * @var Reader
     */
    protected $moduleReader;

    /**
     * @var DirectoryList
     */
    protected $mediaDIR;

    /**
     * @var ProductRepositoryInterface
     */
    protected $productrepo;

    /**
     * @var CategoryLinkManagementInterface
     */
    protected $categoryLinkManagement;

    /**
     * CreateSimpleProducts constructor.
     * @param ProductFactory $product
     * @param State $state
     * @param Option $option
     * @param Reader $moduleReader
     * @param DirectoryList $mediaDIR
     * @param ProductRepositoryInterface $productrepo
     * @param CategoryLinkManagementInterface $categoryLinkManagement
     */
    public function __construct(
        ProductFactory $product,
        State $state,
        Option $option,
        Reader $moduleReader,
        DirectoryList $mediaDIR,
        ProductRepositoryInterface $productrepo,
        CategoryLinkManagementInterface $categoryLinkManagement
    ) {
        $this->product = $product;
        $this->state = $state;
        $this->option = $option;
        $this->moduleReader = $moduleReader;
        $this->mediaDIR = $mediaDIR;
        $this->productrepo = $productrepo;
        $this->categoryLinkManagement = $categoryLinkManagement;
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

        for ($i = 1; $i <= 3; $i++) {
            $product = $this->product->create();
            $viewDir = $this->moduleReader->getModuleDir(
                Dir::MODULE_VIEW_DIR,
                'Overdose_Attributes'
            );
            copy($viewDir . '/frontend/web/img/sp' . $i . '.jpg', $this->mediaDIR->getPath('media') . '/sp' . $i . '.jpg');
            $imagePath = 'sp' . $i . '.jpg'; // path of the image
            try {
                $product->setStoreId(0)
                        ->setName('Overdose Simple Product ' . $i)
                        ->setTypeId('simple')
                        ->setAttributeSetId(4)
                        ->setSku('osp' . $i . '-SKU')
                        ->setWebsiteIds([1])
                        ->setVisibility(4)
                        ->setPrice(100)
                        ->addImageToMediaGallery($imagePath, ['image', 'small_image', 'thumbnail'], false, false)
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
                        "sort_order" => 1 . $i,
                        "title" => "Custom Simple Option 1" . $i,
                        "price_type" => "fixed",
                        "price" => "10",
                        "type" => "field",
                        "is_require" => 0
                    ],
                    [
                        "sort_order" => 2 . $i,
                        "title" => "Custom Simple Option 2" . $i,
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
                $msg = 'Created Simple Product. Product ID: ' . $product->getId();
                echo $msg . "\n";
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        }
    }

    /**
     * @inheritdoc
     */
    public static function getDependencies(): array
    {
        return [
            \Overdose\Attributes\Setup\Patch\Data\AddColorAttribute::class
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
