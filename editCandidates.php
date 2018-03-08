<html>
    <head>
        <link rel="stylesheet" href="css/bootstrap.css"/>
        <link rel="stylesheet" href="css/bootstrap.min.css"/>
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
        if (isset($_POST['submit'])) {
            $candidate_id = $_POST['candidate_id'];
            $name = $_POST['candidate_name'];
            $position = $_POST['candidate_position'];
            $location = $_POST['candidate_location'];
            $work_exp = $_POST['candidate_exp'];
            $ctc = $_POST['candidate_ctc'];
            $date_create = $_POST['date_create'];
            $cv = $_POST['candidate_text'];
            $file = $_FILES['file']['name'];
            $file_loc = $_FILES['file']['tmp_name'];
            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

            if (!empty($file)) {
                $folder = "uploads/";
                $query = "SELECT * FROM candidates WHERE candidate_id='$candidate_id'";
                $result = mysqli_query($dbc, $query);
                while ($row = mysqli_fetch_array($result)) {
                    $file_old = $row['file'];
                }

                $file_path = $folder . $file_old;
                unlink($file_path); // deleting old file
                move_uploaded_file($file_loc, $folder . $file); // transfer new file into database
                // putting new file into database 
                $query = "UPDATE candidates "
                        . "SET name='$name' "
                        . ",position='$position' "
                        . ", location='$location' "
                        . ", work_experience='$work_exp' "
                        . ", ctc='$ctc' "
                        . ", candidate_cv='$cv' "
                        . ", file='$file'"
                        . ", date_create='$date_create' "
                        . "WHERE candidate_id='$candidate_id' ";
                mysqli_query($dbc, $query) or die("mysql_error");
                echo '<h4>Successfully updated the database</h4>';
            } else {

                $query = "UPDATE candidates "
                        . "SET name='$name' "
                        . ",position='$position' "
                        . ", location='$location' "
                        . ", work_experience='$work_exp' "
                        . ", ctc='$ctc' "
                        . ", candidate_cv='$cv' "
                        . ", date_create='$date_create' "
                        . "WHERE candidate_id='$candidate_id' ";

                mysqli_query($dbc, $query) or die("mysql_error");
                echo '<h4>Successfully updated the database</h4>';
            }
        } else {
            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            $candidate_id = mysqli_real_escape_string($dbc, $_GET['id']);
            $query = "SELECT * FROM candidates WHERE candidate_id = '$candidate_id'";

            $result = mysqli_query($dbc, $query);
            while ($row = mysqli_fetch_array($result)) {
                $name = $row['name'];
                $position = $row['position'];
                $location = $row['location'];
                $work_exp = $row['work_experience'];
                $ctc = $row['ctc'];
                $cv = $row['candidate_cv'];
                $date_create = $row['date_create'];
            }
        }

        mysqli_close($dbc);
        ?>
        <section>
            <h1>Editing Page</h1>
            <hr>
            <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="hidden" name="candidate_id" id="candidate_id" value="<?php if (!empty($candidate_id)) echo $candidate_id; ?>"/>
                <div class="form-group row">
                    <label class="col-sm-2 form-control-label" for="candidate_name">Candidate Name</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="candidate_name" id="candidate_name"
                               value="<?php if ($name != ' ') echo $name; ?>" placeholder="Enter Name"/>
                    </div>
                    <label class="col-sm-2 form-control-label" for="candidate_designation">Position</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="candidate_position" name="candidate_position"
                               value="<?php if ($position != ' ') echo $position; ?>"
                               placeholder="Current Designation"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 form-control-label" for="candidate_location">Current Location</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="candidate_location" name="candidate_location"
                               value="<?php if ($location != ' ') echo $location; ?>" placeholder="Enter Location"/>
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
                    <label  for="camdidate_cv">Candidate CV</label>
                    <textarea  class="form-control" id="candidate_text" name="candidate_text" 
                               rows="11"><?php if (!empty($cv)) echo $cv; ?></textarea>
                </div>
                <div class="form-group ">
                    <label class="file">
                        <input type="file" name="file" id="file">
                        <span class="file-custom"></span>
                    </label>
                </div>
                <button type="submit" name="submit" class="btn btn-default">Submit</button>
    </form>
</section>
</body>
</html>

