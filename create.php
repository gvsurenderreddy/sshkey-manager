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
	
	if(isset($_POST['submit'])) { 
		if(file_exists('./keys/private.key') && file_exists('./keys/public.key')) {
			echo 'You already have a key pair created. Use that instead.';
		} else {
			include('Crypt/RSA.php');
			
			$rsa = new Crypt_RSA();
			$rsa->setPublicKeyFormat(CRYPT_RSA_PUBLIC_FORMAT_OPENSSH);
			extract($rsa->createKey(2048));	
			
			// Create RSA Keys
			file_put_contents('./keys/private.key', $privatekey);
			file_put_contents('./keys/public.key', $publickey);

			// Check if they were actually created
			if (file_exists('./keys/private.key') && file_exists('./keys/public.key')) {
				echo '<div class="alert alert-success"><strong>Success!</strong> Keys has been created and saved to this server!</div>';	
			}
			else {
				$phpUser = exec('whoami');
				echo '<div class="alert alert-danger"><strong>Error!</strong> Keys were not created. The "keys" directory is not writable to "'. $phpUser .'" user.</div>';	
			}
		}
	}
?>
<div class="container">
	<h2>Key Creation</h2>
	<p>Generate 2048 bit public/private keys for remote systems.</p>
	<?php
		if(file_exists('./keys/private.key') && file_exists('./keys/public.key')) {
			echo '<div class="alert alert-success fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>You already have a key pair created!</div>';	
		}
		if(!extension_loaded('gmp')) {
			echo '<div class="alert alert-warning fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>PHP GMP extension is not loaded. Key generation may fail if system entropy is not high enough.</div>';
		}
	?>
	<form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<button type="submit" class="btn btn-success" name="submit">Create Key</button>
  	</form>
  	<br />
  	<button type="button" class="btn btn-info" onclick="window.location.href='index.php'"">Return</button>
</div>
</body>
</html>