<?php

class UserDao extends TableDao {


    public function __construct(mysqli $connection) { // <***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>
        parent::__construct($connection);
    } // </***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>

    public function insertUser(UserEntity $userEntity): ?UserEntity { // <***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>
        $query = QueryBuilder::withQueryType(QueryType::INSERT)
            ->withTableName(UserEntity::TABLE_NAME)
            ->columns([
                UserTableSchema::UID,
                UserTableSchema::USERNAME,
                UserTableSchema::EMAIL,
                UserTableSchema::PASSWORD,
                UserTableSchema::AVATAR,
                UserTableSchema::CREATED_AT,
                UserTableSchema::UPDATED_AT
            ])
            ->values([
                $this->escape_string($userEntity->getUid()),
                $this->escape_string($userEntity->getUsername()),
                $this->escape_string($userEntity->getEmail()),
                $this->escape_string($userEntity->getPassword()),
                $this->escape_string($userEntity->getAvatar()),
                $this->escape_string($userEntity->getCreatedAt()),
                $this->escape_string($userEntity->getUpdatedAt())
            ])
            ->generate();

        $result = mysqli_query($this->getConnection(), $query);

        if ($result) {
            return $this->getUserWithId($this->inserted_id());
        }
        return null;
    } // </***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>

    public function getUserWithId(string $id): ?UserEntity { // <***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>
        $query = QueryBuilder::withQueryType(QueryType::SELECT)
             ->withTableName(UserEntity::TABLE_NAME)
             ->columns(['*'])
             ->whereParams([
                [UserTableSchema::ID, '=', $this->escape_string($id)]
             ])
             ->generate();

        $result = mysqli_query($this->getConnection(), $query);

        if ($result && $result->num_rows >= 1) {
            return UserFactory::mapFromDatabaseResult(mysqli_fetch_assoc($result));
        }
        return null;
    } // </***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>

    public function getUserWithUid(string $uid): ?UserEntity { // <***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>
        $query = QueryBuilder::withQueryType(QueryType::SELECT)
             ->withTableName(UserEntity::TABLE_NAME)
             ->columns(['*'])
             ->whereParams([
                [UserTableSchema::UID, '=', $this->escape_string($uid)]
             ])
             ->generate();

        $result = mysqli_query($this->getConnection(), $query);

        if ($result && $result->num_rows >= 1) {
            return UserFactory::mapFromDatabaseResult(mysqli_fetch_assoc($result));
        }
        return null;
    } // </***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>

    public function getAllUser(): array { // <***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>
        $query = QueryBuilder::withQueryType(QueryType::SELECT)
             ->withTableName(UserEntity::TABLE_NAME)
             ->columns(['*'])
             ->generate();

        $result = mysqli_query($this->getConnection(), $query);

        $users = [];

        if ($result) {
            while($row = mysqli_fetch_assoc($result)) {
                array_push($users, UserFactory::mapFromDatabaseResult($row));
            }
        }
        return $users;
    } // </***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>

    public function updateUser(UserEntity $userEntity): ?UserEntity { // <***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>
        $query = QueryBuilder::withQueryType(QueryType::UPDATE)
            ->withTableName(UserEntity::TABLE_NAME)
            ->updateParams([
                [UserTableSchema::USERNAME, $this->escape_string($userEntity->getUsername())],
                [UserTableSchema::EMAIL, $this->escape_string($userEntity->getEmail())],
                [UserTableSchema::PASSWORD, $this->escape_string($userEntity->getPassword())],
                [UserTableSchema::AVATAR, $this->escape_string($userEntity->getAvatar())],
                [UserTableSchema::CREATED_AT, $this->escape_string($userEntity->getCreatedAt())],
                [UserTableSchema::UPDATED_AT, $this->escape_string($userEntity->getUpdatedAt())]
            ])
            ->whereParams([
                [UserTableSchema::ID, '=', $this->escape_string($userEntity->getId())]
            ])
            ->generate();

        $result = mysqli_query($this->getConnection(), $query);

        if ($result) {
            return $this->getUserWithId($userEntity->getId());
        }
        return null;
    } // </***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>

    public function deleteUser(UserEntity $userEntity) { // <***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>
        $query = QueryBuilder::withQueryType(QueryType::DELETE)
            ->withTableName(UserEntity::TABLE_NAME)
            ->whereParams([
                [UserTableSchema::ID, '=', $this->escape_string($userEntity->getId())]
            ])
            ->generate();

        while(true) {
            if (mysqli_query($this->getConnection(), $query)) {
                break;
            }
        }
    } // </***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>

    public function deleteAllUsers() { // <***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>
        $query = QueryBuilder::withQueryType(QueryType::DELETE)
            ->withTableName(UserEntity::TABLE_NAME)
            ->generate();

        while(true) {
            if (mysqli_query($this->getConnection(), $query)) {
                break;
            }
        }
    } // </***_ELECTRO_GENERATED_DO_NOT_REMOVE_***>

}
