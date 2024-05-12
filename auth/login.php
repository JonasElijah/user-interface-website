
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Photography Website Log-in</title>
<link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />

<style>
header {
    background-color: #fdf4eb;
}

body {
    font-family: "Georgia", sans-serif;
    display: flex;
    flex-direction: column;
    background-image: url('/assets/images/gallery/trees-3822149_1280.jpg');
    background-position: center;
    background-size: cover;
    position: relative;
    color: #333;
}

body::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5); 
    z-index: -1; 
}

.form {
    background-color: rgba(253, 244, 235, 0.85);
    padding: 50px;
    border-radius: 10px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    max-width: 500px;
    margin: auto;
    margin-top: 100px; 
}

.form-group {
    margin-bottom: 20px;
}

.form-control {
    border-radius: 5px;
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
    padding: 10px;
    margin-top: 10px;
    font-size: 16px; 
}

.btn {
    background-color: #28a745;
    border-color: #28a745;
    width: 100%;
    color: #fff;
    padding: 10px 20px;
    border-radius: 5px;
    transition: background-color 0.3s, transform 0.3s;
    font-size: 16px; 
}

.btn:hover {
    background-color: #218838;
    transform: translateY(2px);
}

h1 {
    color: #fdf4eb;
    font-size: 50px;
    text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7); 
    text-align: center;
    margin-bottom: 20px;
}

.footer {
    margin-top: auto;
    padding: 10px;
    background-color: #fdf4eb;
    text-align: center;
    border-top: 1px solid #ddd;
}

@media (max-width: 480px) {
    .form {
        padding: 20px;
        margin-top: 50px; 
    }

    .btn {
        width: 100%;
        margin-top: 10px;
    }

    h1 {
        font-size: 30px;
    }
}

    </style>
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
<h1 style = "color: #fdf4eb; font-size: 50px;text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;"  align = "center">Welcome to the Log-in page! </h1>
<?php
if(!isset($_POST['submit'])){
	echo '<form class="col-md-6 offset-md-3 form" id="contact" method="post" action="">';
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
				echo '<p class="alert-danger" id="emailStatus">Email cannot be blank!</p>';
				echo '</div></div>';
			}
			elseif($_GET['email']=='emailNonexist')
			{
				echo '<div class="form-group">';
				echo '<label class="col-md-3" for="email">Email address</label>';
				echo '<div >';
				echo '<input name="email" type="email" class="form-control" id="email" placeholder="Email">';
				echo '<p class="alert alert-danger" id="emailStatus">Email Does not exist!</p>';
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
				echo '<div >';
				echo '<input name="password" type="text" class="form-control" id="password" placeholder="Password">';
				echo '<p class="alert alert-danger" id="passwordStatus">Password cannot be blank!</p>';
				echo '</div></div>';
			}
			elseif($_GET['password']=='pWordNonexist')
			{
			echo '<div class="form-group">';
				echo '<label class="col-md-3" for="password">Password</label>';
				echo '<div >';
				echo '<input name="password" type="text" class="form-control" id="password" placeholder="Password">';
				echo '<p class="alert alert-danger" id="passwordStatus">Password does not match email!</p>';
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

		
			
			echo '<br><button class="btn btn-success col-md-2 offset-md-5" name="submit" type="submit" value="submit">Log In</button></form>';
			
}
	if(isset($_POST['submit'])){
		echo '<div class ="col-md-6 offset-md-3 form">';
		if($_POST['submit']=='submit'){
			$errStatus=array();
			
			$email=$_POST['email'];
			$pWord=$_POST['password'];
			
			
			
			
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
				redirect("https://ec2-18-191-216-234.us-east-2.compute.amazonaws.com/auth/login.php?$errString");
			}
			
			$dblink = db_connect("UI-schema");
			
			$email = addslashes($email);
			$pWord = addslashes($pWord);

			
			
			$sql = "SELECT `pWord`,`email`,`userID` FROM `user` where `email` LIKE '$email'";
			$result = mysqli_query($dblink, $sql);
			$row = $result->fetch_assoc();
			if($row <0)
			{
			
			redirect("https://ec2-18-191-216-234.us-east-2.compute.amazonaws.com/auth/login.php?email=emailNonexist");
			}
			else
			{
			
			
				if($row['pWord'] != $pWord)
				{
				redirect("https://ec2-18-191-216-234.us-east-2.compute.amazonaws.com/auth/login.php?password=pWordNonexist");
				}
				else
				{

			
				$_SESSION['userID'] = $row['userID'];
				//echo '$_SESSION[\'userID\'] = ' . $_SESSION['userID'] . '<br>';
			
				redirect("https://ec2-18-191-216-234.us-east-2.compute.amazonaws.com");
				}
			}
		}
		
}
		?>
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
</html>
