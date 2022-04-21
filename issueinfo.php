<?php
	include "connection.php";
	include "navbar.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Book Request</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style type="text/css">
		.srch{
			padding-left: 850px;
		}
		.form-control{
			margin: 5px auto;
			width: 300px;
			background-color: #000000;
			color: white;
		}
		body {
			font-family: "Lato", sans-serif;
			transition: background-color:.5s;
		}

		.sidenav {
			height: 100%;
			margin-top: 50px; 
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

		.sidenav a {
			padding: 8px 8px 8px 32px;
			text-decoration: none;
			font-size: 25px;
			color: #818181;
			display: block;
			transition: 0.3s;
		}

		.sidenav a:hover {
			color: #f1f1f1;
		}

		.sidenav .closebtn {
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
		.container{
			height: 500px;
			background-color: #000000;
			opacity: .8;
			color: white;
		}	
		.scroll{
			width: 100%;
			height: 350px;
			overflow: auto;
		}
		th, td{
			width: 8%;
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
			<a href="books.php">Books</a>
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
			<h2 style="text-align: center;">Information Of Borrowed Books</h2>
			<?php
				$c=0;

				if(isset($_SESSION['login_user']))
				{
					$sql="SELECT student.username, rollno, books.bookid, name, authors, edition, issuedate, returndate FROM student inner join issue_book on student.username=issue_book.username inner join books on issue_book.bookid=books.bookid where issue_book.approve='Approved' ORDER BY `issue_book`.`returndate` ASC;";

					$res=mysqli_query($db,$sql);
					echo "<table class='table table-bordered ' >";
						echo "<tr style='background-color: #6826f9b8;'>";
					//Table Header
							echo "<th>"; echo "Student Username";		echo "</th>";
							echo "<th>"; echo "Roll No";		echo "</th>";
							echo "<th>"; echo "Book Id";		echo "</th>";
							echo "<th>"; echo "Book Name";		echo "</th>";
							echo "<th>"; echo "Author Names";		echo "</th>";
							echo "<th>"; echo "Edition";		echo "</th>";
							echo "<th>"; echo "Issue Date";		echo "</th>";
							echo "<th>"; echo "Return Date";		echo "</th>";
						echo "</tr>";
						echo "</table>";

						echo "<div class='scroll'>";
						echo "<table class='table table-bordered ' >";

					while($row=mysqli_fetch_array($res))
					{
						$d=date("Y-m-d");
						if($d > $row['returndate'])
						{
							$c=$c+1;
							$var='<p style="color:red;">EXPIRED</p>';

							mysqli_query($db,"UPDATE issue_book SET approve='$var' WHERE returndate='$row[returndate]' AND approve='Approved' limit $c;");


							echo $d."</br>";
						}

						
						echo "<tr>";
							echo "<td>"; echo $row['username']; echo "</td>";
							echo "<td>"; echo $row['rollno']; echo "</td>";				
							echo "<td>"; echo $row['bookid']; echo "</td>";
							echo "<td>"; echo $row['name']; echo "</td>";		
							echo "<td>"; echo $row['authors']; echo "</td>";	
							echo "<td>"; echo $row['edition']; echo "</td>";
							echo "<td>"; echo $row['issuedate']; echo "</td>";
							echo "<td>"; echo $row['returndate']; echo "</td>";
						echo "</tr>";
					}
					echo "</table>";
					echo "</div>";
				}
				else
				{	

			?>		
					<br>
					<h3 style="text-align: center;">Login first.</h3>
			<?php
				}
			?>
		</div>
	</div>
</body>
</html>