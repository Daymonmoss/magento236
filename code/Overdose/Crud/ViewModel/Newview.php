<?php

namespace Overdose\Crud\ViewModel;

use Magento\Framework\DataObject;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Overdose\Crud\Model\StudentsResource\StudentsCollection\CollectionFactory;
use Overdose\Crud\Model\StudentsResource\StudentsCollection\Collection;
use Overdose\Crud\Model\StudentsResource\ResourceModel;
use Overdose\Crud\Model\StudentsModel;
use Overdose\Crud\Model\StudentsModelFactory;

class Newview implements ArgumentInterface
{
    /**
     * @var StudentsModel
     */
    private $studentsModel = null;

    /**
     * @var StudentsModelFactory
     */
    protected $studentsModelFactory;

    /**
     * @var ResourceModel
     */
    protected $studentsResourceModel;

    /**
     * @var CollectionFactory
     */
    protected $studentsCollectionFactory;

    /**
     * Newview constructor.
     * @param StudentsModelFactory $studentsModelFactory
     * @param ResourceModel $studentsResourceModel
     * @param CollectionFactory $studentsCollectionFactory
     */
    public function __construct(
        StudentsModelFactory $studentsModelFactory,
        ResourceModel $studentsResourceModel,
        CollectionFactory $studentsCollectionFactory
    ) {
        $this->studentsModelFactory = $studentsModelFactory;
        $this->studentsResourceModel = $studentsResourceModel;
        $this->studentsCollectionFactory = $studentsCollectionFactory;
    }
    public function fromViewModel(): string
    {
        return "This message is from Overdose Crud ViewModel";
    }

    /**
     * Get collection of all students from 'overdose_crud'
     *
     * @return DataObject[]|Collection[]
     */
    public function getAllStudents()
    {
        $collection = $this->studentsCollectionFactory->create();

        $collection->load();

        return $collection->getItems();
    }

    /**
     * @param int $id
     * @return string
     */
    public function getStudentName($id)
    {
        return $this->getStudentModel($id)->getData();
    }
    /**
     * Return model if exists.
     * IF not, load from db and then return.
     *
     * @param integer $id
     * @return StudentsModel|null
     */
    private function getStudentModel($id)
    {
        if ($this->model === null) {
            // Creates new instance of the 'students object'. A.K.A. individual line/row from mysql table.
            $model = $this->studentsModelFactory->create();

            // Loads the data from the database and puts it to the $model variable.
            $this->studentsResourceModel->load($model, $id);

            // Save model to the class, so that same model won't be loaded numerous times.
            $this->model = $model;
        }

        return $this->model;
    }
}
