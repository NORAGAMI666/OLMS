<?php
	include "connection.php";
	include "navbar.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Books</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style type="text/css">
		body{
			background-color: #bd8224fa;
		  font-family: "Lato", sans-serif;
		  transition: background-color .5s;
		}

		.sidenav{
		  height: 100%;
		  margin-top:50px; 
		  width: 0;
		  position: fixed;
		  z-index: 1;
		  top: 0;
		  left: 0;
		  background-color: #222;
		  overflow-x: hidden;
		  transition: 0.5s;
		  padding-top: 60px;
		}

		.sidenav a{
		  padding: 8px 8px 8px 32px;
		  text-decoration: none;
		  font-size: 25px;
		  color: #818181;
		  display: block;
		  transition: 0.3s;
		}

		.sidenav a:hover{
		  color: #f1f1f1;
		}

		.sidenav .closebtn{
		  position: absolute;
		  top: 0;
		  right: 25px;
		  font-size: 36px;
		  margin-left: 50px;
		}

		#main{
		  transition: margin-left .5s;
		  padding: 16px;
		}

		@media screen and (max-height: 450px){
		  .sidenav {padding-top: 15px;}
		  .sidenav a {font-size: 18px;}
		}
		.img-circle{
			margin-left:10px
		}
		.h:hover{
			color: white;
			width: 300px;
			height: 50px;
			background-color: #6826f9b8;
		}
		.book{
			width: 400px;
			margin-left: 370px ;
		}
		.form-control{
			height: 40px;
		}
	</style>
</head>
<body>

	<div id="mySidenav" class="sidenav">
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

		<div style="color: white; margin-left: 50px; font-size: 22px;">
			<?php
				if(isset($_SESSION['login_user']))
				{
					echo "<img class='img-circle profile_img' height=125 width=125 src='images/".$_SESSION['propic']."'>";
					echo "<br>";
					echo "<br>";
					echo "Welcome, ".$_SESSION['login_user'];
				}
			?>
		</div><br><br>

		<div class="h">
			<a href="books.php">Delete Book</a>
		</div>
		<div class="h">
			<a href="request.php">Book Requests</a>
		</div>
		<div class="h">
			<a href="issueinfo">Issue Information</a>
		</div>
	</div>

	<div id="main">
		<span style="font-size:30px;cursor:pointer; color: black;" onclick="openNav()">&#9776; open</span>
		<div class="container">
			<h2 style="color:black; font-family: Lucida Console; text-align: center;"><b>Add New Book</b></h2><br>
			<form class="book" action="" method="post" style="text-align: center;">
				<input type="text" name="bookid" class="form-control" placeholder="Book Id" required=""><br>
				<input type="text" name="name" class="form-control" placeholder="Book Name" required=""><br>
				<input type="text" name="authors" class="form-control" placeholder="Authors" required=""><br>
				<input type="text" name="edition" class="form-control" placeholder="Edition" required=""><br>
				<input type="text" name="status" class="form-control" placeholder="Status" required=""><br>
				<input type="text" name="quantity" class="form-control" placeholder="Quantity" required=""><br>
				<input type="text" name="department" class="form-control" placeholder="Department" required=""><br>
				<button class="btn btn-primary" type="submit" name="submit">ADD</button>
			</form>
		</div>
		<?php
			if(isset($_POST['submit']))
			{
				if($_SESSION['login_user'])
				{
					mysqli_query($db,"INSERT INTO `books` VALUES('$_POST[bookid]','$_POST[authors]','$_POST[name]','$_POST[edition]','$_POST[status]','$_POST[quantity]','$_POST[department]');");
		?>
					<script type="text/javascript">
						alert("Book added successfully.");
					</script>

		<?php
				}
				else
				{
		?>
						<script type="text/javascript">
							alert("You need to login.");
						</script>
		<?php
				}
			}
		?>
	</div>

		<script>
			function openNav(){
			  document.getElementById("mySidenav").style.width = "250px";
			  document.getElementById("main").style.marginLeft = "250px";
			  document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
			}

			function closeNav(){
			  document.getElementById("mySidenav").style.width = "0";
			  document.getElementById("main").style.marginLeft= "0";
			  document.body.style.backgroundColor = "#bd8224fa";
			}
		</script>
</body>