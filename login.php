<?php
session_start();
require 'functions.php';

// check cookie
if (isset($_COOKIE["id"]) && isset($_COOKIE["key"])) {
    $id = $_COOKIE["id"];
    $key = $_COOKIE["key"];

    // get username by id
    $query = "SELECT * FROM users WHERE id ='$id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    // check cookie and username
    if ($key === hash('sha256', $row["username"])) {
        $_SESSION["login"] = true;
    }
}

// check session if already login
if (isset($_SESSION["login"])) {
    header("Location:index.php");
    exit();
}

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT * FROM users WHERE username ='$username'";
    $result = mysqli_query($conn, $query);

    // check username 
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        // check password
        if (password_verify($password, $row["password"])) {
            // set session
            $_SESSION["login"] = true;

            // check remember me then set cookie
            if (isset($_POST["rememberme"])) {
                setcookie('id', $row["id"], time() + 60);
                setcookie('key', hash('sha256', $row["username"]), time() + 60);
            }
            header("Location:index.php");
            exit;
        }
    }
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1>Login Form</h1>
        <div class="row">
            <div class="col">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Email address</label>
                        <input type="text" name="username" class="form-control" placeholder="Username">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email address</label>
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>
                    <div class="mb-3">
                        <button type="submit" name="login" class="btn btn-success">Login</button>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label" for="rememberMe">
                            Remember Me
                        </label>
                        <input class="form-check-input" name="rememberme" type="checkbox" value="" id="rememberMe">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>