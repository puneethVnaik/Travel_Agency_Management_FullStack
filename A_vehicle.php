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
            border: 1px solid black;
            text-align: left;
            padding: 8px;
        }

       
        tbody {
            background-color:#6AB187; 
        }
        .input-group button {
        color: white;
        background-color:#20948B;
       
    }
    .form-content {
            background-color: #FFF2D7; /* Background color for the form content */
            padding: 20px; /* Adjust padding as needed */
        }
    .header {
        background-color: #20948B; /* Dark background color */
        color: white; /* Text color */
       
    }
    .input-group input[type="number"],
    .input-group input[type="text"],
    .input-group input[type="email"] {
        /* Set input field text color to black */
        color: black;
        /* Set input field background color to a light shade */
        background-color:#6AB187 ;
        /* Add some padding and margin to improve appearance */
      
    }
    </style>
</head>
<body style="background-color:#20948B  ;">
<div class="header">
    <h2>Vehicle</h2>
</div>

<form method="post" action="A_vehicle.php" class="form-content">
    <?php include('errors.php'); ?>
    <div class="input-group">
        <label>vid</label>
        <select name="vid">
        <option value="v1">V1</option>
        <option value="v2">V2</option>
        <option value="v3">V3</option>
        <option value="v4">V4</option>
        <option value="v5">V5</option>
        <option value="v6">V6</option>
        <option value="v7">V7</option>

        <option value="v8">V8</option>

        <option value="v9">V9</option>

        <option value="v19">V10</option>
        <option value="v11">V11</option>

    </select>  
  </div>
    <div class="input-group">
        <label>vname</label>
        <select name="vname">
        <option value="airavatha">Airavatha</option>
        <option value="tt">TT</option>
        <option value="tufan">Tufan</option>
        <option value="innova">Innova</option>
        <option value="bolero">Bolero</option>
        <option value="tempo">Tempo</option>
    </select>
    </div>
    <div class="input-group">
        <label>capacity</label>
        <input type="number" name="capacity">
    </div>
    <div class="input-group">
        <label>type</label>
        <select name="type">
        <option value="bus">Bus</option>
        <option value="car">Car</option>
        <option value="tempo">Tempo</option>
        <option value="offroad_vehicle">offroader</option>
       
    </select>    </div>
 
    <div class="input-group">
        <button type="submit" class="btn" name="vadd">Add</button>
        <button type="submit" class="btn" name="vmodify">Modify</button>
        <button type="submit" class="btn" name="vdelete">Delete</button>
        <button type="submit" class="btn" name="clear">Clear</button>
        <button type="submit" class="btn" name="vnext">Next</button>
        <button type="submit" class="btn" name="vback">Back</button>
    </div>
</form><br><br>

<table id="vehicleTable">
    <tr>
        <th>vid</th>
        <th>vname</th>
        <th>capacity</th>
        <th>type</th>
    </tr>
    <?php
    // Assuming you have a $db connection established already
    $query = "SELECT * FROM vehicle";
    $result = mysqli_query($db, $query);

    // Check for errors
    if (!$result) {
        die('Error in SQL query: ' . mysqli_error($db));
    }

    // Fetch and display data
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr class='clickable-row' data-id='" . htmlspecialchars($row['vid']) . "' data-name='" . htmlspecialchars($row['vname']) . "' data-capacity='" . htmlspecialchars($row['capacity']) . "' data-type='" . htmlspecialchars($row['type'])  . "'>";
        echo "<td>" . htmlspecialchars($row['vid']) . "</td>";
        echo "<td>" . htmlspecialchars($row['vname']) . "</td>";
        echo "<td>" . htmlspecialchars($row['capacity']) . "</td>";
        echo "<td>" . htmlspecialchars($row['type']) . "</td>";
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
            const capacity = row.getAttribute('data-capacity');
            const type = row.getAttribute('data-type');

            // Populate input fields with the data
            document.querySelector('input[name="vid"]').value = id;
            document.querySelector('input[name="vname"]').value = name;
            document.querySelector('input[name="capacity"]').value = capacity;
            document.querySelector('input[name="type"]').value = type;
        });
    });
</script>

</body>
</html>
