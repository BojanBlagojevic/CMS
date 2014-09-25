<?php require_once('pages.php');?>
<?php require_once('comments.php');?>

<?php $pages=new Pages();
      if($naziv){
      	$pages->show_page($naziv);
      	          }
     // if($naziv&&$page){
          //  $pages->find_strana($page);
            //$pages->list_pages_by_nav($page);
         
      
      
       else{
       	     $pages->find_strana($page);
             $pages->show_page_by_nav($page);?>
             <div id="" style="float:left;">
             <p style="color:#fff;font-size:150%;"><b><?php echo $pages->strana;?> Tutorials</p><?php
             $pages->list_pages_by_nav($page);?>
             </div><?php


       }
       if($naziv){
       
       $comments=new Comments();
       $comments->pages_id=$comments->find_page_id($naziv);
       $comments->ime=isset($_POST['ime'])?$_POST['ime']:null;
       $comments->email=isset($_POST['email'])?$_POST['email']:null;
       $comments->comment=isset($_POST['comment'])?$_POST['comment']:null;?>
       
        
      <p style="color:#fff;">Ostavite komentar:</p><?php

          if(isset($_POST['posalji'])){

          if(empty($comments->ime)||empty($comments->email)||empty($comments->comment)){
             echo "<a id=\"komentar\"><p style=\"color:red;font-size:120%;\">All fields are required!</p>";
                    }
          elseif(!preg_match("/^[a-zA-Z ]*$/",$comments->ime)){
             echo "<a id=\"komentar\"><p style=\"color:red;font-size:120%;\">Please enter your name!</p>";
                    }
          elseif(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$comments->email)){
            echo "<a id=\"komentar\"><p style=\"color:red;font-size:120%;\">Email address is not valid!<p>";
                    }
          else{
                 $comments->insert_values_into_db();
                 if($naziv){
                 header('Location: index.php?naziv='.$naziv);
             }
                  if($page&&$naziv){
                  header('Location: index.php?id='.$page.'&naziv='.$naziv.'#komentar');

                  
             }
           }
        }?>
          <form method="post" action="">
          <table>
          <tr><td><p style="color:#fff;">Vase ime:</p></td>
              <td><input type="text" name="ime" style="width:200px"/></td>
          </tr>
          <tr><td><p style="color:#fff;">Email:</p></td>
              <td><input type="text" name="email" style="width:200px"></td>
          </tr>
          <tr><td><p style="color:#fff;">Komentar:</p></td>
              <td><textarea name="comment" rows="4" style="width:200px"></textarea></td>
          </tr>
          <tr><td></td>
              <td><input type="submit" name="posalji" id="posalji" value="Posalji komentar"/></td>
          </tr>
          </table>
          </form>
         
            <a id="komentar"><p style="color:#fff;font-size:150%;">Komentari:</p></a>
<?php
       
       $comments->show_comments();
       
      }

?>
  
