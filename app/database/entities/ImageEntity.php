<?php

class ImageEntity {
    const TABLE_NAME = "images";
    private string $id;
    private string $uid;
    private string $image;
    private string $user_uid;
    private string $created_at;
    private string $updated_at;

    public function __construct(string $uid, string $image, string $user_uid,  string $created_at, string $updated_at) {
        $this->uid = $uid;
        $this->image = $image;
        $this->user_uid = $user_uid;
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

    public function getImage(): string {
        return $this->image;
    }

    public function setImage(string $image): void {
        $this->image = $image;
    }

    public function getUserUid(): string {
        return $this->user_uid;
    }

    public function setUserUid(string $user_uid): void {
        $this->user_uid = $user_uid;
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
