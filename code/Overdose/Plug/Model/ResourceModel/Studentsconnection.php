<?php

namespace Overdose\Plug\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Studentsconnection extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('overdose_plug', 'id');
    }
}
