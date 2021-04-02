<?php
namespace Overdose\CustomersLogger\Plugin;

use Magento\Customer\Api\Data\CustomerExtensionFactory;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Api\Data\CustomerSearchResultsInterface;

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
