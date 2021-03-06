<?php 
	//start session
	session_start(); 
	
	//logged in user
        if( !isset($_SESSION["EVENT_ID"]) ) { header('Location: index.php');}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title> <?php echo "Event Name: " . $_SESSION["EVENT_NAME"]; ?> </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>  

<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
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
        <li><a href="home.php">Home</a></li>
        <li class="active"><a href="user.php">User Mode</a></li>
	<?php
                if( ($_SESSION['DJ_MODE']) == "on" )
                        echo '<li><a href="dj.php">DJ Mode</a></li>';
        ?>
        <li><a href="contact.php">Contact</a></li>
      	<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
	<div class="container" style="text-align:center">
		<div class="container" style="text-align:center">	
		<h5><?php echo 'Event Name: ' . $_SESSION["EVENT_NAME"] . '<br>' .  'Event ID: ' . $_SESSION["EVENT_ID"]; ?></h5>
   		<h1 style="text-align:center">User Mode</h1>
      		<div class="col-lg-6 col-sm-12">
      		<h3>Add to Playlist</h3>
         	<form action="add_song.php" method="post">
         		Song Name <input type="text" name="song_name" placeholder="song name" required><br>
         		Artist <input type="text" name="artist" placeholder="artist" required><br>
        		<div class="form-group">
                        <button type="submit" class="btn btn-default">Send</button>        	
			</div>
        	</form>
      	</div>      
      	<div class="col-lg-6 col-sm-12">
      	<h3>View Playlist</h3>
<?php
	//connect to database
	require 'connection.php';
	$conn	= Connect();
	if($conn->connect_error){ die("Connection Failed: " . $conn->connect_error);}
		
	//variable declaration
	$event_id = $_SESSION["EVENT_ID"];
	
	//query the database
	//$sql = "SELECT song_name,artist FROM `playlist` WHERE event_id = '" . $event_id . "'";
	$sql = "SELECT `song_name`,`artist` FROM `playlist` WHERE event_id = '" . $event_id . "'  ORDER BY `time` ASC";

	$result = $conn->query($sql);

	//output
	if ($result->num_rows > 0){
    		while($row = $result->fetch_assoc()){
			echo $row["song_name"] . " " . $row["artist"];
			echo "<br>";
		}	
	}
	else{ echo "0 results"; }

	//close db connection
	$conn->close();
?>
       <div id="result"></div>
      </div>
    </row>
<footer>
</footer>
</body>
</html>
