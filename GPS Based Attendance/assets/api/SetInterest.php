<?php
header('Access-Control-Allow-Origin: *');

session_start();
include_once('../Database/DBMySql.php');$db=new DBMySql;

$Keyword=$VideoSeries='';$UID='1';$AID='1';
if(isset($_SESSION["UID"]) && isset($_GET["AID"])){
    $UID=$_SESSION["UID"];
    $AID=$_GET["AID"];
    if($db->ScalerQuery("select Count(*) from interests where UID=".$UID." AND AID=".$AID)=="0")
    {
        $SQL="insert into interests(UID,AID,AddedOn) VALUES(".$UID.",".$AID.",NOW())";
        if($db->NonQuery($SQL))
        {
            $Response["Status"]='Success';
            $Response["Message"]='Interest Added';
        }
        else{
            $Response["Status"]='Error';
            $Response["Message"]='Invalid Parameters';
        }


    }else
    {
        $SQL="delete from interests where UID=".$UID." AND AID=".$AID;
        if($db->NonQuery($SQL))
        {
            $Response["Status"]='Success';
            $Response["Message"]='Interest Removed';
        }
        else{
            $Response["Status"]='Error';
            $Response["Message"]='Invalid Parameters';
        }
    }

}
else{
    $Response["Status"]='Error';
    $Response["Message"]='Invalid Parameters';
}
echo json_encode($Response);


?>