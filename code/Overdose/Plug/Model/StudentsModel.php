<?php

namespace Overdose\Plug\Model;

use Magento\Framework\Model\AbstractModel;
use Overdose\Plug\Model\StudentsResource\ResourceModel;

class StudentsModel extends AbstractModel
{
    protected $_eventPrefix = 'overdose_plug_event';

    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }
}
