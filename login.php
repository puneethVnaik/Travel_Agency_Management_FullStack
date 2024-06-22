<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Login - Travel Agency Management System</title>
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
    <h2>Login</h2>
  </div>

  <form method="post" action="login.php">
    <?php include('errors.php'); ?>
    <div class="input-group">
      <label>Username</label>
      <input type="text" name="username" value="<?php echo $username; ?>">
    </div>
    <div class="input-group">
      <label>Password</label>
      <input type="password" name="password">
    </div>
     <!-- Admin Key field -->
     <div class="input-group">
      <label>Admin Key(*For Admin)</label>
      <input type="text" name="admin_key">
    </div>
  
    <div class="input-group">
      <button type="submit" class="btn" name="login_admin">Admin Login</button> <button type="submit" class="btn" name="login_customer">Customer Login</button>

    </div>
    <p>
      Not yet a member? <a href="register.php">Sign up</a>
    </p>
  </form>
</body>
</html>
