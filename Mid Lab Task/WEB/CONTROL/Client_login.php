<?php include "../control/client_logv.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>Login - CAFE MOZO</title>
   <link rel="stylesheet" type="text/css" href="../view/login.css">
</head>
<body>

<div class="login-container">
  <h2>Login to CAFE MOZO</h2>

  <form action="client_login.php" method="post">
    <div class="form-group">
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>">
      <span class="error"><?php echo $username_error; ?></span>
    </div>

    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" id="password" name="password">
      <span class="error"><?php echo $password_error; ?></span>
    </div>

    <div class="form-group">
      <label for="userType">User Type:</label>
      <select id="userType" name="userType">
        <option value="">Select User Type</option>
        <option value="customer" <?php if($userType == "customer") echo "selected"; ?>>Customer</option>
        <option value="seller" <?php if($userType == "seller") echo "selected"; ?>>Seller</option>
      </select>
      <span class="error"><?php echo $userType_error; ?></span>
    </div>

    <div class="form-group">
      <input type="submit" name="submit" value="Login" class="submit-btn">
    </div>
  </form>
</div>

</body>
</html>
