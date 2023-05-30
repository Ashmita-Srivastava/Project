<?php
header('Access-Control-Allow-Origin: *');

session_start();
include_once('../Database/DBMySql.php');$db=new DBMySql;
$UID="1";

{
    $SQL="SELECT i.UID,UserName,Mobile FROM users u,interests i WHERE u.`UID`=i.`UID` AND i.UID=".$UID;
}


$result=$db->GetResult($SQL);
$myArray = array();
while($row = $result->fetch_assoc())
{
    $myArray[]=$row;
}
//shuffle($myArray);
echo json_encode($myArray);


?>