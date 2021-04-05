<?php
namespace Overdose\Crud\Api\Data;

use Overdose\Crud\Setup\Patch\Data\StudentsModel;

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
    * @return StudentsInterface|StudentsModel
    */
    public function setAge($age);

    /**
    * @return string
    */
    public function getName();

    /**
    * @param string $name
    * @return StudentsInterface|StudentsModel
    */
    public function setName($name);

    /**
    * @return string
    */
    public function getComment();

    /**
    * @param string $desc
    * @return StudentsInterface|StudentsModel
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
