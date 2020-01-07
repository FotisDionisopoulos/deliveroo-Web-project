<?php
if(!isset($_SESSION))
{
    session_start();
}
include 'dbh.php';
//Detect Ajax request
if(empty($_SERVER['HTTP_X_REQUESTED_WITH']) || !strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    exit;
}
$user_id = $_SESSION['user_id'];
$sql = "SELECT store_id FROM manages WHERE $user_id = man_id";
$result4 = mysqli_query($conn, $sql);
$store_id = mysqli_fetch_row($result4);
//echo $store_id[0];
foreach($_POST['items'] as $proion => $update) {
        //echo 'alert(message successfully sent)';
        $sql = "UPDATE stock SET qnt=qnt +'$update'  WHERE store_id = '$store_id[0]' AND prod_name_st = '$proion';";
        $sql_ins = mysqli_query($conn, $sql);


}
echo "asdddddddddddddddddddddddd";
//header("Location: index.php");
