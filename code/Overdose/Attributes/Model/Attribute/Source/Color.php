<?php

namespace Overdose\Attributes\Model\Attribute\Source;
use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;

class Color extends AbstractSource
{
    protected $_options;

    /**
     * getAllOptions
     *
     * @return array
     */
    public function getAllOptions()
    {
        if ($this->_options === null) {
            $this->_options = [
                ['value' => 'Pure', 'label' => __('Pure')],
                ['value' => 'Obsidian', 'label' => __('Obsidian')],
                ['value' => 'Ametyst', 'label' => __('Ametyst')],
                ['value' => 'Emerald', 'label' => __('Emerald')],
                ['value' => 'Scarlet', 'label' => __('Scarlet')]
            ];
        }
        return $this->_options;
    }

    final public function toOptionArray()
    {
        return [
            ['value' => 'Pure', 'label' => __('Pure')],
            ['value' => 'Obsidian', 'label' => __('Obsidian')],
            ['value' => 'Ametyst', 'label' => __('Ametyst')],
            ['value' => 'Emerald', 'label' => __('Emerald')],
            ['value' => 'Scarlet', 'label' => __('Scarlet')]
        ];
    }

}
