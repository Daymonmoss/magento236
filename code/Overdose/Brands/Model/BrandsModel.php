<?php

namespace Overdose\Brands\Model;

use Magento\Framework\Model\AbstractExtensibleModel;
use Overdose\Brands\Model\BrandsResource\ResourceModel;

class BrandsModel extends AbstractExtensibleModel
{
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }
}
