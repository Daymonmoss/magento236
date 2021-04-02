<?php

namespace Overdose\Plug\Model\ResourceModel\Collection;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Overdose\Plug\Model\ResourceModel\Studentsconnection;
use Overdose\Plug\Model\Students;

class Studentscollection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            Students::class,
            Studentsconnection::class,
        );
    }
}
