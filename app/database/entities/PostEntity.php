<?php

class PostEntity {
    const TABLE_NAME = "posts";
    private string $id;
    private string $uid;
    private string $user_uid;
    private string $video;
    private string $text;
    private string $created_at;
    private string $updated_at;

    public function __construct(string $uid, string $user_uid, string $video, string $text,  string $created_at, string $updated_at) {
        $this->uid = $uid;
        $this->user_uid = $user_uid;
        $this->video = $video;
        $this->text = $text;
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

    public function getUserUid(): string {
        return $this->user_uid;
    }

    public function setUserUid(string $user_uid): void {
        $this->user_uid = $user_uid;
    }

    public function getVideo(): string {
        return $this->video;
    }

    public function setVideo(string $video): void {
        $this->video = $video;
    }

    public function getText(): string {
        return $this->text;
    }

    public function setText(string $text): void {
        $this->text = $text;
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
