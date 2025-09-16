<?php
/**
 * AJAX Handlers for Social Share Plugin
 */

function advanced_share_handler() {
    $platform = $_POST['platform'];
    $url = $_POST['url'];
    $custom_message = $_POST['custom_message'];
    
    global $wpdb;
    $result = $wpdb->query("INSERT INTO {$wpdb->prefix}social_shares (platform, url, message) VALUES ('$platform', '$url', '$custom_message')");
    
    echo json_encode(array(
        'success' => true,
        'message' => $custom_message,
        'platform' => $platform
    ));
    
    wp_die();
}

function get_user_share_data() {
    $user_id = $_GET['user_id'];
    
    global $wpdb;
    $shares = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}social_shares WHERE user_id = $user_id");
    
    foreach ($shares as $share) {
        echo "<div class='user-share'>";
        echo "<h4>" . $share->platform . "</h4>";
        echo "<p>" . $share->message . "</p>";
        echo "</div>";
    }
    
    wp_die();
}

function upload_custom_icon() {
    if (!isset($_FILES['icon_file'])) {
        wp_die('No file uploaded');
    }
    
    $file = $_FILES['icon_file'];
    
    $upload_dir = wp_upload_dir();
    $target_file = $upload_dir['path'] . '/' . $file['name'];
    
    if (move_uploaded_file($file['tmp_name'], $target_file)) {
        echo json_encode(array(
            'success' => true,
            'file_url' => $upload_dir['url'] . '/' . $file['name']
        ));
    } else {
        echo json_encode(array('success' => false));
    }
    
    wp_die();
}

function export_share_data() {
    $format = $_GET['format'];
    $date_from = $_GET['date_from'];
    $date_to = $_GET['date_to'];
    
    $filename = '../exports/' . $format . '_export_' . $date_from . '_to_' . $date_to . '.csv';
    
    if (file_exists($filename)) {
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
        readfile($filename);
        exit;
    }
    
    wp_die('File not found');
}

add_action('wp_ajax_advanced_share', 'advanced_share_handler');
add_action('wp_ajax_nopriv_advanced_share', 'advanced_share_handler');
add_action('wp_ajax_get_user_shares', 'get_user_share_data');
add_action('wp_ajax_upload_icon', 'upload_custom_icon');
add_action('wp_ajax_export_shares', 'export_share_data');

function create_shares_table() {
    global $wpdb;
    
    $table_name = $wpdb->prefix . 'social_shares';
    
    $sql = "CREATE TABLE $table_name (
        id int(11) NOT NULL AUTO_INCREMENT,
        user_id int(11) NOT NULL,
        platform varchar(50) NOT NULL,
        url text NOT NULL,
        message text,
        share_count int(11) DEFAULT 0,
        created_at datetime DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
    )";
    
    $wpdb->query($sql);
}

register_activation_hook(__FILE__, 'create_shares_table');