<?php 
session_start();
if (isset($_SESSION['username'])) 
{
?>
<!DOCTYPE html>
<html>
<head>
	<title>check</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body class="result_body">
	<div class="rp">
		<center>
		<h2><?php echo $_SESSION['username']; ?> ,Gym membership is successful!!</p>
		<p>Subscription Opted And Amount Paid:-  <?php echo $_SESSION['mplan']; ?></p></h2>
		</center>
	</div>
	<div class="l">
		<a href="login_page.php">logout</a>
	</div>	 
</body>
</html>
<?php 
}
else
{
     header("Location: home_page.php");
     exit();
}
?>