<?php
/**
 * Uninstall Bargardoon Wallet Plugin
 */

// If uninstall not called from WordPress, exit
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// Remove database tables and options
global $wpdb;

// Remove plugin options
delete_option('inlinedoon_settings');
delete_option('inlinedoon_version');

// Remove user meta data
$wpdb->query("DELETE FROM {$wpdb->usermeta} WHERE meta_key LIKE 'inlinedoon_%'");


// Clear any cached data
wp_cache_flush();
