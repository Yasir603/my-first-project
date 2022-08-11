<?php

class ImageDao extends TableDao {


    public function __construct(mysqli $connection) { // <***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>
        parent::__construct($connection);
    } // </***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>

    public function insertImage(ImageEntity $imageEntity): ?ImageEntity { // <***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>
        $query = QueryBuilder::withQueryType(QueryType::INSERT)
            ->withTableName(ImageEntity::TABLE_NAME)
            ->columns([
                ImageTableSchema::UID,
                ImageTableSchema::IMAGE,
                ImageTableSchema::USER_UID,
                ImageTableSchema::CREATED_AT,
                ImageTableSchema::UPDATED_AT
            ])
            ->values([
                $this->escape_string($imageEntity->getUid()),
                $this->escape_string($imageEntity->getImage()),
                $this->escape_string($imageEntity->getUserUid()),
                $this->escape_string($imageEntity->getCreatedAt()),
                $this->escape_string($imageEntity->getUpdatedAt())
            ])
            ->generate();

        $result = mysqli_query($this->getConnection(), $query);

        if ($result) {
            return $this->getImageWithId($this->inserted_id());
        }
        return null;
    } // </***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>

    public function getImageWithId(string $id): ?ImageEntity { // <***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>
        $query = QueryBuilder::withQueryType(QueryType::SELECT)
             ->withTableName(ImageEntity::TABLE_NAME)
             ->columns(['*'])
             ->whereParams([
                [ImageTableSchema::ID, '=', $this->escape_string($id)]
             ])
             ->generate();

        $result = mysqli_query($this->getConnection(), $query);

        if ($result && $result->num_rows >= 1) {
            return ImageFactory::mapFromDatabaseResult(mysqli_fetch_assoc($result));
        }
        return null;
    } // </***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>

    public function getImageWithUid(string $uid): ?ImageEntity { // <***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>
        $query = QueryBuilder::withQueryType(QueryType::SELECT)
             ->withTableName(ImageEntity::TABLE_NAME)
             ->columns(['*'])
             ->whereParams([
                [ImageTableSchema::UID, '=', $this->escape_string($uid)]
             ])
             ->generate();

        $result = mysqli_query($this->getConnection(), $query);

        if ($result && $result->num_rows >= 1) {
            return ImageFactory::mapFromDatabaseResult(mysqli_fetch_assoc($result));
        }
        return null;
    } // </***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>

    public function getAllImage(): array { // <***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>
        $query = QueryBuilder::withQueryType(QueryType::SELECT)
             ->withTableName(ImageEntity::TABLE_NAME)
             ->columns(['*'])
             ->generate();

        $result = mysqli_query($this->getConnection(), $query);

        $images = [];

        if ($result) {
            while($row = mysqli_fetch_assoc($result)) {
                array_push($images, ImageFactory::mapFromDatabaseResult($row));
            }
        }
        return $images;
    } // </***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>

    public function updateImage(ImageEntity $imageEntity): ?ImageEntity { // <***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>
        $query = QueryBuilder::withQueryType(QueryType::UPDATE)
            ->withTableName(ImageEntity::TABLE_NAME)
            ->updateParams([
                [ImageTableSchema::IMAGE, $this->escape_string($imageEntity->getImage())],
                [ImageTableSchema::USER_UID, $this->escape_string($imageEntity->getUserUid())],
                [ImageTableSchema::CREATED_AT, $this->escape_string($imageEntity->getCreatedAt())],
                [ImageTableSchema::UPDATED_AT, $this->escape_string($imageEntity->getUpdatedAt())]
            ])
            ->whereParams([
                [ImageTableSchema::ID, '=', $this->escape_string($imageEntity->getId())]
            ])
            ->generate();

        $result = mysqli_query($this->getConnection(), $query);

        if ($result) {
            return $this->getImageWithId($imageEntity->getId());
        }
        return null;
    } // </***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>

    public function deleteImage(ImageEntity $imageEntity) { // <***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>
        $query = QueryBuilder::withQueryType(QueryType::DELETE)
            ->withTableName(ImageEntity::TABLE_NAME)
            ->whereParams([
                [ImageTableSchema::ID, '=', $this->escape_string($imageEntity->getId())]
            ])
            ->generate();

        while(true) {
            if (mysqli_query($this->getConnection(), $query)) {
                break;
            }
        }
    } // </***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>

    public function deleteAllImages() { // <***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>
        $query = QueryBuilder::withQueryType(QueryType::DELETE)
            ->withTableName(ImageEntity::TABLE_NAME)
            ->generate();

        while(true) {
            if (mysqli_query($this->getConnection(), $query)) {
                break;
            }
        }
    } // </***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>

}
