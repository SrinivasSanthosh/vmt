<?php
#PHP script to perform LDAP Authentication
session_start();
$qs=$_SERVER['QUERY_STRING'];
$email=$_REQUEST['username'];
$pwd=$_REQUEST['password'];

$val="";
$val=system('ldap.exe '.$email." ".$pwd);
if (strpos($val, 'NotMatched') !== false) {
}
else if(strpos($val, 'NotPresent') !== false)
{}
else
{
	$_SESSION["email"] = $email;
	$_SESSION["username"] = $val;	
}	
return "$val";
?>