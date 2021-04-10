<?php
namespace Overdose\Brands\Plugin;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Api\Data\ProductSearchResultsInterface;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Overdose\Brands\Api\BrandsRepositoryInterface;
class AfterPlugin
{

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @var BrandsRepositoryInterface
     */
    private $brandsRepository;

    public function __construct(
        CollectionFactory $collectionFactory,
        BrandsRepositoryInterface $brandsRepository
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->brandsRepository = $brandsRepository;
    }

    public function afterGet(productRepositoryInterface $subject, ProductInterface $brands)
    {
        $collection = $this->collectionFactory->create();

        foreach ($subject as $brand) {
            $count = $collection->getAttributeValueCount('overdose_brand');
            $extensionAttributes = $brand->getExtensionAttributes();
            $extensionAttributes->setTotalBrandProducts($count);
        }
        return $brands;
    }

    public function afterGeById(ProductRepositoryInterface $subject, ProductInterface $product)
    {
        $collection = $this->collectionFactory->create();

        foreach ($subject as $brand) {
            $count = $collection->getAttributeValueCount('overdose_brand');
            $extensionAttributes = $brand->getExtensionAttributes();
            $extensionAttributes->setTotalBrandProducts($count);
        }
        return $product;
    }

    public function afterGetList(ProductRepositoryInterface $subject, ProductSearchResultsInterface $searchCriteria):ProductSearchResultsInterface
    {
        $collection = $this->collectionFactory->create();
        $products = [];
        foreach ($searchCriteria->getItems() as $brand) {
            $count = $collection->getAttributeValueCount('overdose_brand');
            $extensionAttributes = $brand->getExtensionAttributes();
            $extensionAttributes->setTotalBrandProducts($count);
        }
        $searchCriteria->setItems($products);
        return $searchCriteria;
    }
}
