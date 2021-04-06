<?php
namespace Overdose\Brands\Plugin;

use Magento\Catalog\Api\Data\ProductExtensionFactory;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Api\Data\ProductSearchResultsInterface;

class AfterPlugin
{
    /**
     * @var ProductExtensionFactory
     */
    private $productExtensionFactory;

    public function __construct(
        ProductExtensionFactory $productExtensionFactory
    ) {
        $this->productExtensionFactory = $productExtensionFactory;
    }

    /**
     * @param ProductRepositoryInterface $subject
     * @param ProductSearchResultsInterface $searchCriteria
     * @return ProductSearchResultsInterface
     */
    public function afterGetList(ProductRepositoryInterface $subject, ProductSearchResultsInterface $searchCriteria)
    {
//        $products = [];
//        foreach ($searchCriteria->getItems() as $item) {
//            $datenow = date('D-F-Y H:i:s');
//
//            $extensionAttributes = $item->getExtensionAttributes();
//            $extensionAttributes = $extensionAttributes ? $extensionAttributes : $this->customerExtensionFactory->create();
//            $extensionAttributes->setExtractedAt($datenow);
//            $item->setExtensionAttributes($extensionAttributes);
//
//            $customers[] = $item;
//        }
//        $searchCriteria->setItems($customers);
//        return $searchCriteria;
    }
}
