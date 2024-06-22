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

       
        table {
        width: 100%;
        border-collapse: collapse;
        border: 1px solid black; /* Set table border width to 6% */
    }

    th, td {
        border: 1px solid black;
        text-align: left;
        padding: 8px;
        color: black; /* Set default font color */
    }

  

    tbody {
        background-color:#D3C5E5 ; /* Set table body background color as yellow */
    }
    .form-content {
            background-color:#FFF2D7; /* Background color for the form content */
            padding: 20px; /* Adjust padding as needed */
        }
    .input-group button {
        color: white;
        background-color:#735DA5;
       
    }
    .header {
        background-color: #735DA5; /* Dark background color */
        color: white; /* Text color */
       
    }
    
    .input-group input[type="number"],
    .input-group input[type="text"],
    .input-group input[type="email"] {
        /* Set input field text color to black */
        color: black;
        /* Set input field background color to a light shade */
        background-color:#D3C5E5 ;
        /* Add some padding and margin to improve appearance */
      
    }

    
    </style>
</head>
<body style="background-color:#735DA5 ;">


<div class="header">
    <h2>Customers</h2>
</div>

<form method="post" action="A_customer.php" class="form-content">
    <?php include('errors.php'); ?>
    <div class="input-group">
        <label><b> Customer ID</b></label>
        <input type="number" name="id">
    </div>
    <div class="input-group">
        <label><b>Name</b></label>
        <input type="text" name="name">
    </div>
    <div class="input-group">
        <label><b>Email</b></label>
        <input type="email" name="email">
    </div>
    <div class="input-group">
        <label><b>Phone</b></label>
        <input type="number" name="phone">
    </div>
    <div class="input-group">
        <label><b>Address</b></label>
        <input type="text" name="address">
    </div>
    <div class="input-group">
        <button type="submit" class="btn" name="add">Add</button>

        <button type="submit" class="btn" name="modify">Modify</button>

        <button type="submit" class="btn" name="delete">Delete</button>

        <button type="submit" class="btn" name="clear">Clear</button>

        <button type="submit" class="btn" name="next">Next</button>

        <button type="submit" class="btn" name="back">Back</button>

    </div>
</form><br><br>

<table id="customerTable">
    <tr>
        <th>id</th>
        <th>name</th>
        <th>email</th>
        <th>phone</th>
        <th>address</th>
    </tr>
    <?php
    // Assuming you have a $db connection established already
    $query = "SELECT * FROM customer";
    $result = mysqli_query($db, $query);

    // Check for errors
    if (!$result) {
        die('Error in SQL query: ' . mysqli_error($db));
    }

    // Fetch and display data
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr class='clickable-row' data-id='" . htmlspecialchars($row['id']) . "' data-name='" . htmlspecialchars($row['name']) . "' data-email='" . htmlspecialchars($row['email']) . "' data-phone='" . htmlspecialchars($row['phone']) . "' data-address='" . htmlspecialchars($row['address']) . "'>";
        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
        echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
        echo "<td>" . htmlspecialchars($row['address']) . "</td>";
        echo "</tr>";
    }

    // Free result set
    mysqli_free_result($result);
    ?>
</table>

<script>
    // Add click event listener to each row
    document.querySelectorAll('.clickable-row').forEach(row => {
        row.addEventListener('click', () => {
            // Get data attributes from the clicked row
            const id = row.getAttribute('data-id');
            const name = row.getAttribute('data-name');
            const email = row.getAttribute('data-email');
            const phone = row.getAttribute('data-phone');
            const address = row.getAttribute('data-address');

            // Populate input fields with the data
            document.querySelector('input[name="id"]').value = id;
            document.querySelector('input[name="name"]').value = name;
            document.querySelector('input[name="email"]').value = email;
            document.querySelector('input[name="phone"]').value = phone;
            document.querySelector('input[name="address"]').value = address;
        });
    });
</script>

</body>
</html>
