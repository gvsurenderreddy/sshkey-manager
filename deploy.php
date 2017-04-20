<!DOCTYPE html>
<html lang="en">
<head>
	<title>SSH Key Authenticator</title>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<?php
	set_include_path(get_include_path() . PATH_SEPARATOR . 'phpseclib');

	include('Net/SSH2.php');

	if(isset($_POST['submit'])) { 
		$username = $_POST['username'];
		$password = $_POST['password'];
		$server = $_POST['server'];
		
		$ssh = new Net_SSH2($server);
		if (!$ssh->login($username, $password)) {
			echo '<div class="alert alert-danger"><strong>Error!</strong> Server and/or login information is not incorrect.</div>';
		} else {
			if(!file_exists('./keys/public.key')) {
				echo '<div class="alert alert-warning">You must first create a Key Pair.</div>';
			} else {
				$publickey = file_get_contents('./keys/public.key');
				$ssh->exec('mkdir -p ~/.ssh');
				$ssh->exec('echo '.$publickey.' >> ~/.ssh/authorized_keys');
				echo '<div class="alert alert-success"><strong>Success!</strong> Keys has been created and saved to this server!</div>';
			}
		}
	}
?>
<div class="container">
	<h2>Key Installation</h2>
	<p>Install your SSH key on a remote system. Fill out the information below.</p>
	<?php
		if(!file_exists('./keys/public.key') || !file_exists('./keys/private.key')) {
			echo '<div class="alert alert-warning">No local keys were found on this system.</div>';
		}
		else {
		?>
			<form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<div class="form-group">
		      		<label for="server">Server:</label>
		      		<input type="text" class="form-control" id="server" name="server">
		    	</div>
				<div class="form-group">
		      		<label for="username">Username:</label>
		      		<input type="text" class="form-control" id="username" name="username">
		    	</div>
		   		<div class="form-group">
		      		<label for="password">Password:</label>
		      		<input type="password" class="form-control" id="password" name="password">
		   		 </div>
		   		 <button type="submit" class="btn btn-default" name="submit">Submit</button>
			</form>
	<?php
		}
	?>
  	<br />
  	<button type="button" class="btn btn-info" onclick="window.location.href='index.php'"">Return</button>
</div>
</body>
</html>