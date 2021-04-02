<?php

namespace Overdose\Plug\Plugin;

use Overdose\Plug\Model\ResourceModel\Collection\Studentscollection;

class BeforePlugin
{
    /**
     * @var Studentscollection
     */
    private $studentsCollection;

    public function __construct(Studentscollection $studentsCollection)
    {
        $this->studentsCollection = $studentsCollection;
    }
    public function beforeLoad(Studentscollection $studentsCollection, $printQuery = false, $logQuery = false)
    {
        $studentsCollection->addFieldToFilter('age', ["gt" => 18]);
    }
}
