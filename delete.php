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
	if(isset($_POST['submit'])) { 
		unlink('./private.key');
		unlink('./public.key');
		
		echo '<div class="alert alert-success"><strong>Success!</strong> The public and private key pair were deleted.</div>';
	}
?>
<div class="container">
	<h2>Key Deletion</h2>
	<?php
		if(!file_exists('./public.key')) {
			echo '<div class="alert alert-warning">No local keys were found on this system.</div>';
		}
		else {
			?>
			<p><strong>Are you sure you want to destroy the local keys?</strong><br />
			Destroying keys will prevent the web server from accessing any other system remotely.<br />
			New keys will need to be created.</p>
			<form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">Yes</button>
		   		<!-- Modal -->
		  		<div class="modal fade" id="myModal" role="dialog">
		   			<div class="modal-dialog">
		    
			     		<!-- Modal content-->
			      		<div class="modal-content">
			        		<div class="modal-header">
			         			<button type="button" class="close" data-dismiss="modal">&times;</button>
			          			<h3 class="modal-title">Just double checking...</h3>
			        		</div>
			       			 <div class="modal-body">
			          			<p>Are you sure you want to delete the local keys from this system?<br />
			          			Should this become needed in the future, new keys will need to be created.</p>
			        		</div>
			       			<div class="modal-footer">
			          			<button type="button" class="btn btn-info" data-dismiss="modal">No</button>
			          			<button type="submit" class="btn btn-danger" name="submit">Yes</button>
			        		</div>
			      		</div>
		     		</div>
		 		</div>
		  	</form>
		 <?php
		}
	?>
  	<br />
  	<button type="button" class="btn btn-info" onclick="window.location.href='index.php'"">Return</button>
</div>
</body>
</html>