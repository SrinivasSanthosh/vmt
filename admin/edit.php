<?php include_once('include_header.php');
include_once('functions.php');
//var_dump($_POST['name1']);
<<<<<<< HEAD
foreach ($_POST['name1'] as $key => $value)
 {
=======

foreach ($_POST['name1'] as $key => $value) {
>>>>>>> 169b6de7b36cd76dd25ded45084f7332b8ddb1aa
	updateUsers($value);
	# code...
}
header("location:http://localhost/gdpr/gdpr/admin.php");
?>