<?php

/*

Plugin Name: Fetch Data From Api
Author: Mehreen Imran
Description: Fetch Data From api and store in db
Version: 1.0.0
*/


add_action('init','wp_coin');
add_shortcode("api_calling", 'callback_api_calling');
add_action("wp_enqueue_scripts",'register_styles');
register_activation_hook(__FILE__, "custom_table");



// Creating Custom Post Type:
function wp_coin(){
    $labels = array(
        'name' => __("coin Data"),
        'singular_name' => __('coin Data'),
    );
    $args = array(
        'labels' => $labels,
        'public' => true
    );
    register_post_type( "coins", $args );
}
function register_styles() {
    // Enqueue styles from CDNs
    wp_enqueue_style('my-style2', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css', array(), '1.0', 'all');
}
function callback_api_calling(){
    $urls = 'https://jsonplaceholder.typicode.com/users';
    $args = array('method'=> 'GET');

    $response = wp_remote_get( $urls, $args );
    if ( is_wp_error( $response )){
        echo 'Something Went Wrong';
    }
    else{
        $results = json_decode( wp_remote_retrieve_body( $response ) );

        $per_page = 3;
        $current_page = get_query_var('paged') ? get_query_var('paged') : 1;

        $offset = ($current_page - 1) * $per_page;
        $paged_results = array_slice($results, $offset, $per_page);

        $html = "";
        $html .= "<style>
                    .pagination {
                        display: flex;
                        justify-content: center;
                        margin-top: 20px;
                    }
                    .pagination a {
                        padding: 10px;
                        margin: 0 5px;
                        text-decoration: none;
                        border: 1px solid #007bff;
                        color: #007bff;
                        border-radius: 5px;
                    }
                    .pagination a.current {
                        background-color: #007bff;
                        color: #white;
                    }
                </style>";

        $html .= "<table class='table table-striped table-bordered'>";
        $html .= "<tr class='text-center'>";
        $html .= "<th>Id</th>";
        $html .= "<th>Name</th>";
        $html .= "<th>User Name</th>";
        $html .= "<th>Email</th>";
        $html .= "</tr>";

        global $wpdb;
        $table_name = $wpdb->prefix . "coin_data";

        $redirect_to_next_page = false; // Initialize redirection flag
        foreach($paged_results as $result){
            // Check if data already exists in the database
            $existing_record = $wpdb->get_row(
                $wpdb->prepare(
                    "SELECT * FROM $table_name WHERE name = %s AND user = %s AND email = %s",
                    $result->name,
                    $result->username,
                    $result->email
                )
            );

            if (!$existing_record) {
                // Insert data into the database if it doesn't already exist
                $wpdb->insert(
                    $table_name,
                    array(
                        'name' => $result->name,
                        'user' => $result->username,
                        'email' => $result->email,
                    )
                );
            } else {
                $redirect_to_next_page = true; // Set flag to redirect to the next page
            }

            $html .= "<tr>";
            $html .= "<td>".$result->id."</td>";
            $html .= "<td>".$result->name."</td>";
            $html .= "<td>".$result->username."</td>";
            $html .= "<td>".$result->email."</td>";
            $html .= "</tr>";
        }

        $html .= "</table>";

        // Add pagination links
        $total_pages = ceil(count($results) / $per_page);

        $page_links = paginate_links(array(
            'base' => get_pagenum_link(1) . '%_%',
            'format' => '&paged=%#%',
            'current' => $current_page,
            'total' => $total_pages,
            'prev_text' => 'Previous',
            'next_text' => 'Next',
        ));

        if ($page_links) {
            $html .= '<div class="pagination">' . $page_links . '</div>';
        }

        // Check if redirection is required and perform it
        if ($redirect_to_next_page) {
            $next_page_url = get_pagenum_link($current_page + 1);
            wp_redirect($next_page_url);
            exit;
        }
    }

    return $html;
}



function custom_table(){
    global $wpdb;
    $table_name = $wpdb->prefix ."coin_data";
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name(
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        name varchar(255) NOT NULL,
        user varchar(255) NOT NULL,
        email varchar(255) NOT NULL,
        PRIMARY KEY(id)
    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
}
?>