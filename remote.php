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
		$command = $_POST['command'];
		
		$ssh = new Net_SSH2($server);
		$key = new Crypt_RSA();
		$key->loadKey(file_get_contents('./private.key'));
		if (!$ssh->login($username, $key)) {
			echo '<div class="alert alert-danger"><strong>Error!</strong> Key pair does not match or does not exist.</div>';
		} else {
			$cmdOutput = $ssh->exec($command);
			echo '<div class="alert alert-success"><strong>Success!</strong> Command has been executed by remote system.</div>';
		}
	}
?>
<div class="container">
	<h2>Remote Command Execution</h2>
	<p>With remote keys installed, you will be able to run remote commands on those systems. Fill out the information below.</p>
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
      		<label for="command">Command:</label>
      		<input type="text" class="form-control" id="command" name="command">
   		 </div>
   		 <button type="submit" class="btn btn-default" name="submit">Submit</button>
  	</form>
  	<br />
  	<button type="button" class="btn btn-info" onclick="window.location.href='index.php'"">Return</button>
  	<p>
  	<?php 
  		if(isset($cmdOutput)) { ?>
  			<div class="panel panel-default">
  				<div class="panel-heading">Command Output:<br />"<?php echo $command; ?>"</div>
  				<div class="panel-body"><pre><?php echo $cmdOutput; ?></pre></div>
			</div>
  	<?php	
  		}
  	?>
</div>
</body>
</html>