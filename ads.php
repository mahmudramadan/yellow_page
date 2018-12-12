<?php
require_once( 'classes/Functions.php' );
require_once( 'classes/Factory.php' ); 
error_reporting(-1);
$ads_id = $_GET['id'];
$core = new Core();
$ads = $core->get_where('ads','*',array('id'=>$ads_id));
$comments = $core->get_where('comments','*',array('ads_id'=>$ads_id,'approve'=>1),array('id'=>'desc')); 

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<script type="text/javascript" src="assets/js/bootstrap.js"></script>
	<script type="text/javascript" src="assets/js/jquery-2.1.1.min.js"></script>
	<title>Task</title>

	<!-- <div id="fb-root"></div>
	<script>(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.2&appId=758782987833348&autoLogAppEvents=1';
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));


</script>

<div class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="true" data-use-continue-as="false"></div> -->


</head>
<?php
if(isset($_COOKIE['fbUser'])) {
	?>
	<button onclick="LogOut()">Log out</button>
	<?php
}

?>
<script type="text/javascript">
	function dofbLogin() {
		FB.login(function(response) {
			if (response.authResponse) {
				console.log(response)
				console.log('Welcome!  Fetching your information.... ');
				FB.api('/me?fields=first_name,last_name,email,name', function(response) {
					setCookie('fbUser', response.first_name+ ' '+response.last_name);
				});
			}
		});
	}

	window.fbAsyncInit = function() {
		FB.init({
			appId      : '758782987833348',
			xfbml      : true,
			version    : 'v3.2'
		});

		FB.getLoginStatus(function (response) {
			if (response.status === 'connected') {
                // the user is logged in and has authenticated your
                // app, and response.authResponse supplies
                // the user's ID, a valid access token, a signed
                // request, and the time the access token 
                // and signed request each expire
                var uid = response.authResponse.userID;
                var accessToken = response.authResponse.accessToken;
            } else if (response.status === 'not_authorized') {
                // the user is logged in to Facebook, 
                // but has not authenticated your app
            } else {
                // the user isn't logged in to Facebook.
            }
        });
	};

	(function(d, s, id){
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) {return;}
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_US/sdk.js";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
</script>

<script type="text/javascript">

	function setCookie(cname,cvalue) {
		var d = new Date();
		d.setTime(d.getTime() + (30*24*60*60*10000));
		var expires = "expires=" + d.toGMTString();
		var domain = window.location.hostname;
		document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
		location.reload();

	}
	function LogOut(){
		document.cookie = "fbUser=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
		location.reload();

	}
</script>

<body>
	<h1 class="text-center">Ads</h1>
	<div class="row">
		<?php
		if ($ads) {
			foreach ($ads as   $value) {
				
// have the factory create the AdsBody object
				$factory = AdsBodyFactory::create($value['id'] , $value['image'] , $value['description']);

				echo '<div class="col-lg-12 text-center">';
				print($factory->getImageAndDescription()); 
				echo '</div>';  
			}
		}
		?> 
	</div>
	<div class="clearfix"></div>
	<hr>
	<div class="col-lg-12">
		<?php
		if ($comments) {
			echo "<h2>Comments</h2>";
			foreach ($comments as $key) {
				?>
				<div class="col-lg-12 ">
					<div class="col-lg-8 pull-left">
						<b><?=$key['username']?></b>
					</div>
					<div class="col-lg-4 pull-right">
						<?=$key['created_at']?>
					</div>
					<div class="col-lg-12">
						<?=$key['comment']?>
					</div>
				</div>
				<br>
				<hr>
				<br>
				<?php
			}
		}
		?>
	</div>
	<hr>
	<?php
	if(!isset($_COOKIE['fbUser'])) {

		?>
		<button class="alert alert-success" onclick="dofbLogin()">FB LOGIN To comment</button>

		<?php
	}else{
		?>
		<div class="col-lg-12">
			<h3>Add Comment</h3>
			<form id="comment_form">
				<div class="form-group">
					<label> Please Write Comment</label>
					<textarea cols="40" required class="form-control" id="comment"></textarea>
					
				</div>
				<div id="form_error" style="color:red"></div>	
				<div class="form-group">
					<button type="Submit" id="submit" > Submit</button>
				</div>


			</form>

		</div>
		
		<?php
	}
	?>
</body>
</html>
<script type="text/javascript">
	$("#comment_form").submit(function(){
		var ads_id = "<?=$ads_id?>";
		var comment = $("#comment").val();
		$("#submit").html('Loading..');
		$("#submit").attr('disabled');
		if (comment.length < 20 ) {
			$("#form_error").html('Comment is too short');

			$("#submit").removeAttr('disabled');
			$("#submit").html('submit');
			return false;
		}else{
			$.ajax({
				url: "ajax.php",
				type: 'post',
				dataType: 'json',
				data: {ads_id:ads_id,comment:comment,'username':'<?=$_COOKIE['fbUser']?>'},
				success: function (data) {
					$("#submit").removeAttr('disabled');
					$("#submit").html('submit');
					if (data.status=="ok") {

						$("#comment").val('');
						$("#form_error").html('comment is sent');
					}else{
						$("#form_error").html(data.msg);

					} 
				}
			});
		}

		return false;


	});
</script>