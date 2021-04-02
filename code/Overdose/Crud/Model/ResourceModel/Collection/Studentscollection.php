<?php

namespace Overdose\Crud\Model\ResourceModel\Collection;

class Studentscollection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            \Overdose\Crud\Model\Students::class,
            \Overdose\Crud\Model\ResourceModel\Studentsconnection::class,
        );
    }
}
