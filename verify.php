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
	include('Crypt/RSA.php');

	if(isset($_POST['submit'])) { 
		$server = $_POST['server'];
		$username = $_POST['username'];
		
		$ssh = new Net_SSH2($server);
		$key = new Crypt_RSA();
		$key->loadKey(file_get_contents('./keys/private.key'));
		
		if (!$ssh->login($username, $key)) {
			echo '<div class="alert alert-danger"><strong>Error!</strong> Key pair does not match or does not exist.</div>';
		} else {
			echo '<div class="alert alert-success"><strong>Success!</strong> Key pair is verified.</div>';
		}
	}
?>
<div class="container">
	<h2>Key Verification</h2>
	<p>Verify matching exist between the web server and remote server. Fill out the information below.</p>
	<?php 
		if(!file_exists('./keys/public.key')) {
			echo '<div class="alert alert-warning">No local keys were found on this system.</div>';
		}
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
   		
   		<button type="submit" class="btn btn-default" name="submit">Verify</button>
  	</form>
  	<br />
  	<button type="button" class="btn btn-info" onclick="window.location.href='index.php'"">Return</button>
</div>
</body>
</html>