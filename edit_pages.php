<?php require_once('pages.php');?>
<?php 
      $pages=new Pages();

      $pages->id=isset($_GET['page_id'])?$_GET['page_id']:null;
      if($pages->id){
      	$pages->show_sadrzaj();
      }
      if(isset($_POST['update'])){
      	$pages->id=isset($_GET['page_id'])?$_GET['page_id']:null;
      	$pages->naziv=ucfirst($_POST['naziv']);
      	$pages->sadrzaj=$_POST['sadrzaj'];
      	$pages->update_pages();
      	header('Location: admin.php?id=1');
      }




?>