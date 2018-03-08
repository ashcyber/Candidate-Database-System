<html>
    <head>
        <title>CV Uploader</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">

        <style>
            section {
                margin: 20px;
                margin-top: 40px; 

            }

            h4{
                color: #269abc; 
                font-weight: bold; 
            }

            hr{
                border-width: 3px;
                border-color: #ccc;
            }

            .btn{
                padding: 6px 30px; 
            }

            .btn-default{
                border-color: #2049A5;
            }

            .btn-default:hover{
                background-color: #1D72AF;
                color: #FFFBFB;
            }
        </style>
    </head>
    <body>



        <section>
            <h1> Resume Upload</h1>
            <br><br>
            <?php
            // docx Upload
            if (isset($_POST['docx'])) {

                class DocxConversion {

                    private $filename;

                    public function __construct($filePath) {
                        $this->filename = $filePath;
                    }

                    private function read_doc() {
                        $fileHandle = fopen($this->filename, "r");
                        $line = @fread($fileHandle, filesize($this->filename));
                        $lines = explode(chr(0x0D), $line);
                        $outtext = "";
                        foreach ($lines as $thisline) {
                            $pos = strpos($thisline, chr(0x00));
                            if (($pos !== FALSE) || (strlen($thisline) == 0)) {
                                
                            } else {
                                $outtext .= $thisline . " ";
                            }
                        }
                        $outtext = preg_replace("/[^a-zA-Z0-9\s\,\.\-\n\r\t@\/\_\(\)]/", "", $outtext);

                        return $outtext;
                    }

                    private function read_docx() {

                        $striped_content = '';
                        $content = '';

                        $zip = zip_open($this->filename);

                        if (!$zip || is_numeric($zip))
                            return false;

                        while ($zip_entry = zip_read($zip)) {

                            if (zip_entry_open($zip, $zip_entry) == FALSE)
                                continue;

                            if (zip_entry_name($zip_entry) != "word/document.xml")
                                continue;

                            $content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));

                            zip_entry_close($zip_entry);
                        }// end while

                        zip_close($zip);

                        $content = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $content);
                        $content = str_replace('</w:r></w:p>', "\r\n", $content);
                        $striped_content = strip_tags($content);

                        return $striped_content;
                    }

                    public function convertToText() {

                        if (isset($this->filename) && !file_exists($this->filename)) {
                            return "File Not exists";
                        }

                        $fileArray = pathinfo($this->filename);
                        $file_ext = $fileArray['extension'];
                        if ($file_ext == "doc" || $file_ext == "docx") {
                            if ($file_ext == "doc") {
                                return $this->read_doc();
                            } elseif ($file_ext == "docx") {
                                return $this->read_docx();
                            }
                        } else {
                            return "Invalid File Type";
                        }
                    }

                }

                $source = "TargetD/";
                $files_to_upload = scandir($source, 1);
                $last_index = (count($files_to_upload) - 2);
                $counter = 1; 
                for ($i = 0; $i < $last_index; $i++) {
                    $counter++; 
                    $dbc = mysqli_connect('localhost', 'root', '', 'extradb');
                    $file_path = "TargetD/" . $files_to_upload[$i];

                    $docObj = new DocxConversion($file_path);
                    $result = $docObj->convertToText();

                    // SQL Vars 
                    $candidate_name = 'Maintenance Manager';
                    /*$candidate_name = mysqli_real_escape_string($dbc, basename($file_path, ".docx")); */
                    $position = mysqli_real_escape_string($dbc, ' ');
                    $location = mysqli_real_escape_string($dbc, ' ');
                    $ctc = mysqli_real_escape_string($dbc, 0);
                    $work_exp = mysqli_real_escape_string($dbc, 0);
                    $cv = mysqli_real_escape_string($dbc, $result);
                    $file = mysqli_real_escape_string($dbc, $files_to_upload[$i]);
                    $date_create = mysqli_real_escape_string($dbc, '30/06/2016');
                    $query = "INSERT INTO candidates(name,position,location, ctc, work_experience, candidate_cv, file, date_posted, date_create) 
                    VALUES ('$candidate_name','$position','$location','$ctc','$work_exp','$cv','$file',NOW(),'$date_create');";
                    mysqli_query($dbc, $query) or die('error uploading to database emaildb');
                    echo $candidate_name . ' Uploaded to database<br/>';
                    mysqli_close($dbc);
                }
                echo $counter . ' Candidates added to database'; 
            }

            // pdf uploader
            if (isset($_POST['pdf'])) {
                $source = "TargetD/";
                $files_to_upload = scandir($source, 1);
                $last_index = (count($files_to_upload) - 2);
                $counter = 1; 
                for ($i = 0; $i < $last_index; $i++) {
                    $counter++; 
                    $file_path = "TargetD/" . $files_to_upload[$i];
                    $dbc = mysqli_connect('localhost', 'root', '', 'extradb');
                    $result = file_get_contents($source . $files_to_upload[$i]);
                    $candidate_name = "Maintenance Manager"; 
                    /* $candidate_name = mysqli_real_escape_string($dbc, basename($file_path, ".txt")); */
                    $position = mysqli_real_escape_string($dbc, ' ');
                    $location = mysqli_real_escape_string($dbc, ' ');
                    $ctc = mysqli_real_escape_string($dbc, 0);
                    $work_exp = mysqli_real_escape_string($dbc, 0);
                    $cv = mysqli_real_escape_string($dbc, $result);
                      
                    $file_extra = mysqli_real_escape_string($dbc, basename($file_path, ".txt"));
                    /*$file = $candidate_name . '.pdf'*/ 
                    $file = /*$candidate_name*/  $file_extra . '.pdf';
                    
                    $date_create = mysqli_real_escape_string($dbc, '30/06/2016');
                    $query = "INSERT INTO candidates(name,position,location, ctc, work_experience, candidate_cv, file, date_posted, date_create) 
                    VALUES ('$candidate_name','$position','$location','$ctc','$work_exp','$cv','$file',NOW(),'$date_create');";
                    mysqli_query($dbc, $query) or die('error uploading to database extradb');
                    echo $candidate_name . ' Uploaded to database<br/>';
                    mysqli_close($dbc);
                }
                echo $counter . " Candidates added to database"; 
            }
            echo '<br>';
            echo '<br>';
            ?>  
            <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <button type="submit" name="docx" class="btn btn-default">Upload .docx</button>
                <br>
                <hr>
                <button type="submit" name="pdf" class="btn btn-default">Upload .pdf</button>
            </form>
        </section>   
    </body>
</html>
