<?php 
	//start session
	session_start(); 
	
	//checked logged in user
        if( !isset($_SESSION["EVENT_ID"]) ){ header( 'Location: index.php' );}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title> <?php echo $_SESSION["EVENT_NAME"]; ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="index.php">DJ Queue 2.0</a> 
   </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li class="active"><a href="home.php">Home</a></li>
        <li><a href="user.php">User Mode</a></li>
	<?php
                if($_SESSION["DJ_MODE"] == "on"){
                	echo '<li><a href="dj.php">DJ Mode</a></li>';
	        }
        ?>
        <li><a href="contact.php">Contact</a></li>
      	<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
  <div class="container" style="text-align:center">
	<div class="container" style="text-align:center">
        <h5><?php echo 'Event Name: ' . $_SESSION["EVENT_NAME"] . '<br>' . 'Event ID: ' . $_SESSION["EVENT_ID"]; ?></h5>
  <h1>Home Portal</h1>
 <div class="container" style="text-align:center">
   <div>
<!--	<a href="play.php"<button type="button" class="btn-lg btn-primary"></button>Play</a><br><br><br> -->

   	<a href="user.php"<button type="button" class="btn-lg btn-primary"></button>User Mode</a><br><br><br>
	<?php
		if($_SESSION["DJ_MODE"] == "on"){
        		echo '<a href="dj.php"<button type="button" class="btn-lg btn-primary"></button>DJ Mode</a><br><br>';
		}  
	?>
<!--	<a href="data.php"<button type="button" class="btn-lg btn-primary"></button>Data Analytics</a><br><br><br> -->
	</div>
	</div>
	<?php	
		//connect to database
		require 'connection.php';
		$conn = Connect();
		if($conn->connect_error){ die("Connection Failed: " . $conn->connect_error); }

		//variable declaration
		$event_id = $_SESSION["EVENT_ID"];
		
		//query database count
		$sql = "SELECT COUNT(`song_id`) AS COUNT FROM `playlist` WHERE `event_id` = '" . $event_id . "'";  
		$result = $conn->query($sql);
		
		//database count set
		if($result->num_rows > 0){
			$song_count = $result->fetch_assoc();
			$song_count = $song_count['COUNT'];
		}else{ $song_count = 0; }
		
		//output
	//	echo "IP Address " . $_SERVER['REMOTE_ADDR'];
		echo "Event Name: " . $_SESSION["EVENT_NAME"] . "<br>";
		echo "Event ID: " . $_SESSION["EVENT_ID"] . "<br>";
		echo "Songs on the <i>queue</i>: " . $song_count . "<br>";	
	//	echo "Number Users using //event id<br>";
	//	echo "Number of Events created by you //output events<br>";
	//	echo "Number of Songs created by you //output songs where your IP matches";
	 ?>
	</script>
 <footer>
</footer>
 </body>
</html>
