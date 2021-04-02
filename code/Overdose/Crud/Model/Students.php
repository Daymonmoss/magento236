<?php

namespace Overdose\Crud\Model;

class Students extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        $this->_init(\Overdose\Crud\Model\ResourceModel\Studentsconnection::class);
    }
}
