
<?php require_once('database.php');?>

<div id="header">
	
	  <img src="img/php.png"/>
	  <img src="img/mysql.png"/>
	  <img src="img/html.png"/>
	  <img src="img/css.png"/>
</div>
  <div id="navigation">
 
<?php
  $database=new Database();
  $database->navigation();
  ?>





   </div>
   