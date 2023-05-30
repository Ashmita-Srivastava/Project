<?PHP
header('Access-Control-Allow-Origin: *');

if(session_status()==1){session_start();}
$Name=$Mobile=$Email=$PWD=$Address="";
include('../Database/DBMySql.php'); $db=new DBMySql;


$UID = "0";
if(isset($_GET["UID"])) $UID=$_GET["UID"];


    $Name=$_GET["Name"];
    $Mobile=$_GET["Mobile"];
    $Email=$_GET["Email"];
    $Hobbies=$_GET["Hobbies"];
    $City=$_GET["City"];
    $Gender=$_GET["Gender"];
    $Contribution=$_GET["Contribution"];
    $Address=$_GET["Address"];
    $MaritialStatus=$_GET["MaritialStatus"];

    if($UID!="0")
    {
        if($db->ScalerQuery("select count(*) from users where UID<>".$UID." AND Mobile='".$Mobile."'")=="1")  {$Response["Status"]='Error';$Response["Message"]='Mobile Already Exist.';}
        else
        {
            $sql="Update users set `UserName`='".$Name."',`Mobile`='".$Mobile."',MaritialStatus='".$MaritialStatus."',Hobbies='".$Hobbies."',Address='".$Address."',City='".$City."',Contribution='".$Contribution."' where UID=".$UID;
            if($db->NonQuery($sql))
            {
                $Response["Status"]='Success';
                $Response["Message"]='Information Updated';
            }
            else{$Response["Status"]='Error';$Response["Message"]=$sql;}
        }
    }
    else{
        if($db->ScalerQuery("select count(*) from users where Mobile='".$Mobile."'")=="1")  {$Response["Status"]='Error';$Response["Message"]='Mobile Already Exist.';}
        else if($db->ScalerQuery("select count(*) from users where Email='".$Email."'")=="1")  {$Response["Status"]='Error';$Response["Message"]='Email Already Exist.';}
        else
        {
            $sql="INSERT INTO users(`UserName`,`Mobile`,PWD,CreatedOn,Email) VALUES('".$Name."','".$Mobile."','".$PWD."',NOW(),'".$Email."');";
            if($db->NonQuery($sql))
            {
                $_SESSION["UID"]=$db->NonQuery("select MAX(UID) from users");
                $Response["Status"]='Success';
                $Response["Message"]='User Added.';
            }
            else{
                $Response["Status"]='Error';$Response["Message"]=$sql;
            }
        }

    }//else{$Response["Status"]='Error';$Response["Message"]='Invalid User';}


echo json_encode($Response);

?>