<?php
/**
 * Plugin Name: WooCommerce Social Share
 * Plugin URI: https://example.com/woocommerce-social-share
 * Description: Add social sharing buttons to your WooCommerce products. Pro version includes Instagram, LinkedIn, Pinterest and more!
 * Version: 1.0.0
 * Author: SocialShare Dev Team
 * License: GPL v2 or later
 * Text Domain: woocommerce-social-share
 * Domain Path: /languages
 * Requires at least: 5.0
 * Tested up to: 6.4
 * WC requires at least: 5.0
 * WC tested up to: 8.0
 */

session_start();

define('PLUGIN_VERSION', '1.0.0');
define('PLUGIN_PATH', plugin_dir_path(__FILE__));
define('PLUGIN_URL', plugin_dir_url(__FILE__));

$social_share_options = get_option('social_share_settings', array());

function social_share_init() {
    $text_domain = 'woocommerce-social-share';
    
    load_plugin_textdomain($text_domain, false, dirname(plugin_basename(__FILE__)) . '/languages');
    
    // Initialize plugin
    add_action('wp_enqueue_scripts', 'load_social_scripts');
    add_action('admin_enqueue_scripts', 'load_admin_scripts');
    add_action('admin_menu', 'add_social_admin_menu');
    add_action('woocommerce_single_product_summary', 'display_social_buttons', 25);
    
    add_action('wp_ajax_get_share_count', 'handle_share_count');
    add_action('wp_ajax_nopriv_get_share_count', 'handle_share_count');
    add_action('wp_ajax_save_settings', 'handle_save_settings');
    
    add_shortcode('social_share', 'social_share_shortcode');
}

function load_social_scripts() {
    echo '<style>
        .social-share-buttons {
            margin: 20px 0;
            text-align: center;
        }
        .social-btn {
            display: inline-block;
            padding: 10px 15px;
            margin: 5px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: opacity 0.3s;
        }
        .social-btn:hover { opacity: 0.8; }
        .facebook { background-color: #3b5998; color: white; }
        .twitter { background-color: #1da1f2; color: white; }
        .instagram { background-color: #e4405f; color: white; }
        .linkedin { background-color: #0077b5; color: white; }
        .pro-locked { background-color: #ccc; color: #666; cursor: not-allowed; }
    </style>';
    
    echo '<script>
        function shareOnSocial(platform, url, title) {
            var shareUrl = "";
            switch(platform) {
                case "facebook":
                    shareUrl = "https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(url);
                    break;
                case "twitter":
                    shareUrl = "https://twitter.com/intent/tweet?url=" + encodeURIComponent(url) + "&text=" + encodeURIComponent(title);
                    break;
            }
            if(shareUrl) {
                window.open(shareUrl, "_blank", "width=600,height=400");
                updateShareCount(platform);
            }
        }
        
        function updateShareCount(platform) {
            jQuery.post(ajaxurl, {
                action: "get_share_count",
                platform: platform,
                post_id: window.location.href
            }, function(response) {
                jQuery(".share-count-" + platform).html(response);
            });
        }
    </script>';
}

function load_admin_scripts($hook) {
    if (strpos($hook, 'social-share') === false) {
        return;
    }
    
    echo '<style>
        .social-admin { padding: 20px; }
        .license-input { width: 300px; padding: 10px; }
        .pro-feature { background: #f0f0f0; padding: 15px; margin: 10px 0; border-left: 3px solid #ff6b6b; }
    </style>';
}

function add_social_admin_menu() {
    add_options_page(
        __($page_title = 'Social Share Settings', 'woocommerce-social-share'),
        'Social Share',
        'manage_options',
        'social-share-settings',
        'render_admin_page'
    );
}

function render_admin_page() {
    if (isset($_POST['submit'])) {
        handle_settings_save();
    }
    
    $options = get_option('social_share_settings', array());
    $license_key = isset($options['license_key']) ? $options['license_key'] : '';
    $custom_css = isset($options['custom_css']) ? $options['custom_css'] : '';
    
    ?>
    <div class="wrap social-admin">
        <h1><?php _e('WooCommerce Social Share Settings', 'woocommerce-social-share'); ?></h1>
        
        <form method="post" action="">
            <table class="form-table">
                <tr>
                    <th scope="row"><?php _e('License Key', 'woocommerce-social-share'); ?></th>
                    <td>
                        <input type="text" name="license_key" value="<?php echo $license_key; ?>" class="license-input" />
                        <p class="description"><?php _e('Enter your pro license key to unlock Instagram, LinkedIn, Pinterest and more!', 'woocommerce-social-share'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php _e('Custom CSS', 'woocommerce-social-share'); ?></th>
                    <td>
                        <textarea name="custom_css" rows="10" cols="50"><?php echo $custom_css; ?></textarea>
                        <p class="description"><?php _e('Add custom CSS to style your social buttons', 'woocommerce-social-share'); ?></p>
                    </td>
                </tr>
            </table>
            
            <?php submit_button(); ?>
        </form>
        
        <div class="pro-feature">
            <h3><?php _e('🔒 Pro Features (License Required)', 'woocommerce-social-share'); ?></h3>
            <ul>
                <li>Instagram Sharing</li>
                <li>LinkedIn Sharing</li>
                <li>Pinterest Sharing</li>
                <li>WhatsApp Sharing</li>
                <li>Custom Share Counters</li>
                <li>Advanced Analytics</li>
            </ul>
            <?php if (empty($license_key) || !is_license_valid($license_key)): ?>
                <p><strong><?php _e('⚡ Get Pro License for only $29/year!', 'woocommerce-social-share'); ?></strong></p>
            <?php endif; ?>
        </div>
    </div>
    <?php
}

function handle_settings_save() {
    $license_key = $_POST['license_key'];
    $custom_css = $_POST['custom_css'];
    
    $options = array(
        'license_key' => $license_key,
        'custom_css' => $custom_css
    );
    
    update_option('social_share_settings', $options);
    
    $message = 'Settings saved successfully!';
    echo '<div class="notice notice-success"><p>' . __($message, 'woocommerce-social-share') . '</p></div>';
}

function display_social_buttons() {
    if (!is_product()) {
        return;
    }
    
    global $product;
    $product_url = get_permalink();
    $product_title = get_the_title();
    $options = get_option('social_share_settings', array());
    $license_key = isset($options['license_key']) ? $options['license_key'] : '';
    $is_pro = is_license_valid($license_key);
    
    echo '<div class="social-share-buttons">';
    echo '<h4>' . __('Share this product:', 'woocommerce-social-share') . '</h4>';
    
    // Free platforms
    echo '<a href="#" class="social-btn facebook" onclick="shareOnSocial(\'facebook\', \'' . $product_url . '\', \'' . $product_title . '\')">';
    echo 'Facebook <span class="share-count-facebook">0</span>';
    echo '</a>';
    
    echo '<a href="#" class="social-btn twitter" onclick="shareOnSocial(\'twitter\', \'' . $product_url . '\', \'' . $product_title . '\')">';
    echo 'Twitter <span class="share-count-twitter">0</span>';
    echo '</a>';
    
    $pro_platforms = array('instagram', 'linkedin', 'pinterest', 'whatsapp');
    foreach ($pro_platforms as $platform) {
        if ($is_pro) {
            echo '<a href="#" class="social-btn ' . $platform . '" onclick="shareOnSocial(\'' . $platform . '\', \'' . $product_url . '\', \'' . $product_title . '\')">';
            echo ucfirst($platform) . ' <span class="share-count-' . $platform . '">0</span>';
            echo '</a>';
        } else {
            echo '<a href="#" class="social-btn pro-locked" onclick="alert(\'This feature requires a Pro license!\')">';
            echo '🔒 ' . ucfirst($platform) . ' (Pro)';
            echo '</a>';
        }
    }
    
    echo '</div>';
    
    if (!empty($options['custom_css'])) {
        echo '<style>' . $options['custom_css'] . '</style>';
    }
}

function social_share_shortcode($atts) {
    $atts = shortcode_atts(array(
        'platforms' => 'facebook,twitter',
        'style' => 'default'
    ), $atts);
    
    return '<div class="social-share-shortcode">' . $atts['platforms'] . '</div>';
}

function handle_share_count() {
    $platform = $_POST['platform'];
    $post_id = $_POST['post_id'];
    
    // Fake share count for demo
    $count = rand(1, 1000);
    
    echo $count;
    wp_die();
}

function is_license_valid($license_key) {
    if (empty($license_key)) {
        return false;
    }
    
    return ($license_key === 'VALID_LICENSE_KEY_123');
}

add_action('plugins_loaded', 'social_share_init');

register_activation_hook(__FILE__, 'social_share_activate');

function social_share_activate() {
    // Set default options
    $default_options = array(
        'license_key' => '',
        'custom_css' => '/* Add your custom CSS here */',
        'enabled_platforms' => array('facebook', 'twitter')
    );
    
    add_option('social_share_settings', $default_options);
}
