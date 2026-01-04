<?php
include("config.php");
session_start();
// تسجيل الخروج
if(isset($_GET["logout"])){
    session_unset();
    session_destroy();
    // استخدام JavaScript للتوجيه
    echo "<script>window.location.href='login.html';</script>";
    exit();
}

// تسجيل الدخول
if(isset($_POST["log"])){
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    
    $q = "SELECT * FROM `peoples` WHERE email = '$email' AND password = '$password'";
    $res = mysqli_query($conn, $q);
    
    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_array($res);
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $row['name'];
        $_SESSION['role'] = $row['role'];
        echo "<script>window.location.href='index.php';</script>";
        exit();
    } else {
        echo "<script>window.location.href='login.html';</script>";
        exit();
    }
}
?>