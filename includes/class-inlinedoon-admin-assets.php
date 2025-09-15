<?php
/**
 * Admin Assets Management
 * 
 * @package InlineDoon
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

class InlineDoon_Admin_Assets
{
    public function __construct()
    {
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_editor_assets'));
        add_action('enqueue_block_editor_assets', array($this, 'enqueue_block_editor_assets'));
    }

    /**
     * Enqueue admin scripts and styles
     */
    public function enqueue_admin_scripts($hook)
    {
        $allowed_hooks = array(
            'toplevel_page_inlinedoon-admin',
            'inlinedoon-admin_page_inlinedoon-admin-settings'
        );
        if (!in_array($hook, $allowed_hooks, true)) {
            return;
        }

        wp_enqueue_style(
            'inlinedoon-fonts',
            INLINEDOON_PLUGIN_URL . 'admin/css/fonts.css',
            array(),
            INLINEDOON_VERSION . '.1'
        );

        wp_enqueue_style(
            'inlinedoon-admin',
            INLINEDOON_PLUGIN_URL . 'admin/css/admin.css',
            array('inlinedoon-fonts'),
            INLINEDOON_VERSION . '.1'
        );

        wp_enqueue_script(
            'inlinedoon-admin',
            INLINEDOON_PLUGIN_URL . 'admin/js/admin.js',
            array('jquery'),
            INLINEDOON_VERSION . '.2',
            true
        );
        
        wp_localize_script('inlinedoon-admin', 'inlinedoon_admin_ajax', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('inlinedoon_nonce'),
            'export_nonce' => wp_create_nonce('inlinedoon_export')
        ));
    }

    /**
     * Enqueue editor-only assets on post editor screens
     */
    public function enqueue_editor_assets($hook)
    {
        // Load only on post.php (edit) and post-new.php (add new)
        if ($hook !== 'post.php' && $hook !== 'post-new.php') {
            return;
        }

        wp_enqueue_script(
            'inlinedoon-editor',
            INLINEDOON_PLUGIN_URL . 'admin/js/editor-classic.js',
            array('jquery'),
            INLINEDOON_VERSION . '.1',
            true
        );
    }

    /**
     * Enqueue assets for Gutenberg block editor
     */
    public function enqueue_block_editor_assets()
    {
        wp_enqueue_script(
            'inlinedoon-gutenberg-editor',
            INLINEDOON_PLUGIN_URL . 'admin/js/editor-gutenberg.js',
            array('wp-blocks', 'wp-element', 'wp-edit-post', 'wp-data', 'wp-plugins', 'wp-components', 'wp-compose', 'wp-i18n'),
            INLINEDOON_VERSION . '.1',
            true
        );
        wp_localize_script('inlinedoon-gutenberg-editor', 'InlineDoonGutenberg', array(
            'shortcode' => '[inlinedoon]'
        ));
    }
}
