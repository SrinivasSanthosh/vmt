<?php
#PHP script to perform LDAP Authentication
session_start();
$qs=$_SERVER['QUERY_STRING'];
$email=$_REQUEST['username'];
$pwd=$_REQUEST['password'];

$val="";
<<<<<<< HEAD
$val=system('ldap.pl '.$email." ".$pwd);
if (strpos($val, 'NotMatched') !== false) 
{
}
else if(strpos($val, 'NotPresent') !== false)
{
	
}
=======
$val=system('ldap.exe '.$email." ".$pwd);
if (strpos($val, 'NotMatched') !== false) {
}
else if(strpos($val, 'NotPresent') !== false)
{}
>>>>>>> 169b6de7b36cd76dd25ded45084f7332b8ddb1aa
else
{
	$_SESSION["email"] = $email;
	$_SESSION["username"] = $val;	
}	
return "$val";
?>