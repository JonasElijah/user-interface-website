<html>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Photography Website Log-in</title>
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
	background-position: center;
    	background-size: cover;
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
		padding: 50px;
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
             <?php
		if(!isset($_SESSION['userID'])){
			echo '<li class="nav-item"> ';
               	 	echo ' <a class="nav-link" href="#">Login</a>';
              		echo '</li>';
              		echo '<li class="nav-item">';
                	echo '<a class="nav-link" href="signup.php">Signup</a>';
              		echo ' </li>';
			       }
		else{
			echo '<li class="nav-item">';
                	echo '<a class="nav-link" href="cart.php">Cart</a>';
             		echo '</li>';
			echo '<li class="nav-item">';
                	echo '<a class="nav-link" href="account.php">Account</a>';
             		echo '</li>';
			    }
		?>

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
			

			
			include("functions.php");
			if (count($errStatus)>0)
			{
				$errString=implode("&",$errStatus);
				redirect("https://ec2-18-191-216-234.us-east-2.compute.amazonaws.com/login.php?$errString");
			}
			
			$dblink = db_connect("UI-schema");
			
			$email = addslashes($email);
			$pWord = addslashes($pWord);

			
			
			$sql = "SELECT `pWord`,`email`,`userID` FROM `user` where `email` LIKE '$email'";
			$result = mysqli_query($dblink, $sql);
			$row = $result->fetch_assoc();
			if($row <0)
			{
			
			redirect("https://ec2-18-191-216-234.us-east-2.compute.amazonaws.com/login.php?email=emailNonexist");
			}
			else
			{
			
			
				if($row['pWord'] != $pWord)
				{
				redirect("https://ec2-18-191-216-234.us-east-2.compute.amazonaws.com/login.php?password=pWordNonexist");
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
