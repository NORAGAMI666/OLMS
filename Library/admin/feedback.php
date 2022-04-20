<?php
	include "connection.php";
	include "navbar.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Feedback</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
		
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

	<style type="text/css">
		body{
			background-image: url("images/feed2.jpg");
		}
		.wrapper{
			padding:40px;
			margin: 50px auto;  
			width: 900px;
			height: 600px;
			background-color: black;
			opacity: .8;
			color: white;
			border-radius: 80px;
		}
		.form-control{
			height: 70px;
			width: 60%;
			border-radius: 50px;
			padding-right: 50px;
			margin: auto 160px;

		}
		.btn-primary{
			border-radius: 50px;
			margin: auto 330px;
		}
		.scroll{
			height: 300px;
			width:100%;
			overflow: auto;
		}
	</style>
</head>
<body>
	<div class="wrapper">
		<h4 style="text-align: center;">You can submit any suggestions or questions in the comment section below. </h4>
		<br>
		<form style="" action="" method="post">
			<input class="form-control" type="text" name="shit_talk" placeholder="Write Something..."><br>
			<input class="btn btn-primary" type="submit" name="submit" value="Comment" style="width:150px; height: 40px;"> 
		</form>
		<br><br>
		<div class="scroll">
			<?php
				if(isset($_POST['submit']))
				{
					if($_SESSION['login_user'])
					{
						$sql="INSERT INTO `commental` VALUES ('', '$_SESSION[login_user]','$_POST[shit_talk]');";
						if(mysqli_query($db,$sql))
						{
							$q="SELECT * FROM `commental` ORDER BY `cid` DESC;";
							$res=mysqli_query($db,$q) or die( mysqli_error($db));

							echo "<table class='table table-bordered'>";
							while($row=mysqli_fetch_array($res))
							{
								echo "<tr>";
									echo "<td>"; echo $row['username']; echo "</td>";
									echo "<td>"; echo $row['shit_talk']; echo "</td>";
								echo "</tr>";
							}
						}
						
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
				else
				{
					$q="SELECT * FROM `commental` ORDER BY `cid` DESC;";
							$res=mysqli_query($db,$q)or die( mysqli_error($db));

							echo "<table class='table table-bordered'>";
							while($row=mysqli_fetch_assoc($res))
							{
								echo "<tr>";
									echo "<td>"; echo $row['username']; echo "</td>";
									echo "<td>"; echo $row['shit_talk']; echo "</td>";
								echo "</tr>";
							}
				}
			?>
		</div>
	</div>
</body>
</html>