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
			padding-left: 10px;
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
			width: 80%;
			opacity: .8;
			color: white;
			margin-top: -63px;
		}	
		.scroll{
			width: 100%;
			height: 200px;
			overflow: auto;
		}
		th, td{
			width: 10%;
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
			<?php
				if(isset($_SESSION['login_user']))
				{

			?>			
					<div style="float: left; padding: 25px;">
						<form method="post" action="">
							<button name="submit2" type="submit" style="background-color: #6826f9b8;" class="btn btn-primary">RETURNED</button> &nbsp;&nbsp;&nbsp;
							<button name="submit3" type="submit" style="background-color: #6826f9b8;" class="btn btn-primary">EXPIRED</button>
						</form>
					</div>
					<div class="srch">
						<form method="post" action="" name="form1">
							<input type="text" name="username" class="form-control" placeholder="Username" required=""><br>
							<input type="text" name="bookid" class="form-control" placeholder="Book Id" required=""><br>
							<button style="height:40px; width: 80px; margin:auto 100px;background-color: #6826f9b8" class="btn btn-primary" name="submit" type="submit">Submit</button><br>
						</form>
					</div>
			<?php
					if(isset($_POST['submit']))
					{
						$res = mysqli_query($db,"SELECT * FROM `issue_book` WHERE username = '$_POST[username]' AND bookid = '$_POST[bookid]';");
						while($row=mysqli_fetch_array($res))
						{
							$d = strtotime($row['returndate']);
							$c = strtotime(date("Y-m-d"));
							$diff = $c-$d;
							if($diff>=0)
							{
								$day = floor($diff/(60*60*24)); //Days
								$fines = $day * .50;  
								$_SESSION['day'] = $day;
							}
						}
						$x =  date("Y-m-d"); 
						mysqli_query($db,"INSERT INTO `fine` VALUES('$_POST[username]', '$_POST[bookid]', '$x', '$day', '$fines', 'Not Paid');");

						$var1='<p style="color:green;">RETURNED</p>';
						mysqli_query($db,"UPDATE issue_book SET approve='$var1' WHERE username='$_POST[username]' and bookid='$_POST[bookid]';");

						mysqli_query($db,"UPDATE books SET quantity = quantity + 1 WHERE bookid = '$_POST[bookid]';");
					}
				}
			?>
				<!--<h2 style="text-align: center;">Expired Date List</h2>--><br>
			<?php
				$c=0;

				if(isset($_SESSION['login_user']))
				{
					$ret='<p style="color:green;">RETURNED</p>';
					$exp='<p style="color:red;">EXPIRED</p>';

					if(isset($_POST['submit2']))
					{
						$sql="SELECT student.username, rollno, books.bookid, name, authors, edition, approve, issuedate, returndate FROM student inner join issue_book on student.username=issue_book.username inner join books on issue_book.bookid=books.bookid where issue_book.approve ='$ret' ORDER BY `issue_book`.`returndate` DESC;";
						$res=mysqli_query($db,$sql);
					}
					else if(isset($_POST['submit3']))
					{
						$sql="SELECT student.username, rollno, books.bookid, name, authors, edition, approve, issuedate, returndate FROM student inner join issue_book on student.username=issue_book.username inner join books on issue_book.bookid=books.bookid where issue_book.approve ='$exp' ORDER BY `issue_book`.`returndate` DESC;";
						$res=mysqli_query($db,$sql);
					}
					else
					{
						$sql="SELECT student.username, rollno, books.bookid, name, authors, edition, approve, issuedate, returndate FROM student inner join issue_book on student.username=issue_book.username inner join books on issue_book.bookid=books.bookid where issue_book.approve !='' and issue_book.approve !='Approved' ORDER BY `issue_book`.`returndate` DESC;";
						$res=mysqli_query($db,$sql);
					}

					echo "<table class='table table-bordered ' >";
						echo "<tr style='background-color: #6826f9b8;'>";
					//Table Header
							echo "<th>"; echo "Student Username";		echo "</th>";
							echo "<th>"; echo "Roll No";		echo "</th>";
							echo "<th>"; echo "Book Id";		echo "</th>";
							echo "<th>"; echo "Book Name";		echo "</th>";
							echo "<th>"; echo "Author Names";		echo "</th>";
							echo "<th>"; echo "Edition";		echo "</th>";
							echo "<th>"; echo "Approval";		echo "</th>";
							echo "<th>"; echo "Issue Date";		echo "</th>";
							echo "<th>"; echo "Return Date";		echo "</th>";
						echo "</tr>";
						echo "</table>";

						echo "<div class='scroll'>";
						echo "<table class='table table-bordered ' >";

					while($row=mysqli_fetch_array($res))
					{
						
						echo "<tr>";
							echo "<td>"; echo $row['username']; echo "</td>";
							echo "<td>"; echo $row['rollno']; echo "</td>";				
							echo "<td>"; echo $row['bookid']; echo "</td>";
							echo "<td>"; echo $row['name']; echo "</td>";		
							echo "<td>"; echo $row['authors']; echo "</td>";	
							echo "<td>"; echo $row['edition']; echo "</td>";
							echo "<td>"; echo $row['approve']; echo "</td>";
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