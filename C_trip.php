<?php include('server.php') ?>

<!DOCTYPE html>
<html>
<head>
    <title>View Trip</title>
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
            background-color:#2C5F2D;
        }

        .form-content {
            background-color:#A1BE95; /* Background color for the form content */
            padding: 20px; /* Adjust padding as needed */
        }

        .header {
            background-color: #2C5F2D; /* Dark background color */
            color: white; /* Text color */
        }
    </style>
</head>
<body style="background-color:#97BC62;">
    <div class="header">
        <h2>Trip</h2>
    </div>

    <form method="post" action="C_trip.php" class="form-content">
        <?php include('errors.php'); ?>
        <div class="input-group">
            <label>trip id</label>
        <select name="trip id">
        <option value="t1">t1</option>
        <option value="t2">t2</option>
        <option value="t3">t3</option>
        <option value="t4">t4</option>
        <option value="t5">t5</option>
        <option value="t6">t6</option>
        <option value="t7">t7</option>
        <option value="t8">t8</option>
        <option value="t9">t9</option>
        <option value="t10">t10</option>
        <option value="t11">t11</option>
        <option value="t12">t12</option>

       
    </select> 
    
        <div class="input-group">
            <label>source</label>
            <input type="text" name="source">
        </div>
        <div class="input-group">
            <label>destination</label>
            <input type="text" name="destination">
        </div>
        <div class="input-group">
            <label>start date</label>
            <input type="date" name="sdate">
        </div>
        <div class="input-group">
            <label>end date</label>
            <input type="date" name="edate">
        </div>
        <div class="input-group">
            <button type="submit" class="btn" name="tadd">Add</button>
            <button type="submit" class="btn" name="tmodify">Modify</button>
            <button type="submit" class="btn" name="tdelete">Delete</button>
            <button type="submit" class="btn" name="clear">Clear</button>
            <button type="submit" class="btn" name="ctnext">Next</button>
            <button type="submit" class="btn" name="ctback">Back</button>
        </div>
    </form>
</body>
</html>
