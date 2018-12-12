<?php
require 'header.php';

require_once( '../classes/Strategy.php' );
$all_admin_privellage = new PrivellageClass($_SESSION['admin_privellage']);
$all_admin_privellage = $all_admin_privellage->getPrivellage();
// echo "<pre>";
// 	print_r($all_admin_privellage);

?>
<div class="col-sm-3 sidenav">
	<h4><?=$_SESSION['admin_username']?> <br><a class="pull-right" href="logout.php">Logout</a> </h4>
	<ul class="nav nav-pills nav-stacked">

		<?php
		foreach ($all_admin_privellage as $key => $value) {
			echo '<li><a href="'.$key.'.php">'.$key.'</a></li>';
		}
		?> 
	</ul><br>

</div>
<div class="col-sm-9">
	<h1 class="text-center">Welcome to dashboard</h1>
	<hr>
</div>
<?php


 require 'footer.php';

?>