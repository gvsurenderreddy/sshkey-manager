<?php
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
			exit('Login Failed or Key does not exist.');
		} else {
			echo $ssh->exec($command);
		}
	}
?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	Username: <input type="text" name="username"><br />
	Server: <input type="text" name="server"><br />
	Command: <input type="text" name="command"><br />
	<input type="submit" name="submit" value="Run Command"><br>
</form>
<a href="index.php" />Return</a>