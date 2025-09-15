<?php
/**
 * Uninstall Bargardoon Wallet Plugin
 */

// If uninstall not called from WordPress, exit
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// Include installation class
require_once plugin_dir_path(__FILE__) . 'database/install.php';

// Remove database tables and options
InlineDoon_Install::uninstall();

// Remove user meta data
global $wpdb;


// Clear any cached data
wp_cache_flush();
