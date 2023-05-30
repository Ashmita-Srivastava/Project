<?php
header('Access-Control-Allow-Origin: *');

session_start();
include_once('../Database/DBMySql.php');$db=new DBMySql;

$UID=1;if(isset($_SESSION["UID"]))$UID=$_SESSION["UID"];
$AID=0;
if(isset($_GET['Title']))
{
    $AID=$_GET['AID'];
    $Title=$_GET['Title'];
    $Mobile=$_GET['Mobile'];
    $Address=$_GET['Address'];
    $City=$_GET['City'];
    $Cost=$_GET['Cost'];
    $Capacity=$_GET['Capacity'];
    $AC=$_GET['AC'];
    $Geaser=$_GET['Geaser'];
    $RoomType=$_GET['RoomType'];
    $SQL="INSERT INTO ads(`Title`,`Address`,Mobile,`City`,`Cost`,`Capacity`,`PostedOn`,UID,AC,Geaser,RoomType) VALUES('".$Title."','".$Address."','".$Mobile."','".$City."',".$Cost.",".$Capacity.",NOW(),".$UID.",'".$AC."','".$Geaser."','".$RoomType."')";
    if($AID!="0")$SQL="update ads set `Title`='".$Title."',`Address`='".$Address."',Mobile='".$Mobile."',`City`='".$City."',`AC`='".$AC."',`Geaser`='".$Geaser."',`RoomType`='".$RoomType."',`Cost`=".$Cost.",`Capacity`=".$Capacity." Where AID=".$AID;

    if($db->NonQuery($SQL))
    {
        $Response["Status"]='Success';
        if($AID==0)
        {
            $Response["AID"]= $db->ScalerQuery("Select Max(AID) from ads");
            $Response["Message"]='Record Added.';
            if (!file_exists('../img/ads/'.$Response["AID"])) {
                mkdir('../img/ads/'.$Response["AID"], 0777, true);
            }
        }
        else $Response["Message"]='Record Updated.';
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