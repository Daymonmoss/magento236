<?php
namespace Overdose\Plug\Api;

use Magento\Framework\Api\SearchCriteria;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Overdose\Plug\Api\Data\StudentsInterface;
use Overdose\Plug\Model\StudentsModel;

interface StudentsRepositoryInterface
{
    /**
     * @param StudentsInterface|StudentsModel $model
     * @return StudentsInterface|StudentsModel
     */
    public function save($model);

    /**
     * @param StudentsInterface|StudentsModel $model
     * @return true
     * @throws CouldNotDeleteException
     */
    public function delete($model);

    /**
     * @param integer $id
     * @return StudentsInterface|StudentsModel
     */
    public function getById($id);

    /**
     * @param integer $id
     * @return true
     * @throws CouldNotDeleteException
     */
    public function deleteById($id);

    /**
     * @param SearchCriteria $searchCriteria
     * @return SearchResultsInterface
     */
    public function getList($searchCriteria);
}
