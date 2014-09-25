<?php session_start();?>
<?php if(!isset($_SESSION['valid_user'])){header("Location: index.php");}?>
<?php require_once('conf.php');?>
<?php require_once('pages.php');?>



<head>
<title>Nebojsa Masic Tutorials</title>
<link rel="stylesheet" type="text/css" href="style.css"/>


</head>
<body>


<div id="admin_main"><h1 style="color:#fff;">Welcome admin!</h1>
<?php if(isset($_SESSION['valid_user'])){
echo "<p style=\"color:#fff\">You are logged in as <strong>".strtoupper($_SESSION['valid_user'])."</strong></p>";
}
?>
<div id="panel">
  <ul>
    <li><a href="admin.php?id=1">MANAGE PAGES AND COMMENTS</a></li>
    <li><a href="admin.php?id=2">MANAGE PHOTOS</a></li>
    <li><a href="admin.php?id=3">EDIT NAVIGATION</a></li>
    <li><a href="admin.php?id=4">Logout</a></li>
  </ul>
  </div>
</div> 

 

<?php 

$admin_page=isset($_GET['id'])?$_GET['id']:null;
if($admin_page==1){include('manage_pages.php');}
if($admin_page==2){include('manage_photos.php');}
if($admin_page==3){include('manage_navigation.php');}
if($admin_page==4||$admin_page==null){


	unset($_SESSION['valid_user']);
    session_destroy();
    header('Location: index.php');
} 
?> 


