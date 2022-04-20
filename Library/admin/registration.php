<?php
	include "connection.php";
	include "navbar.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin Registration Page</title>
	<link rel="stylesheet" type="text/css" href="nnstyles.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

	<style type="text/css">
		section{
			margin-top: -20px;
		}
		.form-control{
			height: 48px;
			border-radius: 50px;
		}
	</style>
</head>
<body>
	<div>
		<div>
		<section>
			<div class="reg_img">
				<br><br><br>
				<div class="box3">
					<h1 style="text-align: center; font-size: 35px; font-family: Lucida Console;">Library <br>Management System</h1>
					<h1 style="text-align: center; font-size: 25px;">User Registration</h1>
					<form name="regis" action="" method="post">
							<div class="inputreg">
								<input class="form-control" type="text" name="firstname" placeholder="FIRST NAME" required=""><br>
								<input class="form-control" type="text" name="lastname" placeholder="LAST NAME" required=""><br>
								<input class="form-control" type="text" name="username" placeholder="USERNAME" required=""><br>
								<input class="form-control" type="text" name="email" placeholder="email@gmail.com" required=""><br>
								<input class="form-control" type="text" name="mobile" placeholder="9999999999" required=""><br>
								<input class="form-control" type="password" name="password" placeholder="PASSWORD" required=""><br>
								<input class="form-control" type="password" name="repassword" placeholder="RETYPE PASSWORD" required=""><br>
								<input class="btn btn-primary" type="submit" name="submit" value="Register" style="width:90px; height: 42px; margin: auto 95px; border-radius: 50px;">
							</div>
						<p style="font-size: 18px; padding-left: 15px;margin:auto 67px;"> 
							Already have an account? <a style="color: white;" class="logstd" href="adminlogin.php">LogIn</a>
						</p>
					</form>
				</div>
			</div>
		</section>

		<?php

			if(isset($_POST['submit']))
			{
				$count=0;
				$sql="SELECT username from `admin`";
				$res=mysqli_query($db,$sql);

				while($row=mysqli_fetch_assoc($res))
				{
					if($row['username']==$_POST['username'])
					{
						$count=$count+1;
					}
				}
				if($count==0)
				{
					mysqli_query($db,"INSERT INTO `admin` VALUES('','$_POST[firstname]','$_POST[lastname]','$_POST[username]','$_POST[email]','$_POST[mobile]','$_POST[password]','$_POST[repassword]', 'dpfp.jpg');");
				
		?>
					<script type="text/javascript">
						alert("Registration successful.");
					</script>
		<?php
				}
				else
				{
		?>
					<script type="text/javascript">
						alert("The username is already taken.");
					</script>
		<?php
				}
			}
		?>

	</div>
</body>
</html>