<?php
include_once('functions.php');
global $conn;
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
?>