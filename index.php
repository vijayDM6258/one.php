<?php

$config = new Config();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['title'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $release_date = $_POST['release_date'];

    $response = $config->addMovie($title, $description, $release_date);

    if ($response) {
        echo json_encode(array("message" => "Movie added successfully"));
    } else {
        echo json_encode(array("message" => "Failed to add movie"));
    }
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['action']) && $_GET['action'] == 'get_all_movies') {
    $result = $config->fetchAllMovies();
    $movies = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $movies[] = $row;
        }
    }

    echo json_encode($movies);
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['action']) && $_GET['action'] == 'get_movie' && isset($_GET['id'])) {
    $id = $_GET['id'];

    $result = $config->fetchSingleMovie($id);

    if ($result->num_rows == 1) {
        $movie = $result->fetch_assoc();
        echo json_encode($movie);
    } else {
        echo json_encode(array("message" => "Movie not found"));
    }
}

if ($_SERVER["REQUEST_METHOD"] == "PUT" && isset($_GET['action']) && $_GET['action'] == 'update_movie' && isset($_GET['id'])) {
    parse_str(file_get_contents("php://input"), $_PUT);

    $id = $_GET['id'];
    $title = $_PUT['title'];
    $description = $_PUT['description'];
    $release_date = $_PUT['release_date'];

    $response = $config->updateMovie($title, $description, $release_date, $id);

    if ($response) {
        echo json_encode(array("message" => "Movie updated successfully"));
    } else {
        echo json_encode(array("message" => "Failed to update movie"));
    }
}

if ($_SERVER["REQUEST_METHOD"] == "DELETE" && isset($_GET['action']) && $_GET['action'] == 'delete_movie' && isset($_GET['id'])) {
    $id = $_GET['id'];

    $response = $config->deleteMovie($id);

    if ($response) {
        echo json_encode(array("message" => "Movie deleted successfully"));
    } else {
        echo json_encode(array("message" => "Failed to delete movie"));
    }
}
?>
