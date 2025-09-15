<?php
/**
 * Plugin Name: InlineDoon
 * Description: Add carousel of products  into desire location.
 * Version: 1.0.0
 * Author: Barmaan Shokoohi
 * Author URI: https://webdoon.ir
 * Text Domain: inlinedoon
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}
// Define plugin constants (unique to avoid collisions with other plugins)
if (!defined('INLINEDOON_VERSION')) {
    define('INLINEDOON_VERSION', '1.0.0');
}
if (!defined('INLINEDOON_PLUGIN_URL')) {
    define('INLINEDOON_PLUGIN_URL', plugin_dir_url(__FILE__));
}
if (!defined('INLINEDOON_PLUGIN_PATH')) {
    define('INLINEDOON_PLUGIN_PATH', plugin_dir_path(__FILE__));
}

// Includes
require_once INLINEDOON_PLUGIN_PATH . 'includes/class-inlinedoon-frontend.php';
require_once INLINEDOON_PLUGIN_PATH . 'includes/class-inlinedoon-admin-menu.php';
require_once INLINEDOON_PLUGIN_PATH . 'includes/class-inlinedoon-admin-assets.php';
require_once INLINEDOON_PLUGIN_PATH . 'includes/class-inlinedoon-admin-editor.php';
require_once INLINEDOON_PLUGIN_PATH . 'includes/class-inlinedoon-admin.php';
require_once INLINEDOON_PLUGIN_PATH . 'includes/class-inlinedoon-settings.php';

// Include JDF library for Persian dates only if not already loaded by another plugin
if (!function_exists('jdate') && file_exists(INLINEDOON_PLUGIN_PATH . 'includes/libraries/jdf/jdf.php')) {
    require_once INLINEDOON_PLUGIN_PATH . 'includes/libraries/jdf/jdf.php';
}

// Activation hook
register_activation_hook(__FILE__, 'inlinedoon_activate');

function inlinedoon_activate()
{
    $plugin = new InlineDoon();
}

class InlineDoon
{

    private $inlinedoon_admin;

    public function __construct()
    {
        // Initialize hooks
        $this->init_hooks();
    }

    private function init_hooks()
    {
        add_action('init', array($this, 'init'), 10);
    }

    public function init()
    {
        // Initialize frontend assets handler
        if (class_exists('InlineDoon_Frontend')) {
            new InlineDoon_Frontend();
        }


        // Initialize admin (registers menus) only in dashboard
        if (is_admin() && class_exists('InlineDoon_Admin')) {
            $this->inlinedoon_admin = new InlineDoon_Admin();
        }
    }


}
// Initialize the plugin
new InlineDoon();
