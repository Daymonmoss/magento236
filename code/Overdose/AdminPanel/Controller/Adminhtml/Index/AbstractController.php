<?php
namespace Overdose\AdminPanel\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Framework\Controller\Result\JsonFactory;
use Overdose\LessonOne\Model\FriendsFactory;
use Overdose\LessonOne\Model\ResourceModel\Friends;
use Overdose\LessonOne\Api\FriendRepositoryInterface;

abstract class AbstractController extends Action
{

    const DEFAULT_ACTION_PATH = 'myadminroute/index/';
    /**
     * @var FriendsFactory
     */
    protected $friendsFactory;

    /**
     * @var Friends
     */
    protected $friendsResourceModel;

    /**
     * @var \Overdose\LessonOne\Model\ResourceModel\Collection\FriendsFactory
     */
    protected $friendsCollectionFactory;

    /**
     * @var FriendRepositoryInterface
     */
    protected $friendRepository;

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
        FriendsFactory $friendsFactory,
        Friends $friendsResourceModel,
        \Overdose\LessonOne\Model\ResourceModel\Collection\FriendsFactory $friendsCollectionFactory,
        FriendRepositoryInterface $friendRepository,
        JsonFactory $jsonFactory,
        Filter $filter

        // TODO: Add your repository or model/resourceModel classes here
    ) {
        parent::__construct($context);
        $this->friendsFactory = $friendsFactory;
        $this->friendsResourceModel = $friendsResourceModel;
        $this->friendsCollectionFactory = $friendsCollectionFactory;
        $this->friendRepository = $friendRepository;
        $this->jsonFactory = $jsonFactory;
        $this->filter = $filter;
        // TODO: Assign them to the protected variable, so that child classes can access it
    }

    public function getAllFriends()
    {
        $collection = $this->friendsCollectionFactory->create();
        return $collection->getItems();
    }

}
