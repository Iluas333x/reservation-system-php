<?php
include("config.php");
session_start();

// FIX: Initialize session variables if they don't exist to prevent errors
if(!isset($_SESSION['name'])) $_SESSION['name'] = '';
if(!isset($_SESSION['email'])) $_SESSION['email'] = '';

$s = ''; // Initialize success message

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = mysqli_real_escape_string($conn, $_POST["name"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $time = mysqli_real_escape_string($conn, $_POST["time"]);
    $date = mysqli_real_escape_string($conn, $_POST["date"]);
    $people = mysqli_real_escape_string($conn, $_POST["people"]);
    
    $sql = "INSERT INTO resirvation1(name, email, time, date, person)
    VALUES ('$name', '$email', '$time', '$date', '$people')";
    mysqli_query($conn, $sql);
    $s = '<div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px; text-align: center;">Reservation successful! Return to home page</div>';
    if (isset($_POST['boton'])){
        header('location:index.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Bliss</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            line-height: 1.6;
            color: #333;
        }

        /* Header */
        header {
            height: 100vh;
            background: url('https://images.unsplash.com/photo-1511920170033-f8396924c348?auto=format&fit=crop&w=1950&q=80') no-repeat center center/cover;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: #fff;
            position: relative;
        }

        header::after {
            content: "";
            position: absolute;
            top:0; left:0; right:0; bottom:0;
            background: rgba(0,0,0,0.5);
        }

        header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 64px;
            z-index: 1;
            margin-bottom: 10px;
        }

        header p {
            font-size: 20px;
            z-index: 1;
        }

        /* Navigation */
        nav {
            position: fixed;
            top:0;
            width: 100%;
            display: flex;
            justify-content: center;
            padding: 20px 0;
            background: rgba(0,0,0,0.5);
            z-index: 2;
        }

        nav a {
            color: #fff;
            margin: 0 20px;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s;
        }

        nav a:hover {
            color: #ffbf69;
        }

        /* Section styling */
        section {
            padding: 80px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        section h2 {
            text-align: center;
            font-family: 'Playfair Display', serif;
            margin-bottom: 40px;
            font-size: 36px;
            color: #6b4f3f;
        }

        /* Reservation Form */
        .reservation-form {
            background: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
            max-width: 600px;
            margin: 0 auto;
        }

        .reservation-form label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        .reservation-form input,
        .reservation-form select,
        .reservation-form textarea {
            width: 100%;
            padding: 12px;
            margin-top: 5px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        .reservation-form input[type="submit"] {
            background-color: #6b4f3f;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            margin-top: 20px;
            transition: 0.3s;
        }

        .reservation-form input[type="submit"]:hover {
            background-color: #8b624a;
        }

        /* About Section */
        .about, .menu, .contact {
            text-align: center;
        }

        .about p, .menu p, .contact p {
            max-width: 700px;
            margin: 0 auto;
            font-size: 18px;
            color: #555;
        }

        /* Footer */
        footer {
            background: #6b4f3f;
            color: #fff;
            text-align: center;
            padding: 20px;
        }

        /* Responsive */
        @media(max-width: 768px){
            header h1 {
                font-size: 42px;
            }

            header p {
                font-size: 16px;
            }

            .reservation-form {
                padding: 30px;
            }
        }
    </style>
</head>
<body>

<nav>
    <a href="#reservation">Reservation</a>
    <a href="#about">About Us</a>
    <a href="#menu">Menu</a>
    <a href="#contact">Contact</a>
    <a href="index.php">Home</a>
</nav>

<header>
    <h1>Coffee Bliss</h1>
    <p>Reserve your table and enjoy the perfect cup of coffee</p>
</header>

<section id="reservation">
    <h2>Reserve Your Table</h2>
    <?php 
        if(isset($s) && $s != ''){
            echo $s;
        } 
    ?>
    <form class="reservation-form" action="" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" placeholder="Your full name" value="<?php echo htmlspecialchars($_SESSION['name']); ?>" readonly required>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="you@example.com" value="<?php echo htmlspecialchars($_SESSION['email']); ?>"readonly  required>
        
        <label for="date">Date of Reservation:</label>
        <input type="date" id="date" name="date" required>

        <label for="time">Time of Reservation:</label>
        <input type="time" id="time" name="time" required>

        <label for="people">Number of Persons:</label>
        <select id="people" name="people" required>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4" selected>4</option>
        </select>

        <label for="notes">Special Requests / Notes:</label>
        <textarea id="notes" name="notes" rows="3" placeholder="Optional"></textarea>

        <input type="submit" value="Reserve Now" name="boton">
    </form>
</section>

<section id="about" class="about">
    <h2>About Us</h2>
    <p>At Coffee Bliss, we craft the perfect cup of coffee for every guest. Relax in our cozy atmosphere and enjoy a variety of blends, pastries, and friendly service that makes you feel at home.</p>
</section>

<section id="menu" class="menu">
    <h2>Our Menu</h2>
    <p>Explore our menu of gourmet coffee, fresh pastries, and light bites. From classic espresso to specialty lattes, there's something to delight every coffee lover.</p>
</section>

<section id="contact" class="contact">
    <h2>Contact Us</h2>
    <p>Email: info@coffeebliss.com | Phone: (123) 456-7890 | Address: 123 Coffee St, Caffeine City</p>
</section>

<footer>
    &copy; 2025 Coffee Bliss. All Rights Reserved.
</footer>

</body>
</html>