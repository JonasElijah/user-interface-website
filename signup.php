<!DOCTYPE html>
<html lang="en">
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Sign Up Page</title>

<link href="node_modules/css/bootstrap.min.css" rel="stylesheet">
<link href="node_modules/css/bst-styles.css" rel="stylesheet">
<link href="node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />	
<style>
      header {
	       background-color: #fdf4eb;
      }

      body {
        font-family: "Georgia", sans-serif;
	display: flex;
    	flex-direction: column;
	background-image: url('/assets/images/gallery/trees-3822149_1280.jpg');
	
      }

      .dropdown-menu {
        display: none;
      }

      #hover-dropdown:hover .dropdown-menu {
        display: block;
        min-width: 1rem;
        max-width: 6.5rem;
        max-height: calc(50vh - 50px);
        overflow-y: auto;
        text-align: center;
      }

      .photo-row {
        padding: 50px;
      }

      .photo-row img {
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-right: 20px;
      }

      .category {
        margin-bottom: 10px;
        padding: 40px;
        margin-right: 10px;
      }

      .custom-button {
        background-color: #fdf4eb;
        border-color: #fdf4eb;
        color: #a5998c;
      }

      .custom-button:hover {
        background-color: #f0e6d1;
        border-color: #f0e6d1;
        color: #a5998c;
      }
	.footer {
	margin-top: auto; /* Push the footer to the bottom */
	}
	.form
	{
		background-color: #fdf4eb;
	}

    </style>
	
</head>
<body>
	if (session_status() === PHP_SESSION_NONE) {
    	session_start();
	}
	<div>
	<header>
      <nav
        class="navbar navbar-expand-lg custom-navbar shadow rounded"
      >
        <div class="container-fluid">
          <img
            src="assets/images/photography.png"
            alt="Photography Logo"
            style="max-width: 250px; max-height: 100px"
          />

          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
	<h1 class="text-center"> Photo Bucket </h1>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item">
                <a class="nav-link" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Gallery</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">FAQ</a>
	      </li>
              <li class="nav-item">
                <a class="nav-link" href="#">About</a>
              </li>
		
              <li class="nav-item">
                <a class="nav-link" href="#">Login</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="signup.php">Signup</a>
              </li>

              <!--
              <li class="nav-item dropdown" id="hover-dropdown">
                <a
                  class="nav-link dropdown-toggle"
                  href="#"
                  role="button"
                  aria-haspopup="true"
                  aria-expanded="false"
                  >Profile</a
                >
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <li><a class="dropdown-item" href="#">Account</a></li>
                  <li><hr class="dropdown-divider" /></li>
                  <li><a class="dropdown-item" href="#">Cart</a></li>
                  <li><hr class="dropdown-divider" /></li>
                  <li><a class="dropdown-item" href="#">Settings</a></li>
                </ul>
              </li>
              -->
            </ul>
          </div>
        </div>
      </nav>
    </header>
</div>


<h1 style = "color: #fdf4eb; font-size: 50px;text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;"  align = "center">Welcome to the Sign Up page! </h1>

<div id="wrapper">
<div id="page-wrapper">
<div id="page-inner">
<br><br><br><br>
<?php
	
	if(!isset($_POST['submit'])){
		echo '<form class="col-md-6 col-md-offset-3 form-horizontal form" id="contact" method="post" action="">';
		
		if( (!isset($_GET['fName'])))
		{
			if(isset($_SESSION['fName']))
			{
				echo '<div class="form-group">';
				echo '<label class="col-md-3" for="firstName">First Name</label>';
				echo '<div class="col-md-9">';
				echo '<input name="fName" type="text" class="form-control" id="fName" value="'.$_SESSION['fName'].'">';
				echo '<p class="alert-success" id="fNameStatus">First Name is valid!</p>';
				echo '</div></div>';
			}
			else
			{
				echo '<div class="form-group">';
				echo '<label class="col-md-3" for="firstName">First Name</label>';
				echo '<div class="col-md-9">';
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
				echo '<div class="col-md-9">';
				echo '<input name="fName" type="text" class="form-control" id="fName" placeholder="First Name">';
				echo '<p class="alert-danger" id="fNameStatus">First name cannot be blank!</p>';
				echo '</div></div>';
			}
			else
			{
				if (isset($_SESSION['fName']))
				{
					echo '<div class="form-group">';
					echo '<label class="col-md-3" for="firstName">First Name</label>';
					echo '<div class="col-md-9">';
					echo '<input name="fName" type="text" class="form-control" id="fName" value="'.$_SESSION['fName'].'">';
					echo '<p class="alert-danger" id="fNameStatus">First name is invalid!</p>';
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
				echo '<div class="col-md-9">';
				echo '<input name="lName" type="text" class="form-control" id="lName" value="'.$_SESSION['lName'].'">';
				echo '<p class="alert-success" id="lNameStatus">Last name is valid!</p>';
				echo '</div></div>';
			}
			else
			{
				echo '<div class="form-group">';
				echo '<label class="col-md-3" for="lastName">Last Name</label>';
				echo '<div class="col-md-9">';
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
				echo '<div class="col-md-9">';
				echo '<input name="lName" type="text" class="form-control" id="lName" placeholder="Last Name">';
				echo '<p class="alert-danger" id="lNameStatus">Last name cannot be blank!</p>';
				echo '</div></div>';
			}
			else
			{
				if(isset($_SESSION['lName']))
				{
					echo '<div class="form-group">';
					echo '<label class="col-md-3" for="lastName">Last Name</label>';
					echo '<div class="col-md-9">';
					echo '<input name="lName" type="text" class="form-control" id="lName" value="'.$_SESSION['lName'].'">';
					echo '<p class="alert-danger" id="lNameStatus">Last Name is invalid!</p>';
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
				echo '<div class="col-md-9">';
				echo '<input name="email" type="email" class="form-control" id="email" value="'.$_SESSION['email'].'">';
				echo '<p class="alert-success" id="emailStatus">Email is valid!</p>';
				echo '</div></div>';
			}
			else
			{
				echo '<div class="form-group">';
				echo '<label class="col-md-3" for="email">Email address</label>';
				echo '<div class="col-md-9">';
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
				echo '<div class="col-md-9">';
				echo '<input name="email" type="email" class="form-control" id="email" placeholder="Email">';
				echo '<p class="alert-danger" id="emailStatus">Email cannot be blank!</p>';
				echo '</div></div>';
			}
			else
			{
				if (isset($_SESSION['email']))
				{
					echo '<div class="form-group">';
					echo '<label class="col-md-3" for="email">Email address</label>';
					echo '<div class="col-md-9">';
					echo '<input name="email" type="email" class="form-control" id="email" value="'.$_SESSION['email'].'">';
					echo '<p class="alert-danger" id="emailStatus">Email is invalid!</p>';
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
				echo '<div class="col-md-9">';
				echo '<input name="password" type="text" class="form-control" id="password" value="'.$_SESSION['password'].'">';
				echo '<p class="alert-success" id="passwordStatus">Password is valid!</p>';
				echo '</div></div>';
			}
			else
			{
				echo '<div class="form-group">';
				echo '<label class="col-md-3" for="password">Password</label>';
				echo '<div class="col-md-9">';
				echo '<input name="password" type="text" class="form-control" id="password" placeholder="Password">';
				echo '<p id="passwordStatus"></p>';
				echo '</div></div>';
			}
		}
		elseif (isset($_GET['password']))
		{
			if ($_GET['password']=='passwordNull')
			{
				echo '<div class="form-group">';
				echo '<label class="col-md-3" for="password">Password</label>';
				echo '<div class="col-md-9">';
				echo '<input name="password" type="text" class="form-control" id="password" placeholder="Password">';
				echo '<p class="alert-danger" id="passwordStatus">Password cannot be blank!</p>';
				echo '</div></div>';
			}
			else
			{
				if (isset($_SESSION['password']))
				{
					echo '<div class="form-group">';
					echo '<label class="col-md-3" for="password">Password</label>';
					echo '<div class="col-md-9">';
					echo '<input name="password" type="text" class="form-control" id="password" value="'.$_SESSION['password'].'">';
					echo '<p class="alert-danger" id="passwordStatus">Password is invalid!</p>';
					echo '</div>
					</div>';
				}
			}
		}

		
		
			echo '<br><button class="center-block" name="submit" type="submit" value="submit">Submit</button></form>';
	}

	if(isset($_POST['submit'])){
		echo '<div class ="col-md-6 col-md-offset-3">';
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
				$errStatus[] .="pWord=pWordNull";
			}
			$_SESSION['password']=$pWord;
			

			
			include("functions.php");
			if (count($errStatus)>0)
			{
				$errString=implode("&",$errStatus);
				redirect("https://ec2-18-191-216-234.us-east-2.compute.amazonaws.com/signup.php?$errString");
			}
			
			$dblink = db_connect("UI-schema");
			$firstName = addslashes($firstName);
			$lastName = addslashes($lastName);
			$email = addslashes($email);
			$pWord = addslashes($pWord);
			
			$sql="Insert into `user` (`fName`,`lName`,`email`,`pWord`) values ('$firstName','$lastName','$email','$pWord')";
			$dblink->query($sql) or
				die("Something went wrong with: $sql<br>".$dblink->error."</p>");
			$sql = "SELECT 'userID' FROM 'user' where 'email' == $email";
			$result = $dblink->query($sql);
			$_SESSION['userID'] = $result;
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
	<footer class="footer mt-auto py-3 bg-light">
      <div class="container text-center">
        <span class="text-muted">Photography Website &copy; 2024</span>
      </div>
    </footer>
</div>
<br>


</html>
<!--<script src="node_modules/bootstrap/js/validation.js"></script>-->
