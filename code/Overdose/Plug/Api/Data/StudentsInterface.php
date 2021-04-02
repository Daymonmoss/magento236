<?php
namespace Overdose\Plug\Api\Data;

use Overdose\Plug\Model\Students;

interface StudentsInterface
{
    const TABLE_NAME = 'overdose_plug';

    const FIELD_NAME_ID = 'id';
    const FIELD_NAME_AGE = 'age';
    const FIELD_NAME_NAME = 'name';
    const FIELD_NAME_DESC = 'description';
    const FIELD_NAME_CREATED_AT = 'created_at';

    /**
    * @return integer
    */
    public function getId();

    /**
    * @return string|integer
    */
    public function getAge();

    /**
    * @param string|integer $age
    * @return StudentsInterface|Students
    */
    public function setAge($age);

    /**
    * @return string
    */
    public function getName();

    /**
    * @param string $name
    * @return StudentsInterface|Students
    */
    public function setName($name);

    /**
    * @return string
    */
    public function getComment();

    /**
    * @param string $desc
    * @return StudentsInterface|Students
    */
    public function setComment($desc);

    /**
    * @return string
    */
    public function getCreatedAt();

    /**
    * @return string
    */
    public function getUpdatedAt();
}
