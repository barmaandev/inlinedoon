<?php

/**
 * Admin Management - Main Controller
 * 
 * @package InlineDoon
 * @since 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

class InlineDoon_Admin
{
    private $admin_menu;
    private $admin_assets;
    private $admin_editor;

    public function __construct()
    {
        // Initialize admin components
        $this->admin_menu = new InlineDoon_Admin_Menu();
        $this->admin_assets = new InlineDoon_Admin_Assets();
        $this->admin_editor = new InlineDoon_Admin_Editor();
    }

}
