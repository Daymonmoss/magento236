<?php

namespace Overdose\Crud\Model;

use Magento\Framework\Model\AbstractModel;
use Overdose\Crud\Model\StudentsResource\ResourceModel;

class StudentsModel extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }
}
