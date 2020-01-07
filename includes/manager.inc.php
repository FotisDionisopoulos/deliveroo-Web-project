<?php
session_start();
if(isset($_SESSION['name'])) {
    include 'dbh.php';
    $name = $_SESSION['name'];
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM menu";
    $result = mysqli_query($conn, $sql);


    $sql = "SELECT store_id FROM manages WHERE $user_id = man_id";
    $result4 = mysqli_query($conn, $sql);
    $store_id = mysqli_fetch_row($result4);

    $sql = "SELECT * FROM orders WHERE $store_id[0] = store_id AND is_delivered = 0";
    $result2 = mysqli_query($conn, $sql);

    $sql = "SELECT TRUNCATE(SUM(total_price), 2) FROM orders WHERE $store_id[0] = store_id AND MONTH(placed_order) = MONTH(CURRENT_DATE()) AND YEAR(placed_order) = YEAR(CURRENT_DATE())";
    $result3 = mysqli_query($conn, $sql);
} else
    header("Location: index.php");