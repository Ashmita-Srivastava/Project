<?php
header('Access-Control-Allow-Origin: *');


include_once('../Database/DBMySql.php');$db=new DBMySql;

$Date=date("Y-m-d");
if(isset($_GET['Date']))$Date =$_GET['Date'];
$SQL="SELECT EID FROM attendence WHERE `Date` ='".$Date."'";

$PresentEID=$db->GetSingleColumnArray($SQL);

$Employees = array();
$result=$db->GetResult("select * from employees");
if($result)
{

    while($row = $result->fetch_assoc())
    {
        if(in_array($row['EID'], $PresentEID))
        {
            $row['IsPresent']=true;
        } else $row['IsPresent']=false;
        $Employees[] = $row;
    }

}

echo json_encode($Employees);






?>