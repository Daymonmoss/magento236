<?php

namespace Overdose\Brands\Plugin;

use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Catalog\Api\Data\ProductInterface;

class TitleBrandPlugin
{
    /**
     * @var CollectionFactory
     */
    protected $productCollectionFactory;

    /**
     * @var ProductInterface
     */
    protected $productInterface;

    /**
     * @param CollectionFactory $productCollectionFactory
     * @param ProductInterface $productInterface
     */
    public function __construct(
        CollectionFactory $productCollectionFactory,
        ProductInterface $productInterface
    ) {
        $this->productCollectionFactory = $productCollectionFactory;
        $this->productInterface = $productInterface;
    }

    public function afterGetName(Product $subject, $result)
    {
        $brand = $subject->getResource()->getAttribute('overdose_brand')->getFrontend()->getValue($subject);

        if ($brand !== null) {
            $brand = " (" . $brand . "," . $subject->getExtensionAttributes()->getTotalBrandProducts() . " total)";
        }

        return $result . "\n" . $brand;
    }
}
