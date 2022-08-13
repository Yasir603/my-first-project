<?php

class UserTableSchema extends TableSchema {

    const ID = "id";
    const UID = "uid";
    const USERNAME = "username";
    const EMAIL = "email";
    const PASSWORD = "password";
    const AVATAR = "avatar";
    const CREATED_AT = "created_at";
    const UPDATED_AT = "updated_at";

    public function __construct() { parent::__construct(UserEntity::TABLE_NAME); }

    public function getBlueprint(): string {
        return "CREATE TABLE IF NOT EXISTS " . $this->getTableName() . "(
            " . self::ID . " INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
            " . self::UID . " VARCHAR(50) NOT NULL,
            " . self::USERNAME . " VARCHAR(150) NOT NULL,
            " . self::EMAIL . " VARCHAR(150) NOT NULL,
            " . self::PASSWORD . " VARCHAR(150) NOT NULL,
            " . self::AVATAR . " VARCHAR(150) NOT NULL,
            " . self::CREATED_AT . " VARCHAR(100) NOT NULL,
            " . self::UPDATED_AT . " VARCHAR(100) NOT NULL
        )";
    }
}
