<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <style>
        /* BODY STYLING */
        body {
            font-family: 'Georgia', serif;
            background: linear-gradient(135deg, #603402ff 0%, #4a2802 50%, #2d1a01 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            position: relative;
            overflow: hidden;
        }

        /* Animated coffee bean pattern */
        body::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(circle at 15% 20%, rgba(139, 69, 19, 0.15) 0%, transparent 25%),
                radial-gradient(circle at 85% 30%, rgba(160, 82, 45, 0.12) 0%, transparent 30%),
                radial-gradient(circle at 50% 70%, rgba(101, 67, 33, 0.18) 0%, transparent 35%),
                radial-gradient(circle at 25% 80%, rgba(139, 69, 19, 0.1) 0%, transparent 28%),
                radial-gradient(circle at 75% 85%, rgba(160, 82, 45, 0.14) 0%, transparent 32%);
            animation: drift 25s ease-in-out infinite;
            opacity: 0.8;
        }

        /* Floating coffee steam effect */
        body::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(ellipse at 40% 60%, rgba(255, 235, 205, 0.03) 0%, transparent 40%),
                radial-gradient(ellipse at 60% 40%, rgba(255, 235, 205, 0.04) 0%, transparent 45%),
                radial-gradient(ellipse at 30% 30%, rgba(255, 235, 205, 0.02) 0%, transparent 35%);
            animation: steam 15s ease-in-out infinite;
            filter: blur(60px);
        }

        @keyframes drift {
            0%, 100% { 
                transform: translate(0, 0) scale(1);
                opacity: 0.8;
            }
            25% { 
                transform: translate(-30px, -40px) scale(1.05);
                opacity: 0.9;
            }
            50% { 
                transform: translate(-60px, -80px) scale(1.1);
                opacity: 0.7;
            }
            75% { 
                transform: translate(-30px, -40px) scale(1.05);
                opacity: 0.85;
            }
        }

        @keyframes steam {
            0%, 100% {
                transform: translateY(0) scaleY(1);
                opacity: 0.5;
            }
            50% {
                transform: translateY(-50px) scaleY(1.2);
                opacity: 0.8;
            }
        }

        /* CONTAINER CARD */
        .container {
            background: linear-gradient(145deg, #7a5a42 0%, #6f4e37 100%);
            padding: 40px 35px;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.5), 
                        0 0 0 1px rgba(255, 235, 205, 0.1) inset;
            width: 380px;
            color: #fff;
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            position: relative;
            z-index: 1;
            backdrop-filter: blur(10px);
        }

        .container::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, #ffebcd, #8b4513, #a0522d, #ffebcd);
            border-radius: 20px;
            z-index: -1;
            opacity: 0;
            transition: opacity 0.4s ease;
            background-size: 300% 300%;
            animation: gradientShift 6s ease infinite;
        }

        @keyframes gradientShift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        .container:hover::before {
            opacity: 0.3;
        }

        .container:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 70px rgba(0,0,0,0.6),
                        0 0 0 1px rgba(255, 235, 205, 0.2) inset;
        }

        /* HEADINGS */
        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #ffebcd;
            font-size: 32px;
            font-weight: 600;
            letter-spacing: 1px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            animation: fadeInDown 0.6s ease;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* LABELS */
        label {
            display: block;
            margin-bottom: 8px;
            color: #ffe4c4;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        /* INPUT FIELDS */
        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="password"] {
            width: 100%;
            padding: 16px;
            margin: 0 0 20px 0;
            border: 2px solid transparent;
            border-radius: 10px;
            box-sizing: border-box;
            background-color: #fff3e6;
            color: #4b2e2e;
            font-weight: 600;
            font-size: 15px;
            box-shadow: inset 0 3px 8px rgba(0,0,0,0.15);
            transition: all 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="tel"]:focus,
        input[type="password"]:focus {
            box-shadow: inset 0 3px 12px rgba(0,0,0,0.2),
                        0 0 0 3px rgba(255, 235, 205, 0.3);
            outline: none;
            border-color: #ffebcd;
            background-color: #ffffff;
            transform: translateY(-2px);
        }

        input::placeholder {
            color: #a67c52;
            font-style: italic;
            font-weight: 500;
        }

        /* BUTTON */
        button {
            width: 100%;
            padding: 16px;
            background: linear-gradient(145deg, #8b4513, #a0522d);
            color: #fff5e6;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 18px;
            font-weight: bold;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
            position: relative;
            overflow: hidden;
            margin-top: 10px;
        }

        button::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        button:hover::before {
            width: 300px;
            height: 300px;
        }

        button:hover {
            background: linear-gradient(145deg, #a0522d, #8b4513);
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.4);
        }

        button:active {
            transform: translateY(-1px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.3);
        }

        /* FOOTER */
        .footer {
            text-align: center;
            margin-top: 25px;
            font-size: 15px;
            color: #ffe4c4;
            animation: fadeIn 1s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .footer a {
            color: #fff5e6;
            text-decoration: none;
            font-weight: bold;
            position: relative;
            transition: color 0.3s ease;
        }

        .footer a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -2px;
            left: 0;
            background-color: #fff5e6;
            transition: width 0.3s ease;
        }

        .footer a:hover::after {
            width: 100%;
        }

        .footer a:hover {
            color: #ffebcd;
        }

        /* SUCCESS / ERROR MESSAGES */
        .success {
            color: #d4edda;
            background: rgba(212, 237, 218, 0.2);
            padding: 12px;
            border-radius: 8px;
            text-align: center;
            margin-bottom: 20px;
            border-left: 4px solid #28a745;
            animation: slideIn 0.5s ease;
        }

        .error {
            color: #f8d7da;
            background: rgba(248, 215, 218, 0.2);
            padding: 12px;
            border-radius: 8px;
            text-align: center;
            margin-bottom: 20px;
            border-left: 4px solid #dc3545;
            animation: slideIn 0.5s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* FORM ANIMATION */
        form {
            animation: fadeInUp 0.8s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <?php if(isset($eroor)){
            echo $eroor;
        } ?>
        <form action="reg.php" method="post">
            <label for="fullname">Full Name</label>
            <input type="text" id="fullname" name="fullname" placeholder="Enter your full name" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>

            <label for="phone">Phone</label>
            <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter password" required>

            <label for="confirm_password">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm password" required>

            <button type="submit">Register</button>
        </form>
        <div class="footer">
            Already have an account? <a href="login.html">Login</a>
        </div>
    </div>
</body>
</html>