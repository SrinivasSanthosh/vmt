<?php
include_once('functions.php');
global $conn;
$keyword = $_POST['keyword'];  
$i = 0;
$fetchDataSbliw = mysqli_query($conn,"select distinct(cust_nm) from sbliw where cust_nm like '".$keyword."%' order by cust_nm");

while($output_sbliw = mysqli_fetch_array($fetchDataSbliw)) {
	$return_array[$i]['name'] = $output_sbliw['cust_nm'];
	$return_array[$i]['value'] = $output_sbliw['cust_nm'];
	$i++;
}
echo json_encode($return_array);
?>