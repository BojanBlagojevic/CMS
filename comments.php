<?php require_once('database.php');?>
<?php require_once('pages.php');?>

<?php 
class Comments Extends Database{

public $pages_id;
public $ime;
public $email;
public $comment;

public function find_page_id($naziv=""){

	$sql="SELECT id FROM pages ";
	$sql.="WHERE naziv='$naziv' ";

	$this->query($sql);
	while($row=mysqli_fetch_array($this->result)){
		$this->pages_id=$row['id'];
		return $this->pages_id;
	}
}
public function show_comments($page_id=""){
	
   
	$sql="SELECT * FROM comments ";
	$sql.="WHERE pages_id=$this->pages_id ";
	$sql.="ORDER BY id DESC";

	$this->query($sql);
	while($row=mysqli_fetch_array($this->result)){
		$this->ime=$row['ime'];
		$this->comment=$row['comment'];?>
		<div id="comments"><p style="margin:0px;padding:0px"><strong style="color:000099;"><?php echo ucfirst($this->ime);?> commented:</strong>
		           <?php echo $this->comment;?></p></div><?php
		
	}
}
public function insert_values_into_db(){

	$sql="INSERT INTO comments";
	$sql.="(pages_id,ime,email,comment) ";
	$sql.="VALUES ($this->pages_id,'$this->ime','$this->email','$this->comment') ";

	$this->query($sql);

	

}
public function count_comments_by_pages(){
	$sql="SELECT COUNT(*) FROM comments ";
	$sql.="WHERE pages_id=".$this->pages_id;
	$this->query($sql);
	while($row=mysqli_fetch_array($this->result)){
		return $row[0];
	}
}
public function show_comments_for_admin(){
	$sql="SELECT * FROM comments ";
	$sql.="WHERE pages_id=".$this->pages_id;

	$this->query($sql);
	while($row=mysqli_fetch_array($this->result)){
		$this->id=$row['id'];
		$this->ime=$row['ime'];
		$this->email=$row['email'];
		$this->comment=$row['comment'];?>
		<tr>
		  <td><?php echo $this->ime;?></td>
		  <td><?php echo $this->email;?></td>
		  <td><?php echo $this->comment;?></td>
		  <td><a href="delete_comments.php?comment_id=<?php echo $this->id;?>&page_id=<?php echo $this->pages_id;?>">Delete</a>
		</tr><?php 
	}
}
public function delete_comments(){
	$sql="DELETE FROM comments ";
	$sql.="WHERE id=".$this->id;

	$this->query($sql);
}

}









?>