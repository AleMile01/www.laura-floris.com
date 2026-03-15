<?php

if (!defined('ABSPATH')) {
    exit;
}

function laura_floris_theme_setup() {
    load_theme_textdomain('laura-floris', get_template_directory() . '/languages');

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    add_theme_support('responsive-embeds');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script'
    ));

    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');

    register_nav_menus(array(
        'primary' => __('Menu principale', 'laura-floris'),
        'footer'  => __('Menu footer', 'laura-floris'),
    ));
}
add_action('after_setup_theme', 'laura_floris_theme_setup');

function laura_floris_enqueue_assets() {
    wp_enqueue_script(
        'tailwind-cdn',
        'https://cdn.tailwindcss.com',
        array(),
        null,
        false
    );

    wp_enqueue_style(
        'laura-floris-style',
        get_stylesheet_uri(),
        array(),
        '4.2'
    );

    wp_enqueue_script(
        'laura-floris-theme-js',
        get_template_directory_uri() . '/assets/theme.js',
        array(),
        '4.2',
        true
    );

    if (class_exists('WooCommerce')) {
        wp_enqueue_script('wc-cart-fragments');
    }
}
add_action('wp_enqueue_scripts', 'laura_floris_enqueue_assets');

function laura_floris_is_woocommerce_available() {
    return class_exists('WooCommerce') && function_exists('WC');
}

function laura_floris_ensure_woocommerce_pages() {
    if (!class_exists('WooCommerce') || !function_exists('wc_create_page')) {
        return;
    }

    $required_pages = array(
        'woocommerce_cart_page_id' => array(
            'slug'    => 'cart',
            'title'   => 'Cart',
            'content' => '[woocommerce_cart]',
        ),
        'woocommerce_checkout_page_id' => array(
            'slug'    => 'checkout',
            'title'   => 'Checkout',
            'content' => '[woocommerce_checkout]',
        ),
    );

    foreach ($required_pages as $option_name => $page_config) {
        $page_id = (int) get_option($option_name);
        $page = $page_id > 0 ? get_post($page_id) : null;

        if ($page && 'page' === $page->post_type && 'trash' !== $page->post_status) {
            continue;
        }

        wc_create_page(
            $page_config['slug'],
            $option_name,
            $page_config['title'],
            $page_config['content']
        );
    }
}
add_action('init', 'laura_floris_ensure_woocommerce_pages', 20);

function laura_floris_get_cart_count() {
    if (!laura_floris_is_woocommerce_available() || !WC()->cart) {
        return 0;
    }

    return (int) WC()->cart->get_cart_contents_count();
}

function laura_floris_get_cart_subtotal() {
    if (!laura_floris_is_woocommerce_available() || !WC()->cart) {
        return '';
    }

    return wp_strip_all_tags(WC()->cart->get_cart_subtotal());
}

function laura_floris_get_shop_url() {
    $home_url = untrailingslashit(home_url('/'));
    $default_shop_url = home_url('/shop/');

    if (function_exists('wc_get_page_id')) {
        $shop_page_id = (int) wc_get_page_id('shop');

        if ($shop_page_id > 0) {
            $shop_page_url = get_permalink($shop_page_id);

            if ($shop_page_url && untrailingslashit($shop_page_url) !== $home_url) {
                return $shop_page_url;
            }
        }
    }

    if (function_exists('wc_get_page_permalink')) {
        $shop_url = wc_get_page_permalink('shop');

        if ($shop_url && untrailingslashit($shop_url) !== $home_url) {
            return $shop_url;
        }
    }

    if (function_exists('get_post_type_archive_link')) {
        $archive_url = get_post_type_archive_link('product');

        if ($archive_url && untrailingslashit($archive_url) !== $home_url) {
            return $archive_url;
        }
    }

    return $default_shop_url;
}

function laura_floris_get_cart_page_url() {
    if (function_exists('wc_get_cart_url')) {
        return wc_get_cart_url();
    }

    return home_url('/cart/');
}

function laura_floris_get_checkout_page_url() {
    if (function_exists('wc_get_checkout_url')) {
        return wc_get_checkout_url();
    }

    return home_url('/checkout/');
}

function laura_floris_get_shop_highlights() {
    return array(
        array(
            'label' => __('Curated works', 'laura-floris'),
            'value' => __('Limited editions and selected digital pieces.', 'laura-floris'),
        ),
        array(
            'label' => __('Secure checkout', 'laura-floris'),
            'value' => __('Integrated with WooCommerce payment and shipping flow.', 'laura-floris'),
        ),
        array(
            'label' => __('Studio support', 'laura-floris'),
            'value' => __('A calm and guided purchase path from cart to confirmation.', 'laura-floris'),
        ),
    );
}

function laura_floris_get_cart_button_markup($classes = '') {
    if (!laura_floris_is_woocommerce_available()) {
        return '';
    }

    $count = laura_floris_get_cart_count();

    return sprintf(
        '<button type="button" class="%1$s" data-cart-toggle aria-controls="laura-cart-drawer" aria-expanded="false"><span class="laura-cart-button__icon" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none"><path d="M4 5.5H6.2L7.7 15.2C7.85 16.17 8.69 16.88 9.67 16.88H17.75C18.68 16.88 19.49 16.25 19.72 15.35L21 10.25H8.4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"></path><circle cx="10.25" cy="19" r="1.35" fill="currentColor"></circle><circle cx="17.2" cy="19" r="1.35" fill="currentColor"></circle></svg></span><span class="js-laura-cart-count laura-cart-button__count">%2$d</span></button>',
        esc_attr(trim($classes)),
        $count
    );
}

function laura_floris_render_mini_cart_contents() {
    if (!laura_floris_is_woocommerce_available()) {
        return;
    }

    $count = laura_floris_get_cart_count();
    $subtotal = laura_floris_get_cart_subtotal();
    ?>
    <div class="js-laura-mini-cart-contents">
        <div class="laura-mini-cart__summary">
            <div>
                <p class="laura-mini-cart__eyebrow">Cart</p>
                <h2 class="laura-mini-cart__title">Selected products</h2>
            </div>
            <div class="laura-mini-cart__meta">
                <span class="js-laura-cart-count"><?php echo esc_html($count); ?></span>
                <span><?php echo esc_html(_n('item', 'items', $count, 'laura-floris')); ?></span>
            </div>
        </div>

        <?php if ($count > 0) : ?>
            <div class="laura-mini-cart__list">
                <?php woocommerce_mini_cart(); ?>
            </div>
            <div class="laura-mini-cart__footer">
                <p class="laura-mini-cart__subtotal">
                    <span>Subtotal</span>
                    <strong><?php echo esc_html($subtotal); ?></strong>
                </p>
                <div class="laura-mini-cart__actions">
                    <a href="<?php echo esc_url(laura_floris_get_cart_page_url()); ?>" class="laura-mini-cart__link laura-mini-cart__link--secondary">View cart</a>
                    <a href="<?php echo esc_url(laura_floris_get_checkout_page_url()); ?>" class="laura-mini-cart__link laura-mini-cart__link--primary">Checkout</a>
                </div>
            </div>
        <?php else : ?>
            <div class="laura-mini-cart__empty">
                <p>Your cart is empty for now.</p>
                <a href="<?php echo esc_url(laura_floris_get_shop_url()); ?>" class="laura-mini-cart__link laura-mini-cart__link--primary">Browse products</a>
            </div>
        <?php endif; ?>
    </div>
    <?php
}

function laura_floris_add_to_cart_fragments($fragments) {
    if (!laura_floris_is_woocommerce_available()) {
        return $fragments;
    }

    ob_start();
    ?>
    <span class="js-laura-cart-count laura-cart-button__count"><?php echo esc_html(laura_floris_get_cart_count()); ?></span>
    <?php
    $fragments['.laura-cart-button .js-laura-cart-count'] = ob_get_clean();

    ob_start();
    laura_floris_render_mini_cart_contents();
    $fragments['.js-laura-mini-cart-contents'] = ob_get_clean();

    return $fragments;
}
add_filter('woocommerce_add_to_cart_fragments', 'laura_floris_add_to_cart_fragments');

function laura_floris_shop_columns($columns) {
    return 3;
}
add_filter('loop_shop_columns', 'laura_floris_shop_columns');

function laura_floris_products_per_page($per_page) {
    return 9;
}
add_filter('loop_shop_per_page', 'laura_floris_products_per_page', 20);

function laura_floris_shop_toolbar_open() {
    if (!function_exists('is_shop') || (!is_shop() && !is_product_taxonomy())) {
        return;
    }

    echo '<div class="laura-shop-toolbar">';
}
add_action('woocommerce_before_shop_loop', 'laura_floris_shop_toolbar_open', 19);

function laura_floris_shop_toolbar_close() {
    if (!function_exists('is_shop') || (!is_shop() && !is_product_taxonomy())) {
        return;
    }

    echo '</div>';
}
add_action('woocommerce_before_shop_loop', 'laura_floris_shop_toolbar_close', 31);

function laura_floris_get_meta_description() {
    if (is_front_page()) {
        return 'Laura Floris is a digital artist and fashion designer creating artworks and curated visual projects.';
    }

    if (get_query_var('laura_projects_page')) {
        return 'Explore Laura Floris projects, from fashion and editorial concepts to entertainment-focused visual work.';
    }

    if (is_page('about')) {
        return 'Discover Laura Floris, her background, selected projects and press mentions in fashion and visual culture.';
    }

    if (is_post_type_archive('artwork') || is_page('artworks')) {
        return 'Browse artworks by Laura Floris, including digital illustrations, editorial visuals and selected creative projects.';
    }

    if (function_exists('is_shop') && is_shop()) {
        return 'Explore the Laura Floris shop with prints, limited editions and digital works.';
    }

    if (is_singular()) {
        $excerpt = has_excerpt() ? get_the_excerpt() : wp_strip_all_tags(get_the_title());
        return wp_trim_words($excerpt, 24, '');
    }

    return get_bloginfo('description');
}

function laura_floris_render_meta_description() {
    $description = trim((string) laura_floris_get_meta_description());

    if ($description === '') {
        return;
    }

    echo '<meta name="description" content="' . esc_attr($description) . '">' . "\n";
}
add_action('wp_head', 'laura_floris_render_meta_description', 1);

function laura_floris_menu_fallback() {
    echo '<nav class="main-navigation hidden gap-8 text-sm font-medium uppercase tracking-[0.2em] md:flex">';
    echo '<a href="' . esc_url(home_url('/')) . '" class="notranslate transition hover:opacity-60" translate="no">Home</a>';
    echo '<a href="' . esc_url(laura_floris_get_projects_url()) . '" class="transition hover:opacity-60">Projects</a>';
    echo '<a href="' . esc_url(home_url('/artworks')) . '" class="transition hover:opacity-60">Artworks</a>';
    echo '<a href="' . esc_url(home_url('/about')) . '" class="notranslate transition hover:opacity-60" translate="no">About</a>';
    echo '<a href="' . esc_url(laura_floris_get_shop_url()) . '" class="transition hover:opacity-60">Shop</a>';
    echo '</nav>';
}

function laura_floris_mobile_menu_fallback() {
    echo '<nav class="flex flex-col gap-6 text-base font-medium uppercase tracking-[0.2em]">';
    echo '<a href="' . esc_url(home_url('/')) . '" class="notranslate transition hover:opacity-60" translate="no">Home</a>';
    echo '<a href="' . esc_url(laura_floris_get_projects_url()) . '" class="transition hover:opacity-60">Projects</a>';
    echo '<a href="' . esc_url(home_url('/artworks')) . '" class="transition hover:opacity-60">Artworks</a>';
    echo '<a href="' . esc_url(home_url('/about')) . '" class="notranslate transition hover:opacity-60" translate="no">About</a>';
    echo '<a href="' . esc_url(laura_floris_get_shop_url()) . '" class="transition hover:opacity-60">Shop</a>';
    echo '</nav>';
}

function laura_floris_get_projects_url() {
    return home_url('/projects/');
}

function laura_floris_get_artwork_groups() {
    $base_image_path = get_template_directory_uri() . '/assets/images/';

    return array(
        'cities-world' => array(
            'label'       => 'Cities Of The World',
            'title'       => 'Cities Of The World',
            'description' => 'Urban views reimagined through bold color, movement and atmosphere.',
            'cover'       => $base_image_path . 'image00011.webp',
            'items'       => array(
                array(
                    'title' => 'Great Wall',
                    'image' => $base_image_path . 'image00009.webp',
                ),
                array(
                    'title' => 'Paris',
                    'image' => $base_image_path . 'image00011.webp',
                ),
                array(
                    'title' => 'Dubai',
                    'image' => $base_image_path . 'image00012.webp',
                ),
                array(
                    'title' => 'Evening Streets',
                    'image' => $base_image_path . 'image00013.webp',
                ),
            ),
        ),
        'madrid' => array(
            'label'       => 'Madrid',
            'title'       => 'Madrid',
            'description' => 'A focused selection with warm architectural scenes and Mediterranean light.',
            'cover'       => $base_image_path . 'image00014.webp',
            'items'       => array(
                array(
                    'title' => 'Sunset Citadel',
                    'image' => $base_image_path . 'image00014.webp',
                ),
                array(
                    'title' => 'Coastal Escape',
                    'image' => $base_image_path . 'image00015.webp',
                ),
                array(
                    'title' => 'Rio at Sunset',
                    'image' => $base_image_path . 'image00016.webp',
                ),
            ),
        ),
        'character' => array(
            'label'       => 'Character',
            'title'       => 'Character',
            'description' => 'Character-led scenes where figures, mood and travel storytelling come together.',
            'cover'       => $base_image_path . 'image00008.webp',
            'items'       => array(
                array(
                    'title' => 'Quiet Observer',
                    'image' => $base_image_path . 'image00008.webp',
                ),
                array(
                    'title' => 'Island Horizon',
                    'image' => $base_image_path . 'image00010.webp',
                ),
                array(
                    'title' => 'Over Rio',
                    'image' => $base_image_path . 'image00016.webp',
                ),
            ),
        ),
    );
}

function laura_floris_get_artwork_group($slug) {
    $groups = laura_floris_get_artwork_groups();

    return isset($groups[$slug]) ? $groups[$slug] : null;
}

function laura_floris_get_artwork_group_url($slug) {
    return home_url('/artworks/collection/' . $slug . '/');
}

function laura_floris_inject_primary_menu_items($items, $args) {
    if (!isset($args->theme_location) || 'primary' !== $args->theme_location) {
        return $items;
    }

    $home_url = esc_url(home_url('/'));
    $projects_url = esc_url(laura_floris_get_projects_url());

    if (strpos($items, 'href="' . $home_url . '"') === false) {
        $home_classes = is_front_page() ? 'menu-item menu-item-home current-menu-item current_page_item' : 'menu-item menu-item-home';
        $home_item = '<li class="' . esc_attr($home_classes) . '"><a href="' . $home_url . '" class="notranslate" translate="no">Home</a></li>';
        $items = $home_item . $items;
    }

    if (strpos($items, 'href="' . $projects_url . '"') === false) {
        $is_projects_current = get_query_var('laura_projects_page') || get_query_var('laura_collaboration');
        $projects_classes = $is_projects_current ? 'menu-item current-menu-item current_page_item' : 'menu-item';
        $projects_item = '<li class="' . esc_attr($projects_classes) . '"><a href="' . $projects_url . '">Projects</a></li>';
        if (preg_match('/<li[^>]*>.*?<a[^>]*href="' . preg_quote($home_url, '/') . '"[^>]*>.*?Home.*?<\/a>.*?<\/li>/is', $items)) {
            $items = preg_replace('/(<li[^>]*>.*?<a[^>]*href="' . preg_quote($home_url, '/') . '"[^>]*>.*?Home.*?<\/a>.*?<\/li>)/is', '$1' . $projects_item, $items, 1);
        } else {
            $items = $projects_item . $items;
        }
    }

    return $items;
}
add_filter('wp_nav_menu_items', 'laura_floris_inject_primary_menu_items', 10, 2);

function laura_floris_protect_menu_labels_from_translation($nav_menu, $args) {
    if (!isset($args->theme_location) || !in_array($args->theme_location, array('primary', 'footer'), true)) {
        return $nav_menu;
    }

    $home_url = preg_quote(esc_url(home_url('/')), '/');
    $about_url = preg_quote(esc_url(home_url('/about')), '/');

    $nav_menu = preg_replace(
        '/<a([^>]*href="' . $home_url . '"[^>]*)>(.*?)<\/a>/is',
        '<a$1 class="notranslate" translate="no">Home</a>',
        $nav_menu
    );

    $nav_menu = preg_replace(
        '/<a([^>]*href="' . $about_url . '"[^>]*)>(.*?)<\/a>/is',
        '<a$1 class="notranslate" translate="no">About</a>',
        $nav_menu
    );

    return $nav_menu;
}
add_filter('wp_nav_menu', 'laura_floris_protect_menu_labels_from_translation', 10, 2);

function laura_floris_is_non_translatable_menu_item($item) {
    if (!isset($item->url)) {
        return false;
    }

    $normalized_item_url = untrailingslashit((string) $item->url);
    $home_url = untrailingslashit(home_url('/'));
    $about_url = untrailingslashit(home_url('/about'));

    return $normalized_item_url === $home_url || $normalized_item_url === $about_url;
}

function laura_floris_filter_menu_link_attributes($atts, $item, $args, $depth) {
    if (!isset($args->theme_location) || !in_array($args->theme_location, array('primary', 'footer'), true)) {
        return $atts;
    }

    if (!laura_floris_is_non_translatable_menu_item($item)) {
        return $atts;
    }

    $existing_classes = isset($atts['class']) ? trim((string) $atts['class']) : '';
    $class_tokens = $existing_classes === '' ? array() : preg_split('/\s+/', $existing_classes);

    if (!in_array('notranslate', $class_tokens, true)) {
        $class_tokens[] = 'notranslate';
    }

    $atts['class'] = trim(implode(' ', array_filter($class_tokens)));
    $atts['translate'] = 'no';

    return $atts;
}
add_filter('nav_menu_link_attributes', 'laura_floris_filter_menu_link_attributes', 10, 4);

function laura_floris_filter_menu_item_title($title, $item, $args, $depth) {
    if (!isset($args->theme_location) || !in_array($args->theme_location, array('primary', 'footer'), true)) {
        return $title;
    }

    if (!laura_floris_is_non_translatable_menu_item($item)) {
        return $title;
    }

    $label = untrailingslashit((string) $item->url) === untrailingslashit(home_url('/about')) ? 'About' : 'Home';

    return '<span class="notranslate" translate="no">' . esc_html($label) . '</span>';
}
add_filter('nav_menu_item_title', 'laura_floris_filter_menu_item_title', 10, 4);

function laura_floris_register_artworks_post_type() {
    $labels = array(
        'name'               => 'Artworks',
        'singular_name'      => 'Artwork',
        'menu_name'          => 'Artworks',
        'name_admin_bar'     => 'Artwork',
        'add_new'            => 'Aggiungi nuova',
        'add_new_item'       => 'Aggiungi nuova artwork',
        'new_item'           => 'Nuova artwork',
        'edit_item'          => 'Modifica artwork',
        'view_item'          => 'Vedi artwork',
        'all_items'          => 'Tutte le artworks',
        'search_items'       => 'Cerca artworks',
        'not_found'          => 'Nessuna artwork trovata',
        'not_found_in_trash' => 'Nessuna artwork nel cestino',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'menu_icon'          => 'dashicons-format-image',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
        'has_archive'        => true,
        'rewrite'            => array('slug' => 'artworks'),
        'show_in_rest'       => true,
    );

    register_post_type('artwork', $args);
}
add_action('init', 'laura_floris_register_artworks_post_type');

function laura_floris_get_collaborations() {
    $base_image_path = get_template_directory_uri() . '/assets/images/';

    return array(
        'agatha-ruiz-de-la-prada' => array(
            'title' => 'Agatha Ruiz De La Prada',
            'subtitle' => 'Fashion project',
            'image' => $base_image_path . 'laurafoto.webp',
            'excerpt' => 'A colorful project built around expressive graphics and a playful visual language.',
            'description' => array(
                'This project explores a vibrant mix of fashion illustration, bold colors and iconic shapes inspired by the creative world of Agatha Ruiz De La Prada.',
                'The project focuses on turning Laura Floris visual identity into a visual direction that feels energetic, feminine and immediately recognizable across fashion-oriented applications.',
            ),
        ),
        'netflix' => array(
            'title' => 'Netflix',
            'subtitle' => 'Entertainment project',
            'image' => $base_image_path . 'image00011.webp',
            'excerpt' => 'A visual project inspired by storytelling, atmosphere and strong editorial composition.',
            'description' => array(
                'The Netflix project is shaped around visual storytelling, cinematic mood and digital compositions designed to connect illustration with entertainment culture.',
                'Laura approach combines strong image direction, emotional tone and a clean digital finish to create assets that feel contemporary and memorable.',
            ),
        ),
        'hbo' => array(
            'title' => 'HBO',
            'subtitle' => 'Editorial project',
            'image' => $base_image_path . 'image00013.webp',
            'excerpt' => 'An editorial-style project where atmosphere, narrative and visual impact work together.',
            'description' => array(
                'This HBO project is developed with a focus on atmosphere, character and visual depth, translating narrative inspiration into refined digital artwork.',
                'The result is a body of work that balances elegance and impact, with compositions made to feel immersive, polished and distinctive.',
            ),
        ),
    );
}

function laura_floris_get_collaboration($slug) {
    $collaborations = laura_floris_get_collaborations();

    return isset($collaborations[$slug]) ? $collaborations[$slug] : null;
}

function laura_floris_get_collaboration_url($slug) {
    return laura_floris_get_projects_url() . $slug . '/';
}

function laura_floris_register_collaboration_routes() {
    add_rewrite_rule(
        '^artworks/collection/([^/]+)/?$',
        'index.php?laura_artwork_collection=$matches[1]',
        'top'
    );

    add_rewrite_rule(
        '^projects/?$',
        'index.php?laura_projects_page=1',
        'top'
    );

    add_rewrite_rule(
        '^projects/([^/]+)/?$',
        'index.php?laura_collaboration=$matches[1]',
        'top'
    );

    add_rewrite_rule(
        '^collaborations/([^/]+)/?$',
        'index.php?laura_collaboration=$matches[1]',
        'top'
    );

    $rewrite_version = 'collaboration-routes-v3';
    if (get_option('laura_floris_rewrite_version') !== $rewrite_version) {
        flush_rewrite_rules(false);
        update_option('laura_floris_rewrite_version', $rewrite_version);
    }
}
add_action('init', 'laura_floris_register_collaboration_routes');

function laura_floris_register_query_vars($vars) {
    $vars[] = 'laura_artwork_collection';
    $vars[] = 'laura_collaboration';
    $vars[] = 'laura_projects_page';

    return $vars;
}
add_filter('query_vars', 'laura_floris_register_query_vars');

function laura_floris_pre_handle_collaboration_404($preempt, $wp_query) {
    $artwork_group_slug = get_query_var('laura_artwork_collection');

    if ($artwork_group_slug && laura_floris_get_artwork_group($artwork_group_slug)) {
        $wp_query->is_404 = false;
        return true;
    }

    if (get_query_var('laura_projects_page')) {
        $wp_query->is_404 = false;
        return true;
    }

    $slug = get_query_var('laura_collaboration');

    if ($slug && laura_floris_get_collaboration($slug)) {
        $wp_query->is_404 = false;
        return true;
    }

    return $preempt;
}
add_filter('pre_handle_404', 'laura_floris_pre_handle_collaboration_404', 10, 2);

function laura_floris_collaboration_template($template) {
    $artwork_group_slug = get_query_var('laura_artwork_collection');

    if ($artwork_group_slug && laura_floris_get_artwork_group($artwork_group_slug)) {
        $custom_template = get_template_directory() . '/page-artwork-collection.php';

        if (file_exists($custom_template)) {
            status_header(200);
            return $custom_template;
        }
    }

    if (get_query_var('laura_projects_page')) {
        $custom_template = get_template_directory() . '/page-projects.php';

        if (file_exists($custom_template)) {
            status_header(200);
            return $custom_template;
        }
    }

    $slug = get_query_var('laura_collaboration');

    if ($slug && laura_floris_get_collaboration($slug)) {
        $custom_template = get_template_directory() . '/page-collaboration.php';

        if (file_exists($custom_template)) {
            status_header(200);
            return $custom_template;
        }
    }

    return $template;
}
add_filter('template_include', 'laura_floris_collaboration_template');

function laura_floris_collaboration_title_parts($title) {
    $artwork_group_slug = get_query_var('laura_artwork_collection');
    $artwork_group = $artwork_group_slug ? laura_floris_get_artwork_group($artwork_group_slug) : null;

    if ($artwork_group) {
        $title['title'] = $artwork_group['title'];
        return $title;
    }

    if (get_query_var('laura_projects_page')) {
        $title['title'] = 'Projects';
        return $title;
    }

    $slug = get_query_var('laura_collaboration');
    $collaboration = $slug ? laura_floris_get_collaboration($slug) : null;

    if ($collaboration) {
        $title['title'] = $collaboration['title'];
    }

    return $title;
}
add_filter('document_title_parts', 'laura_floris_collaboration_title_parts');
