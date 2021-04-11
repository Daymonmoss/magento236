<?php

namespace Overdose\Plug\Plugin;

use Overdose\Plug\Model\StudentsResource\StudentsCollection\Collection;

class BeforePlugin
{
    /**
     * @var Collection
     */
    private $studentsCollection;

    public function __construct(Collection $studentsCollection)
    {
        $this->studentsCollection = $studentsCollection;
    }
    public function beforeLoad(Collection $studentsCollection, $printQuery = false, $logQuery = false)
    {
        $studentsCollection->addFieldToFilter('age', ["gt" => 18]);
    }
}
