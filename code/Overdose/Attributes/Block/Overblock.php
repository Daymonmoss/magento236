<?php

namespace Overdose\Attributes\Block;

use \Magento\Customer\Model\Session;
use Magento\Framework\View\Element\Template;

class Overblock extends Template
{
    public function showBlock()
    {
        return "It is Overdose Attributes Block!";
    }
}
