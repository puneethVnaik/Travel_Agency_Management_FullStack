<?php include('server.php') ?>

<!DOCTYPE html>
<html>
<head>
  <title>View Customers</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customer Records</title>
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
            background-color:#735DA5;
        }

        .form-content {
            background-color:#A1BE95; /* Background color for the form content */
            padding: 20px; /* Adjust padding as needed */
        }

        .header {
            background-color: #735DA5; /* Dark background color */
            color: white; /* Text color */
        }
    </style>
</head>
<body style="background-color:#D3C5E5;">

<div class="header">
  <h2>Customers</h2>
</div>

<form method="post" action="C_customer.php" class="form-content">
  <?php include('errors.php'); ?>
  <div class="input-group">
    <label> Customer ID</label>
    <input type="number" name="id">
  </div>
  <div class="input-group">
    <label>Name</label>
    <input type="text" name="name">
  </div>
  <div class="input-group">
    <label>Email</label>
    <input type="email" name="email">
  </div>
  <div class="input-group">
    <label>Phone</label>
    <input type="number" name="phone">
  </div>
  <div class="input-group">
    <label>Address</label>
    <input type="text" name="address">
  </div>
  <div class="input-group">
    <button type="submit" class="btn" name="add">Add</button>
    <button type="submit" class="btn" name="modify">Modify</button>
    <button type="submit" class="btn" name="delete">Delete</button>
    <button type="submit" class="btn" name="clear">Clear</button>
    <button type="submit" class="btn" name="cnext">Next</button>
    <button type="submit" class="btn" name="cback">Back</button>
  </div>
</form>

</body>
</html>
