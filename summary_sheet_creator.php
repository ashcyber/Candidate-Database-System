<html>
    <head>
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">

        <style>
            section{
                margin: 50px 50px; 
            }

            button{
                margin-left: auto;
                margin-right: auto; 
                padding-left: 100px;
                padding-top: 50px;
            }
            .table{
                width: 40%;
                border: 1px solid black;
            }

            .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
                border-top: 1px solid #000;
                padding: 2px;
                padding-left: 10px;
            }

            table{
                layout: fixed; 
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
        require_once 'connectvars.php';
        if (isset($_POST['submit'])) {
            echo '<h4>Copy the table and paste it in word</h4>';
            $name = $_POST['name'];
            $positionApplied = ($_POST['positionApplied']);
            $current_employer = ($_POST['current_employer']);
            $curr_location = ($_POST['curr_location']);
            $pref_location = ($_POST['pref_location']);
            $curr_ctc = ($_POST['curr_ctc']);
            $curr_npm = ($_POST['curr_npm']);
            $exp_ctc = ($_POST['exp_ctc']);
            $exp_npm = ($_POST['exp_npm']);
            $edu = ($_POST['edu']);
            $percent_grad = ($_POST['percent_grad']);
            $percent_twelve = ($_POST['percent_twelve']);
            $percent_ten = ($_POST['percent_ten']);
            $total_experience = ($_POST['total_experience']);
            $dob = ($_POST['dob']);
            $email = ($_POST['email']);
            $mobile = ($_POST['mobile']);
            $notice_period = ($_POST['notice_period']);
            $reference_by = ($_POST['reference_by']);
            // file Handling
            // 
            // Creating the table and OUTPUT
            $i = 1;
            echo '<section style="align: center">';
            echo '<br/>';
            echo '<table class="table" border="1">';
            echo '<tr>';
            echo '<td width="6%">' . $i++ . '</td><td width=38%>Name </td><td width=52%>' . $name . '</td>';
            echo '</tr>';

            echo '<tr>';
            echo '<td width="6%">' . $i++ . '</td><td>Position Applied For </td><td>' . $positionApplied . '</td>';
            echo '</tr>';

            echo '<tr>';
            echo '<td width="6%">' . $i++ . '</td><td>Current Employer </td><td>' . $current_employer . '</td>';
            echo '</tr>';

            echo '<tr>';
            echo '<td width="6%">' . $i++ . '<td>Current Location </td><td>' . $curr_location . '</td>';
            echo '</tr>';

            echo '<tr>';
            echo '<td width="6%">' . $i++ . '<td>Preferred Location </td><td>' . $pref_location . '</td>';
            echo '</tr>';

            echo '<tr>';
            echo '<td width="6%">' . $i++ . '<td>Current CTC (Fixed + Variable)  </td><td>' . $curr_ctc . '</td>';
            echo '</tr>';

            echo '<tr>';
            echo '<td width="6%">' . $i++ . '<td>Current Net Pay (Per Month)  </td><td>' . $curr_npm . '</td>';
            echo '</tr>';

            echo '<tr>';
            echo '<td width="6%">' . $i++ . '<td>Expected CTC  </td><td>' . $exp_ctc . '</td>';
            echo '</tr>';


            echo '<tr>';
            echo '<td width="6%">' . $i++ . '<td>Expected Net Pay (Per Month) </td><td>' . $exp_npm . '</td>';
            echo '</tr>';

            echo '<tr>';
            echo '<td width="6%">' . $i++ . '<td>Educational Qualification  </td><td>' . $edu . '</td>';
            echo '</tr>';

            echo '<tr>';
            echo '<td width="6%">' . $i++ . '<td>% in Graduation  </td><td> ' . $percent_grad . '</td>';
            echo '</tr>';


            echo '<tr>';
            echo '<td width="6%">' . $i++ . '<td>% in Std XII / Year of Passing  </td><td>' . $percent_twelve . '</td>';
            echo '</tr>';


            echo '<tr>';
            echo '<td width="6%">' . $i++ . '<td>% in Std X / Year of passing  </td><td>' . $percent_ten . '</td>';
            echo '</tr>';

            echo '<tr>';
            echo '<td width="6%">' . $i++ . '<td>Total Exp   </td><td> ' . $total_experience . '</td>';
            echo '</tr>';

            echo '<tr>';
            echo '<td width="6%">' . $i++ . '<td>Date of Birth   </td><td> ' . $dob . '</td>';
            echo '</tr>';

            echo '<tr>';
            echo '<td width="6%">' . $i++ . '<td>Email Id   </td><td>' . $email . '</td>';
            echo '</tr>';

            echo '<tr>';
            echo '<td width="6%">' . $i++ . '<td>Mobile Number   </td><td> ' . $mobile . '</td>';
            echo '</tr>';

            echo '<tr>';
            echo '<td width="6%">' . $i++ . '<td>Notice Period   </td><td> ' . $notice_period . '</td>';
            echo '</tr>';

            echo '<tr>';
            echo '<td width="6%">' . $i++ . '<td>Reference By   </td><td> ' . $reference_by . '</td>';
            echo '</tr>';

            echo '</table>';
            echo '<br/>';
            echo '</section>';
        }
        ?>
        <section>
            <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="form-group row">
                    <label class="col-sm-2 form-control-label" for="name">Name</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="name" id="candidate_name"
                               value="<?php if (!empty($name)) echo $name; ?>" placeholder="Enter Name"/>
                    </div>
                    <label class="col-sm-2 form-control-label" for="positionApplied">Position Applied For</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="positionApplied" name="positionApplied"
                               value="<?php if (!empty($positionApplied)) echo $positionApplied; ?>"
                               placeholder="E.g. TSO"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 form-control-label" for="current_employer">Current Employer</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="current_employer" id="current_employer"
                               value="<?php if (!empty($current_employer)) echo $current_employer; ?>" placeholder="For e.g. Asian Paints"/>
                    </div>
                    <label class="col-sm-2 form-control-label" for="candidate_location">Current Location</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="curr_location" name="curr_location"
                               value="<?php if (!empty($curr_location)) echo $curr_location; ?>" placeholder="E.g. Mumbai"/>
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-sm-2 form-control-label" for="pref_location">Preferred Location</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="pref_location"
                               name="pref_location" 
                               value="<?php if (!empty($pref_location)) echo $pref_location; ?>" placeholder="In Years" min="0" max="30"/>
                    </div>
                    <label class="col-sm-2 form-control-label" for="curr_ctc">Current CTC (Fixed + Variable)</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="curr_ctc" name="curr_ctc"
                               value="<?php if (!empty($curr_ctc)) echo $curr_ctc; ?>"
                               placeholder="current ctc"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 form-control-label" for="curr_npm">Current Net Pay (Per Month)</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="curr_npm" name="curr_npm"
                               value="<?php if (!empty($curr_npm)) echo $curr_npm; ?>"
                               placeholder="Net Pay (Per Month)" />
                    </div>
                    <label class="col-sm-2 form-control-label" for="exp_ctc">Expected CTC</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="exp_ctc" name="exp_ctc"
                               value="<?php if (!empty($exp_ctc)) echo $exp_ctc; ?>"
                               placeholder="Expected ctc" />
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 form-control-label" for="exp_npm">Expected Net Pay (Per Month)</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="exp_npm" name="exp_npm"
                               value="<?php if (!empty($exp_npm)) echo $exp_npm; ?>"
                               placeholder="Expected net pay per month" />
                    </div>
                    <label class="col-sm-2 form-control-label" for="edu">Educational Qualification</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="edu" name="edu"
                               value="<?php if (!empty($edu)) echo $edu; ?>"
                               placeholder="For e.g. Diploma in paints" />
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 form-control-label" for="percent_grad">% in Graduation</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="percent_grad" name="percent_grad"
                               value="<?php if (!empty($percent_grad)) echo $percent_grad; ?>"
                               placeholder="Percent in graduation" />
                    </div>
                    <label class="col-sm-2 form-control-label" for="percent_twel">% in Std XII / Year of Passing</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="percent_twelve" name="percent_twelve"
                               value="<?php if (!empty($percent_twelve)) echo $percent_twelve; ?>"
                               placeholder="Percentage in XII" />
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-sm-2 form-control-label" for="candidate_CTC">% in Std X / Year of passing</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="percent_ten" name="percent_ten"
                               value="<?php if (!empty($percent_ten)) echo $percent_ten; ?>"
                               placeholder="Percentage in X" />
                    </div>
                    <label class="col-sm-2 form-control-label" for="total_experience">Total Exp</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="total_experience" name="total_experience"
                               value="<?php if (!empty($total_experience)) echo $total_experience; ?>"
                               placeholder="For e.g. 10 Years" />
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 form-control-label" for="dob">Date of Birth</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="dob" name="dob"
                               value="<?php if (!empty($dob)) echo $dob; ?>"
                               placeholder="For e.g. 1-10-1996" />
                    </div>
                    <label class="col-sm-2 form-control-label" for="email">Email Id</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="email" name="email"
                               value="<?php if (!empty($email)) echo $email; ?>"
                               placeholder="For e.g. gopal@jobs.com" />
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 form-control-label" for="mobile">Mobile Number</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="mobile" name="mobile"
                               value="<?php if (!empty($mobile)) echo $mobile; ?>"
                               placeholder="Enter Mobile Number" />
                    </div>
                    <label class="col-sm-2 form-control-label" for="notice_period">Notice Period</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="notice_period" name="notice_period"
                               value="<?php if (!empty($notice_period)) echo $notice_period; ?>"
                               placeholder="For e.g. 1 Month" />
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 form-control-label" for="reference_by">Reference by</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" id="reference_by" name="reference_by"
                               value="<?php if (!empty($reference_by)) echo $reference_by; ?>"
                               placeholder="Gopal Sharma" />
                    </div>
                </div>

                <hr>
                <label class="file">
                    <input type="file" id="file">
                    <span class="file-custom"></span>
                </label>
                <hr>
                <br/>

                <button type="submit" name="submit" class="btn btn-default">Create Summary Sheet</button>
            </form>
        </section>
    </body>
</html>