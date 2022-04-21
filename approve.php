<?php
	include "connection.php";
	include "navbar.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Approve Request</title>
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
			transition: background-color .5s;
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
		.Approve{
			text-align: center;
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
			<h3 style="text-align: center;">Approve Request</h3><br><br>

			<form class="Approve" action="" method="post">
				<input class="form-control" type="text" name="approve" placeholder="Approved/Not Approved" required=""><br>
				<input class="form-control" type="text" name="issuedate" placeholder="Issue Date YYYY-MM-DD" required=""><br>
				<input class="form-control" type="text" name="returndate" placeholder="Return Date YYYY-MM-DD" required=""><br>
				<button style="height:40px; width: 80px; margin:auto 525px;background-color: #6826f9b8" class="btn btn-primary" name="submit" type="submit">Submit</button><br>
			</form>
		</div>
	</div>

	<?php
		if(isset($_POST['submit']))
		{
			mysqli_query($db,"UPDATE `issue_book` SET `approve` = '$_POST[approve]', `issuedate` = '$_POST[issuedate]', `returndate` = '$_POST[returndate]' WHERE username= '$_SESSION[stname]' AND bookid = '$_SESSION[bookid]';");

			mysqli_query($db,"UPDATE books SET quantity = quantity - 1 WHERE bookid='$_SESSION[bookid]';");

			$res=mysqli_query($db,"SELECT quantity from books where bookid='$_SESSION[bookid]';");

			while($row=mysqli_fetch_assoc($res))
			{
				if($row['quantity']==0)
				{
					mysqli_query($db,"UPDATE books SET status = 'Not Available' WHERE bookid='$_SESSION[bookid]';");
				}
			}
	?>
			<script type="text/javascript">
				alert("Udpated Successfully.");
				window.location="request.php";
			</script>
	<?php
		}
	?>
</body>
</html>