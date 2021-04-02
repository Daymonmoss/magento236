<?php
namespace Overdose\LessonOne\Model;

use \Overdose\LessonOne\Api\Data\FriendInterface;

class Friends extends \Magento\Framework\Model\AbstractModel implements FriendInterface
{
//    protected function _afterLoad()
//    {
//        /** @var \Overdose\LessonOne\Api\Data\FriendInterface $model */
//        $model = parent::_afterLoad();
//        $model->setName('OOP IS POWERFUL AS A ZEUS HIMSELF!');
//        $model->setData('wowowowow', 'Wow. This is amazing.');
//        return $model;
//    }

    protected $_eventPrefix = 'abussas_or_michail';

    protected $_eventObject = 'popopopopo';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(\Overdose\LessonOne\Model\ResourceModel\Friends::class);
    }

    /**
     * @inheritDoc
     */
    public function getId()
    {
        return $this->getData(FriendInterface::FIELD_NAME_ID);
    }

    /**
     * @inheritDoc
     */
    public function setAge($age)
    {
        return $this->setData(FriendInterface::FIELD_NAME_AGE, $age);
    }

    /**
     * @inheritDoc
     */
    public function getAge()
    {
        return $this->getData(FriendInterface::FIELD_NAME_AGE);
    }

    /**
     * @inheritDoc
     */
    public function setName(string $name)
    {
        return $this->setData(FriendInterface::FIELD_NAME_NAME, $name);
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return $this->getData(FriendInterface::FIELD_NAME_NAME);
    }

    /**
     * @inheritDoc
     */
    public function setComment(string $comment)
    {
        return $this->setData(FriendInterface::FIELD_NAME_COMMENT, $comment);
    }

    /**
     * @inheritDoc
     */
    public function getComment()
    {
        return $this->getData(FriendInterface::FIELD_NAME_COMMENT);
    }

    /**
     * @inheritDoc
     */
    public function getCreatedAtTimeStamp()
    {
        return $this->getData(FriendInterface::FIELD_NAME_CREATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function getUpdatedAtTimeStamp()
    {
        return $this->getData(FriendInterface::FIELD_NAME_UPDATED_AT);
    }
}
