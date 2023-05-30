<?php
header('Access-Control-Allow-Origin: *');

session_start();
include_once('../Database/DBMySql.php');$db=new DBMySql;
$UID="1";
if(isset($_SESSION["UID"]) && isset($_GET["AID"])&& isset($_GET["Remove"]))
{
    $UID=$_SESSION["UID"];
    $AID=$_GET["AID"];
    $Count=$db->ScalerQuery("Select COUNT(*) from interests where AID=".$AID." AND UID=".$UID);
    if($Count!="0") {  echo "{Status:'Success',Message:'Interest Already Exist' }";return;}
    if(isset($_GET["Add"])) $SQL="insert into interests(AID,UID,AddedOn) VALUES(".$AID.",".$UID.",NOW())";
    if(isset($_GET["Remove"])) $SQL="Delete from interests where AID=".$AID." AND UID=".$UID;

    if($db->NonQuery($SQL) ) {
        $Response["Status"]='Success';
        $Response["Message"]='Interest Updated';
        echo json_encode($Response); return;
    }
}
else{
    $Response["Status"]='Error';
    $Response["Message"]='Invalid Parameters';
    echo json_encode($Response); return;
}

?>