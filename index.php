<html>
<head>
	<title>SSH Key Authenticator</title>
</head>
<body>
	<h2>SSH Key Authenticator</h2><br />
	<?php
		if(file_exists('./private.key') && file_exists('./public.key')) {
			echo 'You already have a key pair created.';
		}
	?>
	<form>
		<input type="button" value="Create Key Pair" onclick="window.location.href='create.php'">
		<input type="button" value="Install Key" onclick="window.location.href='install.php'">
		<input type="button" value="Verify Key" onclick="window.location.href='verify.php'">
		<input type="button" value="Remote Command" onclick="window.location.href='remote.php'">
		<input type="button" value="Revote Key" onclick="window.location.href='revoke.php'">
		<input type="button" value="Delete Keys" onclick="window.location.href='delete.php'">
	</form>
</body>
</html>
