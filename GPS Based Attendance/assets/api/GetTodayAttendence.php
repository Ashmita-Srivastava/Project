<?php
header('Access-Control-Allow-Origin: *');


include_once('../Database/DBMySql.php');$db=new DBMySql;

$Date=date("Y-m-d");
$SQL="SELECT EID FROM attendence WHERE `Date` = Date(Now())";

$PresentEID=$db->GetSingleColumnArray($SQL);
$SQL="SELECT EID,ConCat(Lat,',',`Long`) FROM locations WHERE `Date` = Date(Now())";
$Locations=$db->GetDoubleColumnAssociativeArray($SQL);



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

        if(in_array($row['EID'], array_keys($Locations)))
        {

            $lat=explode(',',$Locations[$row['EID']])[0];
            $long=explode(',',$Locations[$row['EID']])[1];

            $row = array_merge($row,array('Lat'=>$lat) );
            $row = array_merge($row,array('Long'=>$long));
            $MapLink = "http://maps.google.com/maps?&z=20&q=".$row['Lat']."+".$row['Long']."&ll=".$row['Lat']."+".$row['Long'];
            $row= array_merge($row,['MapLink'=>$MapLink]);
        }

        $Employees[] = $row;
    }

}

echo json_encode($Employees);
//if($result)
//{
//    $myArray = array();
//    while($row = $result->fetch_assoc())
//    {
//        $myArray[] = $row;
//    }
//    $Response["Status"]='Success';
//    $Response["Message"]='Ad Deleted.';
//    echo json_encode($myArray);

//}
//else{
//    $Response["Status"]='Error';
//    $Response["Message"]=$SQL;
//}






?>