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

if($is_avail[0] == 0){
    $sql = "UPDATE delivery SET is_avail = 1  WHERE user_ID = $userID";
    $sql_ins = mysqli_query($conn, $sql);}
else{
    $sql = "UPDATE delivery SET is_avail = 0  WHERE user_ID = $userID";
    $sql_ins = mysqli_query($conn, $sql);
}

echo $is_avail[0]."fff";