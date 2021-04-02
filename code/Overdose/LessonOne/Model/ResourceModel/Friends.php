<?php
namespace Overdose\LessonOne\Model\ResourceModel;

class Friends extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init(
            \Overdose\LessonOne\Api\Data\FriendInterface::TABLE_NAME,
            \Overdose\LessonOne\Api\Data\FriendInterface::FIELD_NAME_ID
        );
    }
}
