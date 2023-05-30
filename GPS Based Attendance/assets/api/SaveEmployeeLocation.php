<?php
header('Access-Control-Allow-Origin: *');

session_start();
include_once('../Database/DBMySql.php');$db=new DBMySql;

$EID=1;if(isset($_GET["EID"]))$EID=$_GET["EID"];
$Date=date("Y-m-d");


$Lat =$_GET['Lat'];
$Long =$_GET['Long'];
$Mobile =$_GET['Mobile'];
$PWD =$_GET['PWD'];

if($db->ScalerQuery("select COUNT(*) from employees where Mobile='".$Mobile."' AND PWD = '".$PWD."'")==0)
{
    echo "Error : Invalid ID Password";
    return;
}



$EID=$db->ScalerQuery("select EID from employees where Mobile='".$Mobile."' AND PWD = '".$PWD."'");

if($db->ScalerQuery("select COUNT(*) from locations where EID='".$EID."' AND `Date` = '".$Date."'")!=0)
{
    echo "Error : Attendance Already Marked";
    return;
}




$SQL="INSERT INTO locations(`EID`,`Date`,Lat,`Long`) VALUES(".$EID.",'".$Date."','".$Lat."','".$Long."')";
if($db->NonQuery($SQL)) echo 'Success';
else echo 'Error : '. $SQL;







?>