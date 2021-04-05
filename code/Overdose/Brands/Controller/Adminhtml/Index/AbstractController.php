<?php
namespace Overdose\Brands\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Overdose\Brands\Model\BrandsModelFactory;
use Overdose\Brands\Model\BrandsResource\ResourceModel;
use Overdose\Brands\Model\BrandsResource\BrandsCollection\CollectionFactory;
use Overdose\Brands\Api\BrandsRepositoryInterface;

abstract class AbstractController extends Action
{

    const DEFAULT_ACTION_PATH = 'brands/index/';
    /**
     * @var BrandsModelFactory
     */
    protected $brandsModelFactory;

    /**
     * @var RecourceModel
     */
    protected $brandsResourceModel;

    /**
     * @var CollectionFactory
     */
    protected $brandsCollectionFactory;

    /**
     * @var BrandsRepositoryInterface
     */
    protected $brandsRepositoryInterface;

    public function __construct(
        Context $context,
        BrandsModelFactory $brandsModelFactory,
        ResourceModel $brandsResourceModel,
        CollectionFactory $brandsCollectionFactory,
        BrandsRepositoryInterface $brandsRepositoryInterface
    ) {
        parent::__construct($context);
        $this->brandsModelFactory = $brandsModelFactory;
        $this->brandsResourceModel = $brandsResourceModel;
        $this->brandsCollectionFactory = $brandsCollectionFactory;
        $this->brandsRepositoryInterface = $brandsRepositoryInterface;
    }

    public function getAllFriends()
    {
        $collection = $this->brandsCollectionFactory->create();
        return $collection->getItems();
    }

}
