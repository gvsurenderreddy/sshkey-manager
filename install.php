<?php
	include('Net/SSH2.php');

	if(isset($_POST['submit'])) { 
		$username = $_POST['username'];
		$password = $_POST['password'];
		$server = $_POST['server'];
		
		$ssh = new Net_SSH2($server);
		if (!$ssh->login($username, $password)) {
			exit('Login Failed');
		} else {
			if(!file_exists('./public.key')) {
				echo 'You need to generate an SSH public key.';
			} else {
				$publickey = file_get_contents('./public.key');
				$ssh->exec('echo '.$publickey.' >> ~/.ssh/authorized_keys');
				echo "Key has been installed.";
			}
		}
	}
?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	Username: <input type="text" name="username"><br />
	Password: <input type="password" name="password"><br />
	Server: <input type="text" name="server"><br />
	<input type="submit" name="submit" value="Install Key"><br>
</form>
<a href="index.php" />Return</a>
