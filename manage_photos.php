<?php require_once('photos.php');?>
<div id="photo_upload">
<?php
      if(isset($_POST['upload'])){
      	$photo=new Photos();
      	$photo->file=(isset($_FILES['file_upload']))?$_FILES['file_upload']:null;
        $check_name=$photo->file['name'];
        if($photo->file['error']!=0){
          $photo->upload_errors_reporting();
        }
        elseif($photo->file['type']!="image/jpeg"&&$photo->file['type']!="image/png"&&$photo->file['type']!="image/gif"){
          echo "This is not image file!";
        }

        elseif($photo->check_if_photo_exists($check_name)){
          echo "Image already exists!";
        }
        else{
      	      $photo->name=$photo->file['name'];
      	      $photo->tmp_path=$photo->file['tmp_name'];
      	      $photo->size=$photo->file['size'];
      	      $photo->type=$photo->file['type'];
      	
      	      $photo->upload_photo();
      	      $photo->move_file();
          }
      }
   ?>           




 <h1>Upload Photo</h1>
 <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="MAX_FILE_SIZE" value="5485760">
        <input type="file" name="file_upload"/><br/>
        <input type="submit" name="upload" value="Upload">

        </form>
</div>
<div id="list_photos">
<h1>Photos list</h1>
 
<?php $photos=new Photos();?>
      
<table border="1">
             <tr>
             <th>Image</th>
             <th>Name</th>
             <th>Size</th>
             <th></th>
             </tr>
<?php   $pages=new Pages();
        $current_page_photos=isset($_GET['current_page_photos'])?$_GET['current_page_photos']:1;
        $per_page=10;
        $total_count=$photos->count_all_photos();
        $total_pages=ceil($total_count/$per_page);
        $offset=($current_page_photos-1)*$per_page;
        $previous_page=$current_page_photos-1;
        $next_page=$current_page_photos+1;
        $photos->list_photos($per_page,$offset);
       if($total_pages>1){
        if($pages->has_previous_page()){
                echo "<b><a href=\"admin.php?id=2&current_page_photos=";
                echo $previous_page;
                echo "\">".$previous_page."</a></b>";
        }
        for($i=1;$i<=$total_pages;$i++){
           if($i==$current_page_photos){
                  echo "<span class=\"selected\">{$i}</span>";
              }
              else{
                echo "<a href=\"admin.php?id=2&current_page_photos={$i}\">".$i."</a>";
              }
        }
        if($pages->has_next_page()){
                echo "<a href=\"admin.php?id=2&current_page_photos=";
                echo $next_page;
                echo "\">".$next_page."</a>";
        }
       }
        

        ?>
</table>
