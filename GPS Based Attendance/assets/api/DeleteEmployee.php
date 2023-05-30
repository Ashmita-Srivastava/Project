<?php
header('Access-Control-Allow-Origin: *');


include_once('../Database/DBMySql.php');$db=new DBMySql;

$Keyword=$VideoSeries='';
$EID=0;

if(isset($_GET['EID']))$EID=$_GET['EID'];
$SQL="delete from employees where EID=".$EID;
if($db->NonQuery($SQL))echo 'Success';
else echo "Error : ".$SQL;


?>