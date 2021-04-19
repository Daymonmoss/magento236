<?php
namespace Overdose\Brands\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Framework\Controller\Result\JsonFactory;
use Overdose\Brands\Api\BrandsRepositoryInterface;
use Overdose\Brands\Model\BrandsModelFactory;
use Overdose\Brands\Model\BrandsResource\BrandsCollection\CollectionFactory;
use Overdose\Brands\Model\BrandsResource\ResourceModel;

abstract class AbstractController extends Action
{
    const DEFAULT_ACTION_PATH = 'brands/index/';
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
     * @var BrandsRepositoryInterface
     */
    protected $brandsRepository;

    /**
     * @var JsonFactory
     */
    protected $jsonFactory;

    /**
     * @var Filter
     */
    protected $filter;

    public function __construct(
        Context $context,
        BrandsModelFactory $brandsModelFactory,
        ResourceModel $brandsResourceModel,
        CollectionFactory $brandsCollectionFactory,
        BrandsRepositoryInterface $brandsRepository,
        JsonFactory $jsonFactory,
        Filter $filter
    ) {
        parent::__construct($context);
        $this->brandsModelFactory = $brandsModelFactory;
        $this->brandsResourceModel = $brandsResourceModel;
        $this->brandsCollectionFactory = $brandsCollectionFactory;
        $this->brandsRepository = $brandsRepository;
        $this->jsonFactory = $jsonFactory;
        $this->filter = $filter;
    }

    public function getAllBrands()
    {
        $collection = $this->brandsCollectionFactory->create();
        return $collection->getItems();
    }
}
