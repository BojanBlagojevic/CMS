<?php require_once('pages.php');?>
<?php $pages=new Pages();?>
 <div id="list_pages_for_admin">
 <h1>Pages List</h1>
 <table border="1">
   <th>Naziv</th>
   <th>Created</th>
   <th>Comments</th>
   <th></th>
 <?php 
        $current_page=isset($_GET['current_page'])?$_GET['current_page']:1;
        $per_page=10;
        $total_count=$pages->count_all_pages();
        $total_pages=ceil($total_count/$per_page);
        $offset=($current_page-1)*$per_page;
        $previous_page=$current_page-1;
        $next_page=$current_page+1;
        $pages->list_pages_for_admin($per_page,$offset);

?>
</table>

<?php if($total_pages>1){
        if($pages->has_previous_page()){
        	      echo "<a href=\"admin.php?id=1&current_page=";
        	      echo $previous_page;
        	      echo "\">".$previous_page."</a>";
        }
        for($i=1;$i<=$total_pages;$i++){
        	 if($i==$current_page){
                  echo "<span class=\"selected\">{$i}</span>";
              }
              else{
              	echo "<a href=\"admin.php?id=1&current_page={$i}\">".$i."</a>";
              }
        }
        if($pages->has_next_page()){
        	      echo "<a href=\"admin.php?id=1&current_page=";
        	      echo $next_page;
        	      echo "\">".$next_page."</a>";
        }
       }
?>
<br/>
<a href="admin.php?id=1&create_page=true">Create new page</a>
</div><?php
$naziv=isset($_GET['naziv'])?$_GET['naziv']:null;
$page_id=isset($_GET['page_id'])?$_GET['page_id']:null;
$comments=isset($_GET['comments'])?$_GET['comments']:null;

if($naziv){include('edit_pages.php');}
if($comments){include('comments_admin.php');}
$create_page=isset($_GET['create_page'])?$_GET['create_page']:null;
if($create_page==true){include('create_page.php');}?>
