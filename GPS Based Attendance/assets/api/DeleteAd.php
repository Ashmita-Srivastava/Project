<?php
header('Access-Control-Allow-Origin: *');


include_once('../Database/DBMySql.php');$db=new DBMySql;

$Keyword=$VideoSeries='';
$AID='0';
if(isset($_GET['Delete']))
{

    $SQL="delete from ads where AID=".$_GET['Delete'];

    if($db->NonQuery($SQL))
    {
        $Response["Status"]='Success';
        $Response["Message"]='Ad Deleted.';
    }
    else{
        $Response["Status"]='Error';
        $Response["Message"]=$SQL;
    }

}
else{
    $Response["Status"]='Error';
    $Response["Message"]="Invalid Parameters";
}
echo json_encode($Response);



?>