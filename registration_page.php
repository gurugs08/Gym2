<!DOCTYPE html>
<html>
<head>
  <title>Registration</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="container">
    <center>
      <h2>Register</h2>
      <form action="server.php"method="post">
        <?php if (isset($_GET['error'])) { ?>
          <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
        <table>
          <tr>
            <td><label for="username"> Username : </label></td>
            <td><input type="text" name="username" required></td>
          </tr>
          <tr>
            <td><label for="email"> Email : </label></td>
            <td><input type="email" name="email" required></td>
          </tr>
          <tr>
            <td><label for="password"> Password : </label></td>
            <td><input type="password" name="password_1" required></td>
          </tr>
          <tr>
            <td><label for="password"> Confirm Password : </label></td>
            <td><input type="password" name="password_2" required></td>
          </tr>
        </table>
        <button type="submit" name="reg_user"> Submit </button>
        <p>Already a user?<a href="login_page.php"><b>Log in</b></a></p>
      </form>
    </center>
  </div>
</body>
</html>