<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Register - Travel Agency Management System</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <style>
    .head {
      background-color: #5F9EA0;
      color: #fff;
      text-align: center;
      padding: 40px 0;
    }
  </style>
</head>
<body>
  <div class="head">
    <h1>Welcome to Travel Agency Management System</h1>
  </div>
  <div class="header">
    <h2>Register</h2>
  </div>

  <form method="post" action="register.php">
    <?php include('errors.php'); ?>
    <div class="input-group">
      <label>Username</label>
      <input type="text" name="username" value="<?php echo $username; ?>">
    </div>
    <div class="input-group">
      <label>Email</label>
      <input type="email" name="email" value="<?php echo $email; ?>">
    </div>
    <div class="input-group">
      <label>Password</label>
      <input type="password" name="password_1">
    </div>
    <div class="input-group">
      <label>Confirm Password</label>
      <input type="password" name="password_2">
    </div>

    <!-- Admin Key field -->
    <div class="input-group">
      <label>Admin Key(*For Admins)</label>
      <input type="text" name="admin_key">
    </div>
    
    <div class="input-group">
      <button type="submit" class="btn" name="reg_user">Register</button>
    </div>
    <p>
      Already a member? <a href="login.php">Sign in</a>
    </p>
  </form>
</body>
</html>
