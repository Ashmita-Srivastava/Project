<?php
header('Access-Control-Allow-Origin: *');

session_start();

$Email=$err="";
if (isset($_GET["Email"]) && isset($_GET["PWD"])) {
    include('../Database/DBMySql.php');$db=new DBMySql;

    $Email =  $_GET["Email"];
    $PWD =  $_GET["PWD"];


    $sql="select count(*) from `users` where `Email` ='".$Email."' and `PWD` ='".$PWD."';";

    if( $db->ScalerQuery($sql)=="1")
    {
        $sql="select * from `users` where `Email` ='".$Email."' and `PWD` ='".$PWD."';";
        $User=$db->GetSingleRow($sql);
        
        $UID = $User["UID"];

        
        $Response["Status"]='Success';
        $Response["Message"]='Login Successful';
        $Response["Data"]=$User;

    }
    else{
        $Response["Status"]='Error';
        $Response["Message"]='Invalid Credentials';

    }
}else{
    $Response["Status"]='Error';
    $Response["Message"]='Invalid Parameters';

}
echo json_encode($Response);
?>