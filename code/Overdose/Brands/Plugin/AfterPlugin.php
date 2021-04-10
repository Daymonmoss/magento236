<?php
namespace Overdose\Brands\Plugin;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\Data\ProductSearchResultsInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
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

    public function afterGet(productRepositoryInterface $subject, ProductInterface $entity)
    {
        $collection = $this->collectionFactory->create();

        $count = $collection->getAttributeValueCount('overdose_brand');

        $extensionAttributes = $entity->getExtensionAttributes();
        $extensionAttributes->setTotalBrandProducts($count);
        $entity->setExtensionAttributes($extensionAttributes);

        return $entity;
    }

    public function afterGeById(ProductRepositoryInterface $subject, ProductInterface $entity)
    {
        $collection = $this->collectionFactory->create();

        $count = $collection->getAttributeValueCount('overdose_brand');

        $extensionAttributes = $entity->getExtensionAttributes();
        $extensionAttributes->setTotalBrandProducts($count);
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
            $extensionAttributes->setTotalBrandProducts($count);
            $entity->setExtensionAttributes($extensionAttributes);

            $products[] = $entity;
        }
        $searchCriteria->setItems($products);
        return $searchCriteria;
    }
}
