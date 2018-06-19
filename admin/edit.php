<?php include_once('include_header.php');
include_once('functions.php');
//var_dump($_POST['name1']);

foreach ($_POST['name1'] as $key => $value) {
	updateUsers($value);
	# code...
}
header("location:http://localhost/gdpr/gdpr/admin.php");
?>