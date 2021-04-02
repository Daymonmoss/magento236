<?php

namespace Overdose\Custom\Block;

use \Magento\Customer\Model\Session;
use Magento\Framework\View\Element\Template;

class Overblock extends Template
{
    public function showBlock()
    {
        return "It is Overdose Custom Block!";
    }
}
