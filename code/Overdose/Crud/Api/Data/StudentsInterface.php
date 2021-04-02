<?php
namespace Overdose\Crud\Api\Data;

interface StudentsInterface
{
    const TABLE_NAME = 'overdose_crud';

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
    * @return \Overdose\Crud\Api\Data\StudentsInterface|\Overdose\Crud\Model\Students
    */
    public function setAge($age);

    /**
    * @return string
    */
    public function getName();

    /**
    * @param string $name
    * @return \Overdose\Crud\Api\Data\StudentsInterface|\Overdose\Crud\Model\Students
    */
    public function setName($name);

    /**
    * @return string
    */
    public function getComment();

    /**
    * @param string $desc
    * @return \Overdose\Crud\Api\Data\StudentsInterface|\Overdose\Crud\Model\Students
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
