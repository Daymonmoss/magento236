<?php

namespace Overdose\Brands\Plugin;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;

class TitleBrandPlugin
{
    /**
     * @var CollectionFactory
     */
    protected $productCollectionFactory;

    /**
     * @param CollectionFactory $productCollectionFactory
     */
    public function __construct(
        CollectionFactory $productCollectionFactory
    ) {
        $this->productCollectionFactory = $productCollectionFactory;
    }

    public function afterGetName(ProductInterface $subject, $result)
    {
        $brand = $subject->getAttributeText('overdose_brand');
        $brand_count = $subject->getExtensionAttributes()->getTotalBrandProducts();
        if ($brand !== false) {
            $brand = " (" . $brand . "," . $brand_count . " total)";
        }

        return $result . "\n" . $brand;
    }
}
