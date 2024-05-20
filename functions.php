<?php
	function db_connect($database) {
		$username="root";
		$password="2024UTSA!";
		$hostname="localhost";
		$dblink=new mysqli($hostname,$username,$password,$database);
		if(mysqli_connect_errno()){
			die("Error connecting to database: ".mysqli_connect_error());
		}
		return $dblink;
	}

	function redirect($uri) {
		?>
		<script type="text/javascript">
			document.location.href="<?php echo $uri; ?>";
		</script>	
		<?php die;
	}
	
	function get_width()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') 
		{
			if (isset($_POST['screenWidth'])) 
			{
				$screenWidth = intval($_POST['screenWidth']);

				$itemsToShow = 3;
				if ($screenWidth < 600) 
				{
					$itemsToShow = 1;
				} 
				elseif ($screenWidth < 900) 
				{
					$itemsToShow = 2;
				}

				return $itemsToShow;
			} 
			else 
			{
				echo 'Screen width not set';
				return null;
			}
		} 
		else 
		{
			echo 'Invalid request method';
			return null;
		}
	}

?>
