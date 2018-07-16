<?php
include_once('functions.php');
global $conn;
$geo = $_POST['geo']; 
if(isset($_POST['geo']) && isset($_POST['market']))
{
	$market = $_POST['market']; 
	$result = getGeoCustomer($geo, $market); 
}
elseif($_POST['geo'] == "all")
 {
	$result = getAllGeoCustomer();
} else {   
	$result = getGeoCustomer($geo);
} 
echo json_encode($result);
?>