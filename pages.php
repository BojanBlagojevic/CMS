<?php ob_start();
require_once('database.php');
require_once('comments.php');


class Pages Extends Database {
   public $id;
   public $naziv;
   public $sadrzaj;
   public $navigacija_id;
   public $datum;
   public $strana;
  
  


   public function list_pages($per_page="",$offset=""){
   	
  
    $sql="SELECT * FROM pages ";
    $sql.="ORDER BY id DESC ";
    $sql.="LIMIT {$per_page} ";
    $sql.="OFFSET {$offset} ";

    $this->query($sql);
    while($row=mysqli_fetch_array($this->result)){
      $this->navigacija_id=$row['navigacija_id'];
      $this->naziv=$row['naziv'];
      $this->sadrzaj=$row['sadrzaj'];?>
      <div class="pages"><ul><li><h2><a href="index.php?id=<?php echo $this->navigacija_id;?>&naziv=<?php echo $this->naziv;?>"><?php echo $this->naziv;?></a></h2></li>
        <li><?php echo $this->sadrzaj;?></li></ul></div><?php  

    }

   }
   public function show_page($naziv="",$id=""){

    $sql="SELECT * FROM pages WHERE naziv='$naziv' ";
    $this->query($sql);
    while($row=mysqli_fetch_array($this->result)){?>
    <a href="index.php?id=<?php echo $id=$_GET['id'];?>" style="color:#fff;">&laquo Back</a>
    <div class="page">
      <?php $this->naziv=$row['naziv'];
            $this->sadrzaj=$row['sadrzaj'];
            echo "<h1>".$this->naziv."</h1><br/>";
            echo "<p>".$this->sadrzaj;?>
           
     </div><?php     
           
    
  }
}

    public function find_strana($page=""){

      $sql="SELECT strana FROM navigacija ";
      $sql.="WHERE id='$page' ";
      $this->query($sql);
      while($row=mysqli_fetch_array($this->result)){
        $this->strana=$row['strana'];
        
        
      }
    }
    public function list_pages_by_nav($page=""){

    $sql="SELECT * FROM pages ";
    $sql.="JOIN navigacija ON navigacija.id=pages.navigacija_id ";
    $sql.="WHERE navigacija.strana='$this->strana' "; 

    $this->query($sql);
    while($row=mysqli_fetch_array($this->result)){
      $this->id=$row['navigacija_id'];
      $this->naziv=$row['naziv'];
      $this->datum=$row['datum'];?>
      <ul style="margin:0px;padding:0px;list-style-type:square;color:#fff;">
      <li style="width:280px;"><a style="text-decoration:none;font-size:150%;color:#fff" href="index.php?id=<?php echo $this->id;?>&naziv=<?php 
                                      echo $this->naziv;?>" style="color:#fff;font-size:150%;"><b><?php 
                                      echo $this->naziv."<b/></a><i style=\"color:#700000\"> (".$this->datum.")</i>";?></li></ul><?php
    }
   }
   public function show_page_by_nav($page=""){

    $sql="SELECT * FROM pages ";
    $sql.="JOIN navigacija ON navigacija.id=pages.navigacija_id ";
    $sql.="WHERE navigacija.strana='$this->strana' ";
    $sql.="ORDER BY pages.id ASC ";
    $sql.="LIMIT 1";

    $this->query($sql);
    while($row=mysqli_fetch_array($this->result)){?>
    
    <div class="page_by_nav"><?php 
           $this->naziv=$row['naziv'];
           $this->sadrzaj=$row['sadrzaj'];
           echo "<h1>".$this->naziv."</h1><br/>";
           echo $this->sadrzaj;?>
    </div><?php
   }

 }
 public function check_if_page_exists($check_page=""){
  $sql="SELECT * FROM pages ";
  $sql.="WHERE naziv='{$check_page}' ";
  $this->query($sql);
  $row=mysqli_fetch_array($this->result);
  $this->name=$row['naziv'];
  if(!empty($this->name)){
    return false;
  }
  else{
    return true;
  }
 }
 public function count_all_pages(){

  $sql="SELECT COUNT(*) FROM pages";
  $this->query($sql);
  while($row=mysqli_fetch_array($this->result)){
   return $row[0];
  }
 }
 public function has_previous_page($previous_page=""){
   
   return $previous_page>=1?true:false;
  }
  public function has_next_page($next_page="",$total_pages=""){
    return $next_page<$total_pages?true:false;
  }
  public function list_pages_for_admin($per_page="",$offset=""){

    $sql="SELECT * FROM pages ";
    $sql.="ORDER BY id DESC ";
    $sql.="LIMIT {$per_page} ";
    $sql.="OFFSET {$offset} ";

    $this->query($sql);
    while($row=mysqli_fetch_array($this->result)){
      $this->id=$row['id'];
      $this->naziv=$row['naziv'];
      $this->datum=$row['datum'];
      ?>
      <tr>
      <td><?php echo $this->naziv;?></td>
      <td><?php echo $this->datum;?></td>
      <td><a href="admin.php?id=1&page_id=<?php echo $this->id;?>&comments=1"><?php $comments=new Comments();
                           $comments->pages_id=$this->id;
                           echo $comments->count_comments_by_pages();?>
      <td><a href="delete_pages.php?id=<?php echo $this->id;?>">Delete</a></td>
      <td><a href="admin.php?id=1&page_id=<?php echo $this->id;?>&naziv=<?php echo $this->naziv;?>">Edit</a></td>

      </tr><?php
    }
  }
    public function delete_pages(){
      $sql="DELETE FROM pages WHERE id=".$this->id;
      $this->query($sql);

    

  }
  public function show_sadrzaj(){
    $sql="SELECT * FROM pages ";
    $sql.="WHERE id=".$this->id;

    $this->query($sql);
    while($row=mysqli_fetch_array($this->result)){
      $this->id=$row['id'];
      $this->naziv=$row['naziv'];
      $this->sadrzaj=$row['sadrzaj'];?>
      <div id="edit_page">
      <a href="admin.php?id=1">&laquo; Back</a>
      <h1>Edit page: <i style="color:#DAA520;"><?php echo $this->naziv;?></i></h1>
      <form method="post">
      <table>
      <tr><td><input type="text" value="<?php echo $this->naziv;?>" name="naziv"><td></tr>
      <tr><td><textarea rows="20" cols="60" name="sadrzaj"><?php echo $this->sadrzaj;?></textarea></textarea></td></tr>
      <tr><td><input type="submit" value="Update" name="update"/></td></tr></table></form></div><?php
     

    }
  }
  public function update_pages(){
    $sql="UPDATE pages SET ";
    $sql.="sadrzaj='{$this->sadrzaj}',naziv='{$this->naziv}' ";
    $sql.="WHERE id=".$this->id;

    $this->query($sql);
    
  }
  public function find_navigation_page(){
    $sql="SELECT * FROM navigacija";
    $this->query($sql);
    while($row=mysqli_fetch_array($this->result)){
      
      $this->strana=$row['strana'];
      echo "<option>".$this->strana."</option>";

     

    }
  }
  public function find_navigation_id(){
    $sql="SELECT id FROM navigacija ";
    $sql.="WHERE strana='{$this->strana}' ";
    $this->query($sql);
    while($row=mysqli_fetch_array($this->result)){
      $this->navigacija_id=$row['id'];
      return $this->navigacija_id;
    }
  }
  public function create_new_page(){
    $sql="INSERT INTO pages";
    $sql.="(naziv,sadrzaj,datum,navigacija_id) ";
    $sql.="VALUES ('$this->naziv','$this->sadrzaj','$this->datum',$this->navigacija_id) ";

    $this->query($sql);
  }
}





























?>