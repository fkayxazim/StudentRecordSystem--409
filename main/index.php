<!DOCTYPE html>
<html>

<head>
	<title>
		WELCOME
	</title>
	<link href="css/bootstrap.css" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="css/DT_bootstrap.css">

	<link rel="stylesheet" href="css/font-awesome.min.css">
	<style type="text/css">
		.sidebar-nav {
			padding: 9px 0;
		}
	</style>
	<link href="css/bootstrap-responsive.css" rel="stylesheet">
	<link href="../style.css" media="screen" rel="stylesheet" type="text/css" />
	<link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
	<script src="lib/jquery.js" type="text/javascript"></script>
	<script src="src/facebox.js" type="text/javascript"></script>
	<script type="text/javascript">
		jQuery(document).ready(function ($) {
			$('a[rel*=facebox]').facebox({
				loadingImage: 'src/loading.gif',
				closeImage: 'src/closelabel.png'
			})
		})
	</script>

	<?php
	require_once('auth.php');
	function createRandomPassword()
	{
		$chars = "003232303232023232023456789";
		$pass = '';
		for ($i = 0; $i <= 7; $i++) {
			$pass .= $chars[rand(0, strlen($chars) - 1)];
		}
		return $pass;
	}
	$finalcode = 'RS-' . createRandomPassword();
	?>

<script language="javascript" type="text/javascript">
  /* Visit http://www.yaldex.com/ for full source code
  and get more free JavaScript, CSS and DHTML scripts! */
  <!-- Begin
  var timerID = null;
  var timerRunning = false;
  function stopclock (){
  if(timerRunning)
  clearTimeout(timerID);
  timerRunning = false;
  }
  function showtime () {
  var now = new Date();
  var hours = now.getHours();
  var minutes = now.getMinutes();
  var seconds = now.getSeconds()
  var timeValue = "" + ((hours >12) ? hours -12 :hours)
  if (timeValue == "0") timeValue = 12;
  timeValue += ((minutes < 10) ? ":0" : ":") + minutes
  timeValue += ((seconds < 10) ? ":0" : ":") + seconds
  timeValue += (hours >= 12) ? " P.M." : " A.M."
  document.clock.face.value = timeValue;
  timerID = setTimeout("showtime()",1000);
  timerRunning = true;
  }
  function startclock() {
  stopclock();
  showtime();
  }
  window.onload=startclock;
  // End -->
</script>
</head>

<body>
	<?php
	include('navfixed.php');
	$position = $_SESSION['SESS_LAST_NAME'] ?? 'guest';

	if ($position === 'cashier') {
		echo '<a href="../index.php">Logout</a>';
	} elseif ($position === 'admin') {
		?>
		<div class="container-fluid">
			<div class="row-fluid">
				<div class="span2">
					<div class="well sidebar-nav">
						<ul class="nav nav-list">
							<li class="active"><a href="index.php"><i class="icon-dashboard icon-2x"></i> Dashboard </a>
							</li>
							<li><a href="addstudent.php"><i class="icon-user icon-2x"></i>Add Student</a></li>
							<li>
								<div class="hero-unit-clock">
									<form name="clock">
										<font color="white">Time: <br></font>
										<input style="width:150px;" type="submit" class="trans" name="face" value="">
									</form>
								</div>
							</li>
						</ul>
					</div><!--/.well -->
				</div><!--/span-->
				<div class="span10">
					<div class="contentheader">
						<i class="icon-dashboard"></i> Dashboard
					</div>
					<ul class="breadcrumb">
						<li class="active">
							<font style="font:bold 44px 'Aleo'; color:#722290;">
								<center>Student Record Management System</center>
							</font>
						</li>
						<br>
						<span>
							<input type="text" style="height:35px; color:#222;" name="filter" value="" id="filter"
								placeholder="Search Students..." autocomplete="off" />
							<br>
							<div id="mainmain" style="margin-top: -19px; margin-bottom: 21px;">
								<?php
								include('../connect.php');
								$result = $db->prepare("SELECT * FROM student ORDER BY id DESC");
								$result->execute();
								$rowcount = $result->rowcount();
								?>
								<div style="text-align:center;">
									Total Number of Students: <font color="green" style="font:bold 22px 'Aleo';">[
										<?php echo $rowcount; ?>]
									</font>
								</div>
						</span>

					</ul>


				</div>

				<a href="addstudent.php"><Button type="submit" class="btn btn-info"
						style="float:right; width:230px; height:35px;" /><i class="icon-plus-sign icon-large"></i> Add
					Student</button></a>
				<br>
				<br>
				<table class="hoverTable" id="resultTable" data-responsive="table" style="text-align: left;">
					<thead>
						<tr>
							<th width="15%"> Student ID</th>
							<th width="20%"> Full Name </th>
							<th width="10%"> Gender </th>
							<th width="10%"> Admittion Year </th>
							<th width="10%"> Parent Phone </th>
							<th width="15%"> Action </th>
						</tr>
					</thead>
					<tbody>
						<?php
						include('../connect.php');
						$result = $db->prepare("SELECT * FROM student ORDER BY id DESC");
						$result->execute();
						for ($i = 0; $row = $result->fetch(); $i++) {
							?>
							<td>
								<?php echo $row['student_id']; ?>
							</td>
							<td>
								<?php echo $row['name']; ?>
								<?php echo $row['last_name']; ?>
							</td>
							<td>
								<?php echo $row['gender']; ?>
							</td>
							<td>
								<?php echo $row['yoa']; ?>
							</td>
							<td>
								<?php echo $row['parent']; ?>
							</td>
							<td><a title="Click to view the Student" href="viewstudent.php?id=<?php echo $row['id']; ?>"><button
										class="btn btn-success btn-mini"><i class="icon-search"></i> View</button> </a>
								<a title="Click to edit the Student" href="editstudent.php?id=<?php echo $row['id']; ?>"><button
										class="btn btn-warning btn-mini"><i class="icon-edit"></i> Edit</button> </a>
								<a href="#" id="<?php echo $row['id']; ?>" class="delbutton" title="Click To Delete"><button
										class="btn btn-danger btn-mini"><i class="icon-trash"></i> Delete</button></a>
							</td>
							</tr>
							<?php
						}
						?>
					</tbody>
				</table>
				<div class="clearfix"></div>
			</div>
		</div>
		</div>

		<script src="js/jquery.js"></script>
		<script type="text/javascript">
				$(function () {
					$(".delbutton").click(function () {
						//Save the link in a variable called element
						var element = $(this);
						//Find the id of the link that was clicked
						var del_id = element.attr("id");
						//Built a url to send
						var info = 'id=' + del_id;
						if (confirm("Sure you want to delete this Student? There is NO undo!")) {
							$.ajax({
								type: "GET",
								url: "deletestudent.php",
								data: info,
								success: function () {
								}
							});
							$(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
								.animate({ opacity: "hide" }, "slow");

						}

						return false;

					});

				});
		</script>
		</div>


		<div class="clearfix"></div>
		</div>
		</div>
		</div>
		<?php
	}
	?>
</body>

<?php include('footer.php'); ?>

</html>