<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
    <title>View Bookings</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        .input-group button {
            color: white;
            background-color:#F96167 ;
        }

        .form-content {
            background-color: #FFF2D7; /* Background color for the form content */
            padding: 20px; /* Adjust padding as needed */
        }

        .header {
            background-color:#F96167; /* Dark background color */
            color: white; /* Text color */
        }
    </style>
</head>
<body style="background-color:#F9E795 ;">
<div class="header">
    <h2>Bookings</h2>
</div>

<form method="post" action="C_booking.php"  class="form-content">
    <?php include('errors.php'); ?>
    <div class="input-group">
        <label>id</label>
        <input type="text" name="id">
    </div>
    <div class="input-group">
        <label>vid</label>
        <input type="text" name="vid">
    </div>
    <div class="input-group">
        <label>tid</label>
        <input type="text" name="tid">
    </div>
    <div class="input-group">
        <label>bdate</label>
        <input type="date" name="bdate">
    </div>
    <div class="input-group">
        <button type="submit" class="btn" name="badd">Add</button>
        <button type="submit" class="btn" name="bmodify">Modify</button>
        <button type="submit" class="btn" name="bdelete">Delete</button>
        <button type="submit" class="btn" name="clear">Clear</button>
        <button type="submit" class="btn" name="cbback">Back</button>
    </div>
</form>


</body>
</html>
