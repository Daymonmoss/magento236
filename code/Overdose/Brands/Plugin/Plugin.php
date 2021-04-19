<?php
namespace Overdose\Brands\Plugin;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\Data\ProductSearchResultsInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\ProductRepository;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;

class Plugin
{

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    public function __construct(
        CollectionFactory $collectionFactory
    ) {
        $this->collectionFactory = $collectionFactory;
    }

    public function afterGet(ProductRepositoryInterface $subject, ProductInterface $entity)
    {
        $collection = $this->collectionFactory->create();

        $count = $collection->getAttributeValueCount('overdose_brand');

        $extensionAttributes = $entity->getExtensionAttributes();
        $extensionAttributes->setTotalBrandProducts(10);
        $entity->setExtensionAttributes($extensionAttributes);

        return $entity;
    }

    public function afterGeById(ProductRepositoryInterface $subject, ProductInterface $entity)
    {
        $collection = $this->collectionFactory->create();

        $count = $collection->getAttributeValueCount('overdose_brand');

        $extensionAttributes = $entity->getExtensionAttributes();
        $extensionAttributes->setTotalBrandProducts(10);
        $entity->setExtensionAttributes($extensionAttributes);

        return $entity;
    }

    public function afterGetList(ProductRepositoryInterface $subject, ProductSearchResultsInterface $searchCriteria):ProductSearchResultsInterface
    {
        $collection = $this->collectionFactory->create();
        $products = [];
        foreach ($searchCriteria->getItems() as $entity) {
            $count = $collection->getAttributeValueCount('overdose_brand');

            $extensionAttributes = $entity->getExtensionAttributes();
            $extensionAttributes->setTotalBrandProducts((int)$count);
            $entity->setExtensionAttributes($extensionAttributes);

            $products[] = $entity;
        }
        $searchCriteria->setItems($products);
        return $searchCriteria;
    }
}
