<?php

namespace Overdose\Attributes\Model\Attribute\Frontend;

use Magento\Framework\DataObject;
use Magento\Eav\Model\Entity\Attribute\Frontend\AbstractFrontend;

class Rating extends AbstractFrontend
{
    public function getValue(DataObject $object)
    {
        $value = $object->getData($this->getAttribute()->getAttributeCode());

        return "<b>number_format($value, 1, '.', ' ')</b>";

    }
}

