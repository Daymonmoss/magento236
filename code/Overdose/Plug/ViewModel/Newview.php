<?php

namespace Overdose\Plug\ViewModel;

use Magento\Framework\DataObject;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Overdose\Plug\Model\ResourceModel\Collection\Studentscollection;
use Overdose\Plug\Model\ResourceModel\Collection\StudentscollectionFactory;
use Overdose\Plug\Model\ResourceModel\Studentsconnection;
use Overdose\Plug\Model\Students;
use Overdose\Plug\Model\StudentsFactory;

class Newview implements ArgumentInterface
{
    /**
     * @var Students
     */
    private $model = null;

    /**
     * @var StudentsFactory
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
     * @param StudentsFactory $studentsFactory
     * @param Studentsconnection $studentsResourceModel
     * @param StudentscollectionFactory $studentsCollectionFactory
     */
    public function __construct(
        StudentsFactory $studentsFactory,
        Studentsconnection $studentsResourceModel,
        StudentscollectionFactory $studentsCollectionFactory
    ) {
        $this->studentsFactory = $studentsFactory;
        $this->studentsFactory = $studentsResourceModel;
        $this->studentsCollectionFactory = $studentsCollectionFactory;
    }

    public function fromViewModel(): string
    {
        $message = "This message is from Overdose Plug ViewModel";
        return $message;
    }

    /**
     * @return string
     */
    public function getName($arg1, $arg2)
    {
        return $arg1 . ' |||| ' . $arg2;
    }

    /**
     * Get collection of all students from 'overdose_plug'
     *
     * @return DataObject[]|Studentscollection[]
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
     * @return \Overdose\Plug\Model\Students|null
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

    /**
     * @return string
     */
    public function simpleTextToTheShell()
    {
        return 'Simple text to the terminal';
    }
}
