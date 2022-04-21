<?php
	include "connection.php";
	include "navbar.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Update Admin Password</title>
	<style type="text/css">
		body{
			width: 100%;
			height: 650px;
			background-image: url("images/secti.jpg");
		}
		.wrapper2{
			width: 400px;
			height: 400px;
			background-color: #5d71927a;
			margin: 150px auto;
			color: white;
			padding: 27px 15px;
		}
		.form-control{
			width: 300px;
			text-align: center;
		}
	</style>
</head>
<body>
	<div class="wrapper2">
		<div>
			<h1 style="text-align: center; font-size: 35px; font-family: Lucida Console;">Reset Password</h1><br>
		</div>
		<div style="padding-left: 40px;">
			<form action="" method="post">
			 <input class="form-control" type="text" name="username" placeholder="Username" required=""><br>
			 <input class="form-control" type="text" name="email" placeholder="Email: example@gmail.com" required=""><br>
			 <input class="form-control" type="password" name="password" required="" placeholder="New Password"><br>
			 <input class="form-control" type="password" name="repassword" required="" placeholder="Re-type New Password"><br>
			 <button class="btn btn-primary" type="submit" style="margin-left: 100px;" name="submit">Reset</button>
		</form>
		</div>
	</div>

	<?php

	if(isset($_POST['submit']))
	{
		if(mysqli_query($db,"UPDATE `admin` SET `password`='$_POST[password]', `repassword`='$_POST[repassword]' WHERE `username`='$_POST[username]' AND email='$_POST[email]';"))
		{
	?>
			<script type="text/javascript">
				alert("The password updated successfully.")
			</script>
	<?php
		}
	}

	?>
</body>
</html>