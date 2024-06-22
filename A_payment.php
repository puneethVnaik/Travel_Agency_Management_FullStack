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
            text-align: left;
            padding: 8px;
            border: 1.5px solid black; /* Set border for table header cells */

        }
        .form-content {
            background-color: #FFF2D7; /* Background color for the form content */
            padding: 20px; /* Adjust padding as needed */
        }
        th {
            border: 1.5px solid black; /* Set border for table header cells */
            text-align: left;
            padding: 8px;
            color: black; /* Set default font color */
        }
        
        tbody {
            background-color:#C4DFE6; 
        }
    .input-group input[type="number"],
    .input-group input[type="text"],
    .input-group input[type="email"] {
        /* Set input field text color to black */
        color: black;
        /* Set input field background color to a light shade */
        background-color:#C4DFE6 ;
        /* Add some padding and margin to improve appearance */
      
    }

</style>
</head>
<body style="background-color:#66A5AD  ;">
<div class="header">
    <h2>Payment</h2>
</div>

<form method="post" action="A_payment.php" class="form-content">
    <?php include('errors.php'); ?>
    <div class="input-group">
        <label><b>Customer id</b></label>
        <input type="text" name="id">
    </div>
    <div class="input-group">
        <label><b>trip id</b></label>
        <input type="text" name="tid">
    </div>
    <div class="input-group">
        <label><b>distance travel</b></label>
        <input type="number" name="distance_travel">
    </div>
    <div class="input-group">
        <label><b>payment date</b></label>
        <input type="date" name="pdate">
    </div>
    <div class="input-group">
        <button type="submit" class="btn" name="padd">Add</button>
        <button type="submit" class="btn" name="pmodify">Modify</button>
        <button type="submit" class="btn" name="pdelete">Delete</button>
        <button type="submit" class="btn" name="clear">Clear</button>
        <button type="submit" class="btn" name="pnext">Next</button>
        <button type="submit" class="btn" name="pback">Back</button>
    </div>
</form><br><br>

<table id="paymentTable">
    <tr>
        <th>id</th>
        <th>tid</th>
        <th>distance_travel</th>
        <th>pdate</th>
    </tr>
    <?php
    // Assuming you have a $db connection established already
    $query = "SELECT * FROM payment";
    $result = mysqli_query($db, $query);

    // Check for errors
    if (!$result) {
        die('Error in SQL query: ' . mysqli_error($db));
    }

    // Fetch and display data
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr class='clickable-row' data-id='" . htmlspecialchars($row['id']) . "' data-tid='" . htmlspecialchars($row['tid']) . "' data-distance='" . htmlspecialchars($row['distance_travel']) . "' data-pdate='" . htmlspecialchars($row['pdate']) . "'>";
        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['tid']) . "</td>";
        echo "<td>" . htmlspecialchars($row['distance_travel']) . "</td>";
        echo "<td>" . htmlspecialchars($row['pdate']) . "</td>";
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
            const tid = row.getAttribute('data-tid');
            const distance = row.getAttribute('data-distance');
            const pdate = row.getAttribute('data-pdate');

            // Populate input fields with the data
            document.querySelector('input[name="id"]').value = id;
            document.querySelector('input[name="tid"]').value = tid;
            document.querySelector('input[name="distance_travel"]').value = distance;
            document.querySelector('input[name="pdate"]').value = pdate;
        });
    });
</script>

</body>
</html>
