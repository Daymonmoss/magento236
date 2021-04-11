<?php

namespace Overdose\Plug\Model\StudentsResource;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class ResourceModel extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('overdose_plug', 'id');
    }
}
