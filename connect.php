<?php

class Config {
    public $HOSTNAME = "127.0.0.1";
    public $USERNAME = "root";
    public $PASSWORD = "";
    public $DATABASE = "users";
    public $connection = false;

    public function connect() {
        $connection = mysqli_connect($this->HOSTNAME, $this->USERNAME, $this->PASSWORD, $this->DATABASE);

        if (!$connection) {
            die("Connection failed: " . mysqli_connect_error());
        }

        return $connection;
    }

    public function addMovie($title, $description, $release_date) {
        $connection = $this->connect();

        $sql = "INSERT INTO movies (title, description, release_date) VALUES ('$title', '$description', '$release_date')";

        $res = mysqli_query($connection, $sql);

        return $res;
    }

    public function fetchAllMovies() {
        $connection = $this->connect();

        $sql = "SELECT * FROM movies";

        $res = mysqli_query($connection, $sql);

        return $res;
    }

    public function fetchSingleMovie($id) {
        $connection = $this->connect();

        $sql = "SELECT * FROM movies WHERE id=$id";

        $res = mysqli_query($connection, $sql);

        return $res;
    }

    public function updateMovie($title, $description, $release_date, $id) {
        $connection = $this->connect();

        $sql = "UPDATE movies SET title='$title', description='$description', release_date='$release_date' WHERE id=$id";

        $res = mysqli_query($connection, $sql);

        return $res;
    }

    public function deleteMovie($id) {
        $connection = $this->connect();

        $sql = "DELETE FROM movies WHERE id=$id";

        $res = mysqli_query($connection, $sql);

        return $res;
    }

}

?>
