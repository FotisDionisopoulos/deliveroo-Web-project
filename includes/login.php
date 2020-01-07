<?php
session_start();
if(isset($_POST['login'])){

    include 'dbh.php';

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $pass = mysqli_real_escape_string($conn, $_POST['pass']);


    if(empty($name) || empty($pass))
    {
        header("Location: ../index.php?login=empty");
        exit();
    }

    $sql = "SELECT * FROM users WHERE username = '$name'";
    $result = mysqli_query($conn, $sql);
    $resultcheck = mysqli_num_rows($result);

    if($resultcheck < 1){
        $message = "Username not registered.";
        echo "<script type='text/javascript'>alert('$message');</script>";
        //header("Location: ../index.php?login=error2");
        exit();
    }

    if($row = mysqli_fetch_assoc($result)) {


        if ($pass != $row['pass']) {
            $message = "Username and/or Password incorrect.\\nTry again.";
            echo "<script type='text/javascript'>alert('$message');</script>";
            //header("Location: ../index.php?login=error3");
            //exit();
        } else {
            $_SESSION['name'] = $row['username'];
            $_SESSION['pass'] = $row['pass'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['phone'] = $row['tel'];
            $_SESSION['atrr'] = $row['atrr'];
            $_SESSION['user_id'] = $row['user_id'];


            //Insert user
            //0 Admin
            //1 regular user
            //2 manager
            //3 delivery guy
            if ($row['atrr'] == '0') {
                header("Location: ../admin.php?month=7&year=2018");
                exit();
            }

            if ($row['atrr'] == '1') {
                header("Location: ../user.php");
                exit();
            }

            if ($row['atrr'] == '2') {
                header("Location: ../manager.php");
                exit();
            }

            if ($row['atrr'] == '3') {
                header("Location: ../delivery.php");
                exit();
            }
        }
    }
} else{
    header("Location: ../index.php?login=error1");
    exit();
}

