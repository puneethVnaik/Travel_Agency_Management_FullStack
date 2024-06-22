<?php include('server.php') ?>

<!DOCTYPE html>
<html>
<head>
    <title>View Payment</title>
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
            background-color:#7A2048 ;
        }

        .form-content {
            background-color: #A1BE95; /* Background color for the form content */
            padding: 20px; /* Adjust padding as needed */
        }

        .header {
            background-color:#7A2048; /* Dark background color */
            color: white; /* Text color */
        }
    </style>
</head>
<body style="background-color: #66A5AD ;">
<div class="header">
    <h2>Payment</h2>
</div>
<form method="post" action="C_payment.php"  class="form-content">
    <?php include('errors.php'); ?>
    <div class="input-group">
        <label>Customer id</label>
        <input type="text" name="id">
    </div>
    <div class="input-group">
        <label>Trip id</label>
        <input type="text" name="tid">
    </div>
    <div class="input-group">
        <label>Distance travel (in km)</label>
        <input type="number" id="distance_travel" name="distance_travel">
    </div>
    <div class="input-group">
        <label>Total cost (in Rs.)</label>
        <input type="number" id="total_cost" name="total_cost">
        <button type="button" onclick="calculateTotalCost()">Calculate</button>
    </div>
    <div class="input-group">
        <label>Payment date</label>
        <input type="date" name="pdate">
    </div>
    <div class="input-group">
        <button type="submit" class="btn" name="padd">Add</button>
        <button type="submit" class="btn" name="pmodify">Modify</button>
        <button type="submit" class="btn" name="pdelete">Delete</button>
        <button type="submit" class="btn" name="pclear">Clear</button>
        <button type="submit" class="btn" name="cpback">Back</button>
    </div>
</form>

<script>
    function calculateTotalCost() {
        var distanceTravel = document.getElementById("distance_travel").value;
        var totalCost = distanceTravel * 100; // Assuming Rs. 100 per km
        document.getElementById("total_cost").value = totalCost;
    }
</script>


</body>
</html>
