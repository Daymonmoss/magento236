<?php

namespace Overdose\Brands\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class Newview implements ArgumentInterface
{
    public function fromViewModel(): string
    {
        return "This message is from Overdose Brands ViewModel";
    }
}
