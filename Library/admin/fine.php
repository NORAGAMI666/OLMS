<?php
	include "connection.php";
	include "navbar.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Student Fine Database</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style type="text/css">
		.srch{
			padding-left: 1000px;
		}
		body{
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
		.srch{
			padding-left: 700px;
		}
		.h:hover{
			color: white;
			width: 300px;
			height: 50px;
			background-color: #6826f9b8;
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
				</div>
					
					<div class="h">
						<a href="add.php">Add Book</a>
					</div>
					<div class="h">
						<a href="request.php">Book Request</a>
					</div>
					<div class="h">
						<a href="expired.php">Expired List</a>
					</div>
					<div class="h">
						<a href="issueinfo.php">Issue Information</a>
					</div>
			</div>

			<div id="main">
				<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span>
		

				<script>
					function openNav(){
					  document.getElementById("mySidenav").style.width = "250px";
					  document.getElementById("main").style.marginLeft = "250px";
					  document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
					}

					function closeNav(){
					  document.getElementById("mySidenav").style.width = "0";
					  document.getElementById("main").style.marginLeft= "0";
					  document.body.style.backgroundColor = "white";
					}
				</script>

			<div class="container">
				<div class="srch">
					<form class="navbar-form" method="post" name="form1">
						<input class="form-control" type="text" name="search" placeholder="Search Student Username" required="">
						<button style="background-color: #c9bb27ad;" type="submit" name="submit" class="btn btn-primary">
							<span class="glyphicon glyphicon-search"></span>
						</button>
					</form>
				</div>
			

				<h2>Student Fine List</h2>
				<?php

					if(isset($_POST['submit']))
					{
						$q=mysqli_query($db,"SELECT * FROM `fine` where `username` LIKE '%$_POST[search]%';");
						if(mysqli_num_rows($q)==0)
						{
							echo "Sorry! No student found with that username.";
						}
						else
						{
							echo "<table class='table table-bordered table-hover' >";
							echo "<tr style='background-color: #c9bb27ad;'>";
							//Table Header
								echo "<th>"; echo "Username";		echo "</th>";
								echo "<th>"; echo "Book Id";		echo "</th>";
								echo "<th>"; echo "Return Date";		echo "</th>";
								echo "<th>"; echo "Days";		echo "</th>";
								echo "<th>"; echo "Fine";		echo "</th>";
								echo "<th>"; echo "Status";		echo "</th>";
								echo "</tr>";

						while($row=mysqli_fetch_array($q))
						{
							echo "<tr>";
								echo "<td>"; echo $row['username']; echo "</td>";
								echo "<td>"; echo $row['bookid']; echo "</td>";
								echo "<td>"; echo $row['returned']; echo "</td>";
								echo "<td>"; echo $row['day']; echo "</td>";
								echo "<td>"; echo $row['fines']; echo "</td>";
								echo "<td>"; echo $row['status']; echo "</td>";
							echo "</tr>";
						}
							echo "</table>";
						}
					}
						//If button not pressed
					else
					{
						$res=mysqli_query($db,"SELECT * FROM `fine`");

						echo "<table class='table table-bordered table-hover' >";
							echo "<tr style='background-color: #c9bb27ad;'>";
							//Table Header
								echo "<th>"; echo "Username";		echo "</th>";
								echo "<th>"; echo "Book Id";		echo "</th>";
								echo "<th>"; echo "Return Date";		echo "</th>";
								echo "<th>"; echo "Days";		echo "</th>";
								echo "<th>"; echo "Fine";		echo "</th>";
								echo "<th>"; echo "Status";		echo "</th>";
								echo "</tr>";

						while($row=mysqli_fetch_array($res))
						{
							echo "<tr>";
								echo "<td>"; echo $row['username']; echo "</td>";
								echo "<td>"; echo $row['bookid']; echo "</td>";
								echo "<td>"; echo $row['returned']; echo "</td>";
								echo "<td>"; echo $row['day']; echo "</td>";
								echo "<td>"; echo $row['fines']; echo "</td>";
								echo "<td>"; echo $row['status']; echo "</td>";
							echo "</tr>";
						}
						echo "</table>";
					}
				?>
			</div>
		</div>
</body>
</html>

