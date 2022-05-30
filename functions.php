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

function upload()
{
    $nameFile = $_FILES['gambar']['name'];
    $sizeFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tempName = $_FILES['gambar']['tmp_name'];
    // check if image uploaded or not
    if ($error === 4) {
        echo  "
        <script>
        alert('Choose File First!');
        </script>
        ";
        return false;
    }

    // check only image uploaded
    $extensionImgValidation = ['jpg', 'jpeg', 'png'];
    $extensionImg = explode('.', $nameFile);
    $extensionImg = strtoLower(end($extensionImg));

    if (!in_array($extensionImg, $extensionImgValidation)) {
        echo  "
        <script>
        alert('file uploaded not image!');
        </script>
        ";
        return false;
    }

    // if file size to large
    if ($sizeFile > 1000000) {
        echo  "
        <script>
        alert('file uploaded size to large!');
        </script>
        ";
        return false;
    }

    // generate new image files for duplicate issue
    $newNameFile = uniqid();
    $newNameFile .= '.';
    $newNameFile .= $extensionImg;

    // after image validated
    move_uploaded_file($tempName, 'img/' . $newNameFile);
    return $newNameFile;
}

function addComic($data)
{
    global $conn;
    $nama = htmlspecialchars($data["nama"]);
    $author = htmlspecialchars($data["author"]);
    $genre = htmlspecialchars($data["genre"]);
    $statuss = htmlspecialchars($data["statuss"]);
    // $gambar = htmlspecialchars($data["gambar"]);

    // upload gambar
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

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
    $oldImage = $data["oldImage"];


    // check if user pick new image or not
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $oldImage;
    } else {
        $gambar = upload();
    }


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

function find($keyword)
{
    $query = "SELECT * FROM comics WHERE 
    nama LIKE '%$keyword%' OR
    author LIKE '%$keyword%' OR
    genre LIKE '%$keyword%' OR
    statuss LIKE '%$keyword%' OR
    gambar LIKE '%$keyword%'
    ";
    return query($query);
}

function register($data)
{
    global $conn;
    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $confirmPass = mysqli_real_escape_string($conn, $data["confirmpass"]);

    //check username duplicate or not
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo  "
        <script>
        alert('username already used!');
        </script>
        ";
        return false;
    }

    // check confirm password
    if ($password !== $confirmPass) {
        echo  "
        <script>
        alert('Password not same as confirm password');
        </script>
        ";
        return false;
    } else {
        echo mysqli_error($conn);
    }

    // ecryp password
    $password = password_hash($password, PASSWORD_DEFAULT);

    //insert into db
    $query = "INSERT INTO users VALUE(
        '',
        '$username',
        '$password')
        ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
