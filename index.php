
<?php session_start();?>
<?php ob_start();?>
<?php require_once('conf.php');?>
<?php require_once('pages.php');?>




<head>
<title>Nebojsa Masic Tutorials</title>
<link rel="stylesheet" type="text/css" href="style.css"/>
<link rel="stylesheet" href="nivo-slider/nivo-slider.css" type="text/css" />
<link rel="stylesheet" href="nivo-slider/themes/default/default.css" type="text/css" />
<script type="text/javascript" src="jquery-2.0.3.min.js"></script>
<script src="jquery.nivo.slider.pack.js" type="text/javascript"></script>
<script type="text/javascript">
$(window).load(function() {
    $('#slider').nivoSlider();
});
</script>

</head>
<body>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div id="wrapper">
<?php include('header.php');?>
  <div class="slider-wrapper theme-default">
    <div class="ribbon"></div><!--End of Ribbon-->
  <div id="slider" class="nivoSlider">
  <img src="images/picture1.jpg"/>
	<img src="images/picture2.jpg"/>
    <img src="images/picture3.jpg"/>

  
    
</div><!--End of Nivo Slider-->
</div><!--End of Slider Wrapper-->
<div id="main">
    <div id="fb-root"></div>

  <div id="pages_wrapper">
<?php 
     $naziv=isset($_GET['naziv'])?$_GET['naziv']:null;
     $page=isset($_GET['id'])?$_GET['id']:1;
     if($naziv){include('navigation_pages/pojedinacne.php');}
     else{if($page==1){require_once('navigation_pages/naslovna.php');}
          elseif($page==6){require_once('navigation_pages/galerija.php');
             }else(require_once('navigation_pages/pojedinacne.php'));
   }
     



     
     ?>
         



