<?php
namespace Overdose\Brands\Api;

use Magento\Framework\Api\SearchCriteria;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Overdose\Brands\Api\Data\BrandsInterface;
use Overdose\Brands\Model\BrandsModel;

interface BrandsRepositoryInterface
{
//    /**
//     * @param BrandsInterface|BrandsModel $model
//     * @return BrandsInterface|BrandsModel
//     */
//    public function get($model);

    /**
     * @param BrandsInterface|BrandsModel $model
     * @return BrandsInterface|BrandsModel
     */
    public function save($model);

    /**
     * @param BrandsInterface|BrandsModel $model
     * @return true
     * @throws CouldNotDeleteException
     */
    public function delete($model);

    /**
     * @param integer $id
     * @return BrandsInterface|BrandsModel
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
