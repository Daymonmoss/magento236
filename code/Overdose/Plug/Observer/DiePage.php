<?php
namespace Overdose\Plug\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;


class DiePage implements ObserverInterface
{

    public function execute(Observer $observer)
    {
        $getPage = $observer->getData('plug_index_die');

        echo $getPage . die('dead');
    }
}
