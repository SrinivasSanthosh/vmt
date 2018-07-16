<?php
include_once('functions.php'); 
if (isset($_REQUEST['submit'])){
foreach ($_REQUEST['ID'] as $key => $value) {
	$id = $_REQUEST['ID'][$key];
	$adm = $_REQUEST['ADMIN'][$value];
	$admin = ($_REQUEST['ADMIN'][$value] != '1') ? '0': $_REQUEST['ADMIN'][$value];
	if ($adm === 1){
		$adm = 1;
}
	updateUsers($id,$admin);
}
header('Location:admin.php');
}
?>