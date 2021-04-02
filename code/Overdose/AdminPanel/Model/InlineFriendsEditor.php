<?php

namespace Overdose\AdminPanel\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Stdlib\DateTime;

use Overdose\LessonOne\Api\Data\FriendInterface as LessonsInterface;
use Overdose\LessonOne\Model\ResourceModel\Friends as ResourceModel;

class InlineFriendsEditor extends AbstractModel implements LessonsInterface, IdentityInterface
{
    /**
     * No route page id
     */
    const NOROUTE_PAGE_ID = 'no-route';

    /** {@inheritdoc} */
    public function getIdentities()
    {
        return [sprintf("%s_%s", "myadminroute", $this->getId())];
    }

    /** {@inheritdoc} */
    public function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    /** {@inheritdoc} */
    public function getById($id)
    {
        $this->setData(LessonsInterface::FIELD_NAME_ID, $id);

        return $this;
    }
    /** {@inheritdoc} */
    public function getName()
    {
        return $this->getData(LessonsInterface::FIELD_NAME_NAME);
    }

    /** {@inheritdoc} */
    public function setName($name)
    {
        $this->setData(LessonsInterface::FIELD_NAME_NAME, $name);

        return $this;
    }
    /** {@inheritdoc} */
    public function getAge()
    {
        return $this->getData(LessonsInterface::FIELD_NAME_AGE);
    }

    /** {@inheritdoc} */
    public function setAge($age)
    {
        $this->setData(LessonsInterface::FIELD_NAME_AGE, $age);

        return $this;
    }
    /** {@inheritdoc} */
    public function getComment()
    {
        return $this->getData(LessonsInterface::FIELD_NAME_COMMENT);
    }

    /** {@inheritdoc} */
    public function setComment($comment)
    {
        $this->setData(LessonsInterface::FIELD_NAME_COMMENT, $comment);

        return $this;
    }
    /** {@inheritdoc} */
    public function getUpdatedAtTimeStamp()
    {
        return $this->getData(LessonsInterface::FIELD_NAME_UPDATED_AT);
    }
    /** {@inheritdoc} */
    public function getCreatedAtTimeStamp()
    {
        return $this->getData(LessonsInterface::FIELD_NAME_CREATED_AT);
    }
}

