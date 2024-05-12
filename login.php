<?php
session_start();
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
