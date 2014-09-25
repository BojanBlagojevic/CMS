<?php require_once('photos.php');
      $photos=new Photos();
      $photos->id=isset($_GET['id'])?$_GET['id']:null;
      if($photos->id){
      	$photos->delete_photos();
      	header('Location: admin.php?id=2');

      }