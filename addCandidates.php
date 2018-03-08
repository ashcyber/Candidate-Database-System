<html>
    <head>
        <title>Add Candidates | Database</title>
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
        <?php
        require_once 'navigation.php';
        require_once('connectvars.php');
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        // code for form handling 
        if (isset($_POST['submit'])) {
            $candidate_name = mysqli_real_escape_string($dbc, $_POST['candidate_name']) . ' ';
            $position = mysqli_real_escape_string($dbc, $_POST['candidate_position']) . ' ';
            $ctc = mysqli_real_escape_string($dbc, $_POST['candidate_ctc']) . ' ';
            $location = mysqli_real_escape_string($dbc, $_POST['candidate_location']) . ' ';
            $work_exp = mysqli_real_escape_string($dbc, $_POST['candidate_exp']) . ' ';
            $cv = mysqli_real_escape_string($dbc,$_POST['candidate_text']) . ' ';
            $date_create = $_POST['date_create'];
            $file = $_FILES['file']['name'];
            $file_loc = $_FILES['file']['tmp_name'];
            $file_size = $_FILES['file']['size'];
            $file_type = $_FILES['file']['type'];
            


            if (!empty($candidate_name) && !empty($cv) && !empty($file) && !empty($date_create)) {
                $query = "INSERT INTO candidates(name,position,location, ctc, work_experience, candidate_cv, file, date_posted, date_create) 
                    VALUES ('$candidate_name','$position','$location','$ctc','$work_exp','$cv','$file',NOW(),'$date_create');";
                mysqli_query($dbc, $query) or die('error uploading to database giridb2');
                $folder = "uploads/";
                move_uploaded_file($file_loc, $folder . $file);
                echo '<h4>' . $candidate_name . 'was added to the database</h4>' . '<br />';
            } else {
                echo "please fill all the details";
            }
        }

        mysqli_close($dbc);
        ?>

        <!-- form begins -------------------------------------------------------
        -->
        <section>
            <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="form-group row">
                    <label class="col-sm-2 form-control-label" for="candidate_name">Candidate Name</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="candidate_name" id="candidate_name"
                               placeholder="Enter Name"/>
                    </div>
                    <label class="col-sm-2 form-control-label" for="candidate_designation">Position</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="candidate_position" name="candidate_position"
                               value="<?php if (!empty($position)) echo $position; ?>"
                               placeholder="Current Designation"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 form-control-label" for="candidate_location">Current Location</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="candidate_location" name="candidate_location"
                               value="<?php if (!empty($location)) echo $location; ?>" placeholder="Enter Location"/>
                    </div>
                    <label class="col-sm-2 form-control-label" for="candidate_exp">Total Experience</label>
                    <div class="col-sm-3">
                        <input type="number" class="form-control" id="candidate_exp"
                               name="candidate_exp" 
                               value="<?php if (!empty($work_exp)) echo $work_exp; ?>" placeholder="In Years" min="0" max="30"/>
                    </div>

                </div>

                <div class="form-group row">

                    <label class="col-sm-2 form-control-label" for="candidate_CTC">CTC</label>
                    <div class="col-sm-3">
                        <input type="number" class="form-control" id="candidate_ctc" name="candidate_ctc"
                               value="<?php if (!empty($ctc)) echo $ctc; ?>"
                               placeholder="CTC in Lacs" min="0" max="100"/>
                    </div>

                    <label class="col-sm-2 form-control-label" for="Date Document Created">Document Date Created</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="date_create" name="date_create"
                               value="<?php if (!empty($date_create)) echo $date_create; ?>"
                               placeholder="20/5/2016"/>
                    </div>
                </div>

                <h4>Resume</h4><hr/>
                <div class="form-group ">
                    <label  for="exampleTextarea">Candidate CV</label>
                    <textarea  class="form-control" id="candidate_text" name="candidate_text" 
                               value="<?php if (!empty($cv)) echo $cv; ?>"
                               rows="5"></textarea>
                </div>
                <div class="form-group ">
                    <label class="file">
                        <input type="file" name="file" id="file">
                        <span class="file-custom"></span>
                    </label>
                </div>
                <button type="submit" name="submit" class="btn btn-default">Submit</button>
        </section>
    </form>
</body>
</html>