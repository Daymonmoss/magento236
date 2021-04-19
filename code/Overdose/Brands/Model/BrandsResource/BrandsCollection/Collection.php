<?php

namespace Overdose\Brands\Model\BrandsResource\BrandsCollection;

use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Data\Collection\Db\FetchStrategyInterface;
use Magento\Framework\Data\Collection\EntityFactoryInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\Event\ManagerInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Psr\Log\LoggerInterface;
use Overdose\Brands\Model\BrandsModel;
use Overdose\Brands\Model\BrandsResource\ResourceModel;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'id';

    protected function _construct()
    {
        $this->_init(
            BrandsModel::class,
            ResourceModel::class,
        );
    }

    /**
     * @var ResourceConnection
     */
    protected $resourceConnection;

    /**
     * @param EntityFactoryInterface $entityFactory
     * @param LoggerInterface $logger
     * @param FetchStrategyInterface $fetchStrategy
     * @param ManagerInterface $eventManager
     * @param AdapterInterface|null $connection
     * @param AbstractDb|null $resource
     */
    public function __construct(
        ResourceConnection $resourceConnection,
        EntityFactoryInterface $entityFactory,
        LoggerInterface $logger,
        FetchStrategyInterface $fetchStrategy,
        ManagerInterface $eventManager,
        AdapterInterface $connection = null,
        AbstractDb $resource = null
    ) {
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $connection, $resource);
        $this->resourceConnection = $resourceConnection;
    }

    public function delete()
    {
        $ids = implode(",", $this->getAllIds());
        $connection = $this->resourceConnection->getConnection();
        $table = $connection->getTableName('overdose_brands');
        $query = "DELETE FROM `" . $table . "` WHERE id IN ($ids)";
        $connection->query($query);
    }
}
