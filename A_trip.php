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
            border: 1px solid black;
            text-align: left;
            padding: 8px;
        }

       
        tbody {
            background-color:#A1BE95; 
        }
        .input-group button {
        color: white;
        background-color:#F98866;
       
    }
    .form-content {
            background-color:  #FFF2D7; /* Background color for the form content */
            padding: 20px; /* Adjust padding as needed */
        }
    .header {
        background-color:#F98866; /* Dark background color */
        color: white; /* Text color */
       
    }
        .input-group input[type="number"],
    .input-group input[type="text"],
    .input-group input[type="email"] {
        /* Set input field text color to black */
        color: black;
        /* Set input field background color to a light shade */
        background-color:#A1BE95;
        /* Add some padding and margin to improve appearance */
      
    }
    </style>
</head>
<body style="background-color:#F98866  ;">
<div class="header">
    <h2>Trip</h2>
</div>

<form method="post" action="A_trip.php" class="form-content">
    <?php include('errors.php'); ?>
    <div class="input-group">
        <label>trip id</label>
        <input type="text" name="tid">
    </div>
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
        <button type="submit" class="btn" name="tnext">Next</button>
        <button type="submit" class="btn" name="tback">Back</button>
    </div>
</form><br><br>

<table id="tripTable">
    <tr>
        <th>tid</th>
        <th>source</th>
        <th>destination</th>
        <th>sdate</th>
        <th>edate</th>
    </tr>
    <?php
    // Assuming you have a $db connection established already
    $query = "SELECT * FROM trip";
    $result = mysqli_query($db, $query);

    // Check for errors
    if (!$result) {
        die('Error in SQL query: ' . mysqli_error($db));
    }

    // Fetch and display data
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr class='clickable-row' data-id='" . htmlspecialchars($row['tid']) . "' data-source='" . htmlspecialchars($row['source']) . "' data-destination='" . htmlspecialchars($row['destination']) . "' data-sdate='" . htmlspecialchars($row['sdate']) . "' data-edate='" . htmlspecialchars($row['edate']) . "'>";
        echo "<td>" . htmlspecialchars($row['tid']) . "</td>";
        echo "<td>" . htmlspecialchars($row['source']) . "</td>";
        echo "<td>" . htmlspecialchars($row['destination']) . "</td>";
        echo "<td>" . htmlspecialchars($row['sdate']) . "</td>";
        echo "<td>" . htmlspecialchars($row['edate']) . "</td>";
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
            const source = row.getAttribute('data-source');
            const destination = row.getAttribute('data-destination');
            const sdate = row.getAttribute('data-sdate');
            const edate = row.getAttribute('data-edate');

            // Populate input fields with the data
            document.querySelector('input[name="tid"]').value = id;
            document.querySelector('input[name="source"]').value = source;
            document.querySelector('input[name="destination"]').value = destination;
            document.querySelector('input[name="sdate"]').value = sdate;
            document.querySelector('input[name="edate"]').value = edate;
        });
    });
</script>

</body>
</html>
