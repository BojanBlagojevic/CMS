<? require_once('database.php');?>
  
  <div id="navigation_list">
  <h1>Navigation list</h1>
  <table border="1">
   <tr>
    <th>ID</th>
    <th>Name</th>
    <th></th>
    <th></th>
   </tr>
    <?php
   $navigation=new Database();
   $navigation->list_navigation();?>
   
   </table>
   <?php $navigation_id=isset($_GET['navigation_id'])?$_GET['navigation_id']:null;
        if($navigation_id){include('edit_navigation.php');}?>





  </div>


