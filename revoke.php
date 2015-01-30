<?php
	include('Net/SSH2.php');
	include('Crypt/RSA.php');

	if(isset($_POST['submit'])) { 
		$server = $_POST['server'];
		$username = $_POST['username'];
		
		$ssh = new Net_SSH2($server);
		$key = new Crypt_RSA();
		$key->loadKey(file_get_contents('./private.key'));
		if (!$ssh->login($username, $key)) {
			exit('Login Failed or Key does not exist.');
		} else {
			$ssh->exec('> ~/.ssh/authorized_keys');
			echo 'Keys have been removed from this server!';
		}
	}
?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	Username: <input type="text" name="username"><br />
	Server: <input type="text" name="server"><br /><br />
	Are you sure you wish to remove keys from this server?<br />
	<input type="submit" name="submit" value="Revoke Key"><br />
</form>
<a href="index.php" />Return</a>