<?php
/**
 * Admin Menu Management
 * 
 * @package InlineDoon
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

class InlineDoon_Admin_Menu
{
    public function __construct()
    {
        add_action('admin_menu', array($this, 'add_admin_menu'));
    }

    /**
     * Add admin menu
     */
    public function add_admin_menu()
    {
        if (!$this->is_user_allowed_to_view_admin()) {
            return;
        }

        add_menu_page(
            'این‌لاین دون',
            'این‌لاین دون',
            'manage_options',
            'inlinedoon-admin',
            array($this, 'render_admin_page'),
            'dashicons-feedback',
            56
        );
    }

    /**
     * Render main admin page
     */
    public function render_admin_page()
    {
        $current_tab = isset($_GET['tab']) ? sanitize_text_field($_GET['tab']) : 'settings';
        ?>
        <div class="wbdn-wrapper">
            <h1>مدیریت این‌لاین دون</h1>
            <nav class="wbdn-tab-wrapper">
                <a href="?page=inlinedoon-admin&tab=settings" class="wbdn-tab-nav-btn <?php echo $current_tab === 'settings' ? 'active' : ''; ?>">تنظیمات</a>
                <a href="?page=inlinedoon-admin&tab=docs" class="wbdn-tab-nav-btn <?php echo $current_tab === 'docs' ? 'active' : ''; ?>">راهنما</a>
            </nav>
            <div class="tab-content">
                <?php
                switch ($current_tab) {
                    case 'settings':
                        $this->render_settings_tab();
                        break;
                    case 'docs':
                        $this->render_docs_tab();
                        break;
                    default:
                        $this->render_settings_tab();
                        break;
                }
                ?>
            </div>
        </div>
        <?php
    }


    /**
     * Render settings tab
     */
    private function render_settings_tab()
    {
        $settings = InlineDoon_Settings::get_instance();
        $settings->render_page();
    }

    /**
     * Render docs tab
     */
    private function render_docs_tab()
    {
        include_once INLINEDOON_PLUGIN_PATH . 'admin/views/admin-docs.php';
    }

    /**
     * Check if user is allowed to view admin
     */
    private function is_user_allowed_to_view_admin()
    {
        if (current_user_can('manage_options')) {
            return true;
        }

        $allowed_roles = get_option('inlinedoon_allowed_roles');
        if (!is_array($allowed_roles) || empty($allowed_roles)) {
            return false;
        }

        $user = wp_get_current_user();
        if (!$user || empty($user->roles)) {
            return false;
        }

        foreach ($user->roles as $role) {
            if (in_array($role, $allowed_roles, true)) {
                return true;
            }
        }
        return false;
    }
}
