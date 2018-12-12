<?php
require 'header.php';
require_once( '../classes/Functions.php' );
require_once( '../classes/Strategy.php' );
error_reporting(-1);

$core = new Core(); 
$admin_privellage = new PrivellageClass($_SESSION['admin_privellage'],'report','open');
$check_admin_privellage = $admin_privellage->check_admin_privellage();
if (!$check_admin_privellage) {
	header('Location: index.php');
} 

$from_date = strip_tags($_POST['from_date']);
$to_date = strip_tags($_POST['to_date']);
$approve = strip_tags($_POST['approve']);
$ads_id = strip_tags($_POST['ads_id']);

$data = $core->get_report_date($from_date,$to_date,$approve,$ads_id);

if (count($data) > 0 ) {
	?><table class="table table-responsive table-bordered table-hover">
		<thead style="background: #eee">
			<tr>
				<th>serial</th>
				<th>username</th>
				<th>comment</th>
				<th>ads_id</th>
				<th>approve</th>
				<th>created_at</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$i = 0 ;
			foreach ($data as $key => $value) {
				$i ++ ;
				$approved = $value['approve'] == 1 ? "Approved":"Waiting";
				echo "<tr>
				<td> ".$i."</td>	
				<td> ".$value['username']."</td>	
				<td> ".$value['comment']."</td>	
				<td> ".$value['ads_id']."</td>	
				<td> ".$approved."</td>	
				<td> ".$value['created_at']."</td>	
				<tr>
				"; 
			}
			?>
		</tbody>
	</table>

	<?php
}else{
	echo "No result found";
} 