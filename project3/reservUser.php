<?php
include("config.php");
if(isset($_SESSION["role"])){
     header("location:login.php");
}
$email = $_SESSION["email"];
$q = "SELECT * FROM resirvation1 WHERE email = '$email";
$result = mysqli_query($conn, $q);
$row = mysqli_fetch_array($result);
 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation User Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .status-confirmed {
            color: green;
            font-weight: bold;
        }
        .status-pending {
            color: orange;
            font-weight: bold;
        }
        .status-cancelled {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>My Reservations</h1>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Time</th>
                <th>Persons</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>2025-12-20</td>
                <td>18:30</td>
                <td>2</td>
                <td class="status-confirmed">Confirmed</td>
            </tr>
            <tr>
                <td>2025-12-22</td>
                <td>20:00</td>
                <td>4</td>
                <td class="status-pending">Pending</td>
            </tr>
            <tr>
                <td>2025-12-25</td>
                <td>19:00</td>
                <td>3</td>
                <td class="status-cancelled">Cancelled</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
