<?php

session_start();

// if dont have session, not login yet
if (!isset($_SESSION["login"])) {
    header("Location:login.php");
    exit();
}

require 'functions.php';
$id = $_GET["id"];

if (delete($id) > 0) {
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
