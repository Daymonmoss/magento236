<?php

namespace Overdose\Plug\Block;

use Magento\Framework\View\Element\Template;

class Overblock extends Template
{
    public function showBlock()
    {
        return "It is Overdose Plug Block!" . "\n";
    }
}
