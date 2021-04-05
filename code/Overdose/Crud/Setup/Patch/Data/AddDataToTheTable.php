<?php
namespace Overdose\Crud\Setup\Patch\Data;

use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Overdose\Crud\Model\StudentsResource\ResourceModel;
use Overdose\Crud\Model\StudentsModelFactory;

class AddDataToTheTable implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    protected $moduleDataSetup;

    /**
     * @var CouldNotSaveException.
     */
    public $e;

    /**
     * @var StudentsModelFactory
     */
    protected $studentsModelFactory;

    /**
     * @var ResourceModel
     */
    protected $resourceModel;

    /**
     * @var ManagerInterface
     */
    protected $messageManager;

    /**
     * AddDataToTheTable constructor.
     *
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param StudentsModelFactory $studentsModelFactory
     * @param ResourceModel $studentsResourceModel
     */
    public function __construct(
        ModuleDataSetupInterface  $moduleDataSetup,
        StudentsModelFactory  $studentsModelFactory,
        ResourceModel  $studentsResourceModel
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->studentsModelFactory = $studentsModelFactory;
        $this->resourceModel = $studentsResourceModel;
    }


    public static function getDependencies()
    {
        return[];
    }


    public function getAliases()
    {
        return[];
    }

    /**
     * Applies this function only once.
     * You can find 'patch_list' table and DROP the row from DB with the name of this class, so that system will apply
     * this patch again. Useful when you're learning.
     */
    public function apply()
    {
        $this->moduleDataSetup->startSetup();

        $model = $this->studentsModelFactory->create();

        $_data = [
            ['name' => 'Dimon', 'age' => 20, 'description' => 'It is the First student'],
            ['name' => 'Bodya', 'age' => 21, 'description' => 'It is the Second student'],
            ['name' => 'Vasyl', 'age' => 22, 'description' => 'It is the Third student'],
            ['name' => 'Boris', 'age' => 23, 'description' => 'It is the Fourth student'],
            ['name' => 'Petro', 'age' => 24, 'description' => 'It is the Fifth student'],
            ['name' => 'Roman', 'age' => 25, 'description' => 'It is the Sixth student'],
            ['name' => 'Ihor', 'age' => 26, 'description' => 'It is the Seventh student'],
            ['name' => 'Den', 'age' => 27, 'description' => 'It is the Eighth student'],
            ['name' => 'Artem', 'age' => 28, 'description' => 'It is the Ninth student'],
            ['name' => 'Semen', 'age' => 29, 'description' => 'It is the Tenth student']
        ];
        try {
            //  foreach ($_data as $note) { ->insertForce(tableName, data
            $this->moduleDataSetup->getConnection()->insertMultiple(
                $this->moduleDataSetup->getTable('overdose_crud'),
                $_data
            );
            //  }
            $this->resourceModel->save($model);
        } catch (\Exception $e) {
            $this->messageManager->addException($e, __('Cannot save data.'));
        }

        $this->moduleDataSetup->endSetup();
    }
}
