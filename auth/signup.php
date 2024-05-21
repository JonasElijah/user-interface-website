<!DOCTYPE html>
<html lang="en">
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Sign Up Page</title>
<link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />	
<link href="/assets/css/signup.css" rel="stylesheet" />	
</head>
<body>
	<?php
	if (session_status() === PHP_SESSION_NONE) {
    	session_start();
	}
	?>
	<div>
	<div id="header">
        <?php include '../assets/html/header.html'; ?>
</div>
</div>

<div id="wrapper">
<div id="page-wrapper">
<div id="page-inner">
<br><br><br><br>
<?php

	if(!isset($_POST['submit'])){
		echo '<form class="col-md-6 offset-md-3  form" id="contact" method="post" action="">';
		echo '<h1 style = "color: #fdf4eb; font-size: 50px;text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;"  align = "center">Welcome to the Sign Up page! </h1>
				';
		if( (!isset($_GET['fName'])))
		{
			if(isset($_SESSION['fName']))
			{
				echo '<div class="form-group">';
				echo '<label class="col-md-3" for="firstName">First Name</label>';
				echo '<div >';
				echo '<input name="fName" type="text" class="form-control" id="fName" value="'.$_SESSION['fName'].'">';
				echo '<p class="alert alert-success" id="fNameStatus">First Name is valid!</p>';
				echo '</div></div>';
			}
			else
			{
				echo '<div class="form-group">';
				echo '<label class="col-md-3" for="firstName">First Name</label>';
				echo '<div>';
				echo '<input name="fName" type="text" class="form-control" id="fName" placeholder="First Name">';
				echo '<p id="fNameStatus"></p>';
				echo '</div></div>';
			}
		}
		elseif (isset($_GET['fName']))
		{
			if ($_GET['fName']=="fNameNull")
			{
				echo '<div class="form-group">';
				echo '<label class="col-md-3" for="firstName">First Name</label>';
				echo '<div >';
				echo '<input name="fName" type="text" class="form-control" id="fName" placeholder="First Name">';
				echo '<p class="alert alert-danger" id="fNameStatus">First name cannot be blank!</p>';
				echo '</div></div>';
			}
			else
			{
				if (isset($_SESSION['fName']))
				{
					echo '<div class="form-group">';
					echo '<label class="col-md-3" for="firstName">First Name</label>';
					echo '<div >';
					echo '<input name="fName" type="text" class="form-control" id="fName" value="'.$_SESSION['fName'].'">';
					echo '<p class="alert alert-danger" id="fNameStatus">First name is invalid!</p>';
					echo '</div></div>';
				}
			}
		}
			
		if( (!isset($_GET['lName'])))
		{
			if(isset($_SESSION['lName']))
			{
				echo '<div class="form-group">';
				echo '<label class="col-md-3" for="lastName">Last Name</label>';
				echo '<div >';
				echo '<input name="lName" type="text" class="form-control" id="lName" value="'.$_SESSION['lName'].'">';
				echo '<p class="alert alert-success" id="lNameStatus">Last name is valid!</p>';
				echo '</div></div>';
			}
			else
			{
				echo '<div class="form-group">';
				echo '<label class="col-md-3" for="lastName">Last Name</label>';
				echo '<div >';
				echo '<input name="lName" type="text" class="form-control" id="lName" placeholder="Last Name">';
				echo '<p id="lNameStatus"></p>';
				echo '</div></div>';
			}
		}
		elseif (isset($_GET['lName']))
		{
			if($_GET['lName']=="lNameNull")
			{
				echo '<div class="form-group">';
				echo '<label class="col-md-3" for="lastName">Last Name</label>';
				echo '<div>';
				echo '<input name="lName" type="text" class="form-control" id="lName" placeholder="Last Name">';
				echo '<p class="alert alert-danger" id="lNameStatus">Last name cannot be blank!</p>';
				echo '</div></div>';
			}
			else
			{
				if(isset($_SESSION['lName']))
				{
					echo '<div class="form-group">';
					echo '<label class="col-md-3" for="lastName">Last Name</label>';
					echo '<div >';
					echo '<input name="lName" type="text" class="form-control" id="lName" value="'.$_SESSION['lName'].'">';
					echo '<p class="alert alert-danger" id="lNameStatus">Last Name is invalid!</p>';
					echo '</div></div>';
				}
			}
		}
		
		if( (!isset($_GET['email'])))
		{
			if(isset($_SESSION['email']))
			{
				echo '<div class="form-group">';
				echo '<label class="col-md-3" for="email">Email address</label>';
				echo '<div >';
				echo '<input name="email" type="email" class="form-control" id="email" value="'.$_SESSION['email'].'">';
				echo '<p class="alert alert-success" id="emailStatus">Email is valid!</p>';
				echo '</div></div>';
			}
			else
			{
				echo '<div class="form-group">';
				echo '<label class="col-md-3" for="email">Email address</label>';
				echo '<div >';
				echo '<input name="email" type="email" class="form-control" id="email" placeholder="Email">';
				echo '<p id="emailStatus"></p>';
				echo '</div></div>';
			}
		}
		elseif (isset($_GET['email']))
		{
			if ($_GET['email']=='emailNull')
			{
				echo '<div class="form-group">';
				echo '<label class="col-md-3" for="email">Email address</label>';
				echo '<div >';
				echo '<input name="email" type="email" class="form-control" id="email" placeholder="Email">';
				echo '<p class="alert alert-danger" id="emailStatus">Email cannot be blank!</p>';
				echo '</div></div>';
			}
			else
			{
				if (isset($_SESSION['email']))
				{
					echo '<div class="form-group">';
					echo '<label class="col-md-3" for="email">Email address</label>';
					echo '<div >';
					echo '<input name="email" type="email" class="form-control" id="email" value="'.$_SESSION['email'].'">';
					echo '<p class="alert alert-danger" id="emailStatus">Email is invalid!</p>';
					echo '</div>
					</div>';
				}
			}
		}

		if( (!isset($_GET['password'])))
		{
			if(isset($_SESSION['password']))
			{
				echo '<div class="form-group">';
				echo '<label class="col-md-3" for="password">Password</label>';
				echo '<div >';
				echo '<input name="password" type="text" class="form-control" id="password" value="'.$_SESSION['password'].'">';
				echo '<p class="alert alert-success" id="passwordStatus">Password is valid!</p>';
				echo '</div></div>';
			}
			else
			{
				echo '<div class="form-group">';
				echo '<label class="col-md-3" for="password">Password</label>';
				echo '<div >';
				echo '<input name="password" type="text" class="form-control" id="password" placeholder="Password">';
				echo '<p id="passwordStatus"></p>';
				echo '</div></div>';
			}
		}
		elseif (isset($_GET['password']))
		{
			if ($_GET['password']=='pWordNull')
			{
				echo '<div class="form-group">';
				echo '<label class="col-md-3" for="password">Password</label>';
				echo '<div>';
				echo '<input name="password" type="text" class="form-control" id="password" placeholder="Password">';
				echo '<p class="alert alert-danger" id="passwordStatus">Password cannot be blank!</p>';
				echo '</div></div>';
			}
			else
			{
				if (isset($_SESSION['password']))
				{
					echo '<div class="form-group">';
					echo '<label class="col-md-3" for="password">Password</label>';
					echo '<div >';
					echo '<input name="password" type="text" class="form-control" id="password" value="'.$_SESSION['password'].'">';
					echo '<p class="alert alert-danger" id="passwordStatus">Password is invalid!</p>';
					echo '</div>
					</div>';
				}
			}
		}

		
		
		echo '<div class="button-container">';
		echo '<button class="btn_log btn btn-success" name="submit" type="submit" value="submit">Sign Up</button>';
		echo '<a href="/auth/login.php" class="btn_sin btn btn-success">Login</a></form>';
		echo '</div>';	
	}

	if(isset($_POST['submit'])){
		echo '<div class ="col-md-6 offset-md-3 ">';
		if($_POST['submit']=='submit'){
			$errStatus=array();
			$firstName=$_POST['fName'];
			$lastName=$_POST['lName'];
			$email=$_POST['email'];
			$pWord=$_POST['password'];
			
			
			if ($firstName==NULL)
			{
				$errStatus[] .="fName=fNameNull";
			}
			elseif (!preg_match("/^[a-zA-Z\'-]+$/",$firstName))
			{
				$errStatus[] .="fName=fNameInvalid";
			}
			$_SESSION['fName']=$firstName;
			
			if ($lastName==NULL)
			{
				$errStatus[] .="lName=lNameNull";
			}
			elseif (!preg_match("/^[a-zA-Z\'-]+$/",$lastName))
			{
				$errStatus[] .="lName=lNameInvalid";
			}
			$_SESSION['lName'] =$lastName;
			
			if ($email==NULL)
			{
				$errStatus[] .="email=emailNull";
			}
			elseif (!preg_match('/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/',$email))
			{
				$errStatus[] .="email=emailInvalid";
			}
			$_SESSION['email']=$email;

			if ($pWord==NULL)
			{
				$errStatus[] .="password=pWordNull";
			}
			$_SESSION['password']=$pWord;
			

			
			include("../functions.php");
			if (count($errStatus)>0)
			{
				$errString=implode("&",$errStatus);
				redirect("https://ec2-18-191-216-234.us-east-2.compute.amazonaws.com/auth/signup.php?$errString");
			}
			
			$dblink = db_connect("UI-schema");
			$firstName = addslashes($firstName);
			$lastName = addslashes($lastName);
			$email = addslashes($email);
			$pWord = addslashes($pWord);

			$sqlW="Insert into `user` (`fName`,`lName`,`email`,`pWord`) values ('$firstName','$lastName','$email','$pWord')";
			$dblink->query($sqlW) or
				die("Something went wrong with: $sqlW<br>".$dblink->error."</p>");
			
			$sql = "SELECT `userID` FROM `user` where `email` LIKE '$email'";
			$result = mysqli_query($dblink, $sql);
			$row = $result->fetch_assoc();
			$_SESSION['userID'] = $row['userID'];
			//echo '$_SESSION[\'userID\'] = ' . $_SESSION['userID'] . '<br>';
			//echo '<script>window.location.href = "index.php";</script>';
			redirect("https://ec2-18-191-216-234.us-east-2.compute.amazonaws.com");
		}
		
}
		
?>
</div>
</div>
</div>

</body>
<div>
	<br>
	<br>
<div id="footer">
        <?php include '../assets/html/footer.html'; ?>
</div>
</div>
<br>


</html>
<!--<script src="node_modules/bootstrap/js/validation.js"></script>-->
