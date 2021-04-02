<?php
namespace Daymonmoss\DuplicateEntry\Plugin;

use Magento\Eav\Model\Entity\Collection\AbstractCollection;
use Magento\Framework\DataObject;

class Collection
{
    /**
     * @param AbstractCollection $subject
     * @param \Closure $process
     * @param DataObject $dataObject
     * @return $this
     */
    public function aroundAddItem(AbstractCollection $subject, \Closure $process, DataObject $dataObject)
    {
        try {
            return $process($dataObject);
        } catch (\Exception $e) {
            return $this;
        }
    }
}
