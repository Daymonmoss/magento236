<?php
namespace Overdose\Plug\Api;

use Magento\Framework\Api\SearchCriteria;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Overdose\Plug\Api\Data\StudentsInterface;
use Overdose\Plug\Model\Students;

interface StudentsRepositoryInterface
{
    /**
     * @param StudentsInterface|Students $model
     * @return StudentsInterface|Students
     */
    public function save($model);

    /**
     * @param StudentsInterface|Students $model
     * @return true
     * @throws CouldNotDeleteException
     */
    public function delete($model);

    /**
     * @param integer $id
     * @return StudentsInterface|Students
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
