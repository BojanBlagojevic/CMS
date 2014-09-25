<?php require_once('database.php');?>
<?php 
      $navigation_id=isset($_GET['navigation_id'])?$_GET['navigation_id']:null;
      $strana=isset($_GET['strana'])?$_GET['strana']:null;
      $navigation=new Database();
      if(isset($_POST['edit_navigacija'])){
      	$strana=$_POST['navigacija'];
      	$navigation->id=$navigation_id;
      	$navigation->edit_navigation($strana);
      	header('Location: admin.php?id=3');
      }
      ?>




  <form method="post">
    <input type="text" name="navigacija" value="<?php echo $strana;?>"/>
    <input type="submit" name="edit_navigacija" value="Edit"/>
  </form>