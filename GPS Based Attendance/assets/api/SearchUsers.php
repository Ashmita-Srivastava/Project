<?php
header('Access-Control-Allow-Origin: *');

session_start();
include_once('../Database/DBMySql.php');$db=new DBMySql;

$Keyword=$VideoSeries='';$City='';
$SQL="SELECT *,DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(DOB, '%Y') - (DATE_FORMAT(NOW(), '00-%m-%d') < DATE_FORMAT(DOB, '00-%m-%d')) AS Age from users where `Status`<>'Disable'";

if(isset($_GET["Gender"]))$SQL=$SQL." AND Gender='".$_GET["Gender"]."'";
if(isset($_GET["Contribution"]))$SQL=$SQL." AND Contribution=".$_GET["Contribution"];
if(isset($_GET["MaritialStatus"]))$SQL=$SQL." AND MaritialStatus='".$_GET["MaritialStatus"]."'";
if(isset($_GET["City"]))$SQL=$SQL." AND City like '%".$_GET["City"]."%'";



$result=$db->GetResult($SQL);
$myArray = array();
if($result)while($row = $result->fetch_assoc())
{
    $myArray[] = $row;
}
//shuffle($myArray);
echo json_encode($myArray);


?>