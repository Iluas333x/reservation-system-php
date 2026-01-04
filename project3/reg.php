<?php
include("config.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = mysqli_real_escape_string($conn, $_POST["fullname"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $phone = mysqli_real_escape_string($conn, $_POST["phone"]);
    $confirmpassword = mysqli_real_escape_string($conn, $_POST["confirm_password"]);

    if ($password == $confirmpassword) {
        $q2 = "SELECT * FROM peoples WHERE email = '$email'";
        $res = mysqli_query($conn, $q2);

    }else{
         header("location:registration_page.php");
    }
        
        if (mysqli_num_rows($res) > 0) {
            $error = 'this email already exists';
        } else{
            $sql = "INSERT INTO peoples (name, email, phone, password) VALUES ('$name', '$email', '$phone', '$password')";
            mysqli_query($conn, $sql);
            session_start();
            $_SESSION["email"] = $email;
            $_SESSION["name"] = $name;
        
        }
    } else {
        $error = 'check the information';
    }









?>