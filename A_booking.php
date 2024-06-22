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
            border: 1px solid black;
            text-align: left;
            padding: 8px;
        }

      
        
        tbody {
            background-color:#F9E795; 
        }
        .input-group button {
        color: white;
        background-color:#F96167;
       
    }
    .form-content {
            background-color: #FFF2D7; /* Background color for the form content */
            padding: 20px; /* Adjust padding as needed */
        }
    .header {
        background-color:#F96167; /* Dark background color */
        color: white; /* Text color */
       
    }
        .input-group input[type="number"],
    .input-group input[type="text"],
    .input-group input[type="email"] {
        /* Set input field text color to black */
        color: black;
        /* Set input field background color to a light shade */
        background-color:#F9E795;
        /* Add some padding and margin to improve appearance */
      
    }
    </style>
</head>
<body style="background-color:#F96167  ;">
<div class="header">
    <h2>Bookings</h2>
</div>

<form method="post" action="A_booking.php" class="form-content">
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
        <button type="submit" class="btn" name="bback">Back</button>
    </div>
</form><br><br>

<table id="bookingTable">
    <tr>
        <th>id</th>
        <th>vid</th>
        <th>tid</th>
        <th>bdate</th>
    </tr>
    <?php
    // Assuming you have a $db connection established already
    $query = "SELECT * FROM booking";
    $result = mysqli_query($db, $query);

    // Check for errors
    if (!$result) {
        die('Error in SQL query: ' . mysqli_error($db));
    }

    // Fetch and display data
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr class='clickable-row' data-id='" . htmlspecialchars($row['id']) . "' data-vid='" . htmlspecialchars($row['vid']) . "' data-tid='" . htmlspecialchars($row['tid']) . "' data-bdate='" . htmlspecialchars($row['bdate']) . "'>";
        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['vid']) . "</td>";
        echo "<td>" . htmlspecialchars($row['tid']) . "</td>";
        echo "<td>" . htmlspecialchars($row['bdate']) . "</td>";
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
            const vid = row.getAttribute('data-vid');
            const tid = row.getAttribute('data-tid');
            const bdate = row.getAttribute('data-bdate');

            // Populate input fields with the data
            document.querySelector('input[name="id"]').value = id;
            document.querySelector('input[name="vid"]').value = vid;
            document.querySelector('input[name="tid"]').value = tid;
            document.querySelector('input[name="bdate"]').value = bdate;
        });
    });
</script>

</body>
</html>
