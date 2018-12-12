<?php
if(!isset($_SESSION['admin_ID']))
{
	echo "<script>window.location='login.php';</script>";
}

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	// error_reporting(-1);
	

	require_once( '../classes/Strategy.php' );
	session_start();
	$admin_privellage = new PrivellageClass($_SESSION['admin_privellage'],'ads','approve');
	$check_admin_privellage = $admin_privellage->check_admin_privellage();

	require_once( '../classes/Functions.php' ); 
	$cond['ads_id'] = strip_tags($_GET['id']); 



// error_reporting(-1);
	$core = new Core();
	$comments = $core->get_where('comments','*',$cond,array('id'=>'desc')); 
	if ($comments) {
		?>
		<table class="table table-responsive table-bordered table-hover">
			<thead>
				<tr>
					<th>serial</th>
					<th>User</th>
					<th>Comment</th>
					<th>date</th>
					<?php
					if ($check_admin_privellage) {
						echo "<th>status</th>";
					}
					?>
					
				</tr>
			</thead>
			<tbody>
				<?php
				$i = 0 ;
				foreach ($comments as $key => $value) {
					$i++;
					?>
					<tr>
						<td><?=$i?></td>
						<td><?=$value['username']?></td>
						<td><?=$value['comment']?></td>
						<td><?=$value['created_at']?></td>
						<?php
						if ($check_admin_privellage) {
							?>
							<td>
								<?=$value['approve']==1?"<b style='color:green'>approved done</b><br><button class='btn btn-xs btn-danger  approve_now' comment_id='".$value['id']."'  status='".$value['approve']."'> Back to waiting</button>":"<b style='color:red'>Waiting to approve </b><br><button class='btn btn-xs btn-success  approve_now' comment_id='".$value['id']."' status='".$value['approve']."'> Approve now</button>"?>
							</td>
							<?php
						}
						?>
					</tr>
					<?php
				}
				?>
			</tbody>
		</table>
		<?php
	}

}else{
	die();
}