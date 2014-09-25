<?php require_once('database.php');?>

<?php
 
 class Photos Extends Database{

   public $file=array();
   public $id;
   public $name;
   public $type;
   public $tmp_path;
   public $size;

  public function upload_errors_reporting(){
    switch ($this->file['error']) {
      case '2':
        echo "Maximum image size is 5 MB!";
        break;

      case '3':
        echo "Partial upload,please try again!";
        break;

      case '4':
        echo 'No file!';
        break;

      case '6':
        echo 'Error!Temporary folder missing!';
        break;

      case '7':
        echo 'Failed to write to disc!';
        break;

      case '8':
        echo 'File extension is not recognised!';
        break;
      
    }
  }
  public function upload_photo(){

  $sql="INSERT INTO photos";
	$sql.="(name,type,size) ";
	$sql.="VALUES ('$this->name','$this->type',$this->size) ";
    
    $this->query($sql);
  }
  public function check_if_photo_exists($check_name=""){
    $sql="SELECT * FROM photos ";
    $sql.="WHERE name='$check_name' ";
    $this->query($sql);
    $row=mysqli_fetch_array($this->result);
    $this->name=$row['name'];
    if(!empty($this->name)){
      return true;
    }
      
      
    }
  
  public function move_file(){

  	move_uploaded_file($this->tmp_path,'/opt/lampp/htdocs/tutorials/uploaded_images/'.$this->name);
  }
  public function show_fotographs(){

  	$sql="SELECT name,id FROM photos";

  	$this->query($sql);

  	while($row=mysqli_fetch_assoc($this->result)){
  		 
  		$this->name=$row['name'];
      $this->id=$row['id'];?>
   <a href="index.php?id=6&photo_id=<?php echo $this->id;?>"><img src="uploaded_images/<?php echo $this->name;?>" width="200" height="200"></a><?php
  		

  }

}
 public function find_photo_by_id(){

  $sql="SELECT name FROM photos ";
  $sql.="WHERE id=".$this->id;

  $this->query($sql);
  while($row=mysqli_fetch_array($this->result)){
    $this->name=$row['name'];
    echo $this->name;
  }
 }

  public function list_photos($per_page="",$offset=""){

    $sql="SELECT * FROM photos ";
    $sql.="ORDER BY id DESC ";
    $sql.="LIMIT {$per_page} ";
    $sql.="OFFSET {$offset} ";

    $this->query($sql);
    while($row=mysqli_fetch_array($this->result)){
      $this->id=$row['id'];
      $this->name=$row['name'];
      $this->size=$row['size'];?>
  
             
             
             <tr>
             <td><img src="uploaded_images/<?php echo $this->name;?>" width="100" height="50"></td>
             <td><?php echo $this->name;?></td>
             <td><?php echo $this->size;?> B</td>
             <td><a href="delete_photo.php?id=<?php echo $this->id;?>">Delete</a></td>
             </tr>

            <?php
      
    }
  }
  public function count_all_photos(){
    $sql="SELECT COUNT(*) FROM photos";
    $this->query($sql);
    while($row=mysqli_fetch_array($this->result)){
    return $row[0];
     }
  }
  public function delete_photos(){

    $sql="DELETE FROM photos WHERE id=".$this->id;
    $this->query($sql);
  }
  
 }




?>