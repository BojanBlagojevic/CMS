<?php
require_once('conf.php');


class Database {
	public $id;
	public $strana;
	public $connect;
	public $query;
	public $result;
	public $row;


//Common DB Methods


public function __construct(){

	$this->connect=new mysqli(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
	if($this->connect->connect_errno){
		die("Database connection failed".mysqli_connect_error());
	}

	
}
public function query($sql){
 
	$this->result =$this->connect->query($sql);
}
//Navigation methods
public function navigation(){
$sql="SELECT * FROM navigacija ORDER BY id ASC";
$this->query($sql);
while($row=mysqli_fetch_array($this->result)){?>
    <ul><li><a href="index.php?id=<?php echo $row['id']?>"><?php echo $row['strana'];?></a></li></ul><?php
 	}
 }
 public function list_navigation(){
 	$sql="SELECT * FROM navigacija";
 	$this->query($sql);
 	while($row=mysqli_fetch_assoc($this->result)){
 		$this->id=$row['id'];
 		$this->strana=$row['strana'];?>
 	    <tr>
         <td><?php echo $this->id;?></td>
         <td><?php echo $this->strana;?></td>
         <td><a href="admin.php?id=3&navigation_id=<?php echo $this->id;?>">Delete</a></td>
         <td><a href="admin.php?id=3&navigation_id=<?php echo $this->id;?>&strana=<?php echo $this->strana;?>">Edit</a></td>
        </tr><?php

 		 }
 		}

 
 public function edit_navigation($strana=""){
 	$sql="UPDATE navigacija ";
 	$sql.="SET strana='{$strana}' ";
 	$sql.="WHERE id=".$this->id;

 	$this->query($sql);
 }


}













?>