<?php
require_once( 'classes/Functions.php' );
require_once( 'classes/Factory.php' );


// error_reporting(-1);
$core = new Core();
$ads = $core->get_where('ads');

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<script type="text/javascript" src="assets/js/bootstrap.js"></script>
	<title>Task</title>
</head>
<body>
	<h1 class="text-center">Ads</h1>
	<div class="row">
		<?php
		if ($ads) {
			foreach ($ads as   $value) {
				
// have the factory create the AdsBody object
				$factory = AdsBodyFactory::create($value['id'] , $value['image'] , $value['description']);
				echo '<div class="col-lg-4">';
				print($factory->getImageAndDescription()); 
				echo '</div>'; 
			}
		}
		?> 
	</div>
</body>
</html>