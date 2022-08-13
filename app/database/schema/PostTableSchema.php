<?php

class PostTableSchema extends TableSchema {

    const ID = "id";
    const UID = "uid";
    const USER_UID = "user_uid";
    const VIDEO = "video";
    const TEXT = "text";
    const CREATED_AT = "created_at";
    const UPDATED_AT = "updated_at";

    public function __construct() { parent::__construct(PostEntity::TABLE_NAME); }

    public function getBlueprint(): string {
        return "CREATE TABLE IF NOT EXISTS " . $this->getTableName() . "(
            " . self::ID . " INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
            " . self::UID . " VARCHAR(50) NOT NULL,
            " . self::USER_UID . " VARCHAR(150) NOT NULL,
            " . self::VIDEO . " VARCHAR(150) NOT NULL,
            " . self::TEXT . " VARCHAR(500) NOT NULL,
            " . self::CREATED_AT . " VARCHAR(100) NOT NULL,
            " . self::UPDATED_AT . " VARCHAR(100) NOT NULL
        )";
    }
}
