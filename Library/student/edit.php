<?php
	include "connection.php";
	include "navbar.php"
?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Admin Profile</title>
	<style type="text/css">
		.form-control
		{
			height: 38px;
			width: 250px;
		}
		form
		{
			padding-left: 650px;
		}
	</style>
</head>
<body style="background-color: #250722ed;">
	<h2 style="text-align: center; color: white;">Edit User Details</h2>

	<?php
		$sql = "SELECT * FROM `student` WHERE username = '$_SESSION[login_user]';";
		$result = mysqli_query($db,$sql) or die (mysqli_error());

		while($rows = mysqli_fetch_assoc($result))
		{
			$firstname = $rows['firstname'];
			$lastname = $rows['lastname'];
			$username = $rows['username'];
			$roll = $rows['rollno'];
			$email = $rows['email'];
			$contact = $rows['mobile'];
			$password = $rows['password'];
		}
	?>
	<div class="profile" style="text-align: center;">
		<span style="color: white;">Welcome,</span>
		<h4 style="color: white;">
			<?php
				echo $_SESSION['login_user'];
			?>
		</h4>
	</div><br><br>
	<div class="form1">
		<form action="" method="post" enctype="multipart/form-data">

			<label style="color: white;"><h4><b>Profile Picture:</b></h4></label>
			<input class="form-control" type="file" name="file"><br>
			
			<label style="color: white;"><h4><b>Firstname:</b></h4></label>
			<input class="form-control" type="text" name="firstname" value="<?php echo $firstname; ?>"><br>
			
			<label style="color: white;"><h4><b>Lastname:</b></h4></label>
			<input class="form-control" type="text" name="lastname" value="<?php echo $lastname; ?>"><br>
			
			<label style="color: white;"><h4><b>Username:</b></h4></label>
			<input class="form-control" type="text" name="username" value="<?php echo $username; ?>"><br>

			<label style="color: white;"><h4><b>Roll Number:</b></h4></label>
			<input class="form-control" type="text" name="rollno" value="<?php echo $roll; ?>"><br>
			
			<label style="color: white;"><h4><b>Email:</b></h4></label>
			<input class="form-control" type="text" name="email" value="<?php echo $email; ?>"><br>
			
			<label style="color: white;"><h4><b>Contact:</b></h4></label>
			<input class="form-control" type="text" name="mobile" value="<?php echo $contact; ?>"><br>
			
			<label style="color: white;"><h4><b>Password:</b></h4></label>
			<input class="form-control" type="text" name="password" value="<?php echo $password; ?>"><br>

			<div style="padding-left: 70px;">
				<button  class="btn btn-primary" type="submit" name="submit">Save</button>
			</div>
		</form>
	</div>
	<?php
		if(isset($_POST['submit']))
		{
			move_uploaded_file($_FILES['file']['tmp_name'],"images/".$_FILES['file']['name']);

			$firstname = $_POST['firstname'];
			$lastname = $_POST['lastname'];
			$username = $_POST['username'];
			$roll = $_POST['rollno'];
			$email = $_POST['email'];
			$contact = $_POST['mobile'];
			$password = $_POST['password'];
			$proph = $_FILES['file']['name']; 

			$sql1 = "UPDATE `student` SET firstname = '$firstname', lastname = '$lastname', username = '$username', rollno = '$roll', email = '$email', mobile = '$contact', password = '$password', propic = '$proph' WHERE username = '".$_SESSION['login_user']."';";

			if(mysqli_query($db,$sql1))
			{
				?>
					<script type="text/javascript">
						alert("Saved Successfully.");
						window.location="profile.php";
					</script>
				<?php
			}
		}
	?>
</body>
</html>