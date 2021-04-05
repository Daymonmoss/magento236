<?php

namespace Overdose\Brands\Model\Attribute\Backend;

use Magento\Catalog\Model\Product;
use Magento\Eav\Model\Entity\Attribute\Backend\AbstractBackend;
use Magento\Framework\Exception\LocalizedException;

class Brand extends AbstractBackend
{
    /**
     * Validate
     * @param Product $object
     * @throws LocalizedException
     * @return bool
     */
    public function validate($object)
    {
        $value = $object->getData($this->getAttribute()->getAttributeCode());

//        if ($value == null && $object->getTypeId() == "simple") {
//            throw new LocalizedException(
//                __('Overdose Color must have some color' . "\n")
//            );
//        }
        return true;
    }
}
