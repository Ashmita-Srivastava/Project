<?php
header('Access-Control-Allow-Origin: *');

session_start();


if(isset($_GET["GetSessionValue"]))
{
    if(isset($_SESSION[$_GET["GetSessionValue"]]))
    {
        $Response["Status"]='Success';
        $Response["Value"]=$_SESSION[$_GET["GetSessionValue"]];
        echo json_encode($Response); return;
    }
}




if(isset($_GET["Name"])&& isset($_GET["Type"])&& isset($_GET["Value"]))
{
    $Type = $_GET["Type"];
    if($Type=="Get" && isset($_SESSION[$_GET["Name"]])){
        $Response["Status"]='Success';
        $Response["Value"]=$_SESSION[$_GET["Name"]];
        echo json_encode($Response); return;
    }
    if($Type=="Set"){
        $_SESSION[$_GET["Name"]] = $_GET["Value"];
        $Response["Status"]='Success';
        $Response["Value"]=$_GET["Value"];
        echo json_encode($Response); return;
    }
}
if(isset($_GET["Name"])&& isset($_GET["Remove"]))
{
    unset($_GET["Name"]);
    $Response["Status"]='Success';
    $Response["Value"]="Session Removed";
    echo json_encode($Response); return;
}
if(isset($_GET["Name"])&& isset($_GET["Check"]))
{
    if(isset($_SESSION[$_GET["Name"]])){
        $Response["Status"]='Success';
        $Response["Value"]=$_SESSION[$_GET["Name"]];
    }
    else{
        $Response["Status"]='Error';
        $Response["Value"]="Session Not Found.";
    }
    echo json_encode($Response); return;
}
$Response["Status"]='Error';
$Response["Value"]="Invalid Parameters.";
echo json_encode($Response); return;

?>