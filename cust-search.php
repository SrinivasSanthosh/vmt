<?php
include_once('functions.php');
global $conn;
$keyword = $_POST['keyword'];  
$i = 0;
$sql="select distinct(cust_nm) from sbliw where cust_nm like ? order by cust_nm";
$results = fetchAll($sql,["$keyword%"]);
foreach($results as $output_sbliw)

{
	$return_array[$i]['name'] = $output_sbliw->cust_nm;
	$return_array[$i]['value'] = $output_sbliw->cust_nm;
	$i++;
}
echo json_encode($return_array);
?>