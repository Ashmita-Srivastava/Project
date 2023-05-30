<?PHP
header('Access-Control-Allow-Origin: *');

if(session_status()==1){session_start();}
$Name=$Mobile=$Email=$PWD=$Address="";
include('../Database/DBMySql.php'); $db=new DBMySql;


$err=$CID="";
if (isset($_GET["Name"])) {

    $Name=$_GET["Name"];
    $Mobile=$_GET["Mobile"];
    $Email=$_GET["Email"];
    $PWD=$_GET["PWD"];



    if($db->ScalerQuery("select count(*) from users where Mobile='".$Mobile."'")=="1")  {$Response["Status"]='Error';$Response["Message"]='Mobile Already Exist.';}
    else if($db->ScalerQuery("select count(*) from users where Email='".$Email."'")=="1")  {$Response["Status"]='Error';$Response["Message"]='Email Already Exist.';}
    else
    {
        $sql="INSERT INTO users(`UserName`,`Mobile`,PWD,CreatedOn,Email) VALUES('".$Name."','".$Mobile."','".$PWD."',NOW(),'".$Email."');";
        if($db->NonQuery($sql))
        {
            $_SESSION["UID"]=$db->NonQuery("select MAX(UID) from users");
            $Response["Status"]='Success';
            $Response["Message"]='SignUp Successful';
        }
        else{
            $Response["Status"]='Error';
            $Response["Message"]=$sql;
        }

    }
}
else{
    $Response["Status"]='Error';
    $Response["Message"]='Invalid Parameters';
}
echo json_encode($Response);

?>