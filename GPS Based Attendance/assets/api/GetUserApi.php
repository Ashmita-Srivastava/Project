<?php
header('Access-Control-Allow-Origin: *');

session_start();
    include_once('../Database/DBMySql.php');$db=new DBMySql;

$Keyword=$VideoSeries='';
$UID='1';
if(isset($_SESSION["UID"]))$UID=$_SESSION["UID"];

$SQL="SELECT *,DATE_FORMAT(NOW(), '%Y') - DATE_FORMAT(DOB, '%Y') - (DATE_FORMAT(NOW(), '00-%m-%d') < DATE_FORMAT(DOB, '00-%m-%d')) AS age from users where UID=".$UID;
    $row=$db->GetSingleRow($SQL);
    if($row){
        $row["Interests"] =array_values( $db->GetSingleColumnArray("select AID from interests where UID = ".$UID));

        $result=$db->GetResult("select * from ads where UID = ".$UID);
        $myArray = array();
        while($row1 = $result->fetch_assoc())
        {
            $myArray[] = $row1;
        }
        $row["Ads"] = $myArray;
        echo json_encode($row);
    }
    else "{Status:'Error',Message:'Invalid Parameters.'}";



?>