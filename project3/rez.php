<?php
include("config.php");

session_start();
if(isset($_SESSION["role"])){
    header("location:login.php");
}
// FIX: Initialize session variables if they don't exist
if(!isset($_SESSION['name'])) $_SESSION['name'] = '';
if(!isset($_SESSION['email'])) $_SESSION['email'] = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get data from POST - using correct field names from HTML form
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $time = mysqli_real_escape_string($conn, $_POST["time"]);
    $date = mysqli_real_escape_string($conn, $_POST["date"]);
    $people = mysqli_real_escape_string($conn, $_POST["people"]);
    
    $sql = "INSERT INTO resirvation1(name, email, time, date, person)
    VALUES ('$name', '$email', '$time', '$date', '$people')";
    mysqli_query($conn, $sql);
    $s = 'done';
}
?>