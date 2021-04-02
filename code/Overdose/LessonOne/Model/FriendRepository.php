<?php
namespace Overdose\LessonOne\Model;

use \Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

class FriendRepository implements \Overdose\LessonOne\Api\FriendRepositoryInterface
{
    /**
     * @var \Overdose\LessonOne\Model\FriendsFactory
     */
    protected $friendsFactory;

    /**
     * @var \Overdose\LessonOne\Model\ResourceModel\Friends
     */
    protected $friendsResourceModel;

    /**
     * @var \Overdose\LessonOne\Model\ResourceModel\Collection\FriendsFactory
     */
    protected $friendsCollectionFactory;

    /**
     * @var \Magento\Framework\Api\SearchResultsInterfaceFactory
     */
    protected $searchResultFactory;

    /**
     * @var \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * OneOne constructor.
     *
     * @param \Overdose\LessonOne\Model\FriendsFactory $friendsFactory
     * @param \Overdose\LessonOne\Model\ResourceModel\Friends $friendsResourceModel
     * @param \Overdose\LessonOne\Model\ResourceModel\Collection\FriendsFactory $friendsCollectionFactory
     * @param \Magento\Framework\Api\SearchResultsInterfaceFactory $searchResultFactory
     * @param \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        \Overdose\LessonOne\Model\FriendsFactory $friendsFactory,
        \Overdose\LessonOne\Model\ResourceModel\Friends $friendsResourceModel,
        \Overdose\LessonOne\Model\ResourceModel\Collection\FriendsFactory $friendsCollectionFactory,
        \Magento\Framework\Api\SearchResultsInterfaceFactory $searchResultFactory,
        \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor
    ) {
        $this->friendsFactory = $friendsFactory;
        $this->friendsResourceModel = $friendsResourceModel;
        $this->friendsCollectionFactory = $friendsCollectionFactory;
        $this->searchResultFactory = $searchResultFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function getById($id)
    {
        try {
            /** @var \Overdose\LessonOne\Api\Data\FriendInterface|\Overdose\LessonOne\Model\Friends $model */
            $model = $this->friendsFactory->create();
            $this->friendsResourceModel->load($model, $id, \Overdose\LessonOne\Api\Data\FriendInterface::FIELD_NAME_ID);

            return $model;
        } catch (\Exception $e) {
            throw new NoSuchEntityException(__("There is no friend record with id of %1", $id));
        }
    }

    /**
     * @inheritDoc
     */
    public function save($model)
    {
        try {
            return $this->friendsResourceModel->save($model);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__("Unable to save the data. Sorry  =)"));
        }
    }

    /**
     * @inheritDoc
     */
    public function delete($model)
    {
        try {
            $this->friendsResourceModel->delete($model);
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(__("Unable to delete provided record from friends storage."));
        }
    }

    /**
     * @inheritDoc
     */
    public function deleteById($id)
    {
        try {
            $this->friendsResourceModel->delete($this->getById($id));
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(__("Unable to delete provided record from friends storage."));
        }
    }

    /**
     * @inheritDoc
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->friendsCollectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);

        /** @var \Magento\Framework\Api\SearchResultsInterface $searchResult */
        $searchResult = $this->searchResultFactory->create();
        $searchResult->setItems($collection->getItem())
            ->setTotalCount($collection->getSize())
            ->setSearchCriteria($searchCriteria);

        return $searchResult;
    }
}
