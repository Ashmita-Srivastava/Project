<?php
header('Access-Control-Allow-Origin: *');

session_start();
include_once('../Database/DBMySql.php');$db=new DBMySql;

$SQL="SELECT a.AID,a.UID,`Title`,a.`Address`,a.`City`,`Cost`,`Capacity`,`PostedOn`,Email,a.Mobile,Username FROM ads a,users u WHERE u.`UID`=a.`UID`";
//if(isset($_GET["Gender"]))$SQL=$SQL." AND u.Gender=".$_GET["Gender"];
//if(isset($_GET["Contribution"]))$SQL=$SQL." AND u.Contribution=".$_GET["Contribution"];
//if(isset($_GET["MaritialStatus"]))$SQL=$SQL." AND u.Gender=".$_GET["MaritialStatus"];

if(isset($_GET["Range"]))$SQL=$SQL." AND Cost>=".$_GET["Range"];
if(isset($_GET["City"]))$SQL=$SQL." AND a.City='".$_GET["City"]."'";

 $result=$db->GetResult($SQL);
        $myArray = array();
        if($result) while($row = $result->fetch_assoc())
        {
            $myArray[] = $row;
        }
        echo json_encode($myArray);return;


?>