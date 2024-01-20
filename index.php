<?php
//Start session
session_start();
//Unset the variables stored in session
unset($_SESSION['SESS_MEMBER_ID']);
unset($_SESSION['SESS_FIRST_NAME']);
unset($_SESSION['SESS_LAST_NAME']);
?>
<html>

<head>
	<title>
		Students Records Management System
	</title>
	<link rel="shortcut icon" href="main/images/pos.jpg">
	<link href="main/css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="main/css/DT_bootstrap.css">
	<link rel="stylesheet" href="main/css/font-awesome.min.css">
	<style type="text/css">
		body {
			background-color=#D6ACE6;
			padding-top: 60px;
			padding-bottom: 40px;
		}

		.sidebar-nav {
			padding: 9px 0;
		}
	</style>
	<link href="main/css/bootstrap-responsive.css" rel="stylesheet">
	<link href="main/css/style.css" media="screen" rel="stylesheet" type="text/css" />
</head>

<body>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span4">
			</div>
		</div>
		<div id="login"
			style="max-width: 400px; margin: 0 auto; padding: 20px; background-color: #fff; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
			<?php
			if (isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) > 0) {
				foreach ($_SESSION['ERRMSG_ARR'] as $msg) {
					echo '<div style="color: red; text-align: center;">', $msg, '</div><br>';
				}
				unset($_SESSION['ERRMSG_ARR']);
			}
			?>
			<form action="login.php" method="post">
				<h1
					style="font-size: 28px; text-align: center; margin-bottom: 20px; font-family: 'Aleo', sans-serif; color: #333;">
					WELCOME TO THE 409 SRMS </h1>
				<p>
				<h4>Login Below</h4>
				</p>
				<div style="margin-bottom: 20px;">
					<label for="username"
						style="display: block; font-size: 16px; font-weight: bold; color: #333;">Username</label>
					<input type="text" id="username" name="username"
						style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;"
						placeholder="Username" required>
				</div>
				<div style="margin-bottom: 20px;">
					<label for="password"
						style="display: block; font-size: 16px; font-weight: bold; color: #333;">Password</label>
					<input type="password" id="password" name="password"
						style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;"
						placeholder="Password" required>
				</div>
				<div class="center-text">
					<button class="btn btn-large btn-primary btn-block pull-right" href="dashboard.html"
						type="submit"><i class="icon-signin icon-large"></i> Login</button>
				</div>
			</form>
		</div>
	</div>

</body>

</html>