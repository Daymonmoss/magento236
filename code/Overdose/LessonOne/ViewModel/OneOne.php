<?php
namespace Overdose\LessonOne\ViewModel;

use \Overdose\LessonOne\Model\FriendsFactory as SomethingDifferent;

class OneOne implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    /**
     * @var null|\Overdose\LessonOne\Model\Friends
     */
    private $model = null;

    /**
     * @var SomethingDifferent
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

    protected $data;

    /**
     * OneOne constructor.
     *
     * @param SomethingDifferent $friendsFactory
     * @param \Overdose\LessonOne\Model\ResourceModel\Friends $friendsResourceModel
     * @param \Overdose\LessonOne\Model\ResourceModel\Collection\FriendsFactory $friendsCollectionFactory
     * @param string $data
     */
    public function __construct(
        \Overdose\LessonOne\Model\FriendsFactory $friendsFactory,
        \Overdose\LessonOne\Model\ResourceModel\Friends $friendsResourceModel,
        \Overdose\LessonOne\Model\ResourceModel\Collection\FriendsFactory $friendsCollectionFactory,
        string $data = 'we'
    ) {
        $this->friendsFactory = $friendsFactory;
        $this->friendsResourceModel = $friendsResourceModel;
        $this->friendsCollectionFactory = $friendsCollectionFactory;
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function iAmViewModel()
    {
        return 'i am view model ' . $this->data;
    }

    /**
     * @param string $name
     * @param integer $age
     * @param string $comment
     */
    public function saveNewFriend($name, $age, $comment)
    {
        for ($i = 0; $i < 10; $i++) {
//            'Semen', '156', 'A cool guy'
            $model = $this->friendsFactory->create();

            $model->setData('age', $age)
                ->setData('name', $name)
                ->setData('comment', $comment);

            $this->friendsResourceModel->save($model);
        }


//        $this->friendsResourceModel->load($model, 'ivan', 'name');

//        load model by default field. ( field specified in the 'resourceModel::_construct()' )
//        $this->friendsResourceModel->load($model, 3);

//        $this->friendsResourceModel->delete($model);

    }

    /**
     * Get collection of all friends from 'overdose_lesson_one'
     *
     * @return \Magento\Framework\DataObject[]|\Overdose\LessonOne\Model\ResourceModel\Collection\Friends[]
     */
    public function getAllFriends()
    {
        $collection = $this->friendsCollectionFactory->create();

//      'equal' => 3        ||   'id' === 3
        $collection->addFieldToFilter('id', ['eq' => 3]);

//      'not equal' => 7    ||   'id' !== 7
//      $collection->addFieldToFilter('id', ['neq' => 7]);

//      'greater then equal' => 4    ||   'id' >= 4
//      $collection->addFieldToFilter('id', ['gteq' => 4]);

//      'lower then equal' => 6    ||   'id' <= 6
//      $collection->addFieldToFilter('id', ['lteq' => 6]);

        $collection->load();

        return $collection->getItems();
    }

    /**
     * Return name of the friend
     *
     * @param int $id
     * @return string
     */
    public function getFriendName($id)
    {
        return $this->getFriendModel($id)->getData('name');
    }

    /**
     * Return model if exists.
     * IF not, load from db and then return.
     *
     * @param integer $id
     * @return \Overdose\LessonOne\Model\Friends|null
     */
    public function getFriendModel($id)
    {
        if ($this->model === null ) {
            // Creates new instance of the 'friends object'. A.K.A. individual line/row from mysql table.
            $model = $this->friendsFactory->create();

            // Loads the data from the database and puts it to the $model variable.
            $this->friendsResourceModel->load($model, $id);

            // Save model to the class, so that same model won't be loaded numerous times.
            $this->model = $model;
        }

        return $this->model;
    }
}
