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
include 'dbh.php';
if(empty($_SERVER['HTTP_X_REQUESTED_WITH']) || !strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    exit;
}
$userID = $_SESSION['user_id'];
$sql = "SELECT is_avail, ID FROM delivery WHERE user_ID = $userID";
$result = mysqli_query($conn, $sql);
$is_avail = mysqli_fetch_row($result);


$sql = "SELECT end_sh FROM shifts WHERE delivery_guy = $is_avail[1] AND  DAY(end_sh) = DAY(CURRENT_DATE())";
$sql_ins = mysqli_query($conn, $sql);

if(mysqli_num_rows($sql_ins))
{
    echo "You have ended your shift already!";
}else
{
    $sql = "INSERT INTO shifts(delivery_guy, end_sh) VALUES( '$is_avail[1]',  now())";
    $sql = "UPDATE shifts SET end_sh = now() WHERE delivery_guy = $is_avail[1] AND  DAY(start_sh) = DAY(CURRENT_DATE())";
    $sql_ins = mysqli_query($conn, $sql);
    echo "You just ended your shift!";
}

