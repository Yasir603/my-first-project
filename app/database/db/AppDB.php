<?php

class AppDB {
    const HOSTNAME = "localhost";
    const USERNAME = "root";
    const PASSWORD = "";
    const DATABASE = "yasir_db";

    private mysqli $conn;

    private UserDao $userDao;
    private PostDao $postDao;
    private ImageDao $imageDao;

    function __construct() {
        $temp_conn = mysqli_connect(self::HOSTNAME, self::USERNAME, self::PASSWORD, self::DATABASE);

        if (!$temp_conn) {
            die("Couldn't Connect to DB!");
        }

        $this->conn = $temp_conn;

        mysqli_query($this->conn, (new UserTableSchema())->getBlueprint()); // Creates User Table
        $this->userDao = new UserDao($this->conn); // Initialize User Dao

        mysqli_query($this->conn, (new PostTableSchema())->getBlueprint()); // Creates Post Table
        $this->postDao = new PostDao($this->conn); // Initialize Post Dao

        mysqli_query($this->conn, (new ImageTableSchema())->getBlueprint()); // Creates Image Table
        $this->imageDao = new ImageDao($this->conn); // Initialize Image Dao

    }

    public function getConnection(): mysqli {
        return $this->conn;
    }

    public function closeConnection() {
        $this->conn->close();
    }

    public function getUserDao(): UserDao {
        return $this->userDao;
    }

    public function getPostDao(): PostDao {
        return $this->postDao;
    }

    public function getImageDao(): ImageDao {
        return $this->imageDao;
    }
}

