<?php
/*
require_once('connectvars.php');
$folder = "uploads/";
$folder2 = "C:\\Users\\user\\Desktop\\uploading\\";
$a = scandir($folder);
$b = scandir($folder2); 

$result = array_diff($b, $a);
$counter = 0;
$result2 = array_diff($b,$result); 
foreach($result2 as $r){
    $counter++; 
    echo $r . '<br/>'; 
}
*/

// file differentiator 

$pathS = "C:\Users\user\Desktop\sourceD";
$pathT = "C:\Users\user\Desktop\TargetD";
$folderS = scandir($pathS);
$folderT = scandir($pathT); 
$fileS = array();
$fileT = array(); 
for($i = 3; $i = 375; $i++){
    $fileS[] = basename($pathS . $folderS[$i]); 
    
}

print_r($file_S); 

?>