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
    $nama = htmlspecialchars($data["nama"]);
    $author = htmlspecialchars($data["author"]);
    $genre = htmlspecialchars($data["genre"]);
    $statuss = htmlspecialchars($data["statuss"]);
    $gambar = htmlspecialchars($data["gambar"]);

    $query = "INSERT INTO comics VALUES ('', '$nama', '$author', '$genre', '$statuss', '$gambar')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function delete($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM comics WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function update($data)
{
    global $conn;
    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $author = htmlspecialchars($data["author"]);
    $genre = htmlspecialchars($data["genre"]);
    $statuss = htmlspecialchars($data["statuss"]);
    $gambar = htmlspecialchars($data["gambar"]);

    $query = "UPDATE comics SET
        nama = '$nama',
        author = '$author',
        genre = '$genre',
        statuss = '$statuss',
        gambar = '$gambar'
        WHERE id = $id
        ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
