<?php
session_start();
if(isset($_SESSION['admin_ID']))
{
	echo "<script>window.location='index.php';</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin</title> 

</body>
</html>
<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
<script type="text/javascript" src="../assets/js/bootstrap.js"></script>
<script type="text/javascript" src="../assets/js/jquery-2.1.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
</head>
<body id="LoginForm">
	<div class="container">
		<h1 class="form-heading">login Form</h1>
		<div class="login-form">
			<div class="main-div">
				<div class="panel">
					<p>Please enter your username and password</p>
				</div>
				<form id="Login">

					<div class="form-group">
						<input type="text" required class="form-control" id="username" placeholder="username">
					</div>

					<div class="form-group">
						<input type="password" required class="form-control" id="password" placeholder="Password">
					</div>
					<div id="form_error"></div>
					<br>
					<button type="submit"  id="submit" class="btn btn-primary">Login</button>

				</form>
			</div>
		</div></div></div>


	</body>
	</html>


	<script type="text/javascript">
		$("#Login").submit(function(){
			var username = $("#username").val();
			var password = $("#password").val();
			$("#submit").html('Loading..');
			$("#submit").attr('disabled');

			$.ajax({
				url: "login_ajax.php",
				type: 'post',
				dataType: 'json',
				data: {username:username,password:password},
				success: function (data) {
					$("#submit").removeAttr('disabled');
					$("#submit").html('submit');
					$("#form_error").html(data.msg);
					if (data.status=="ok") {
						setTimeout(function(){ window.location='index.php'; }, 2000);
					}  
				}
			});


			return false;


		});
	</script>