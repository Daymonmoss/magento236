<?php
namespace Overdose\Crud\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Overdose\Crud\Api\StudentsRepositoryInterface;
use Overdose\Crud\Model\StudentsModelFactory;
use Overdose\Crud\Model\StudentsResource\ResourceModel;
use Overdose\Crud\Model\StudentsResource\StudentsCollection\CollectionFactory;

class StudentsRepository implements StudentsRepositoryInterface
{
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
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * @var SearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * Repository constructor.
     *
     * @param StudentsModelFactory $studentsModelFactory
     * @param ResourceModel $studentsResourceModel
     * @param CollectionFactory $studentsCollectionFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param SearchResultsInterfaceFactory $searchResultsFactory
     */
    public function __construct(
        StudentsModelFactory $studentsModelFactory,
        ResourceModel $studentsResourceModel,
        CollectionFactory $studentsCollectionFactory,
        CollectionProcessorInterface $collectionProcessor,
        SearchResultsInterfaceFactory $searchResultsFactory
    ) {
        $this->studentsFactory = $studentsModelFactory;
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
            throw new CouldNotSaveException(__("Sorry. I cannot save this student =("));
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
            throw new CouldNotDeleteException(__("Sorry. I cannot delete this student. =("));
        }
    }

    /**
     * @inheritDoc
     */
    public function getById($id)
    {
        try {
            $model = $this->studentsModelFactory->create();
            $this->studentsResourceModel->load($model, $id);

            return $model;
        } catch (\Exception $e) {
            throw new NoSuchEntityException(__("Sorry. No student with this id"));
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
        return $this->studentsModelFactory->create();
    }
}
