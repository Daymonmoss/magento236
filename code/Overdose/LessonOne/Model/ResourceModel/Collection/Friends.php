<?php
namespace Overdose\LessonOne\Model\ResourceModel\Collection;

class Friends extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            \Overdose\LessonOne\Model\Friends::class,
            \Overdose\LessonOne\Model\ResourceModel\Friends::class
        );
    }
}
