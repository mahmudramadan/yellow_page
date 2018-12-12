<?php
require 'header.php';

require_once( '../classes/Strategy.php' );
$page = 'ads.php';

require_once( '../classes/Functions.php' );
$core = new Core();
$table = 'ads';
$data = $core->get_where($table,'*');
$admin_privellage = new PrivellageClass($_SESSION['admin_privellage'],'ads','open');
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
 <h1 class="text-center">Ads</h1>
 <hr>
 <?php
 if ($check_admin_privellage->add == 1 ) {
  echo '  <a type="button" class="btn btn-info btn-lg" href="ads_edit.php">  Add New</a>
  ';	

}
?>
<hr>

<table class="table table-responsive table-bordered table-hover">
  <thead>
   <tr>
    <th>Id</th>
     <th>Image</th>
    <th>description</th>
    <th style="width: 30%">Oerations</th>
  </tr>
</thead>
<tbody>
 <?php
 foreach ($data as $key => $value) {
  ?>
  <tr id="tr_<?=$value['id']?>">
   <td><?=$value['id']?></td>
    <td><img style="width: 50px;height: 50px" src="../uploads/<?=$value['image']?>" /></td>
   <td><?=$value['description']?></td>
   <td>
    <?php 
    if ($check_admin_privellage->edit == 1 ) {
     echo '<a   class="btn btn-xs btn-warning edit-btn"  href="ads_edit.php?id='.$value['id'].'"> Edit</a> ';

   }
   if ($check_admin_privellage->delete == 1 ) {
     echo '<button class="btn btn-xs btn-danger delete-btn"  ad-id="'.$value['id'].'" ad-image="'.$value['image'].'"> DELETE</button> ';
   }

   if ($check_admin_privellage->delete == 1 ) {
     echo '<button class="btn btn-xs btn-success  view_comments"  ad-id="'.$value['id'].'"> view comments</button> ';
   }

   ?>
 </td>
</tr>
<?php
}
?>
</tbody>
</table>
</div>

<?php


require 'footer.php';

?>
<script type="text/javascript">
  $(".delete-btn").click(function () {
   var id = $(this).attr('ad-id');
   var image = $(this).attr('ad-image');
   var r = confirm("Are you sure");
   if (r == true) {
    $.ajax({
      url: "delete_ad.php",
      type: 'post',
      dataType: 'json',
      data: {id:id,image:image},
      success: function (data) {
        alert(data.msg)
        if (data.status=='ok') {
          $("#tr_"+id).remove(); 
          
        }
      }
    });
  }  


});
</script>
<link rel="stylesheet" type="text/css" href="../assets/jquery-confirm-master/css/jquery-confirm.css">
<script type="text/javascript" src="../assets/jquery-confirm-master/js/jquery-confirm.js"></script>

<script type="text/javascript">
  $(".view_comments").click(function () {
   var id = $(this).attr('ad-id');

   $.confirm({
    title: 'Title',
    content: 'url:get_add_comments.php?id='+id,
    onContentReady: function (data) {
      var self = this;
      this.setContentPrepend(data);
      this.setTitle('Ad # '+id+ ' comments');

      Approved_function();

      setTimeout(function () {
        // self.setContentAppend('<div>Appended text after 2 seconds</div>');
      }, 2000);
    },
    columnClass: 'medium',
  });  
 });

  function Approved_function() {
    $(".approve_now").click(function () {
      var btn = $(this);
     var id = btn.attr('comment_id');
     var status = btn.attr('status');
     var r = confirm("Are you sure change approve statu for emenet #"+id);
     if (r == true) {
      $.ajax({
        url: "change_comment_approval.php",
        type: 'post',
        dataType: 'json',
        data: {id:id,status:status},
        success: function (data) {
          alert(data.msg)
          if (data.status=='ok') {
            if (status==0) {
              btn.attr('status','1');
              btn.parent().find('b').css('color','green').html('approved done');
              btn.removeClass('btn-success').addClass('btn-danger').html('Back to waiting');
            }else{
              btn.attr('status','0');
              btn.removeClass('btn-danger').addClass('btn-success').html('Approve now');
              btn.parent().find('b').css('color','red').html(' Waiting to approve');

            }
          }
        }
      });
    } 

  });
  }
</script>