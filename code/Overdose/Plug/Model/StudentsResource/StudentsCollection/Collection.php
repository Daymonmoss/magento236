<?php

namespace Overdose\Plug\Model\StudentsResource\StudentsCollection;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Overdose\Plug\Model\StudentsResource\ResourceModel;
use Overdose\Plug\Model\StudentsModel;

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
