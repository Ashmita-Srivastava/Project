<?php
header('Access-Control-Allow-Origin: *');

session_start();



if(isset($_GET["DeleteFile"]))
{
    DeleteFile($_GET["DeleteFile"]);
}

if(isset($_GET["GetFiles"]))
{
    GetFileArray($_GET["GetFiles"]);
}

function GetFileArray($Path)
{
    $temp=[];
    // Open a directory, and read its contents
    if (is_dir($Path))
    {
        if ($dh = opendir($Path)){
            while (($file = readdir($dh)) !== false) {if($file!='.' && $file!='..' ) array_push($temp,$file); ;}
            closedir($dh);
        }
        $Response["Status"]='Success';
        $Response["Files"]=$temp;
        echo  json_encode($Response);
    }
    else{
        $Response["Status"]='Error';
        $Response["Message"]="Invalid Path";
        echo json_encode($Response);
    }
}

function GetFileArrayOfExtension($Path,$Extension)
{
    $arr=[];
    if (is_dir($Path))  // Open a directory, and read its contents
    {
        if ($dh = opendir($Path)){

            while (($file = readdir($dh)) !== false)
            {
                $temp=pathinfo($file);
                if($temp["extension"]==$Extension && $file!='.' && $file!='..'){array_push($arr,$file);}
            }
            closedir($dh);
        }
        $Response["Status"]='Success';
        $Response["Files"]=$arr;
        echo json_encode($Response);
    }
    else{
        $Response["Status"]='Error';
        $Response["Message"]="Invalid Path";
        echo json_encode($Response);
    }
}
function IsFileExist($file_to_search,$dir){

    $files = scandir($dir);

    foreach($files as $value)
    {

        $path = realpath($dir.DIRECTORY_SEPARATOR.$value);
        if(is_dir($path)){continue;}
        if($file_to_search == $value){

            $Response["Status"]='Success';
            $Response["Message"]="File Exist";
            echo json_encode($Response);
            return;
        }
        //else{return false;}

    }
    $Response["Status"]='Error';
    $Response["Message"]="File Not Found";
    echo json_encode($Response);
    return;
}

function DeleteFile($FilePath)
{

    unlink($FilePath);
}


function endsWith( $haystack, $needle ) {
    $length = strlen( $needle );
    if( !$length ) {
        return true;
    }
    return substr( $haystack, -$length ) === $needle;
}



?>