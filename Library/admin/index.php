<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>
			Library Management
		</title>
		<link rel="stylesheet" type="text/css" href="nstyles.css">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

		<style type="text/css">
			.wrapper{
				height:660px;
				width:100%;
				background-color: #1d1a1a;
			}
			header{
				height: 170px;
				width: 100%;
				background-color: #161616;
				padding:10px;
				border-radius: 50%;
			}
			section{
				height:500px;
				width:100%;
				background-color: red;
			}
			footer{
				height:92px;
				width:100%;
				background-color: black;
			}
			.logo{
				float: left;
				padding-left: 20px;
			}
			.logo img{
				padding-left: 50px;
				border-radius: 50%;
			}
			li a {
				color: white;
				text-decoration: none;
			}
			nav{
				float: right;
				word-spacing: 30px;
				padding: 20px;
			}
			nav li{
					display: inline-block;
					line-height: 90px;
				}
			section .sec_img{
				margin-top: 0px;
				background-image: url("images/secti.jpg");
				height: 550px;
			}
			.box{
				height: 400px;
				width: 450px;
				background-color: black; 
				margin: 40px auto;
				opacity: .8;
				color: white;
				border-radius: 160px;
			}
		</style>
	</head>
	<body>
		<div class="wrapper">
			<header>
				<div class="logo">
					<img src="images/logo.jfif" height="110" width="150"> 
					<h2 style="color: white">ONLINE LIBRARY MANAGEMENT SYSTEM</h2>
				</div>

				<?php
					if(isset($_SESSION['login_user']))
					{
				?>
						<nav>
							<ul>
								<li><a href="index.php">HOME</a></li>
								<li><a href="books.php">BOOKS</a></li>
								<li><a href="logout.php">LOGOUT</a></li>
								<li><a href="registration.php">REGISTER</a></li>
								<li><a href="feedback.php">FEEDBACK</a></li>
							</ul>
						</nav>
				<?php
					}
					else
					{
				?>
						<nav>
							<ul>
								<li><a href="index.php">HOME</a></li>
								<li><a href="books.php">BOOKS</a></li>
								<li><a href="adminlogin.php">LOGIN</a></li>
								<li><a href="registration.php">REGISTER</a></li>
								<li><a href="feedback.php">FEEDBACK</a></li>
							</ul>
						</nav>
				<?php	
					}
				?>
			</header>
			<section>
				<div class="sec_img">
					<br>
					<div class="box">
						<br><br><br><br>
						<h1 style="text-align: center; font-size: 35px">Welcome To Library</h1><br><br>
						<h1 style="text-align: center; font-size: 25px">Opens at 10:00 </h1><br>
						<h1 style="text-align: center; font-size: 25px">CLoses at 16:00 </h1><br>
					</div>
				</div>
			</section>
			<footer>
				<p style="color:white;  text-align: center; ">
					<br><br>
					LIBRARY MANAGEMENT PROJECT BY SEM-6 CMSA
				</p>
			</footer>
		</div>
	</body>
</html>
