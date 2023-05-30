<?php
header('Access-Control-Allow-Origin: *');

session_start();
include_once('../Database/DBMySql.php');$db=new DBMySql;
$UID="1";
if(isset($_SESSION["UID"]))$UID=$_SESSION["UID"];
{
    $SQL="SELECT AID from interests where UID=".$UID;
}


$result=$db->GetSingleColumnArray($SQL);
//$myArray = array();
//while($row = $result->fetch_assoc())
//{
//    array_push($myArray,$row['AID']);
//}
//shuffle($myArray);
echo json_encode($result);


?>