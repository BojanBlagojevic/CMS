<?php require_once('photos.php');?>
<?php

$photos=new Photos();?>
<div id="show_photos"><?php
$photos->id=isset($_GET['photo_id'])?$_GET['photo_id']:null;
if($photos->id){include('navigation_pages/slike_pojedinacno.php');
            }else{

               $photos->show_fotographs();
           }

?>
</div>

	


