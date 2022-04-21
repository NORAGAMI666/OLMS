<?php
	include "connection.php";
	include "navbar.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Student Login Page</title>
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
			border-radius: 50px;
			height: 55px;
		}
		.btn-primary{
			border-radius: 50px;
			height: 50px;
		}
	</style>
</head>
<body>
	<div class="len">
		<section>
			<div class="stdlogin_img">
				<br><br><br>
				<div class="box2">
					<h1 style="text-align: center; font-size: 35px; font-family: Lucida Console;">Library Management System</h1><br>
					<h1 style="text-align: center; font-size: 25px;">User Login</h1><br>
					<form name="stdlogin" action="" method="post">
							<div class="inputstd">
								<input class="form-control" type="text" name="username" placeholder="USERNAME" required=""><br>
								<input class="form-control" type="password" name="password" placeholder="PASSWORD" required=""><br>
								<input class="btn btn-primary" type="submit" name="submit" value="Login" style="width:90px;margin: auto 95px;">
							</div><br><br>
						<p style="font-size: 18px; padding-left: 15px"> 
							<a class="forgotstd" href="updatepass.php">Forget Password?</a>&nbsp; &nbsp;  &nbsp;&nbsp;&nbsp;
							New to Website?<a class="newstd" href="registration.php">Sign Up</a>
						</p>
					</form>	
				</div>
			</div>
		</section>

		<?php

		if(isset($_POST['submit']))
		{
			$count=0;
			$res=mysqli_query($db,"SELECT * FROM `admin` WHERE username='$_POST[username]' && password='$_POST[password]';");

			$row=mysqli_fetch_assoc($res);

			$count=mysqli_num_rows($res);

			if($count==0)
			{
				?>
				<!--
				<script type="text/javascript">
					alert("Wrong username and password.")
				</script>
				-->
					<div class="alert alert-danger" style="width:700px; margin: 120px 400px;">
						<strong>Wrong username and password.</strong>
					</div>
				<?php
			}
			else
			{
				$_SESSION['login_user'] = $_POST['username'];
				$_SESSION['propic'] = $row['propic'];
				$_SESSION['username'] = ''; 
				?>
					
					<script type="text/javascript">
						window.location="index.php"	
					</script>
					
				<?php
			}
		}

		?>

	</div>
</body>
</html>