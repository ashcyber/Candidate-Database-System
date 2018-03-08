<?php

require_once("connectvars.php");
$folder = "uploads/";
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$candidate_id = mysqli_real_escape_string($dbc, $_GET['id']);
$query = "DELETE FROM candidates WHERE candidate_id = '$candidate_id'";
mysqli_query($dbc, $query) or die("Error connecting to the database");
mysqli_close($dbc); 
echo 'File Removed From SQL'; 

 
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

$query = "SELECT file FROM candidates WHERE candidate_id = '$candidate_id'"; 
  $result = mysqli_query($dbc, $query);
            $file = ''; 
            while ($row = mysqli_fetch_array($result)) {
                $file =  $row['file'];  
            }
            $fileName = $folder.$file;
           $tmp = dirname(__FILE__);
            if (strpos($tmp, '/', 0)!==false) {
              define('WINDOWS_SERVER', false);
              } else {
              define('WINDOWS_SERVER', true);
            }
              $deleteError = 0;
              if (!WINDOWS_SERVER) {
                if (!unlink($fileName)) {
                  $deleteError = 1;
                }
              } else {
                $lines = array();
                exec("DEL /F/Q \"$fileName\"", $lines, $deleteError);
              }
              if ($deleteError) {
                echo 'file delete error';
              }
  
 mysqli_close($dbc); 

?>