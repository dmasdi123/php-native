<?php
session_start();

// if dont have session, not login yet
if (!isset($_SESSION["login"])) {
    header("Location:login.php");
    exit();
}

require 'functions.php';

$dataComics = query("SELECT * FROM comics");
if (isset($_POST["search"])) {
    $dataComics = find($_POST["keyword"]);
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta a="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col">
                <a href="add.php" class="btn btn-success px-5">Tambah Data</a>
                <a href="logout.php" class="btn btn-warning px-5">Logout</a>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <form action="" method="POST">
                    <div class="input-group mb-3">
                        <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Searching Comics ...">
                        <button class="btn btn-outline-secondary" type="submit" id="search-button" name="search">Search</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col">
                <h1>Comics List</h1>
                <div id="contain-table-ajax">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Name</th>
                                <th scope="col">Author</th>
                                <th scope="col">Genre</th>
                                <th scope="col">Status</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($dataComics as $data) : ?>
                                <tr>
                                    <th scope="data"><?= $i++; ?></th>
                                    <td><?= $data["nama"]; ?></td>
                                    <td><?= $data["author"]; ?></td>
                                    <td><?= $data["genre"]; ?></td>
                                    <td><?= $data["statuss"]; ?></td>
                                    <!-- src ganti ke img/ kalau mau pake img dari fodler img -->
                                    <td><img src="<?= $data["gambar"]; ?>"></td>
                                    <td>
                                        <a href="edit.php?id=<?= $data["id"]; ?>">Edit</a>
                                        <a href="delete.php?id=<?= $data["id"]; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>