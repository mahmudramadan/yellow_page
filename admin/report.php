<?php
require 'header.php';
require_once( '../classes/Functions.php' );
require_once( '../classes/Strategy.php' );

 
$core = new Core();
$table = 'ads';
$data = $core->get_where($table,'id');
$admin_privellage = new PrivellageClass($_SESSION['admin_privellage'],'report','open');
$check_admin_privellage = $admin_privellage->check_admin_privellage();
if (!$check_admin_privellage) {
	header('Location: index.php');

} 

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
			echo '<li><a href="index.php?page='.$key.'">'.$key.'</a></li>';
		}
		?> 
	</ul><br>

</div>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<div class="col-sm-9">
 <h1 class="text-center">Report</h1>
 <hr>
 
 <div class="col-lg-12">
  <form id="report_form" method="post" action="report_result.php" target="_blank">
   <div class="col-lg-3">
     <div class="form-group">
      <label>From Date</label>
      <input required class="form-control" type="date" name="from_date" id="from_date"/>        
    </div>
  </div>
  <div class="col-lg-3">
   <div class="form-group">
    <label>To Date</label>
    <input required class="form-control" type="date" name="to_date" id="to_date"/>        
  </div>
</div>
<div class="col-lg-3">
 <div class="form-group">
  <label>Approve status</label>
  <select required class="form-control" name="approve" id="approve"> 
    <option value="all">All</option>
    <option value="1">Approved</option>
    <option value="0">Waiting</option>
  </select>       
</div>
</div>
<div class="col-lg-3">
 <div class="form-group">
  <label>Ads  </label>
  <select required class="form-control" name="ads_id" id="ads_id"> 
    <option value="all">All</option>

    <?php
    if ($data) {
      foreach ($data as $key => $value) {
        echo "<option value='".$value['id']."'>Ad #".$value['id']."</option>";
      }
    }
    ?>
  </select>

</div>
</div>
<div id="form_error">

</div>
<div class="text-center">
 <button type="submit" id="submit">Submit</button>
</div>

</form>
</div>


</div>



<?php
require 'footer.php';

?> 

<script type="text/javascript">
  $("#report_form").submit(function(){
   var from_date = $("#from_date").val();
   var to_date = $("#to_date").val();
   if (from_date > to_date ) {
    $("#form_error").html('From date must be less than to date');

    return false;
  } 
});
</script>