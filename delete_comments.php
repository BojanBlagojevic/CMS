<?php require_once('comments.php');?>
<?php 
      $comment=new Comments();
      $comment->id=$_GET['comment_id'];
      $page_id=$_GET['page_id'];

      if($comment->id){
      	$comment->delete_comments();
      	header('Location: http://localhost/tutorials/admin.php?id=1&page_id='.$page_id.'&comments=1');
      }