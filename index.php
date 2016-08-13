<!DOCTYPE html>
<html lang="en">
<head>
	<title>SSH Key Authenticator</title>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
	<h2>SSH Key Manager</h2>
	<p>SSH Key Management for remote systems. Please follow guide below.</p>
	<br />
	<?php
		set_include_path(get_include_path() . PATH_SEPARATOR . 'phpseclib');

		if(file_exists('./keys/private.key') && file_exists('./keys/public.key')) {
			echo '<div class="alert alert-success fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>You already have a key pair created!</div>';
		}
		else {
			echo '<div class="alert alert-warning fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>No existing key pair can be found. Please create keys.</div>';	
		}
		
		if(!is_writable('./keys')) {
			$phpUser = exec('whoami');
			echo '<div class="alert alert-danger fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>The "keys" directory is not writable to "'. $phpUser .'" user.</div>';
		}

	?>
	<h4>Key Creation and Deployment</h4>
	<div class="panel panel-default">
 		<div class="panel-heading">Steps: Create Keys, Deploy Keys, Verify Keys</div>
  		<div class="panel-body"><button type="button" class="btn btn-success" onclick="window.location.href='create.php'">Create Keys</button> <button type="button" class="btn btn-success" onclick="window.location.href='deploy.php'">Deploy Keys</button> <button type="button" class="btn btn-success" onclick="window.location.href='verify.php'">Verify Keys</button></div>
  	</div>
</div>

<div class="container">
	<h4>Remote Command Execution</h4>
	<div class="panel panel-default">
		<div class="panel-heading">Run remote commands on systems with active keys.</div>
		<div class="panel-body"><button type="button" class="btn btn-primary" onclick="window.location.href='remote.php'">Run Remote Commands</button></div>
	</div>
</div>

<div class="container">
	<h4>Key Management</h4>
	<div class="panel panel-default">
		<div class="panel-heading">Manage active keys.</div>
		<div class="panel-body"><button type="button" class="btn btn-warning" onclick="window.location.href='revoke.php'">Revoke Keys</button> <button type="button" class="btn btn-danger" onclick="window.location.href='delete.php'">Delete Keys</button></div>
	</div>
</div>

</body>
</html>
