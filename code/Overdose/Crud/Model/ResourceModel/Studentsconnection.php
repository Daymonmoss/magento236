<?php

namespace Overdose\Crud\Model\ResourceModel;

class Studentsconnection extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('overdose_crud', 'id');
    }
}
