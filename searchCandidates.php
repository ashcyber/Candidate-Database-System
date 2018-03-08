<html>
    <head>
        <title>Search Results</title>
        <link rel="stylesheet" href="css/bootstrap.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </head>
    <body>
        <?php
        require_once 'navigation.php';
        require_once 'connectvars.php';
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

        function build_query($user_search, $sort, $search_key, $location) {
            $search_query = "SELECT * FROM candidates";
            // extract the keywords into an array

            if (!empty($user_search)) {
                $clean_search = str_replace(',', ' ', $user_search);
                $search_words = explode(' ', $clean_search);
                $final_search_words = array();
                if (count($search_words) > 0) {
                    foreach ($search_words as $word) {
                        if (!empty($word)) {
                            $final_search_words[] = $word;
                        }
                    }
                }

                $where_list = array();
                if (count($final_search_words) > 0) {
                    foreach ($search_words as $word) {
                        $where_list[] = " candidate_cv LIKE '%$word%' ";
                    }
                }

                switch ($search_key) {
                    case 1:
                        $where_clause = implode('AND', $where_list);
                        break;

                    case 2:
                        $where_clause = implode('OR', $where_list);
                        break;
                    default:
                }

                if (!empty($where_clause)) {
                    $search_query .= " WHERE ($where_clause)";
                }

                if (!empty($location)) {
                    $search_query .= " AND (candidate_cv LIKE '%$location%') ";
                }
            } else {
                if (!empty($location)) {
                    $search_query .= " WHERE candidate_cv LIKE '%$location%' ";
                }
            }


            switch ($sort) {
                case '1':
                    $search_query .= " ORDER BY date_posted";
                    break;

                case '2':
                    $search_query .= " ORDER BY ctc";
                    break;
                case '3':
                    $search_query .= " ORDER BY work_experience";
                    break;
                default:
                // do nothing
            }

            $search_query .= ';';
            return $search_query;
        }

        $sort = $_GET['filter'];
        $user_search = $_GET['search'];
        $search_key = $_GET['search_key'];
        $location = $_GET['location'];

        $query = build_query($user_search, $sort, $search_key, $location);


        $result = mysqli_query($dbc, $query);

        echo '<div class="container">';
        echo '<table border="1px" class="table table-hover">';
        echo '<thead style="background-color: #ccc">';
        echo '<tr class="heading">';
        echo '<th>No.</th>';
        echo '<th>Name</th>';
        echo '<th>Position</th>';
        echo '<th>Location</th>';
        echo '<th>Salary</th>';
        echo '<th>Work Exp</th>';
        echo '<th>Resume</th>';
        echo '<th>Date Uploaded</th>';
        echo '<th>Date Create</th>';
        echo '<th>Edit</th>';
        echo '</tr>';
        echo '<thead>';


        echo '<tbody>';

        // counter variable 
        $counter = 1;
        while ($row = mysqli_fetch_array($result)) {
            echo '<tr class="results">';
            echo '<td valign="top" width="5%">' . $counter++ . '</td>';
            echo '<td valign="top" width="10%">' . $row['name'] . '</td>';
            echo '<td valign="top" width="10%">' . $row['position'] . '</td>';
            echo '<td valign="top" width="10%">' . $row['location'] . '</td>';
            echo '<td valign="top" width="10%">' . $row['ctc'] . ' Lacs</td>';
            echo '<td valign="top" width="10%">' . $row['work_experience'] . ' Years</td>';
            echo '<td valign="top" width="10%">' . substr($row['date_posted'], 0, 10) . '</td>';
            echo '<td valign="top" width="15%">' . $row['date_create'] . '</td>';
            echo '<td valign="top" width="20%">' . '<a href="http://localhost/uploads/' . $row['file'] . '"target="_blank">View Profile</a>' . '</td>';
            echo '<td valign="top" width="5%">'
            . '<a href="editCandidates.php?id=' . $row['candidate_id'] . '">Edit</a></td>';

            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
        echo '</div>';
        ?>
    </body>
</html>