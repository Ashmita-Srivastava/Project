<?php
header('Access-Control-Allow-Origin: *');

session_start();
    include_once('../Database/DBMySql.php');$db=new DBMySql;
    $Mode='Active';
$UID='1';
if(isset($_GET["Mode"]))$Mode=$_GET["Mode"];
else {echo "{Status:'Error',Message:'Invalid Parameters.'}";return;}
if(isset($_SESSION["UID"])){
    $UID=$_SESSION["UID"];

    $SQL="Update users set `Status` = '".$Mode."' where UID=".$UID;

    if($db->NonQuery($SQL)) echo "{Status:'Success',Message:'Record Updated.'}";
    else echo "{Status:'Error',Message:'Invalid Parameters.'}";
}
else echo  "{Status:'Error',Message:'UnAuthorized Access.'}";


?>