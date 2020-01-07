<?php
if(!isset($_SESSION))
{
    session_start();
}
include 'dbh.php';
if(empty($_SERVER['HTTP_X_REQUESTED_WITH']) || !strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    exit;
}
$user_id = $_SESSION['user_id'];
$order_id = $_POST['order_ID'];

$sql = "UPDATE orders SET is_delivered = 1  WHERE ID = '$order_id'";
$sql_ins = mysqli_query($conn, $sql);

$sql = "SELECT lat, lng FROM orders WHERE ID = '$order_id'";
$result = mysqli_query($conn, $sql);
$res = mysqli_fetch_row($result);

$sql = "UPDATE delivery SET lat =$res[0], lng = $res[1] WHERE user_ID = '$user_id'";
$ins = mysqli_query($conn, $sql);
echo $user_id;
