<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
    <title>View Vehicle</title>
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
            background-color: #20948B;
        }

        .form-content {
            background-color:  #FFF2D7; /* Background color for the form content */
            padding: 20px; /* Adjust padding as needed */
        }

        .header {
            background-color:  #20948B; /* Dark background color */
            color: white; /* Text color */
        }
    </style>
</head>
<body style="background-color:#6AB187  ;">
<div class="header">
    <h2>Vehicle</h2>
</div>

<form method="post" action="C_vehicle.php"  class="form-content">
    <?php include('errors.php'); ?>
    <div class="input-group">
        <label>vid</label>
        <input type="text" name="vid">
    </div>
    <div class="input-group">
        <label>vname</label>
        <input type="text" name="vname">
    </div>
    <div class="input-group">
        <label>capacity</label>
        <input type="number" name="capacity">
    </div>
    <div class="input-group">
        <label>type</label>
        <input type="text" name="type">
    </div>
    
    <div class="input-group">
        <button type="submit" class="btn" name="vadd">Add</button>
        <button type="submit" class="btn" name="vmodify">Modify</button>
        <button type="submit" class="btn" name="vdelete">Delete</button>
        <button type="submit" class="btn" name="clear">Clear</button>
        <button type="submit" class="btn" name="cvnext">Next</button>
        <button type="submit" class="btn" name="cvback">Back</button>
    </div>
</form>


</body>
</html>
