<?php
namespace Overdose\LessonOne\Api\Data;

interface FriendInterface
{
    const TABLE_NAME = 'overdose_lesson_one';

    const FIELD_NAME_ID = 'id';
    const FIELD_NAME_AGE = 'age';
    const FIELD_NAME_NAME = 'name';
    const FIELD_NAME_COMMENT = 'comment';
    const FIELD_NAME_CREATED_AT = 'created_at';
    const FIELD_NAME_UPDATED_AT = 'updated_at';

    /**
     * @return integer
     */
    public function getId();

    /**
     * @param string|integer $age
     * @return \Overdose\LessonOne\Api\Data\FriendInterface
     */
    public function setAge($age);

    /**
     * @return string|integer
     */
    public function getAge();

    /**
     * @param string $name
     * @return \Overdose\LessonOne\Api\Data\FriendInterface
     */
    public function setName(string $name);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $comment
     * @return \Overdose\LessonOne\Api\Data\FriendInterface
     */
    public function setComment(string $comment);

    /**
     * @return string
     */
    public function getComment();

    /**
     * @return string
     */
    public function getCreatedAtTimeStamp();

    /**
     * Return updated_at timestamp
     *
     * @return string
     */
    public function getUpdatedAtTimeStamp();
}
