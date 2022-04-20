<?php
	include "connection.php";
	include "navbar.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Messages</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<style type="text/css">
	.left_box{
		height: 677px;
		width: 500px;
		float: left;
		background-color: black;
		margin-top: -20px;
	}
	.right_box{
		height: 677px;
		width: 1100px;
		background-color: blue;
		margin-top: -20px;
		margin-left: 436px;
		padding: 10px;
	}
	.left_box2{
		height: 677px;
		width: 300px;
		border-radius: 20px;
		background-color: red;
		float: right;
		margin-right: 30px;
	}
	.left_box input{
		width: 150px;
		height: 50px;
		background-color: red;
		padding: 10px;
		margin: 10px;
		border-radius: 10px; 
	}
	.right_box2{
		height: 677px;
		width: 860px;
		background-color: yellow;
		margin-top: -20px;
		border-radius: 20px;
		padding: 20px;
		float: left;
		color: black;
	}
	.list{
		height: 500px;
		width: 300px;
		background-color: green;
		float: right;
		color: white;
		padding: 10px;
		overflow-x: hidden;
		overflow-y: scroll;
		border-radius: 20px;
	}
	tr:hover{
		background-color: black;
		cursor: pointer;
	}

	/* STUDENT MESSAGE CSS CODES */

	.form-control{
		height: 60px;
		width: 690px;
		border-radius: 10px;
		float: left;
	}
	.msg{
		height: 430px;
		overflow-y: scroll;
	}
	.chat{
		display: flex;
		flex-flex: row wrap;
	}
	.user .chatbox{
		height: 70px;
		width: 700px;
		padding: 30px 15px;
		background-color: red;
		border-radius: 10px;
	}
	.admin .chatbox{
		height: 70px;
		width: 700px;
		padding: 30px 15px;
		background-color: blue;
		border-radius: 10px;
		order: -1;
	}
	.btn-primary{
		background-color: #06bbd5;
	}
	.from{
		padding-left: 0px;
		margin-top: -12px;
	}
</style>

<body style="width: 1536px; height: 595px;">

	<?php
		$sql1=mysqli_query($db,"SELECT student.propic, message.username FROM student INNER JOIN message ON student.username=message.username GROUP BY username ORDER BY status;");
	?>
	<!-- ----- Left ----- -->
	<div class="left_box"> 
		<div class="left_box2">
			<div style="color: white;">
				<form method="post" enctype="multipart/form-data">
					<input type="text" name="username" id="uname">
					<button type="submit" name="submit5" class="btn btn-primary">SHOW</button>
				</form>
			</div>
			<div class="list">
				<?php
					echo "<table id='table' class='table'>";
					while($res1=mysqli_fetch_assoc($sql1))
					{
						echo "<tr>";
							echo "<td width=65>"; echo "<img class='img-circle profile_img' height=60 width=60 src='images/".$res1['propic']."'>"; echo "</td>";
							echo "<td style='padding-top: 30px;'>"; echo $res1['username']; echo "</td>";
						echo "</tr>";
					}
					echo "</table>";
				?>
			</div>
		</div>
	</div>
    <!-- ----- Right ----- -->
	<div class="right_box">
		<div class="right_box2">
			<br>
			<?php
/*------------------------------------------------------ IF SUBMIT BUTTON PRESSED -----------------------------------------------------*/
				if(isset($_POST['submit5']))
				{
					$res=mysqli_query($db,"SELECT * FROM message WHERE username='$_POST[username]' ;");

					if($_POST['username'] != '')
					{
						$_SESSION['username'] = $_POST['username'];
					}

					?>
					<div style="height: 70px; width: 100%; text-align: center; color: black;">
						<h3 style="margin-top: -5px; padding-top: 10px;">
							<?php
								echo $_SESSION['username'];
							?> 
						</h3>
					</div>
<!-----------------------------------------------------SHOW MESSAGE --------------------------------------------------------------------->

					<div class="msg">
						<br>
						<?php
							while($row=mysqli_fetch_assoc($res))
							{
								if($row['sender']=='student')
								{
						?>
						<!-- student -->
						<div class="chat user">
							<div style="float: left; padding-top: 5px;">
								&nbsp;
								<?php
									echo "<img class='img-circle profile_img' height=60 width=60 src='images/".$_SESSION['propic']."'>";
								?>
								&nbsp;
							</div>
							<div style="float: left;" class="chatbox">
								<p>
									<?php
										echo $row['massage'];
									?>
								</p>
							</div>
						</div><br>

						<?php
								}
								else
								{
						?>

						<!-- admin -->

						<div class="chat admin">
							<div style="float: left; padding-top: 5px;">
								&nbsp;
								<img style="height:60px; width:60px; border-radius: 50%;" src="images/dpfp.jpg">
								&nbsp;
							</div>
							<div style="float: left;" class="chatbox">
								<p>
									<?php
										echo $row['massage'];
									?>
								</p>
							</div>
						</div>
						<br>

						<?php
								}
							}
						?>
					</div>

					<div style="height: 100px; padding-top: 10px;">
						<form class="from" action="" method="post">
								&nbsp;&nbsp;
							<input type="text" name="mesage" class="form-control" required="" placeholder="Type Here...">
							<button type="submit" name="submit1" style="height: 60px; width: 75px; border-radius: 50px;" class="btn btn-info btn-lg">
								<span class="glyphicon glyphicon-send"></span>
							</button>
						</form>
					</div>
					<?php
				}
/*----------------------------------------------- IF SUBMIT NOT PRESSED ---------------------------------------------------------*/
				else
				{
					if($_SESSION['username'] == '')
					{
						?>
							<img style="margin: 100px 80px" src="images/4.jpg">
						<?php
					}
				}
			?>
		</div>
	</div>

	<script type="text/javascript">
		var table = document.getElementById('table'),eIndex;
		for (var i = 0; i < table.rows.length; i++) 
		{
			table.rows[i].onclick = function()
			{
				rIndex = this.rowIndex;
				document.getElementById('uname').value = this.cells[1].innerHTML;
			}
		}
	</script>
</body>