<?php
include_once('functions.php');
global $conn;
$geo = $_POST['geo']; 
<<<<<<< HEAD
if(isset($_POST['geo']) && isset($_POST['market']))
{
	$market = $_POST['market']; 
	$result = getGeoCustomer($geo, $market); 
}
elseif($_POST['geo'] == "all")
 {
=======
if(isset($_POST['geo']) && isset($_POST['market'])){
	$market = $_POST['market']; 
	$result = getGeoCustomer($geo, $market); 
}
elseif($_POST['geo'] == "all") {
>>>>>>> 169b6de7b36cd76dd25ded45084f7332b8ddb1aa
	$result = getAllGeoCustomer();
} else {   
	$result = getGeoCustomer($geo);
} 
echo json_encode($result);
?>