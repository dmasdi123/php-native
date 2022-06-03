<?php
require '../functions.php';

$keyword = $_GET["keyword"];
$query = "SELECT * FROM comics WHERE 
nama LIKE '%$keyword%' OR
author LIKE '%$keyword%' OR
genre LIKE '%$keyword%' OR
statuss LIKE '%$keyword%' OR
gambar LIKE '%$keyword%'
";

$dataComics = query($query);

?>
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