<?php
namespace Overdose\Crud\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

class StudentsRepository implements \Overdose\Crud\Api\StudentsRepositoryInterface
{
    /**
     * @var \Overdose\Crud\Model\StudentsFactory
     */
    protected $studentsFactory;

    /**
     * @var \Overdose\Crud\Model\ResourceModel\Studentsconnection
     */
    protected $studentsResourceModel;

    /**
     * @var \Overdose\Crud\Model\ResourceModel\Collection\StudentscollectionFactory
     */
    protected $studentsCollectionFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * @var SearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * Newview constructor.
     *
     * @param \Overdose\Crud\Model\StudentsFactory $studentsFactory
     * @param \Overdose\Crud\Model\ResourceModel\Studentsconnection $studentsResourceModel
     * @param ResourceModel\Collection\StudentscollectionFactory $studentsCollectionFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param SearchResultsInterfaceFactory $searchResultsFactory
     */
    public function __construct(
        \Overdose\Crud\Model\StudentsFactory $studentsFactory,
        \Overdose\Crud\Model\ResourceModel\Studentsconnection $studentsResourceModel,
        \Overdose\Crud\Model\ResourceModel\Collection\StudentscollectionFactory $studentsCollectionFactory,
        CollectionProcessorInterface $collectionProcessor,
        SearchResultsInterfaceFactory $searchResultsFactory
    ) {
        $this->studentsFactory = $studentsFactory;
        $this->studentsResourceModel = $studentsResourceModel;
        $this->studentsCollectionFactory = $studentsCollectionFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->searchResultsFactory = $searchResultsFactory;
    }

    /**
     * @inheritDoc
     */
    public function save($model)
    {
        try {
            return $this->studentsResourceModel->save($model);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__("Sorry. I cannot save your friend. =("));
        }
    }

    /**
     * @inheritDoc
     */
    public function delete($model)
    {
        try {
            $this->studentsResourceModel->delete($model);
            return true;
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(__("Sorry. I cannot delete this student. =("));
        }
    }

    /**
     * @inheritDoc
     */
    public function deleteById($id)
    {
        try {
            $this->studentsResourceModel->delete($this->getById($id));

            return true;
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(__("Sorry. I cannot delete your friend. =("));
        }
    }

    /**
     * @inheritDoc
     */
    public function getById($id)
    {
        try {
            $model = $this->studentsFactory->create();
            $this->studentsResourceModel->load($model, $id);

            return $model;
        } catch (\Exception $e) {
            throw new NoSuchEntityException(__("Sorry. No friend with id of 666"));
        }
    }

    /**
     * @inheritDoc
     */
    public function getList($searchCriteria)
    {
        $collection = $this->studentsCollectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResult = $this->searchResultsFactory->create();

        $searchResult->setSearchCriteria($searchCriteria)
            ->setTotalCount($collection->getSize())
            ->setItems($collection->getItems());

        return $searchResult;
    }

    /**
     * @return Students
     */
    public function getEmptyModel()
    {
        return $this->studentsFactory->create();
    }
}
