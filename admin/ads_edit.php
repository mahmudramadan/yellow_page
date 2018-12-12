<?php
error_reporting(0);
require 'header.php';

require_once( '../classes/Strategy.php' );
$page = 'ads.php';

require_once( '../classes/Functions.php' );
$core = new Core();
$table = 'ads';
$error = '';

if (isset($_POST) && count($_POST) > 0 ) {
 $table_id = $_POST['table_id'];
 $description = strip_tags($_POST['description']); 

if (empty($_FILES["image"]["tmp_name"] ) && $table_id == 0) {
   
  $error =  "please upload  your file.";
}else{
  
 $target_dir = "../uploads/";
 $target_file = $target_dir . basename($_FILES["image"]["name"]);
 $uploadOk = 1;
 $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
 $check = getimagesize($_FILES["image"]["tmp_name"]);

 if($check === false) {
  $error =  "File is not an image.";
}else if ($_FILES["image"]["size"] > 50000000) {
  $error =  "Sorry, your file is too large.";

}elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
  $error =  "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
}else if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
  $array_data['image']=basename( $_FILES["image"]["name"]);
  $array_data['description'] = strip_tags($_POST['description']);
  $table_id = $_POST['table_id'];
  if ($table_id > 0 ) {
    $ads_add_or_edit = $core->update_where_id('ads',$array_data,$table_id);  
  }else{
    $ads_add_or_edit = $core->insert_New('ads',$array_data); 
  }
  if ($ads_add_or_edit) {
    header('Location: ads.php');
  }
}else{
  $error =  "Sorry, there was an error uploading your file.";

}
}



}


$table_id=0;
$data=array();
if (isset($_GET['id'])) {
 $data = $core->get_where($table,'*',array('id'=>$_GET['id']));
 $table_id=$data[0]['id'];
}

$admin_privellage = new PrivellageClass($_SESSION['admin_privellage'],'ads','add');
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

<div class="col-sm-9">
 <h1 class="text-center">Ads</h1>
 <hr>
 <div class="col-lg-12">
  <?=$error?>
</div>
<div class="col-lg-12">

  <form action="" enctype="multipart/form-data" method="POST" id="adsForm">
    <div class="col-md-12">
      <input type="hidden" name="table_id" class="form-control" value="<?=$table_id?>">

      <div class="form-group">
        <label for=""> Image jpeg,jpg,png</label>
        <input type="file" name="image" class="form-control"  required="required">
      </div>
      <?php
      if (count($data)>0) {
        ?>
        <div class="form-group">
          <label for=""> Current Image</label>
          <img src="../uploads/<?=$data[0]['image']?>" style="width: 100px;height: 100px">
        </div>
        
        <?php
      }
      ?>
    </div>
    <div class="col-md-12">

      <div class="form-group">
        <label for="">description</label>
        <textarea name="description" class="form-control" rows="3" style="height: 150px;resize: none;" ><?php
        if (count($data)>0) {
          echo $data[0]['description'];
        }
        ?> </textarea>
      </div>
    </div>
    <div class="col-md-12" id="form_error">
    </div>
    <div class="col-md-12">

      <div class="form-group" id="contactResult">
        <button type="submit" class="btn btn-submit" id="send_data" style="width: 20%;">save</button>
      </div>
    </div>
  </form>
</div>


</div>

<?php


require 'footer.php';

?>




</script>