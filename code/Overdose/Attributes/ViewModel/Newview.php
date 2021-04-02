<?php

namespace Overdose\Attributes\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class Newview implements ArgumentInterface
{
    public function fromViewModel(): string
    {
        return "This message is from Overdose Attributes ViewModel";
    }
}
