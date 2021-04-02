<?php
namespace Overdose\CustomersLogger\Cron;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Serialize\SerializerInterface;
use Psr\Log\LoggerInterface;

/**
 * Class RunCron
 * @package Overdose\CustomersLogger\Cron
 */
class RunCron
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var CustomerRepositoryInterface
     */
    private $customerslist;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * RunCron constructor.
     *
     * @param LoggerInterface                      $logger
     * @param SerializerInterface                  $serializer
     * @param CustomerRepositoryInterface          $customerslist
     * @param SearchCriteriaBuilder                $searchCriteriaBuilder
     */
    public function __construct(
        LoggerInterface $logger,
        SerializerInterface $serializer,
        CustomerRepositoryInterface $customerslist,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->logger                   = $logger;
        $this->serializer               = $serializer;
        $this->customerslist            = $customerslist;
        $this->searchCriteriaBuilder    = $searchCriteriaBuilder;
    }

    /**
     * Write to system.log changed to customers.log via di.xml
     * @throws LocalizedException
     * @return void
     */
    public function execute()
    {

        $searchCriteria = $this->searchCriteriaBuilder->addFilter('entity_id', '100', 'lt')->create();

        $items = $this->customerslist->getList($searchCriteria)->getItems();
        $toJson = [];
        foreach ($items as $item) {
            $toJson[$item->getId()] = [
                'name' => $item->getFirstname(),
                'email' => $item->getEmail(),
                'extracted_at' => $item->getExtensionAttributes()->getExtractedAt()
            ];
        }

        $data = $this->serializer->serialize($toJson);

        $this->logger->info($data);
    }
}
