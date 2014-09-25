<?php require_once('pages.php');?>
<?php 
     $pages=new Pages();
     $pages->id=isset($_GET['id'])?$_GET['id']:null;
     if($pages->id){
     	$pages->delete_pages();
     	header('Location: admin.php?id=1');
     }
