<?php

class UserEntity {
    const TABLE_NAME = "users";
    private string $id;
    private string $uid;
    private string $username;
    private string $email;
    private string $password;
    private string $avatar;
    private string $created_at;
    private string $updated_at;

    public function __construct(string $uid, string $username, string $email, string $password, string $avatar,  string $created_at, string $updated_at) {
        $this->uid = $uid;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->avatar = $avatar;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public function getId(): ?string {
        return $this->id;
    }

    public function setId(string $id): void {
        $this->id = $id;
    }

    public function getUid(): string {
        return $this->uid;
    }

    public function setUid(string $uid): void {
        $this->uid = $uid;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function setUsername(string $username): void {
        $this->username = $username;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function setPassword(string $password): void {
        $this->password = $password;
    }

    public function getAvatar(): string {
        return $this->avatar;
    }

    public function setAvatar(string $avatar): void {
        $this->avatar = $avatar;
    }

    public function getCreatedAt(): string {
        return $this->created_at;
    }

    public function setCreatedAt(string $created_at): void {
        $this->created_at = $created_at;
    }

    public function getUpdatedAt(): string {
        return $this->updated_at;
    }

    public function setUpdatedAt(string $updated_at): void {
        $this->updated_at = $updated_at;
    }

}
