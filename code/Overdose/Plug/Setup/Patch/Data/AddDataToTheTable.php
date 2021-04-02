<?php
namespace Overdose\Plug\Setup\Patch\Data;

use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Overdose\Plug\Model\ResourceModel\Studentsconnection;
use Overdose\Plug\Model\StudentsFactory;

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
     * @var StudentsFactory
     */
    protected $model;

    /**
     * @var Studentsconnection
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
     * @param StudentsFactory $studentsModel
     * @param Studentsconnection $studentsResourceModel
     */
    public function __construct(
        ModuleDataSetupInterface  $moduleDataSetup,
        StudentsFactory  $studentsModel,
        Studentsconnection  $studentsResourceModel
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->model = $studentsModel;
        $this->resourceModel = $studentsResourceModel;
    }

    /**
     * // TODO:
     */
    public static function getDependencies()
    {
        return[];
    }

    /**
     * // TODO:
     */
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

        $model = $this->model->create();

        $_data = [
            ['name' => 'Dimon', 'age' => 18, 'description' => 'It is the young student'],
            ['name' => 'Bodya', 'age' => 21, 'description' => 'It is the Second student'],
            ['name' => 'Vasyl', 'age' => 22, 'description' => 'It is the Third student'],
            ['name' => 'Boris', 'age' => 23, 'description' => 'It is the Fourth student'],
            ['name' => 'Petro', 'age' => 24, 'description' => 'It is the Fifth student'],
            ['name' => 'Roman', 'age' => 25, 'description' => 'It is the Sixth student'],
            ['name' => 'Ihor', 'age' => 14, 'description' => 'It is the younger student'],
            ['name' => 'Den', 'age' => 10, 'description' => 'It is the youngest student'],
            ['name' => 'Artem', 'age' => 28, 'description' => 'It is the Ninth student'],
            ['name' => 'Semen', 'age' => 29, 'description' => 'It is the Tenth student']
        ];
        try {
            $this->moduleDataSetup->getConnection()->insertMultiple(
                $this->moduleDataSetup->getTable('overdose_plug'),
                $_data
            );

            $this->resourceModel->save($model);
        } catch (\Exception $e) {
            $this->messageManager->addException($e, __('Cannot save data.'));
        }

        $this->moduleDataSetup->endSetup();
    }
}
