<?php

namespace Overdose\Crud\Setup\Patch\Schema;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\Patch\SchemaPatchInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements SchemaPatchInterface
{

    /**
     * @var SchemaSetupInterface
     */
    private $setup;

    /**
     * EnableSegmentation constructor.
     *
     * @param SchemaSetupInterface $setup
     */
    public function __construct(
        SchemaSetupInterface $setup
    ) {
        $this->setup = $setup;
    }

    /**
     * @inheritDoc
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public function getAliases()
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public function apply()
    {
        /**
         * Create table 'overdose_crud'
         */
        $setup = $this->setup;

        $setup->startSetup();

        $table = $setup->getConnection()->newTable(
            $setup->getTable('overdose_crud')
        )
                ->addColumn(
                    'id',
                    Table::TYPE_INTEGER,
                    null,
                    ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                    'ID Autoincrement'
                )
                ->addColumn(
                    'name',
                    Table::TYPE_TEXT,
                    40,
                    ['nullable' => false],
                    'Name'
                )
                ->addColumn(
                    'age',
                    Table::TYPE_SMALLINT,
                    3,
                    ['nullable' => false],
                    'Name'
                )
                ->addColumn(
                    'description',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable' => false],
                    'Description'
                )
                ->addColumn(
                    'updated_at',
                    Table::TYPE_TIMESTAMP,
                    20,
                    ['nullable' => false, 'default' => Table::TIMESTAMP_INIT_UPDATE],
                    'Updated'
                )
                ->addColumn(
                    'created_at',
                    Table::TYPE_TIMESTAMP,
                    20,
                    ['nullable' => false, 'on_update' => false,  'default' => Table::TIMESTAMP_INIT],
                    'Created'
                )->setComment(
                    'Overdose Crud Students'
                );
        $setup->getConnection()->createTable($table);

        $setup->endSetup();
    }
}
