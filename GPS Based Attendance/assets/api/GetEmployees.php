<?php
header('Access-Control-Allow-Origin: *');

session_start();
include_once('../Database/DBMySql.php');$db=new DBMySql;


$result=$db->GetResult("Select * from employees");
$myArray = array();
while($row = $result->fetch_assoc())
{
    $myArray[] = $row;
}
//shuffle($myArray);
echo json_encode($myArray);


?>