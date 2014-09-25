<?php require_once('pages.php');?>
<?php 
      $pages=new Pages();?>
      
    <div id="create_page">
    <?php 
     if(isset($_POST['update_create'])){
      $check_page=$_POST['naziv_create'];
      if($pages->check_if_page_exists($check_page)==false){
        echo "<p style=\"color:#fff\">Page<b><i> ".$check_page."</i></b> already exists!</p>";
      }
      else{
      $pages->naziv=ucfirst($check_page);
      $pages->sadrzaj=addslashes($_POST['sadrzaj_create']);
      $pages->datum=strftime("%Y-%m-%d %H:%M:%S",time());
      $pages->strana=$_POST['navigacija'];
      $pages->find_navigation_id();
      $pages->create_new_page();
      header('Location: admin.php?id=1');
     }
   }


?>
    <h1>Create new page</h1>
      <form method="post">
      <table>
      <tr>
      <td>Naziv strane:</td>
      <td><input type="text" value="" name="naziv_create"><td>
      </tr>
      <tr>
      <td>Odaberite kategoriju:</td>
      <td><select name="navigacija" value=""><?php $pages->find_navigation_page();?></select></td>
      </tr>
      <tr>
      <td>Unesite text:</td>
      <td><textarea rows="20" cols="60" name="sadrzaj_create"></textarea></td>
      </tr>
      <tr>
      <td></td>
      <td><input type="submit" value="Update" name="update_create"/></td></tr></table></form></div>




