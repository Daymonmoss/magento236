<?php

namespace Overdose\Crud\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use Overdose\Crud\Model\ResourceModel\Collection\StudentscollectionFactory;
use Overdose\Crud\Model\ResourceModel\Studentsconnection;
use Overdose\Crud\Model\Students;
use Overdose\Crud\Model\StudentsFactory as SomethingDifferent;

class Newview implements ArgumentInterface
{
    /**
     * @var Students
     */
    private $model = null;

    /**
     * @var SomethingDifferent
     */
    protected $studentsFactory;

    /**
     * @var Studentsconnection
     */
    protected $studentsResourceModel;

    /**
     * @var StudentscollectionFactory
     */
    protected $studentsCollectionFactory;

    /**
     * Newview constructor.
     * @param SomethingDifferent $studentsFactory
     * @param Studentsconnection $studentsResourceModel
     * @param StudentscollectionFactory $studentsCollectionFactory
     */
    public function __construct(
        \Overdose\Crud\Model\StudentsFactory $studentsFactory,
        Studentsconnection $studentsResourceModel,
        StudentscollectionFactory $studentsCollectionFactory
    ) {
        $this->studentsFactory = $studentsFactory;
        $this->studentsFactory = $studentsResourceModel;
        $this->studentsCollectionFactory = $studentsCollectionFactory;
    }
    public function fromViewModel(): string
    {
        return "This message is from Overdose Crud ViewModel";
    }

    /**
     * Get collection of all students from 'overdose_crud'
     *
     * @return \Magento\Framework\DataObject[]|\Overdose\Crud\Model\ResourceModel\Collection\Studentscollection[]
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
     * @return Students|null
     */
    private function getStudentModel($id)
    {
        if ($this->model === null) {
            // Creates new instance of the 'students object'. A.K.A. individual line/row from mysql table.
            $model = $this->studentsFactory->create();

            // Loads the data from the database and puts it to the $model variable.
            $this->studentsResourceModel->load($model, $id);

            // Save model to the class, so that same model won't be loaded numerous times.
            $this->model = $model;
        }

        return $this->model;
    }
}
