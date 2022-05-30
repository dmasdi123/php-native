<?php
require 'functions.php';

$id = $_GET["id"];
$dataComics = query("SELECT * FROM comics WHERE id = $id");

if (isset($_POST["submit"])) {
    if (update($_POST) > 0) {
        echo "
        <script>
        alert('success');
        document.location.href = 'index.php';
        </script>
        ";
    } else {
        echo "
        <script>
        alert('failed');
        document.location.href = 'index.php';
        </script>
        ";
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
        <div class="row mt-5">
            <h1>Edit Comics Form</h1>
            <div class="col">
                <?php foreach ($dataComics as $data) : ?>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $data["id"]; ?>">
                        <input type="hidden" name="oldImage" value="<?= $data["gambar"]; ?>">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="nama" class="form-control" value="<?= $data["nama"]; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Author</label>
                            <input type="text" name="author" class="form-control" value="<?= $data["author"]; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Genre</label>
                            <input type="text" name="genre" class="form-control" value="<?= $data["genre"]; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <input type="text" name="statuss" class="form-control" value="<?= $data["statuss"]; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gambar</label>
                            <img src="<?= $data["gambar"]; ?>" alt="">
                            <input type="file" name="gambar" class="form-control">
                        </div>
                        <div class="mb-3 text-center">
                            <button type="Submit" name="submit" class="btn btn-lg btn-success">Update Comic</button>
                        </div>
                    </form>
                <?php endforeach; ?>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>