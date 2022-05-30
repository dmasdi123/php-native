<?php
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col">
                <a href="add.php" class="btn btn-success px-5">Tambah Data</a>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <form action="" method="POST">
                    <div class="input-group mb-3">
                        <input type="text" name="keyword" class="form-control" placeholder="Searching Comics ...">
                        <button class="btn btn-outline-secondary" type="submit" name="search">Search</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col">
                <h1>Comics List</h1>
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

    <!-- <script>
        alert('success');
        document.location.href = 'index.php';
    </script> -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>