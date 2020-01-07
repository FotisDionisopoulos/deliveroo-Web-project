<?php
session_start();
if(isset($_SESSION['name'])) {
    include 'dbh.php';
    $name = $_SESSION['name'];
    $sql = "SELECT * FROM menu";
    $result = mysqli_query($conn, $sql);

} else
    header("Location: index.php");