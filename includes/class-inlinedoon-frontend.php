<?php

/**
 * InlineDoon Frontend Class
 */

if (!defined('ABSPATH')) {
    exit;
}

class InlineDoon_Frontend
{

    public function __construct()
    {
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        // Register shortcode directly instead of using init action
        $this->register_shortcodes();
    }

    public function enqueue_scripts()
    {


        wp_enqueue_style(
            'swiper-frontend',
            INLINEDOON_PLUGIN_URL . 'public/assets/css/swiper.css',
            array(),
            INLINEDOON_VERSION
        );
        wp_enqueue_style(
            'inlinedoon-frontend',
            INLINEDOON_PLUGIN_URL . 'public/assets/css/frontend.css',
            array(),
            INLINEDOON_VERSION
        );
        wp_enqueue_script(
            'swiper-frontend',
            INLINEDOON_PLUGIN_URL . 'public/assets/js/swiper.js',
            array(),
            INLINEDOON_VERSION,
            true
        );
        wp_enqueue_script(
            'inlinedoon-frontend',
            INLINEDOON_PLUGIN_URL . 'public/assets/js/frontend.js',
            array('swiper-frontend'),
            INLINEDOON_VERSION,
            true
        );

        // Get slider settings
        $slider_settings = get_option('inlinedoon_slider_settings', array());

        // Ensure we have default values if settings are empty
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

        wp_localize_script('inlinedoon-frontend', 'inlinedoon_ajax', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('inlinedoon_nonce')
        ));

        wp_localize_script('inlinedoon-frontend', 'inlinedoon_slider_settings', $slider_settings);
    }

    public function register_shortcodes()
    {
        add_shortcode('inlinedoon', array($this, 'inlinedoon_product_slider_shortcode'));
    }

    public function inlinedoon_product_slider_shortcode($atts)
    {
        static $instance = 0;
        $instance++;

        // Scripts are enqueued via wp_enqueue_scripts; avoid double-enqueue here

        $atts = shortcode_atts(array(
            'cat' => '',
            'include' => '',
            'exclude' => '',
            'link_text' => 'مشاهده همه',
            'link_url' => '', // لینک دلخواه اضافه شد
        ), $atts, 'product_slider');

        $category_slugs = array_filter(array_map('trim', explode(',', $atts['cat'])));
        $manual_ids = array_filter(array_map('intval', explode(',', $atts['include'])));
        $exclude_ids = array_filter(array_map('intval', explode(',', $atts['exclude'])));
        $link_text = sanitize_text_field($atts['link_text']);
        $custom_link_url = esc_url($atts['link_url']); // secure link url
        $slider_id = 'product-slider-' . $instance;

        // Get the first category for the link (or use custom link)
        $category = !empty($category_slugs) ? get_term_by('slug', $category_slugs[0], 'product_cat') : null;
        $category_link = $category ? get_term_link($category) : '#';

        $final_link = $custom_link_url ? $custom_link_url : $category_link;

        $manual_products = [];
        if (!empty($manual_ids)) {
            $manual_products_query = new WP_Query([
                'post_type' => 'product',
                'post__in' => $manual_ids,
                'orderby' => 'post__in',
                'posts_per_page' => count($manual_ids),
            ]);
            $manual_products = $manual_products_query->posts;
        }

        $random_products_query = new WP_Query([
            'post_type' => 'product',
            'posts_per_page' => 12 - count($manual_products),
            'orderby' => 'rand',
            'post__not_in' => array_merge($manual_ids, $exclude_ids),
            'tax_query' => !empty($category_slugs) ? [
                [
                    'taxonomy' => 'product_cat',
                    'field' => 'slug',
                    'terms' => $category_slugs,
                    'operator' => 'IN',
                ],
            ] : [],
            'meta_query' => [
                [
                    'key' => '_stock_status',
                    'value' => 'instock',
                    'compare' => '=',
                ]
            ],
        ]);

        $random_products = $random_products_query->posts;

        $products = array_merge($manual_products, $random_products);



        ob_start();
        global $post;
        $original_post = $post;
    ?>
        <?php if (!empty($products)): ?>
            <div class="slider-products-list">
                <ul>
                    <?php foreach ($products as $product_post): ?>
                        <?php
                        $product = wc_get_product($product_post->ID);
                        ?>
                        <li><?php echo esc_html($product->get_name()); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <div class="swiper <?php echo esc_attr($slider_id); ?>" data-inlinedoon-slider="true" data-product-count="<?php echo count($products); ?>">
            <div class="swiper-wrapper">
                <?php foreach ($products as $product_post): ?>
                    <div class="swiper-slide product">
                        <?php
                        $post = $product_post;
                        setup_postdata($post);
                        wc_get_template_part('content', 'product');
                        ?>
                    </div>
                <?php endforeach; ?>
                <?php
                wp_reset_postdata();
                $post = $original_post;
                ?>
            </div>
        </div>

        <?php if ($category || $custom_link_url): ?>
            <div class="product-slider-link text-center" style="margin-top: 15px;">
                <a href="<?php echo esc_url($final_link); ?>" class="btn-slider-link"
                    style="text-decoration:none; font-weight:600;">
                    <?php echo esc_html($link_text); ?>
                </a>
            </div>
<?php endif;
        return ob_get_clean();
    }
}
