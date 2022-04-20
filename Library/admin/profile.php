<?php
	include "connection.php";
	include "navbar.php"
?>

<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
	<style type="text/css">
		.wrapper1{
			width:500px;
			margin:0 auto;
			color: white;
		}
	</style>
</head>
<body style="background-color: #250722ed;">
	<div class="container">
		<form action="" method="post">
			<button class="btn btn-primary" style="float: right;" name="submit1" type="submit">
				Edit
			</button>
		</form>
		<div class="wrapper1">
			<?php
				if(isset($_POST['submit1']))
				{
					?>
						<script type="text/javascript">
							window.location="edit.php"
						</script>
					<?php
				}
				$q=mysqli_query($db,"SELECT * FROM `admin` WHERE `username` = '$_SESSION[login_user]' ;");

			?>
			<h2 style="text-align: center;">My Profile</h2>
			<?php
				$row=mysqli_fetch_assoc($q);

				echo "<div style='text-align: center'>
						<img class='img-circle profile_img' height=200 width=200 src='images/".$_SESSION['propic']."'>
					  </div>";
			?>
			<div style="text-align: center;">
				<b>Welcome</b>
				<h4>
					<?php
						echo $_SESSION['login_user'];
					?>
				</h4>
			</div>
			<?php

				echo "<b>";
					echo "<table class='table table-bordered'>";
						echo "<tr>";
							echo "<td>";
								echo "<b> First Name: </b>";
							echo "</td>";
							echo "<td>";
								echo $row['firstname'];
							echo "</td>";
						echo "</tr>";

						echo "<tr>";
							echo "<td>";
								echo "<b> Last Name: </b>";
							echo "</td>";
							echo "<td>";
								echo $row['lastname'];
							echo "</td>";
						echo "</tr>";

						echo "<tr>";
							echo "<td>";
								echo "<b> Username: </b>";
							echo "</td>";
							echo "<td>";
								echo $row['username'];
							echo "</td>";
						echo "</tr>";

						echo "<tr>";
							echo "<td>";
								echo "<b> Email ID: </b>";
							echo "</td>";
							echo "<td>";
								echo $row['email'];
							echo "</td>";
						echo "</tr>";

						echo "<tr>";
							echo "<td>";
								echo "<b> Contact: </b>";
							echo "</td>";
							echo "<td>";
								echo $row['mobile'];
							echo "</td>";
						echo "</tr>";
					echo "</table>";
				echo "</b>";
			?>
		</div>
	</div>
</body>
</html>