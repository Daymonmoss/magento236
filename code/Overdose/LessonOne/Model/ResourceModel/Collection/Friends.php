<?php
namespace Overdose\LessonOne\Model\ResourceModel\Collection;

use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Data\Collection\Db\FetchStrategyInterface;
use Magento\Framework\Data\Collection\EntityFactoryInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\Event\ManagerInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Psr\Log\LoggerInterface;

class Friends extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id';

    protected function _construct()
    {
        $this->_init(
            \Overdose\LessonOne\Model\Friends::class,
            \Overdose\LessonOne\Model\ResourceModel\Friends::class
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
        $table = $connection->getTableName('overdose_lesson_one');
        $query = "DELETE FROM `" . $table . "` WHERE id IN ($ids)";
        $connection->query($query);
    }
}
