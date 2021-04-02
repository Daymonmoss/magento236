<?php

namespace Overdose\Custom\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class Newview implements ArgumentInterface
{
    public function fromViewModel(): string
    {
        return "This message is from Overdose Custom ViewModel";
    }
}
