<?php


class ImageFactory {
    /**
     * @param string[]|null|false $result
     * @return ImageEntity
     */
    public static function mapFromDatabaseResult($result): ImageEntity {
        $entity = new ImageEntity(
            $result[ImageTableSchema::UID],
            $result[ImageTableSchema::IMAGE],
            $result[ImageTableSchema::USER_UID],
            $result[ImageTableSchema::CREATED_AT],
            $result[ImageTableSchema::UPDATED_AT]
        );
        $entity->setId($result[ImageTableSchema::ID]);
        return $entity;
    }
}
