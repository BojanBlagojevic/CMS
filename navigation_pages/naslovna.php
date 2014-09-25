
<?php 
      $pages=new Pages();
      $current_page=isset($_GET['current_page'])?$_GET['current_page']:1;
      $per_page=2;
      $offset=($current_page-1)*$per_page;
      
     
      $pages->list_pages($per_page=2,$offset);
      $total_count=$pages->count_all_pages();
      $total_pages=ceil($total_count/$per_page);
      $next_page=$current_page+1;
      $previous_page=$current_page-1;
      if($total_pages>1){
        if($pages->has_previous_page($previous_page)){ echo "<a style=\"color:#fff;\" href=\"index.php?current_page=";
                               echo $previous_page;
                               echo "\">&laquo; Back</a>";}
        for($i=1;$i<=$total_pages;$i++){
           if($i==$current_page){
            echo "<span class=\"selected\">{$i}</span>";
           }else{
              echo "<a style=\"color:#fff;\" href=\"index.php?current_page={$i}\">{$i}</a> ";
           }
        }

        if($pages->has_next_page($next_page,$total_pages)){  echo "<a href=\"index.php?current_page=";
                               echo $next_page;
                               echo "\" style=\"color:#fff;\">";
                               echo "Next &raquo;</a>";}

        }

      ?>
   </div><!--End of pages_wrapper-->
<div id="sidebar">
 <div id="login">
   <h3>Admin login:</h3>
   <form action="" method="post">
   <table>
     <tr>
       <td><p>Username:</p></td>
       <td><input type="text" name="username" /></td>
    </tr>
    <tr>
       <td><p>Password:</p></td>
       <td><input type="password" name="password"/></td>
    </tr>
    <tr>
        <td></td>
        <td><input type="submit" name="submit" value="Submit"/></td>
    </tr>
  </table>
  </form>

 <?php  
// Login code
 if(isset($_POST['submit'])){

  $username=mysql_real_escape_string($_POST['username']);
  $password=mysql_real_escape_string($_POST['password']);


    $connect=mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);

    $sql="SELECT * FROM users ";
    $sql.="WHERE username='$username' ";
    $sql.="AND password='$password' ";
    $result=mysqli_query($connect,$sql);
    $row=mysqli_num_rows($result);
   

  //$dbusername=$row['username'];
  //$dbpassword=$row['password'];

   if($row==1){
  
   $_SESSION['valid_user']=$username;

     if(isset($_SESSION['valid_user'])){

      header("Location: admin.php?id=0");
      mysqli_close($connect);

     }
    }
    if($username&&$password){

      echo "Incorrect Username/Password combination!";
  }
  
  
  }else{
    $username="";
    $password="";
  }
 // unset($_SESSION['valid_user']);
  //session_destroy();
// Login code end*/
?>
  </div><!--End of login-->
 <div class="fb-like-box" data-href="https://www.facebook.com/Webd2d" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true" style="background-color:black ;opacity:0.9;"></div>
 </div><!--End of sidebar-->
</div><!--End of main-->

  </div><!--End of wrapper-->
