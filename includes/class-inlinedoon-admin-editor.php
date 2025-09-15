<?php
/**
 * Admin Editor Integration
 * 
 * @package InlineDoon
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

class InlineDoon_Admin_Editor
{
    public function __construct()
    {
        add_action('add_meta_boxes', array($this, 'register_classic_editor_meta_box'));
    }

    /**
     * Register Classic Editor meta box to insert shortcode
     */
    public function register_classic_editor_meta_box()
    {
        $post_types = get_post_types(array('public' => true), 'names');
        foreach ($post_types as $post_type) {
            add_meta_box(
                'inlinedoon-shortcode-box',
                __('InlineDoon', 'inlinedoon'),
                array($this, 'render_classic_editor_meta_box'),
                $post_type,
                'side',
                'default'
            );
        }
    }

    /**
     * Render the Classic Editor meta box
     */
    public function render_classic_editor_meta_box($post)
    {
        $shortcode = '[inlinedoon]';
        ?>
        <div class="inlinedoon-metabox">
            <p>
                <code><?php echo esc_html($shortcode); ?></code>
            </p>
            <p>
                <button type="button" class="button button-primary" id="inlinedoon-insert-shortcode" data-shortcode="<?php echo esc_attr($shortcode); ?>">
                    <?php esc_html_e('Insert InlineDoon', 'inlinedoon'); ?>
                </button>
            </p>
        </div>
        <?php
    }
}
