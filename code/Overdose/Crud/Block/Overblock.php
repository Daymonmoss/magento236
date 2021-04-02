<?php

namespace Overdose\Crud\Block;

use Magento\Framework\View\Element\Template;

class Overblock extends Template
{
    public function showBlock()
    {
        return "It is Overdose Crud Block!" . "\n";
    }
}
