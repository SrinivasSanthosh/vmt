<?php
include_once('functions.php');
global $conn;
<<<<<<< HEAD
if(!isset($_POST['searchTerm']))
{ 
  $sql="select distinct(cust_nm) from sbliw order by cust_nm limit 9, 10";
  
  $results=fetchAll($sql,[]);
}else
{ 
  $search = $_POST['searchTerm'];   
$sql="select distinct(cust_nm) from sbliw where cust_nm like ? limit 30";
 
  $results=fetchAll($sql,["%$search%"]);
} 

$data = array();
foreach($results as $row) 
{    
  $data[] = array("id"=>$row->cust_nm, "text"=>$row->cust_nm);
}
echo json_encode($data);   
=======
if(!isset($_POST['searchTerm'])){ 
  $fetchData = mysqli_query($conn,"select distinct(cust_nm) from sbliw order by cust_nm limit 9, 10");
}else{ 
  $search = $_POST['searchTerm'];   
  $fetchData = mysqli_query($conn,"select distinct(cust_nm) from sbliw where cust_nm like '%".$search."%' limit 30");
} 

$data = array();
while ($row = mysqli_fetch_array($fetchData)) {    
  $data[] = array("id"=>$row['cust_nm'], "text"=>$row['cust_nm']);
}
echo json_encode($data);
>>>>>>> 169b6de7b36cd76dd25ded45084f7332b8ddb1aa
?>