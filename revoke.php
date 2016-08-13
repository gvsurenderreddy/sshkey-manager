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
		$key->loadKey(file_get_contents('./private.key'));
		$publicKey = file_get_contents('./public.key');

		if (!$ssh->login($username, $key)) {
			echo '<div class="alert alert-danger"><strong>Error!</strong> Key pair does not match or does not exist.</div>';
		} else {
			$ssh->exec("sed -i '\|".$publicKey."|d' ~/.ssh/authorized_keys");
			echo '<div class="alert alert-success"><strong>Success!</strong> Key was removed from server.</div>';
		}
	}
?>
<div class="container">
	<h2>Key Revokation</h2>
	<p>Revoke keys that exist on a remote system.</p>
	<form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<div class="form-group">
      		<label for="server">Server:</label>
      		<input type="text" class="form-control" id="server" name="server">
    	</div>
		<div class="form-group">
      		<label for="username">Username:</label>
      		<input type="text" class="form-control" id="username" name="username">
    	</div>
   		
   		<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">Revoke</button>
   		<!-- Modal -->
  		<div class="modal fade" id="myModal" role="dialog">
   			<div class="modal-dialog">
    
	     		<!-- Modal content-->
	      		<div class="modal-content">
	        		<div class="modal-header">
	         			<button type="button" class="close" data-dismiss="modal">&times;</button>
	          			<h3 class="modal-title">Are you sure?</h3>
	        		</div>
	       			 <div class="modal-body">
	          			<p>Are you sure you want to revoke the keys off this system?</p>
	        		</div>
	       			<div class="modal-footer">
	          			<button type="button" class="btn btn-info" data-dismiss="modal">No</button>
	          			<button type="submit" class="btn btn-danger" name="submit">Yes</button>
	        		</div>
	      		</div>
     		</div>
 		</div>
  	</form>
  	<br />
  	<button type="button" class="btn btn-info" onclick="window.location.href='index.php'"">Return</button>
</div>
</body>
</html>