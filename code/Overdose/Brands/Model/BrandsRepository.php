<?php
namespace Overdose\Brands\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Overdose\Brands\Api\BrandsRepositoryInterface;
use Overdose\Brands\Model\BrandsModel;
use Overdose\Brands\Model\BrandsModelFactory;
use Overdose\Brands\Model\BrandsResource\ResourceModel;
use Overdose\Brands\Model\BrandsResource\BrandsCollection\CollectionFactory;

class BrandsRepository implements BrandsRepositoryInterface
{
    /**
     * @var BrandsModelFactory
     */
    protected $brandsModelFactory;

    /**
     * @var ResourceModel
     */
    protected $brandsResourceModel;

    /**
     * @var CollectionFactory
     */
    protected $brandsCollectionFactory;

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
     * @param BrandsModelFactory $brandsModelFactory
     * @param ResourceModel $brandsResourceModel
     * @param CollectionFactory $brandsCollectionFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param SearchResultsInterfaceFactory $searchResultsFactory
     */
    public function __construct(
        BrandsModelFactory $brandsModelFactory,
        ResourceModel $brandsResourceModel,
        CollectionFactory $brandsCollectionFactory,
        CollectionProcessorInterface $collectionProcessor,
        SearchResultsInterfaceFactory $searchResultsFactory
    ) {
        $this->brandsModelFactory = $brandsModelFactory;
        $this->brandsResourceModel = $brandsResourceModel;
        $this->brandsCollectionFactory = $brandsCollectionFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->searchResultsFactory = $searchResultsFactory;
    }

    /**
     * @inheritDoc
     */
    public function get($model)
    {
        try {
            $model = $this->brandsModelFactory->create();
            $this->brandsResourceModel->load($model);

            return $model;
        } catch (\Exception $e) {
            throw new NoSuchEntityException(__("Sorry. This brand model doesn't exist"));
        }
    }

    /**
     * @inheritDoc
     */
    public function save($model)
    {
        try {
            return $this->brandsResourceModel->save($model);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__("Sorry. I cannot save this brand. =("));
        }
    }

    /**
     * @inheritDoc
     */
    public function delete($model)
    {
        try {
            $this->brandsResourceModel->delete($model);
            return true;
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(__("Sorry. I cannot delete this brand. =("));
        }
    }

    /**
     * @inheritDoc
     */
    public function deleteById($id)
    {
        try {
            $this->brandsResourceModel->delete($this->getById($id));

            return true;
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(__("Sorry. I cannot delete this brand. =("));
        }
    }

    /**
     * @inheritDoc
     */
    public function getById($id)
    {
        try {
            $model = $this->brandsModelFactory->create();
            $this->brandsResourceModel->load($model, $id);

            return $model;
        } catch (\Exception $e) {
            throw new NoSuchEntityException(__("Sorry. No brand with this id"));
        }
    }

    /**
     * @inheritDoc
     */
    public function getList($searchCriteria)
    {
        $collection = $this->brandsCollectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResult = $this->searchResultsFactory->create();

        $searchResult->setSearchCriteria($searchCriteria)
            ->setTotalCount($collection->getSize())
            ->setItems($collection->getItems());

        return $searchResult;
    }

    /**
     * @return BrandsModel
     */
    public function getEmptyModel()
    {
        return $this->brandsModelFactory->create();
    }
}
