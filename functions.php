<?php

$conn = mysqli_connect("localhost", "root", "", "komik_db");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function addComic($data)
{
    global $conn;
    $name = htmlspecialchars($data["name"]);
    $author = htmlspecialchars($data["author"]);
    $genre = htmlspecialchars($data["genre"]);
    $status = htmlspecialchars($data["status"]);
    $gambar = htmlspecialchars($data["gambar"]);

    $query = "INSERT INTO comics VALUES ('', '$name', '$author', '$genre', '$status', '$gambar')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function delete($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM comics WHERE id = $id");
    return mysqli_affected_rows($conn);
}
