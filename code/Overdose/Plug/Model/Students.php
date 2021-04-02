<?php

namespace Overdose\Plug\Model;

use Magento\Framework\Model\AbstractModel;
use Overdose\Plug\Model\ResourceModel\Studentsconnection;

class Students extends AbstractModel
{
    protected $_eventPrefix = 'overdose_plug_event';

    protected function _construct()
    {
        $this->_init(Studentsconnection::class);
    }
}
