<?php
include_once('functions.php');
global $conn;
$keyword = $_POST['keyword'];  
$i = 0;
<<<<<<< HEAD
$sql="select distinct(cust_nm) from sbliw where cust_nm like ? order by cust_nm";
$results = fetchAll($sql,["$keyword%"]);
foreach($results as $output_sbliw)

{
	$return_array[$i]['name'] = $output_sbliw->cust_nm;
	$return_array[$i]['value'] = $output_sbliw->cust_nm;
=======
$fetchDataSbliw = mysqli_query($conn,"select distinct(cust_nm) from sbliw where cust_nm like '".$keyword."%' order by cust_nm");

while($output_sbliw = mysqli_fetch_array($fetchDataSbliw)) {
	$return_array[$i]['name'] = $output_sbliw['cust_nm'];
	$return_array[$i]['value'] = $output_sbliw['cust_nm'];
>>>>>>> 169b6de7b36cd76dd25ded45084f7332b8ddb1aa
	$i++;
}
echo json_encode($return_array);
?>