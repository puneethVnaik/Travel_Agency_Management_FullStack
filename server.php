<?php
session_start();

// initializing variables
$username="";
$email="";
$id = "";
$name = "";
$phone = "";
$address = "";
$email="";
$vid="";
$vname="";
$capacity="";
$type="";
$regno="";
$Admin_username="";
$Admin_password="";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost','root','',  'travel agency management system');



// Initialize variables
$errors = array();



// Register new user
if (isset($_POST['reg_user'])) {
  // Receive input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  $admin_key = mysqli_real_escape_string($db, $_POST['admin_key']);

  // Form validation
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if (strlen($password_1) < 8) { array_push($errors, "Password must be at least 8 characters long"); }
  if ($password_1 != $password_2) { array_push($errors, "The two passwords do not match"); }

  // Check if admin key is provided and validate it
  if (!empty($admin_key)) {
      // Admin key validation logic (e.g., check against a predefined admin key)
      $valid_admin_key = "295"; // Replace with your actual admin key
      if ($admin_key !== $valid_admin_key) { array_push($errors, "Invalid admin key"); }
  }

  // Check if user already exists in the database
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user) { // If user exists
      if ($user['username'] === $username) { array_push($errors, "Username already exists"); }
      if ($user['email'] === $email) { array_push($errors, "Email already exists"); }
  }

  // If no errors, register user
  if (count($errors) == 0) {
      $password = md5($password_1); // Encrypt password before saving in the database

      if (!empty($admin_key)) {
          // Register as admin
          $query = "INSERT INTO admin (Admin_username, Admin_email, Admin_password) VALUES ('$username', '$email', '$password')";
          $redirect_url = 'A_dash.php'; // Redirect to admin dashboard
      } else {
          // Register as customer
          $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
          $redirect_url = 'C_dash.php'; // Redirect to customer dashboard
      }

      mysqli_query($db, $query);

      // Set session variables and redirect user
      $_SESSION['username'] = $username;
      $_SESSION['success'] = "You are now registered and logged in";
      header('location: ' . $redirect_url);
      exit();
  }
}

//login


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = isset($_POST['username']) ? $db->real_escape_string($_POST['username']) : '';
  $password = isset($_POST['password']) ? $_POST['password'] : '';
  $admin_key = isset($_POST['admin_key']) ? $db->real_escape_string($_POST['admin_key']) : '';

  if (empty($username) || empty($password)) {
      array_push($errors, "Username and password are required");
  } else {
      $password_hashed = md5($password); // Assuming passwords are stored as MD5 hashes

      // Check if the login is for an admin
      if (isset($_POST['login_admin'])) {
          $query_admin = "SELECT * FROM admin WHERE Admin_username='$username' AND Admin_password='$password_hashed'";
          $result_admin = mysqli_query($db, $query_admin);

          if (mysqli_num_rows($result_admin) == 1) {
              // Check if admin key is provided and validate it
              if (!empty($admin_key)) {
                  $valid_admin_key = "295"; // Replace with your actual admin key
                  if ($admin_key !== $valid_admin_key) {
                      array_push($errors, "Invalid admin key");
                  } else {
                      $_SESSION['username'] = $username;
                      $_SESSION['user_type'] = "admin";
                      $_SESSION['success'] = "You are now logged in";
                      header('Location: A_dash.php');
                      exit();
                  }
              } else {
                  array_push($errors, "Admin key is required");
              }
          } else {
              array_push($errors, "Wrong username/password combination");
          }
      } elseif (isset($_POST['login_customer'])) {
          $query_user = "SELECT * FROM users WHERE username='$username' AND password='$password_hashed'";
          $result_user = mysqli_query($db, $query_user);

          if (mysqli_num_rows($result_user) == 1) {
              $_SESSION['username'] = $username;
              $_SESSION['user_type'] = "customer";
              $_SESSION['success'] = "You are now logged in";
              header('Location: C_dash.php');
              exit();
          } else {
              array_push($errors, "Wrong username/password combination");
          }
      }
  }
}

// Function to display errors
function display_errors($errors) {
  if (count($errors) > 0) {
      echo '<div class="error">';
      foreach ($errors as $error) {
          echo '<p>' . $error . '</p>';
      }
      echo '</div>';
  }
}





//customer 

if (isset($_POST['add'])) {
  $id = mysqli_real_escape_string($db, $_POST['id']);
  $name = mysqli_real_escape_string($db, $_POST['name']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $phone = mysqli_real_escape_string($db, $_POST['phone']);
  $address = mysqli_real_escape_string($db, $_POST['address']);

  if (empty($id)) {
  	array_push($errors, "id is required");
  }
  if (empty($name)) {
  	array_push($errors, "name is required");
  }
  if (empty($email)) {
  	array_push($errors, "email is required");
  }
  if (empty($phone)) {
  	array_push($errors, "phone is required");
  }
  if (empty($address)) {
  	array_push($errors, "address is required");
  }


  $customer_check_query = "SELECT * FROM customer WHERE id='$id' OR name='$name' OR email='$email' OR  phone='$phone' OR address='$address' LIMIT 1";
  $result = mysqli_query($db, $customer_check_query);
  $customer= mysqli_fetch_assoc($result);
   // if user exists
  if($customer){
    if ($customer['id'] === $id) {
      array_push($errors, "id already exists");
    }
    if ($customer['name'] === $name) {
      array_push($errors, "name already exists");
    }
    if ($customer['email'] === $email) {
      array_push($errors, "email already exists");
    }
    if ($customer['phone'] === $phone) {
      array_push($errors, "phone already exists");
    }

    if ($customer['address'] === $address) {
      array_push($errors, "address already exists");

    }
  }
  

  if (count($errors) == 0) {
  	$query = "INSERT INTO customer (id,name, email, phone, address) VALUES ('$id','$name', '$email', '$phone', '$address')";
    mysqli_query($db, $query);
  	  $_SESSION['id'] = $id;
      $_SESSION['name'] = $name;
      $_SESSION['email'] = $email;
      $_SESSION['phone'] = $phone;
      $_SESSION['address'] = $address;
      $_SESSION['success'] = "New record created succesfully";
   }
}
elseif(isset($_POST['modify'])) {
  // Retrieve form data
  $id = mysqli_real_escape_string($db, $_POST['id']);
  $name = mysqli_real_escape_string($db, $_POST['name']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $phone = mysqli_real_escape_string($db, $_POST['phone']);
  $address = mysqli_real_escape_string($db, $_POST['address']);

  $errors = array();

  // Validate inputs
  if (empty($id)) { array_push($errors, "id is required"); }
  if (empty($name)) { array_push($errors, "name is required"); }
  if (empty($email)) { array_push($errors, "email is required"); }
  if (empty($phone)) { array_push($errors, "phone is required"); }
  if (empty($address)) { array_push($errors, "address is required"); }

  // If no validation errors, update data in the database
  if (count($errors) == 0) {
      $sql = "UPDATE customer SET name='$name', email='$email', phone='$phone', address='$address' WHERE id='$id'";
      if (mysqli_query($db, $sql)) {
          // Display success message
          echo "<p>Customer updated successfully!</p>";
      } else {
          // Display error message if modification fails
          echo "Error updating record: " . mysqli_error($db);
      }
  } else {
      // Display validation errors
      foreach ($errors as $error) {
          echo "<p>$error</p>";
      }
  }
}
elseif(isset($_POST['delete'])) {
  // Retrieve form data
  $id = mysqli_real_escape_string($db, $_POST['id']);

  // If ID is not empty, perform deletion
  if (!empty($id)) {
      $sql = "DELETE FROM customer WHERE id='$id'";
      if (mysqli_query($db, $sql)) {
          // Display success message
          echo "<p>Customer deleted successfully!</p>";
      } else {
          // Display error message if deletion fails
          echo "Error deleting record: " . mysqli_error($db);
      }
  } else {
      // Display error message if ID is empty
      echo "<p>ID is required for deletion</p>";
  }
}elseif(isset($_POST['next'])) {
  header("Location: A_vehicle.php");
  exit(); // Ensure no further code execution after redirection
}elseif(isset($_POST['back'])) {
  header("Location: A_Dash.php");
  exit(); // Ensure no further code execution after redirection
}elseif(isset($_POST['cnext'])) {
  header("Location: C_vehicle.php");
  exit(); // Ensure no further code execution after redirection
}elseif(isset($_POST['cback'])) {
  header("Location: C_Dash.php");
  exit(); // Ensure no further code execution after redirection
}








//vehicle

if (isset($_POST['vadd'])) {
  $vid = mysqli_real_escape_string($db, $_POST['vid']);
  $vname = mysqli_real_escape_string($db, $_POST['vname']);
  $capacity = mysqli_real_escape_string($db, $_POST['capacity']);
  $type = mysqli_real_escape_string($db, $_POST['type']);

  if (empty($vid)) {
    array_push($errors, "Vehicle ID is required");
  }
  if (empty($vname)) {
    array_push($errors, "Vehicle name is required");
  }
  if (empty($capacity)) {
    array_push($errors, "Capacity is required");
  }
  if (empty($type)) {
    array_push($errors, "Type is required");
  }
 

  $vehicle_check_query = "SELECT * FROM vehicle WHERE vid='$vid' OR vname='$vname' OR type='$type'  LIMIT 1";
  $result = mysqli_query($db, $vehicle_check_query);
  $vehicle = mysqli_fetch_assoc($result);
  // if vehicle exists
  if ($vehicle) {
    if ($vehicle['vid'] === $vid) {
      array_push($errors, "Vehicle ID already exists");
    }
    
  }

  if (count($errors) == 0) {
    $query = "INSERT INTO vehicle (vid, vname, capacity, type) VALUES ('$vid', '$vname', '$capacity', '$type')";
    mysqli_query($db, $query);
    $_SESSION['success'] = "New record created successfully";
  }
} elseif (isset($_POST['vmodify'])) {
  // Retrieve form data
  $vid = mysqli_real_escape_string($db, $_POST['vid']);
  $vname = mysqli_real_escape_string($db, $_POST['vname']);
  $capacity = mysqli_real_escape_string($db, $_POST['capacity']);
  $type = mysqli_real_escape_string($db, $_POST['type']);

  $errors = array();

  // Validate inputs
  if (empty($vid)) { array_push($errors, "Vehicle ID is required"); }
  if (empty($vname)) { array_push($errors, "Vehicle name is required"); }
  if (empty($capacity)) { array_push($errors, "Capacity is required"); }
  if (empty($type)) { array_push($errors, "Type is required"); }

  // If no validation errors, update data in the database
  if (count($errors) == 0) {
    $sql = "UPDATE vehicle SET vname='$vname', capacity='$capacity', type='$type'  WHERE vid='$vid'";
    if (mysqli_query($db, $sql)) {
      // Display success message
      echo "<p>Vehicle updated successfully!</p>";
    } else {
      // Display error message if modification fails
      echo "Error updating record: " . mysqli_error($db);
    }
  } else {
    // Display validation errors
    foreach ($errors as $error) {
      echo "<p>$error</p>";
    }
  }
} elseif (isset($_POST['vdelete'])) {
  // Retrieve form data
  $vid = mysqli_real_escape_string($db, $_POST['vid']);

  // If ID is not empty, perform deletion
  if (!empty($vid)) {
    $sql = "DELETE FROM vehicle WHERE vid='$vid'";
    if (mysqli_query($db, $sql)) {
      // Display success message
      echo "<p>Vehicle deleted successfully!</p>";
    } else {
      // Display error message if deletion fails
      echo "Error deleting record: " . mysqli_error($db);
    }
  } else {
    // Display error message if ID is empty
    echo "<p>Vehicle ID is required for deletion</p>";
  }
}elseif(isset($_POST['vnext'])) {
  header("Location: A_trip.php");
  exit(); // Ensure no further code execution after redirection
}elseif(isset($_POST['vback'])) {
  header("Location: A_Dash.php");
  exit(); // Ensure no further code execution after redirection
}elseif(isset($_POST['cvnext'])) {
  header("Location: C_trip.php");
  exit(); // Ensure no further code execution after redirection
}elseif(isset($_POST['cvback'])) {
  header("Location: C_Dash.php");
  exit(); // Ensure no further code execution after redirection
}





//Trip

if (isset($_POST['tadd'])) {
  $tid = mysqli_real_escape_string($db, $_POST['tid']);
  $source = mysqli_real_escape_string($db, $_POST['source']);
  $destination = mysqli_real_escape_string($db, $_POST['destination']);
  $sdate = mysqli_real_escape_string($db, $_POST['sdate']);
  $edate = mysqli_real_escape_string($db, $_POST['edate']);

  if (empty($tid)) {
    array_push($errors, "Trip ID is required");
  }
  if (empty($source)) {
    array_push($errors, "Source is required");
  }
  if (empty($destination)) {
    array_push($errors, "Destination is required");
  }
  if (empty($sdate)) {
    array_push($errors, "Start date is required");
  }
  if (empty($edate)) {
    array_push($errors, "End date is required");
  }

  $trip_check_query = "SELECT * FROM trip WHERE tid='$tid' OR source='$source' OR destination='$destination' OR  sdate='$sdate' OR edate='$edate' LIMIT 1";
  $result = mysqli_query($db, $trip_check_query);
  $trip = mysqli_fetch_assoc($result);
  // if trip exists
  if ($trip) {
    if ($trip['tid'] === $tid) {
      array_push($errors, "Trip ID already exists");
    }
    if ($trip['source'] === $source) {
      array_push($errors, "Source already exists");
    }
    if ($trip['destination'] === $destination) {
      array_push($errors, "Destination already exists");
    }
    if ($trip['sdate'] === $sdate) {
      array_push($errors, "Start date already exists");
    }
    if ($trip['edate'] === $edate) {
      array_push($errors, "End date already exists");
    }
  }

  if (count($errors) == 0) {
    $query = "INSERT INTO trip (tid, source, destination, sdate, edate) VALUES ('$tid', '$source', '$destination', '$sdate', '$edate')";
    mysqli_query($db, $query);
    $_SESSION['success'] = "New record created successfully";
  }
} elseif (isset($_POST['tmodify'])) {
  // Retrieve form data
  $tid = mysqli_real_escape_string($db, $_POST['tid']);
  $source = mysqli_real_escape_string($db, $_POST['source']);
  $destination = mysqli_real_escape_string($db, $_POST['destination']);
  $sdate = mysqli_real_escape_string($db, $_POST['sdate']);
  $edate = mysqli_real_escape_string($db, $_POST['edate']);

  $errors = array();

  // Validate inputs
  if (empty($tid)) { array_push($errors, "Trip ID is required"); }
  if (empty($source)) { array_push($errors, "Source is required"); }
  if (empty($destination)) { array_push($errors, "Destination is required"); }
  if (empty($sdate)) { array_push($errors, "Start date is required"); }
  if (empty($edate)) { array_push($errors, "End date is required"); }

  // If no validation errors, update data in the database
  if (count($errors) == 0) {
    $sql = "UPDATE trip SET source='$source', destination='$destination', sdate='$sdate', edate='$edate' WHERE tid='$tid'";
    if (mysqli_query($db, $sql)) {
      // Display success message
      echo "<p>Trip updated successfully!</p>";
    } else {
      // Display error message if modification fails
      echo "Error updating record: " . mysqli_error($db);
    }
  } else {
    // Display validation errors
    foreach ($errors as $error) {
      echo "<p>$error</p>";
    }
  }
} elseif (isset($_POST['tdelete'])) {
  // Retrieve form data
  $tid = mysqli_real_escape_string($db, $_POST['tid']);

  // If ID is not empty, perform deletion
  if (!empty($tid)) {
    $sql = "DELETE FROM trip WHERE tid='$tid'";
    if (mysqli_query($db, $sql)) {
      // Display success message
      echo "<p>Trip deleted successfully!</p>";
    } else {
      // Display error message if deletion fails
      echo "Error deleting record: " . mysqli_error($db);
    }
  } else {
    // Display error message if ID is empty
    echo "<p>Trip ID is required for deletion</p>";
  }
}elseif(isset($_POST['tnext'])) {
  header("Location: A_payment.php");
  exit(); // Ensure no further code execution after redirection
}elseif(isset($_POST['tback'])) {
  header("Location: A_Dash.php");
  exit(); // Ensure no further code execution after redirection
}elseif(isset($_POST['ctnext'])) {
  header("Location: C_payment.php");
  exit(); // Ensure no further code execution after redirection
}elseif(isset($_POST['ctback'])) {
  header("Location: C_Dash.php");
  exit(); // Ensure no further code execution after redirection
}





//payment
$errors = array();

if (isset($_POST['padd'])) {
  $id = mysqli_real_escape_string($db, $_POST['id']);
  $tid = mysqli_real_escape_string($db, $_POST['tid']);
  $pdate = mysqli_real_escape_string($db, $_POST['pdate']);
  $distance_travel = mysqli_real_escape_string($db, $_POST['distance_travel']);
  $total_cost = $distance_travel * 100; // Calculate total cost based on distance traveled
  
  if (empty($id)) {
      array_push($errors, "Customer ID is required");
  }
  if (empty($tid)) {
      array_push($errors, "Trip ID is required");
  }
  if (empty($pdate)) {
      array_push($errors, "Payment date is required");
  }
  if (empty($distance_travel)) {
      array_push($errors, "Distance traveled is required");
  }
  if (empty($total_cost)) { // Validate total cost
      array_push($errors, "Total cost is required");
  }

  $payment_check_query = "SELECT * FROM payment WHERE id='$id' AND tid='$tid' LIMIT 1";
  $result = mysqli_query($db, $payment_check_query);
  $payment = mysqli_fetch_assoc($result);
  // if payment exists
  if ($payment) {
      if ($payment['id'] === $id) {
          array_push($errors, "Payment ID already exists");
      }
      
      if ($payment['tid'] === $tid) {
          array_push($errors, "Trip ID already exists");
      }
  }

  if (count($errors) == 0) {
      $query = "INSERT INTO payment (id, tid, pdate, distance_travel, total_cost) VALUES ('$id', '$tid', '$pdate', '$distance_travel', '$total_cost')";
      mysqli_query($db, $query);
      $_SESSION['success'] = "New record created successfully";
  }
} elseif (isset($_POST['pmodify'])) {
  // Retrieve form data
  $id = mysqli_real_escape_string($db, $_POST['id']);
  $tid = mysqli_real_escape_string($db, $_POST['tid']);
  $pdate = mysqli_real_escape_string($db, $_POST['pdate']);
  $distance_travel = mysqli_real_escape_string($db, $_POST['distance_travel']);
  $total_cost = $distance_travel * 100; // Calculate total cost based on distance traveled

  $errors = array();

  // Validate inputs
  if (empty($id)) { array_push($errors, "Payment ID is required"); }
  if (empty($tid)) { array_push($errors, "Trip ID is required"); }
  if (empty($pdate)) { array_push($errors, "Payment date is required"); }
  if (empty($distance_travel)) { array_push($errors, "Distance traveled is required"); }
  if (empty($total_cost)) { array_push($errors, "Total cost is required"); } // Validate total cost

  // If no validation errors, update data in the database
  if (count($errors) == 0) {
      $sql = "UPDATE payment SET pdate='$pdate', distance_travel='$distance_travel', total_cost='$total_cost' WHERE id='$id' AND tid='$tid'";
      if (mysqli_query($db, $sql)) {
          // Display success message
          echo "<p>Payment updated successfully!</p>";
      } else {
          // Display error message if modification fails
          echo "Error updating record: " . mysqli_error($db);
      }
  } else {
      // Display validation errors
      foreach ($errors as $error) {
          echo "<p>$error</p>";
      }
  }
}elseif(isset($_POST['pnext'])) {
  header("Location: A_booking.php");
  exit(); // Ensure no further code execution after redirection
}elseif(isset($_POST['pback'])) {
  header("Location: A_dash.php");
  exit(); // Ensure no further code execution after redirection
}elseif(isset($_POST['cpback'])) {
  header("Location: C_dash.php");
  exit(); // Ensure no further code execution after redirection
}




//booking

if (isset($_POST['badd'])) {
  $id = mysqli_real_escape_string($db, $_POST['id']);
  $vid = mysqli_real_escape_string($db, $_POST['vid']);
  $tid = mysqli_real_escape_string($db, $_POST['tid']);
  $bdate = mysqli_real_escape_string($db, $_POST['bdate']);

  if (empty($id)) {
    array_push($errors, "Customer ID is required");
  }
  if (empty($vid)) {
    array_push($errors, "Vehicle ID is required");
  }
  if (empty($tid)) {
    array_push($errors, "Trip ID is required");
  }
  if (empty($bdate)) {
    array_push($errors, "Booking date is required");
  }

  $booking_check_query = "SELECT * FROM booking WHERE id='$id' AND vid='$vid' AND tid='$tid' LIMIT 1";
  $result = mysqli_query($db, $booking_check_query);
  $booking = mysqli_fetch_assoc($result);
  // if booking exists
  if ($booking) {
    array_push($errors, "Booking already exists for this customer, vehicle, and trip");
  }

  if (count($errors) == 0) {
    $query = "INSERT INTO booking (id, vid, tid, bdate) VALUES ('$id', '$vid', '$tid', '$bdate')";
    mysqli_query($db, $query);
    $_SESSION['success'] = "New record created successfully";
  }
} elseif (isset($_POST['bmodify'])) {
  // Retrieve form data
  $id = mysqli_real_escape_string($db, $_POST['id']);
  $vid = mysqli_real_escape_string($db, $_POST['vid']);
  $tid = mysqli_real_escape_string($db, $_POST['tid']);
  $bdate = mysqli_real_escape_string($db, $_POST['bdate']);

  $errors = array();

  // Validate inputs
  if (empty($id)) { array_push($errors, "Customer ID is required"); }
  if (empty($vid)) { array_push($errors, "Vehicle ID is required"); }
  if (empty($tid)) { array_push($errors, "Trip ID is required"); }
  if (empty($bdate)) { array_push($errors, "Booking date is required"); }

  // If no validation errors, update data in the database
  if (count($errors) == 0) {
    $sql = "UPDATE booking SET bdate='$bdate' WHERE id='$id' AND vid='$vid' AND tid='$tid'";
    if (mysqli_query($db, $sql)) {
      // Display success message
      echo "<p>Booking updated successfully!</p>";
    } else {
      // Display error message if modification fails
      echo "Error updating record: " . mysqli_error($db);
    }
  } else {
    // Display validation errors
    foreach ($errors as $error) {
      echo "<p>$error</p>";
    }
  }
} elseif (isset($_POST['bdelete'])) {
  // Retrieve form data
  $id = mysqli_real_escape_string($db, $_POST['id']);
  $vid = mysqli_real_escape_string($db, $_POST['vid']);
  $tid = mysqli_real_escape_string($db, $_POST['tid']);

  // If IDs are not empty, perform deletion
  if (!empty($id) && !empty($vid) && !empty($tid)) {
    $sql = "DELETE FROM booking WHERE id='$id' AND vid='$vid' AND tid='$tid'";
    if (mysqli_query($db, $sql)) {
      // Display success message
      echo "<p>Booking deleted successfully!</p>";
    } else {
      // Display error message if deletion fails
      echo "Error deleting record: " . mysqli_error($db);
    }
  } else {
    // Display error message if any ID is empty
    echo "<p>Customer ID, Vehicle ID, and Trip ID are required for deletion</p>";
  }
}elseif(isset($_POST['bback'])) {
  header("Location: A_Dash.php");
  exit(); // Ensure no further code execution after redirection
}elseif(isset($_POST['cbback'])) {
  header("Location: C_Dash.php");
  exit(); // Ensure no further code execution after redirection
}



