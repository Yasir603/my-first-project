<?php


class PostFactory {
    /**
     * @param string[]|null|false $result
     * @return PostEntity
     */
    public static function mapFromDatabaseResult($result): PostEntity {
        $entity = new PostEntity(
            $result[PostTableSchema::UID],
            $result[PostTableSchema::USER_UID],
            $result[PostTableSchema::VIDEO],
            $result[PostTableSchema::TEXT],
            $result[PostTableSchema::CREATED_AT],
            $result[PostTableSchema::UPDATED_AT]
        );
        $entity->setId($result[PostTableSchema::ID]);
        return $entity;
    }
}
