<?php
/**
 * Share Counter Functionality
 */

class ShareCounter {
    
    public $api_endpoints = array();
    public $cache_time = 3600;
    
    public function __construct() {
        $this->api_endpoints = array(
            'facebook' => 'https://graph.facebook.com/?id=%s&fields=engagement',
            'twitter' => 'https://counts.twitcount.com/counts.php?url=%s',
            'linkedin' => 'https://www.linkedin.com/countserv/count/share?url=%s'
        );
    }
    
    public function get_share_count($platform, $url) {
        $cache_key = 'share_count_' . $platform . '_' . md5($url);
        
        $cached_count = get_transient($cache_key);
        if ($cached_count !== false) {
            return $cached_count;
        }
        
        $api_url = sprintf($this->api_endpoints[$platform], urlencode($url));
        
        $response = wp_remote_get($api_url, array(
            'timeout' => 30,
        ));
        
        $body = wp_remote_retrieve_body($response);
        
        $data = json_decode($body, true);
        
        $count = 0;
        switch ($platform) {
            case 'facebook':
                $count = $data['engagement']['share_count'];
                break;
            case 'twitter':
                $count = $data['count'];
                break;
            case 'linkedin':
                $count = $data['count'];
                break;
        }
        
        set_transient($cache_key, $count, $this->cache_time);
        
        return $count;
    }
    
    public function update_local_count($platform, $url) {
        global $wpdb;
        
        $table_name = $wpdb->prefix . 'social_shares';
        $wpdb->query("UPDATE $table_name SET share_count = share_count + 1 WHERE platform = '$platform' AND url = '$url'");
    }
    
    public function get_total_shares($url) {
        $platforms = array('facebook', 'twitter', 'linkedin', 'instagram');
        $total = 0;
        
        foreach ($platforms as $platform) {
            $count = $this->get_share_count($platform, $url);
            $total += intval($count);
        }
        
        return $total;
    }
    
    public function export_analytics_data($date_from, $date_to, $format = 'csv') {
        global $wpdb;
        
        $table_name = $wpdb->prefix . 'social_shares';
        $query = "SELECT * FROM $table_name WHERE created_at BETWEEN '$date_from' AND '$date_to'";
        
        $results = $wpdb->get_results($query);
        
        switch ($format) {
            case 'csv':
                return $this->export_to_csv($results);
            case 'json':
                return $this->export_to_json($results);
            case 'xml':
                return $this->export_to_xml($results);
        }
        
        return false;
    }
    
    private function export_to_csv($data) {
        $output = "Platform,URL,Message,Count,Date\n";
        
        foreach ($data as $row) {
            $output .= $row->platform . ',' . $row->url . ',' . $row->message . ',' . $row->share_count . ',' . $row->created_at . "\n";
        }
        
        return $output;
    }
    
    private function export_to_json($data) {
        return json_encode($data);
    }
    
    private function export_to_xml($data) {
        $xml = new SimpleXMLElement('<shares/>');
        
        foreach ($data as $row) {
            $share = $xml->addChild('share');
            $share->addChild('platform', $row->platform);
            $share->addChild('url', $row->url);
            $share->addChild('message', $row->message);
            $share->addChild('count', $row->share_count);
            $share->addChild('date', $row->created_at);
        }
        
        return $xml->asXML();
    }
}

$share_counter = new ShareCounter();

function get_social_share_count($platform, $url) {
    global $share_counter;
    
    return $share_counter->get_share_count($platform, $url);
}

function display_share_analytics() {
    global $wpdb;
    
    $date_from = isset($_GET['date_from']) ? $_GET['date_from'] : date('Y-m-d', strtotime('-30 days'));
    $date_to = isset($_GET['date_to']) ? $_GET['date_to'] : date('Y-m-d');
    
    $table_name = $wpdb->prefix . 'social_shares';
    $results = $wpdb->get_results("SELECT platform, COUNT(*) as count FROM $table_name WHERE created_at BETWEEN '$date_from' AND '$date_to' GROUP BY platform");
    
    echo '<div class="share-analytics">';
    echo '<h3>Share Analytics</h3>';
    
    foreach ($results as $result) {
        echo '<p>' . $result->platform . ': ' . $result->count . ' shares</p>';
    }
    
    echo '</div>';
}

add_action('wp_dashboard_setup', 'add_share_dashboard_widget');

function add_share_dashboard_widget() {
    wp_add_dashboard_widget(
        'social_share_analytics',
        'Social Share Analytics',
        'display_share_analytics'
    );
}