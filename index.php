<?php
require 'functions.php';

$comic = query("SELECT * FROM comics");

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
        <div class="row justify-content-center mt-5">
            <div class="col d-flex justify-content-center">
                <a href="add.php" class="btn btn-success px-5">Tambah Data</a>
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
                        <?php foreach ($comic as $row) : ?>
                            <tr>
                                <th scope="row"><?= $i++; ?></th>
                                <td><?= $row["name"]; ?></td>
                                <td><?= $row["author"]; ?></td>
                                <td><?= $row["genre"]; ?></td>
                                <td><?= $row["status"]; ?></td>
                                <td><img src="<?= $row["gambar"]; ?>"></td>
                                <td>
                                    <a href="">Edit</a>
                                    <a href="delete.php?id=<?= $row["id"]; ?>" onclick="return confirm('Are you sure?')">Delete</a>
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