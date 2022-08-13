<?php


class UserFactory {
    /**
     * @param string[]|null|false $result
     * @return UserEntity
     */
    public static function mapFromDatabaseResult($result): UserEntity {
        $entity = new UserEntity(
            $result[UserTableSchema::UID],
            $result[UserTableSchema::USERNAME],
            $result[UserTableSchema::EMAIL],
            $result[UserTableSchema::PASSWORD],
            $result[UserTableSchema::AVATAR],
            $result[UserTableSchema::CREATED_AT],
            $result[UserTableSchema::UPDATED_AT]
        );
        $entity->setId($result[UserTableSchema::ID]);
        return $entity;
    }
}
