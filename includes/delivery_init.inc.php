<?php
/**
 * Created by PhpStorm.
 * User: fotis
 * Date: 17-Jul-18
 * Time: 19:08
 */
if(!isset($_SESSION))
{
    session_start();
}

$userID = $_SESSION['user_id'];
$sql = "SELECT is_avail, ID FROM delivery WHERE user_ID = $userID";
$result = mysqli_query($conn, $sql);
$is_avail = mysqli_fetch_row($result);

echo $is_avail[1];
$sql = "SELECT * FROM orders WHERE delivery_guy = $is_avail[1]";
$result = mysqli_query($conn, $sql);


$sql = "SELECT SUM(distance) FROM orders WHERE delivery_guy = $is_avail[1] AND DAY(placed_order) = DAY(CURRENT_DATE()) AND is_delivered = 1";
$result2 = mysqli_query($conn, $sql);


$sql = "SELECT time_to_sec(timediff(end_sh, start_sh))/3600 FROM shifts WHERE delivery_guy = $is_avail[1] AND DAY(start_sh) = DAY(CURRENT_DATE())";
$result3 = mysqli_query($conn, $sql);



