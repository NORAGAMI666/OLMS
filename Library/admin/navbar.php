<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="nnstyles.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<?php
		$r = mysqli_query($db,"SELECT COUNT(status) AS total FROM `message` WHERE status='no' AND sender='student';");
		$count = mysqli_fetch_assoc($r);
	?>

	<nav class="navbar navbar-inverse">
				<div class="container-fluid">
					<div class="navbar-header">
						<a class="navbar-brand active" href="#">ONLINE LIBRARY MANAGEMENT SYSTEM</a>
					</div>
					<ul class="nav navbar-nav">
						<li ><a href="index.php">HOME</a></li>
						<li><a href="books.php">BOOKS</a></li>
						<li><a href="feedback.php">FEEDBACK</a></li>
					</ul>

					<?php
						if(isset($_SESSION['login_user']))
						{
					?>
							<ul class="nav navbar-nav">
								<li>
									<a href="profile.php">
										PROFILE
									</a>
								</li>
								<li>
									<a href="student.php">
										STUDENT DATABASE
									</a>
								</li>
								<li>
									<a href="fine.php">FINES</a>
								</li>
							</ul>

							<ul class="nav navbar-nav navbar-right">
								<li class="nav-item"><a class="nav-link active" href="logout.php"><span class="glyphicon glyphicon-log-out"> LOGOUT</span></a></li>
							</ul>
							<ul class="nav navbar-nav navbar-right">
								<li>
									<a href="message.php">
										<span class="glyphicon glyphicon-envelope"></span>
										<span class="badge bg-green">
											<?php
												echo $count['total'];
											?>
										</span>
									</a>
								</li>
								<li>
									<a href="profile.php">
										<div style="color: white;">
											<?php
												echo "<img class='img-circle profile_img' height=50 width=50 src='images/".$_SESSION['propic']."'>";
												echo " ".$_SESSION['login_user'];
											?>
										</div>
									</a>
								</li>
							</ul>
					<?php
						}
						else
						{
					?>
							<ul class="nav navbar-nav navbar-right">
								<li class="nav-item"><a class="nav-link active" href="adminlogin.php"><span class="glyphicon glyphicon-log-in"> LOGIN</span></a></li>
								<li class="nav-item"><a class="nav-link" href="registration.php"><span class="glyphicon glyphicon-user"> REGISTER</span></a></li>
						</ul>
					<?php
						}
					?>
				</div>
		</nav>
</body>
</html>