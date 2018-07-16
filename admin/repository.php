

<?php
//connect to db
function connDB()
{
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'gdpr_new');
// Establish database connection.
try {
$dbh = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS, 
array(
PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
PDO::MYSQL_ATTR_LOCAL_INFILE => true,
PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
));
}
catch (PDOException $e) {
exit("Error: " . $e->getMessage());
}
return $dbh;
}


//fetch data based on parameter
function fetchAll($sql, $values)
{
$conn  = connDB();
$query = $conn->prepare($sql);
if (isset($values)) {
$query->execute($values);
} else {
$query->execute();
}
return $results = $query->fetchAll(PDO::FETCH_OBJ);
}


//insert data
function insertData($sql, $data)
{
$conn  = connDB();
$query = $conn->prepare($sql);
return $query->execute($data);
}


//fetch data by binding values
function fetchbyBind($sql,$values)
{
$conn  = connDB();
$sth = $conn->prepare($sql);
$sth->bindValue(1, $values['market'], PDO::PARAM_STR);
// bindvalue is 1-indexed, so $k+1
foreach ($values['vendor'] as $k => $id) {
$sth->bindValue(($k + 2), $id);
}
$sth->execute();
return $sth->fetchAll(PDO::FETCH_OBJ);
}


//update data
function updateData($sql, $id)
{
$conn = connDB();
$query = $conn->prepare($sql);
return $query->execute($id);
}


//excute query
function excuteQuery($query)
{
$conn = connDB();
$sth = $conn->prepare($query);
return $sth->execute();
}


function pagination($sql, $values){
$conn  = connDB();
$query=$conn->prepare($sql);
$query->execute();
return $rowCount =$query->fetchColumn();
}

