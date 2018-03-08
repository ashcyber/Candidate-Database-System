<style>
    .pagination > li > a, .pagination > li > span{
            padding: 6px 20px;
    }
</style>
<?php
            function build_query($user_search, $sort, $search_key,$exclude_word, $exact_word) {
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
                    
                    if(!empty($exact_word)){
                        $search_query .= " AND (candidate_cv  LIKE '%$exact_word%') "; 
                    }

                    if (!empty($exclude_word)) {
                        $search_query .= " AND (candidate_cv NOT LIKE '%$exclude_word%') ";
                    }
                } 
                
                else {
                    if (!empty($exclude_word)) {
                        $search_query .= " WHERE candidate_cv NOT LIKE '%$exclude_word%' ";
                        if(!empty($exact_word)){
                            $search_query .= " AND (candidate_cv  LIKE '%$exact_word%') "; 
                        }
                    } else{
                        if(!empty($exact_word)){
                            $search_query .= " WHERE candidate_cv  LIKE '%$exact_word%' "; 
                        }
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
                }

                return $search_query;
            }
        
        $sort = $_GET['filter'];
        $user_search = $_GET['search'];
        $search_key = $_GET['search_key'];

            function generate_page_links($sort, $user_search, $search_key, $exclude_word, $exact_word, $db_name , $cur_page, $num_pages) {
            $page_links = '';
            
            // If this page is not the first page, generate the "previous" link
            if ($cur_page > 1) {
              $page_links .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?page=' . ($cur_page - 1) . '&filter=' . $sort . '&search=' . $user_search . '&search_key=' . $search_key . '&exclude_word=' . $exclude_word . '&exact_word=' . $exact_word . '&db=' . $db_name . '">Prev</a></li>';
            }

            // Loop through the pages generating the page number links
            
            if($num_pages > 7){
                $last = 7 + $cur_page; 
            }
            else{
                $last = $num_pages; 
            }
                
            for ($i = 0 + $cur_page; $i <= $last; $i++) {
              if ($cur_page == $i) {
                $page_links .= '<li class="active"><a href="#">'. $i . '</a></li>';
              }
              else {
                $page_links .= '<li><a href="' . $_SERVER['PHP_SELF'] . '?page=' . $i . '&filter=' . $sort . '&search=' . $user_search . '&search_key=' . $search_key . '&exclude_word=' . $exclude_word . '&exact_word=' . $exact_word . '&db=' . $db_name .  '"> ' . $i . '</a></li>';
              }
            }

            // If this page is not the last page, generate the "next" link
            if ($cur_page < $num_pages) {
              $page_links .= '<li><a href="' . $_SERVER['PHP_SELF'] .  '?page=' . ($cur_page + 1) . '&filter=' . $sort . '&search=' . $user_search . '&search_key=' . $search_key . '&exclude_word=' . $exclude_word . '&exact_word=' . $exact_word . '&db=' . $db_name . '">Next</a></li>';
            }
                
            echo '<ul class="pagination">'; 
                return $page_links;
            echo '</ul>'; 
          }

?>