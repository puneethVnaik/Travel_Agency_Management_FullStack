<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
  <style>
    .header {
    background-color: purple; /* Semi-transparent black background */
    color: #fff;
    font-size: 25px;
    text-align: center;
    padding: 20px 0;
}
    .button-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      margin-top: 45px;
    }

    .butt {
      display: inline-block;
      padding: 35px 65px; /* Increase padding to increase button size */
      margin: 5px;
      background-color: purple;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      margin: 5px; /* Adjust margin to add space between buttons */
      margin-right: 100px; /* Additional right margin for spacing */
     margin-bottom: 30px;
     margin-top: 30px;
     justify-content: center;

      font-size: 25px;
    }

    .butt:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body style="background-color:#FEE715 ;">
  <div class="header">
    <h2>Welcome to Dashboard</h2>
  </div>
  <div class="button-container">
    <form method="post" action="A_customer.php">
      <button type="submit" class="butt" name="customers_btn">View Customers</button>
    </form>
    <form method="post" action="A_vehicle.php">
      <button type="submit" class="butt" name="vehicles_btn">View Vehicles</button>
    </form>
    <form method="post" action="A_trip.php">
      <button type="submit" class="butt" name="trips_btn">View Trip</button>
    </form>
   
   
  </div>
  <div class="button-container">
    <form method="post" action="A_payment.php">
      <button type="submit" class="butt" name="transactions_btn">View Payment</button>
    </form>
    <form method="post" action="A_booking.php">
      <button type="submit" class="butt" name="bookings_btn">View Bookings</button>
    </form>
    <form action="login.php">
      <button type="submit" class="butt">Logout</button>
    </form>
  </div>
</body>
</html>
