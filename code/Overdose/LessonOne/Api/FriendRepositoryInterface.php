<?php
namespace Overdose\LessonOne\Api;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NotFoundException;

interface FriendRepositoryInterface
{
    /**
     * @param integer $id
     * @return \Overdose\LessonOne\Api\Data\FriendInterface|\Overdose\LessonOne\Model\Friends
     * @throws NotFoundException
     */
    public function getById($id);

    /**
     * @param \Overdose\LessonOne\Api\Data\FriendInterface|\Overdose\LessonOne\Model\Friends $model
     * @return \Overdose\LessonOne\Api\Data\FriendInterface|\Overdose\LessonOne\Model\Friends
     * @throws CouldNotSaveException
     */
    public function save($model);

    /**
     * @param \Overdose\LessonOne\Api\Data\FriendInterface|\Overdose\LessonOne\Model\Friends $model
     * @return true
     * @throws CouldNotDeleteException
     */
    public function delete($model);

    /**
     * @param integer $id
     * @return true
     * @throws CouldNotDeleteException
     */
    public function deleteById($id);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Magento\Framework\Api\SearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);
}
