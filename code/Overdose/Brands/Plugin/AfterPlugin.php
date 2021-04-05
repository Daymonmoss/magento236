<?php
namespace Overdose\Brands\Plugin;

use Magento\Product\Api\Data\CustomerExtensionFactory;
use Magento\Product\Api\CustomerRepositoryInterface;
use Magento\Product\Api\Data\ProductSearchResultsInterface;

class AfterPlugin
{
    /**
     * @var CustomerExtensionFactory
     */
    private $customerExtensionFactory;

    public function __construct(
        CustomerExtensionFactory $customerExtensionFactory
    ) {
        $this->customerExtensionFactory = $customerExtensionFactory;
    }

    /**
     * @param CustomerRepositoryInterface $subject
     * @param CustomerSearchResultsInterface $searchCriteria
     * @return CustomerSearchResultsInterface
     */
    public function afterGetList(CustomerRepositoryInterface $subject, CustomerSearchResultsInterface $searchCriteria)
    {
        $customers = [];
        foreach ($searchCriteria->getItems() as $item) {
            $datenow = date('D-F-Y H:i:s');

            $extensionAttributes = $item->getExtensionAttributes();
            $extensionAttributes = $extensionAttributes ? $extensionAttributes : $this->customerExtensionFactory->create();
            $extensionAttributes->setExtractedAt($datenow);
            $item->setExtensionAttributes($extensionAttributes);

            $customers[] = $item;
        }
        $searchCriteria->setItems($customers);
        return $searchCriteria;
    }
}
