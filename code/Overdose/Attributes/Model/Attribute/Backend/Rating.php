<?php

namespace Overdose\Attributes\Model\Attribute\Backend;

use Magento\Catalog\Model\Product;
use Magento\Eav\Model\Entity\Attribute\Backend\AbstractBackend;
use Magento\Framework\Exception\LocalizedException;

class Rating extends AbstractBackend
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
        if ($value < 0 or $value > 5.0) {
            throw new LocalizedException(
                __('Overdose Product Rating must be between 0 and 5.0')
            );
        }
        return true;
    }
}
