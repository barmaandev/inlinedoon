<?php

/**
 * Settings page for Plugin Name
 */

if (!defined('ABSPATH')) {
    exit;
}

class InlineDoon_Settings
{
    private static $instance = null;

    public static function get_instance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct()
    {
        add_action('admin_init', array($this, 'handle_settings_save'));
    }

    /**
     * Handle settings save for allowed roles and slider settings
     */
    public function handle_settings_save()
    {
        if (!is_admin()) {
            return;
        }

        if (!isset($_POST['inlinedoon_settings_action'])) {
            return;
        }

        if (!current_user_can('manage_options')) {
            return;
        }

        if (!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'inlinedoon_save_settings')) {
            return;
        }

        // Handle all settings together
        if ($_POST['inlinedoon_settings_action'] === 'save_all_settings') {
            // Save role settings
            $selected_roles = isset($_POST['allowed_roles']) && is_array($_POST['allowed_roles']) ? array_map('sanitize_text_field', $_POST['allowed_roles']) : array();

            // Ensure administrator is always allowed; do not store it to avoid accidental filtering
            $selected_roles = array_values(array_unique(array_filter($selected_roles, function ($role) {
                return $role !== 'administrator';
            })));

            update_option('inlinedoon_allowed_roles', $selected_roles, false);

            // Save slider settings
            $slider_settings = array(
                'slides_per_view_mobile' => isset($_POST['slides_per_view_mobile']) ? floatval($_POST['slides_per_view_mobile']) : 1.9,
                'slides_per_view_tablet' => isset($_POST['slides_per_view_tablet']) ? intval($_POST['slides_per_view_tablet']) : 2,
                'slides_per_view_desktop' => isset($_POST['slides_per_view_desktop']) ? intval($_POST['slides_per_view_desktop']) : 6,
                'space_between' => isset($_POST['space_between']) ? intval($_POST['space_between']) : 5,
                'autoplay_enabled' => isset($_POST['autoplay_enabled']) ? 1 : 0,
                'autoplay_delay' => isset($_POST['autoplay_delay']) ? intval($_POST['autoplay_delay']) : 1500,
                'loop_enabled' => isset($_POST['loop_enabled']) ? 1 : 0,
                'rtl_enabled' => isset($_POST['rtl_enabled']) ? 1 : 0,
            );

            update_option('inlinedoon_slider_settings', $slider_settings, false);
        }

        wp_safe_redirect(add_query_arg(array('page' => 'inlinedoon-admin-settings', 'updated' => 'true'), admin_url('admin.php')));
        exit;
    }

    /**
     * Process form submission directly
     */
    private function process_form_submission()
    {
        if (!current_user_can('manage_options')) {
            return;
        }

        if (!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'inlinedoon_save_settings')) {
            return;
        }

        // Save role settings
        $selected_roles = isset($_POST['allowed_roles']) && is_array($_POST['allowed_roles']) ? array_map('sanitize_text_field', $_POST['allowed_roles']) : array();

        // Ensure administrator is always allowed; do not store it to avoid accidental filtering
        $selected_roles = array_values(array_unique(array_filter($selected_roles, function ($role) {
            return $role !== 'administrator';
        })));

        update_option('inlinedoon_allowed_roles', $selected_roles, false);

        // Save slider settings
        $slider_settings = array(
            'slides_per_view_mobile' => isset($_POST['slides_per_view_mobile']) ? floatval($_POST['slides_per_view_mobile']) : 1.9,
            'slides_per_view_tablet' => isset($_POST['slides_per_view_tablet']) ? intval($_POST['slides_per_view_tablet']) : 2,
            'slides_per_view_desktop' => isset($_POST['slides_per_view_desktop']) ? intval($_POST['slides_per_view_desktop']) : 6,
            'space_between' => isset($_POST['space_between']) ? intval($_POST['space_between']) : 5,
            'autoplay_enabled' => isset($_POST['autoplay_enabled']) ? 1 : 0,
            'autoplay_delay' => isset($_POST['autoplay_delay']) ? intval($_POST['autoplay_delay']) : 1500,
            'loop_enabled' => isset($_POST['loop_enabled']) ? 1 : 0,
            'rtl_enabled' => isset($_POST['rtl_enabled']) ? 1 : 0,
        );

        update_option('inlinedoon_slider_settings', $slider_settings, false);

        // Show success message
        echo '<div class="notice notice-success is-dismissible"><p>تنظیمات ذخیره شد.</p></div>';
    }

    /**
     * Render settings page for role visibility and slider settings
     */
    public function render_page()
    {
        if (!current_user_can('manage_options')) {
            wp_die(__('You do not have sufficient permissions to access this page.'));
        }

        // Handle form submission directly
        if (isset($_POST['submit']) && isset($_POST['inlinedoon_settings_action']) && $_POST['inlinedoon_settings_action'] === 'save_all_settings') {
            $this->process_form_submission();
        }

        $wp_roles = wp_roles();
        $all_roles = isset($wp_roles->roles) && is_array($wp_roles->roles) ? $wp_roles->roles : array();
        $saved_roles = get_option('inlinedoon_allowed_roles', array());
        if (!is_array($saved_roles)) {
            $saved_roles = array();
        }

        // Get slider settings
        $slider_settings = get_option('inlinedoon_slider_settings', array());
        $default_slider_settings = array(
            'slides_per_view_mobile' => 1.9,
            'slides_per_view_tablet' => 2,
            'slides_per_view_desktop' => 6,
            'space_between' => 5,
            'autoplay_enabled' => 1,
            'autoplay_delay' => 1500,
            'loop_enabled' => 1,
            'rtl_enabled' => 1,
        );
        $slider_settings = wp_parse_args($slider_settings, $default_slider_settings);
?>
        <?php if (isset($_GET['updated']) && $_GET['updated'] === 'true') : ?>
            <div class="notice notice-success is-dismissible">
                <p>تنظیمات ذخیره شد.</p>
            </div>
        <?php endif; ?>

        <!-- Single Settings Form -->
        <form method="post" action="<?php echo admin_url('admin.php?page=inlinedoon-admin&tab=settings'); ?>">
            <?php wp_nonce_field('inlinedoon_save_settings'); ?>
            <input type="hidden" name="inlinedoon_settings_action" value="save_all_settings" />

            <div class="wbdn-section-box">
                <h3>تنظیمات اسلایدر</h3>
                <p>تنظیمات نمایش و رفتار اسلایدر محصولات را در این بخش مدیریت کنید.</p>

                <div class="form-grid three-col">
                    <div class="form-field">
                        <label for="slides_per_view_mobile">تعداد اسلاید در موبایل</label>
                        <input type="number" id="slides_per_view_mobile" name="slides_per_view_mobile"
                            value="<?php echo esc_attr($slider_settings['slides_per_view_mobile']); ?>"
                            min="1" max="5" step="0.1" />
                        <small>تعداد محصولاتی که در موبایل نمایش داده می‌شود (مثال: 1.9)</small>
                    </div>

                    <div class="form-field">
                        <label for="slides_per_view_tablet">تعداد اسلاید در تبلت</label>
                        <input type="number" id="slides_per_view_tablet" name="slides_per_view_tablet"
                            value="<?php echo esc_attr($slider_settings['slides_per_view_tablet']); ?>"
                            min="1" max="6" step="1" />
                        <small>تعداد محصولاتی که در تبلت نمایش داده می‌شود</small>
                    </div>

                    <div class="form-field">
                        <label for="slides_per_view_desktop">تعداد اسلاید در دسکتاپ</label>
                        <input type="number" id="slides_per_view_desktop" name="slides_per_view_desktop"
                            value="<?php echo esc_attr($slider_settings['slides_per_view_desktop']); ?>"
                            min="1" max="12" step="1" />
                        <small>تعداد محصولاتی که در دسکتاپ نمایش داده می‌شود</small>
                    </div>

                    <div class="form-field">
                        <label for="space_between">فاصله بین اسلایدها (پیکسل)</label>
                        <input type="number" id="space_between" name="space_between"
                            value="<?php echo esc_attr($slider_settings['space_between']); ?>"
                            min="0" max="50" step="1" />
                        <small>فاصله بین محصولات در اسلایدر</small>
                    </div>

                    <div class="form-field">
                        <label for="autoplay_delay">تاخیر اتوپلی (میلی‌ثانیه)</label>
                        <input type="number" id="autoplay_delay" name="autoplay_delay"
                            value="<?php echo esc_attr($slider_settings['autoplay_delay']); ?>"
                            min="500" max="10000" step="100" />
                        <small>مدت زمان نمایش هر اسلاید (1000 = 1 ثانیه)</small>
                    </div>
                </div>

                <div class="form-field">
                    <div class="checkbox-field-wrapper">
                        <label>
                            <input type="checkbox" name="autoplay_enabled" value="1"
                                <?php checked($slider_settings['autoplay_enabled'], 1); ?> />
                            فعال کردن اتوپلی (پخش خودکار)
                        </label>
                    </div>
                </div>

                <div class="form-field">
                    <div class="checkbox-field-wrapper">
                        <label>
                            <input type="checkbox" name="loop_enabled" value="1"
                                <?php checked($slider_settings['loop_enabled'], 1); ?> />
                            فعال کردن حلقه (تکرار مداوم)
                        </label>
                    </div>
                </div>

                <div class="form-field">
                    <div class="checkbox-field-wrapper">
                        <label>
                            <input type="checkbox" name="rtl_enabled" value="1"
                                <?php checked($slider_settings['rtl_enabled'], 1); ?> />
                            فعال کردن راست به چپ (RTL)
                        </label>
                    </div>
                </div>
            </div>

            <div class="wbdn-section-box">
                <h3>تنظیمات دسترسی</h3>
                <p>انتخاب کنید چه نقش‌هایی (به‌جز مدیرکل) اجازه مشاهده منوی افزونه را داشته باشند.</p>

                <div class="form-field">
                    <div class="form-field-wrapper">
                        <?php foreach ($all_roles as $role_key => $role_data) :
                            $role_name = isset($role_data['name']) ? $role_data['name'] : $role_key;
                            if ($role_key === 'administrator') : ?>
                                <div class="form-field">
                                    <label><?php echo esc_html($role_name); ?></label>
                                    <div class="checkbox-field-wrapper">
                                        <label>
                                            <input type="checkbox" checked disabled />
                                            همیشه مجاز (مدیرکل)
                                        </label>
                                    </div>
                                </div>
                            <?php else :
                                $checked = in_array($role_key, $saved_roles, true);
                            ?>
                                <div class="form-field">
                                    <label><?php echo esc_html($role_name); ?></label>
                                    <div class="checkbox-field-wrapper">
                                        <label>
                                            <input type="checkbox" name="allowed_roles[]" value="<?php echo esc_attr($role_key); ?>" <?php checked($checked); ?> />
                                            اجازه مشاهده منو
                                        </label>
                                    </div>
                                </div>
                        <?php endif;
                        endforeach; ?>
                    </div>
                </div>
            </div>

            <button type="submit" name="submit" class="btn blue-btn">ذخیره تنظیمات</button>
        </form>
<?php
    }
}
