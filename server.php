<?php 

session_start(); 

$db = mysqli_connect('localhost','root','','gym') or die("Could not connect to database");
if (isset($_POST['login_user']))
{
	if (isset($_POST['username']) && isset($_POST['password_1']))
	{
    	function validate($data)
    	{
        	$data = trim($data);
        	$data = stripslashes($data);
        	$data = htmlspecialchars($data);
        	return $data;
    	}
    	$uname = validate($_POST['username']);
    	$pass = validate($_POST['password_1']);
    	if (empty($uname)) 
    	{
        	header("Location: login_page.php?error=User Name is required");
        	exit();
    	}
    	else if(empty($pass))
    	{
        	header("Location: login_page.php?error=Password is required");
        	exit();
    	}
    	else
    	{
        	$pass= md5($pass);
        	$sql = "SELECT * FROM user WHERE username='$uname' AND password='$pass'";
        	$result = mysqli_query($db, $sql);
        	if (mysqli_num_rows($result) === 1)
        	{
            	$row = mysqli_fetch_assoc($result);
            	if ($row['username'] === $uname && $row['password'] === $pass) 
            	{
                	echo "Logged in!";
                	$_SESSION['username'] = $row['username'];
                	$_SESSION['id'] = $row['id'];
                	if ($row['Status']==0) {
                			header('location: home.php');
                		}
                	else{
                		$query="SELECT * FROM gym_management WHERE UserName='$uname'";
                		$query1=mysqli_query($db,$query);
                		$row1=mysqli_fetch_assoc($query1);
                		$_SESSION['username']=$row1['Name'];
                		$_SESSION['mplan']=$row1['MembershipPlan'];
                		header('location: result.php');
                	}
                	exit();	
            	}
            	else
            	{
                	header("Location: login_page.php?error=Incorect User name or password");
                	exit();
            	}
        	}
        	else
        	{
            	header("Location: login_page.php?error=Incorect User name or password");
            	exit();
        	}
    	}
	}
	else
	{
    	header("Location: login_page.php");
    	exit();
	}
}
if (isset($_POST['reg_user']))
{
 	if (isset($_POST['username']))
 	{
    	$username= mysqli_real_escape_string($db, $_POST['username']);
	}
	if (isset($_POST['email']))
	{
    	$email= mysqli_real_escape_string($db, $_POST['email']);
	}
	if (isset($_POST['password_1']))
	{
    	$password_1= mysqli_real_escape_string($db, $_POST['password_1']);
	}
	if (isset($_POST['password_2']))
	{
    	$password_2= mysqli_real_escape_string($db, $_POST['password_2']);
	}

	if($password_1 != $password_2)
	{
    	header("Location: registration_page.php?error=passwords do not match");
    	exit();   
	}

//check db for existing user with same username and email id

	$user_check_query = "SELECT * FROM user WHERE username = '$username' or email = '$email' LIMIT 1";
	$results = mysqli_query($db,$user_check_query);
	$user = mysqli_fetch_assoc($results);

	if ($user)
	{
    	if ($user["username"] === $username)
    	{
        	header("Location: registration_page.php?error=Entered user name is already registered");
        	exit();
    	}
    	if ($user["email"] === $email)
    	{
        	header("Location: registration_page.php?error=Entered email id is already registered");
        	exit();
    	}
	}

//Register the user if no errors

    	$password = md5($password_1); //this will encrypt the password
    	$query = "INSERT INTO user (username,email,password) VALUES ('$username','$email','$password')";

    	mysqli_query($db,$query);
    	$_SESSION['username'] = $username;
    	header('location: home.php'); 	
}

if (isset($_POST['u_submit'])) {

	$Name=$_REQUEST['u_name'];
	$Age=$_REQUEST['u_age'];
	$Height=$_REQUEST['u_height'];
	$Weight=$_REQUEST['u_weight'];
	$MemberShip=$_REQUEST['u_plan'];
	$PhoneNumber=$_REQUEST['u_number'];
	$username=$_SESSION['username'];
	$query="INSERT INTO gym_management(Name,Age,Height,Weight,MembershipPlan,PhoneNo,Status,UserName) VALUES('$Name','$Age','$Height','$Weight','$MemberShip','$PhoneNumber','1','$username')";
	$query1="UPDATE user SET Status='1' WHERE username='$username'";
	mysqli_query($db,$query1);
	mysqli_query($db,$query);  
	$_SESSION['username']=$username;
	$_SESSION['mplan']=$MemberShip;
	header('location: result.php');
}
?>