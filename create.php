<?php
	if(isset($_POST['submit'])) { 
		if(file_exists('/srv/www/htdocs/private.key') && file_exists('/srv/www/htdocs/public.key')) {
			echo 'You already have a key pair created. Use that instead.';
		} else {
			include('Crypt/RSA.php');
			
			$encryption = $_POST['encryption'];

			$rsa = new Crypt_RSA();
			$rsa->setPublicKeyFormat(CRYPT_RSA_PUBLIC_FORMAT_OPENSSH);
			extract($rsa->createKey($encryption));	
			
			file_put_contents('/srv/www/htdocs/private.key', $privatekey);
			file_put_contents('/srv/www/htdocs/public.key', $publickey);
			echo 'Keys has been created and saved to this server!<br />';	
		}
	}
?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	Encryption Length: <input type="text" value="1024" name="encryption"><br />
	<input type="submit" name="submit" value="Create Key"><br>
</form>
<a href="index.php" />Return</a>