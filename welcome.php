<?php include('server.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Agency Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-image: url('travel5.jpg'); /* Replace 'background_image.jpg' with your image file */
            background-size: cover;
            background-position: center;
            height: 100vh;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative; /* Position relative for absolute positioning of buttons */
        }
        #buttons {
            position: absolute;
            top: 20px; /* Adjust this value to adjust the vertical position */
            right: 20px; /* Adjust this value to adjust the horizontal position */
            display: flex;
            flex-direction: row; /* Arrange buttons horizontally */
            gap: 10px; /* Add space between buttons */
        }
        #buttons form {
            display: flex;
            flex-direction: column;
            align-items: flex-end; /* Align buttons to the right within each form */
        }
        #welcome {
            margin-top: 50px;
            font-size: 60px;
            padding: 20px;
            border-radius: 10px;
            position: absolute;
            top: 170px; /* Adjust this value to adjust the vertical position */
            right: 16%; /* Adjust this value to set the gap from the right */
            text-align: right; /* Align text to the right */
            font-weight: bold; /* Make text bold */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Stylish font style */
        }
        #welcome p:first-child {
            margin-bottom: 5px; /* Add space between the sentences */
        }
        #travel {
            margin-top: 50px;
            font-size: 55px;
            padding: 10px;
            border-radius: 10px;
            position: absolute;
            top: 215px; /* Adjust this value to adjust the vertical position */
            right: 1%; /* Align to the right */
            text-align: right; /* Align text to the right */
            font-weight: bold; /* Make text bold */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Stylish font style */
        }

        
        .butt {
            padding: 15px 25px;
            font-size: 16px;
            margin: 10px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            background-color:purple;
            color: #fff;
        }
        .butt:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div id="buttons">
        <form action="register.php">
            <button type="submit" class="butt">Register</button>
        </form>
        <form action="login.php">
            <button type="submit" class="butt">Admin Login</button>
        </form>
        <form action="login.php">
            <button type="submit" class="butt">User Login</button>
        </form>
    </div>
    <div id="welcome">
        <p>Welcome to</p><br><br><br>
    </div>
    <div id="travel">
        <br><p>Travel Agency Management</p>
    </div>
</body>
</html>
