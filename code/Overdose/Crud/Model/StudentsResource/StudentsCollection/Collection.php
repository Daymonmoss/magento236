<?php

namespace Overdose\Crud\Model\StudentsResource\StudentsCollection;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Overdose\Crud\Model\StudentsModel;
use Overdose\Crud\Model\StudentsResource\ResourceModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            StudentsModel::class,
            ResourceModel::class,
        );
    }
}
