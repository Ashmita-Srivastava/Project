<?php
header('Access-Control-Allow-Origin: *');

session_start();
include_once('../Database/DBMySql.php');$db=new DBMySql;

$SQL="SELECT *,DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(DOB, '%Y') - (DATE_FORMAT(NOW(), '00-%m-%d') < DATE_FORMAT(DOB, '00-%m-%d')) AS Age from users where `Status`<>'Disable'";

$result=$db->GetResult($SQL);
$myArray = array();
while($row = $result->fetch_assoc())
{
    $myArray[] = $row;
}
//shuffle($myArray);
echo json_encode($myArray);


?>