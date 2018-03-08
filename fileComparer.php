<?php
  require_once('connectvars.php');
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  
  $source = "uploads/";
  $files_uploads = scandir($source, 1);
  $last_index = (count($files_uploads) - 2);
  $array1 = array(); 
  for($i = 0; $i < $last_index; $i++){
      $array1[] = $files_uploads[$i];
  }
  
  $query = "SELECT file,candidate_id FROM candidates"; 
  $result = mysqli_query($dbc, $query);
  $array2 = array(); 
  while($row = mysqli_fetch_array($result)){
      $array2[] = $row['file'];
      
  } 

 
  $array_final = array_diff($array1, $array2);
  foreach($array_final as $item){
       $file_path = $source . $item; 
       unlink($file_path);
  }


?>