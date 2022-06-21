<?php 
session_start();
if (isset($_SESSION['id']) || isset($_SESSION['username'])) 
{
?>
<!DOCTYPE html>
<html>
<head>
    <title>HOME</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
     <h1>Welcome, <?php echo $_SESSION['username']; ?></h1>
     <a href="logout.php">Logout</a>
     <div class="home">
     	<center>
     		<form action="server.php" method="post">
     			<h2>Please Fill the form</h2>
     			<table>
     				<tr>
     					<td><label>Name</label></td>
     					<td><input type="text" name="u_name"></td>
     				</tr>
     				<tr>
     					<td><label>Age</label></td>
     					<td><input type="number" name="u_age"></td>
     				</tr>
     				<tr>
     					<td><label>Height</label></td>
     					<td><input type="number" name="u_height"></td>
     				</tr>
     				<tr>
     					<td><label>Weight</label></td>
     					<td><input type="number" name="u_weight"></td>
     				</tr>
     				<tr>
     					<td><label>MemberShip Plan</label></td>
     					<td><select name="u_plan">
     						<option value="MonthlyPlan--Rs2000">Monthly Plan -- Rs2000</option>
     						<option value="QuaterlyPlan--Rs5800">Quaterly Plan -- Rs5800</option>
     						<option value="HalfYearlyPlan--Rs10000">Half Yearly Plan -- Rs10000</option>
     						<option value="YearlyPlan--Rs18000">Yearly Plan -- Rs18000</option>
     						
     					</select></td>
     				</tr>
     				<tr>
     					<td><label>Phone Number</label></td>
     					<td><input type="number" name="u_number"></td>
     				</tr>
     			</table>
     			<button type="Submit" name="u_submit">Submit Form</button>
     		</form>
     	</center>
     </div>
</body>
</html>
<?php 
}
else
{
     header("Location: login_page.php");
     exit();
}
?>