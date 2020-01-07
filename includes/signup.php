<?php
session_start();
if(isset($_POST['register'])){
    include_once 'dbh.php';

    $name = mysqli_real_escape_string($conn,  $_POST['name']);
    $email = mysqli_real_escape_string($conn,  $_POST['email']);
    $pass = mysqli_real_escape_string($conn,  $_POST['pass']);
    $phone = mysqli_real_escape_string($conn,  $_POST['phone']);
    $atrr = mysqli_real_escape_string($conn,  $_POST['$atrr']);

    //Err check
    if(empty($name) ||empty($email) ||empty($pass) ||empty($phone))
    {
        header("Location: ../register.php?signup=empty");
        exit();
    }

    if(!preg_match("/^[a-zA-Z0-9]+([_ -]?[a-zA-Z0-9])*$/", $name))
    {
        header("Location: ../register.php?signup=invalid");
        exit();
    }

    if(!preg_match("/^[0-9]{10}/", $phone))
    {
        header("Location: ../register.php?signup=phone");
        exit();
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("Location: ../register.php?signup=email");
        exit();
    }


    $sql = "SELECT * FROM users WHERE username = '$name'";
    $result = mysqli_query($conn, $sql);
    $resultcheck = mysqli_num_rows($result);

    if($resultcheck > 0)
    {
        header("Location: ../register.php?signup=usertaken");
        exit();
    } else{
        //Insert user
        //0 Admin
        //1 regular user
        //2 manager
        //3 delivery guy
        $sql = "INSERT INTO users(username, email, pass,  tel, atrr) VALUES ('$name', '$email', '$pass', '$phone', '1');";


        mysqli_query($conn, $sql);

        $sql = "SELECT * FROM users WHERE username = '$name'";
        $result = mysqli_query($conn, $sql);
        $resultcheck = mysqli_num_rows($result);



        $_SESSION['name'] = $row['username'];
        $_SESSION['pass'] = $row['pass'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['phone'] = $row['tel'];
        $_SESSION['atrr'] = $row['atrr'];
        $_SESSION['user_id'] = $row['user_id'];

        header("Location: ../user.php");

        exit();
    }



} else {
    header("Location: ../register.php");
    exit();

}