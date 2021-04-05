<?php

namespace Overdose\Brands\Model\BrandsResource\BrandsCollection;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Overdose\Brands\Model\BrandsModel;
use Overdose\Brands\Model\BrandsResource\ResourceModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            BrandsModel::class,
            ResourceModel::class,
        );
    }
}
