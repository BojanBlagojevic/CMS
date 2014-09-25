<div id="admin_comments">
<h1>Comments for page: <i style="color:#DAA520"><br/><?php echo ucfirst($pages->naziv);?></i></h1>
<table border="1" style="width:300 px;">
  <tr>
    <th>Ime</th>
    <th>E-mail</th>
    <th>Comment</th>
    <th></th>
  </tr><?php
  $comments=new Comments();
  $comments->pages_id=$page_id;
  if($comments->count_comments_by_pages()==0){
  	echo "No comments!";
  }
  else{
  $comments->show_comments_for_admin();
  }?>
 </table>
 </div>