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
        '1.3'
    );

    wp_enqueue_script(
        'laura-floris-theme-js',
        get_template_directory_uri() . '/assets/theme.js',
        array(),
        '1.3',
        true
    );
}
add_action('wp_enqueue_scripts', 'laura_floris_enqueue_assets');

function laura_floris_get_meta_description() {
    if (is_front_page()) {
        return 'Laura Floris is a digital artist and fashion designer creating artworks, brand collaborations and curated visual projects.';
    }

    if (is_page('about')) {
        return 'Discover Laura Floris, her background, collaborations and press mentions in fashion and visual culture.';
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
    echo '<a href="' . esc_url(home_url('/')) . '" class="transition hover:opacity-60">Home</a>';
    echo '<a href="' . esc_url(home_url('/artworks')) . '" class="transition hover:opacity-60">Artworks</a>';
    echo '<a href="' . esc_url(home_url('/about')) . '" class="transition hover:opacity-60">About</a>';
    echo '<a href="' . esc_url(home_url('/shop')) . '" class="transition hover:opacity-60">Shop</a>';
    echo '</nav>';
}

function laura_floris_mobile_menu_fallback() {
    echo '<nav class="flex flex-col gap-6 text-base font-medium uppercase tracking-[0.2em]">';
    echo '<a href="' . esc_url(home_url('/')) . '" class="transition hover:opacity-60">Home</a>';
    echo '<a href="' . esc_url(home_url('/artworks')) . '" class="transition hover:opacity-60">Artworks</a>';
    echo '<a href="' . esc_url(home_url('/about')) . '" class="transition hover:opacity-60">About</a>';
    echo '<a href="' . esc_url(home_url('/shop')) . '" class="transition hover:opacity-60">Shop</a>';
    echo '</nav>';
}

function laura_floris_prepend_home_menu_item($items, $args) {
    if (!isset($args->theme_location) || 'primary' !== $args->theme_location) {
        return $items;
    }

    if (strpos($items, 'href="' . esc_url(home_url('/')) . '"') !== false) {
        return $items;
    }

    $home_classes = is_front_page() ? 'menu-item menu-item-home current-menu-item current_page_item' : 'menu-item menu-item-home';
    $home_item = '<li class="' . esc_attr($home_classes) . '"><a href="' . esc_url(home_url('/')) . '">Home</a></li>';

    return $home_item . $items;
}
add_filter('wp_nav_menu_items', 'laura_floris_prepend_home_menu_item', 10, 2);

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
            'subtitle' => 'Fashion collaboration',
            'image' => $base_image_path . 'laurafoto.png',
            'excerpt' => 'A colorful collaboration built around expressive graphics and a playful visual language.',
            'description' => array(
                'This collaboration explores a vibrant mix of fashion illustration, bold colors and iconic shapes inspired by the creative world of Agatha Ruiz De La Prada.',
                'The project focuses on turning Laura Floris visual identity into a collaboration that feels energetic, feminine and immediately recognizable across fashion-oriented applications.',
            ),
        ),
        'netflix' => array(
            'title' => 'Netflix',
            'subtitle' => 'Entertainment collaboration',
            'image' => $base_image_path . '2020.png',
            'excerpt' => 'A visual project inspired by storytelling, atmosphere and strong editorial composition.',
            'description' => array(
                'The collaboration with Netflix is shaped around visual storytelling, cinematic mood and digital compositions designed to connect illustration with entertainment culture.',
                'Laura approach combines strong image direction, emotional tone and a clean digital finish to create assets that feel contemporary and memorable.',
            ),
        ),
        'hbo' => array(
            'title' => 'HBO',
            'subtitle' => 'Editorial collaboration',
            'image' => $base_image_path . 'madrid.png',
            'excerpt' => 'An editorial-style collaboration where atmosphere, narrative and visual impact work together.',
            'description' => array(
                'This collaboration with HBO is developed with a focus on atmosphere, character and visual depth, translating narrative inspiration into refined digital artwork.',
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
    return home_url('/collaborations/' . $slug . '/');
}

function laura_floris_register_collaboration_routes() {
    add_rewrite_rule(
        '^collaborations/([^/]+)/?$',
        'index.php?laura_collaboration=$matches[1]',
        'top'
    );

    $rewrite_version = 'collaboration-routes-v1';
    if (get_option('laura_floris_rewrite_version') !== $rewrite_version) {
        flush_rewrite_rules(false);
        update_option('laura_floris_rewrite_version', $rewrite_version);
    }
}
add_action('init', 'laura_floris_register_collaboration_routes');

function laura_floris_register_query_vars($vars) {
    $vars[] = 'laura_collaboration';

    return $vars;
}
add_filter('query_vars', 'laura_floris_register_query_vars');

function laura_floris_pre_handle_collaboration_404($preempt, $wp_query) {
    $slug = get_query_var('laura_collaboration');

    if ($slug && laura_floris_get_collaboration($slug)) {
        $wp_query->is_404 = false;
        return true;
    }

    return $preempt;
}
add_filter('pre_handle_404', 'laura_floris_pre_handle_collaboration_404', 10, 2);

function laura_floris_collaboration_template($template) {
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
    $slug = get_query_var('laura_collaboration');
    $collaboration = $slug ? laura_floris_get_collaboration($slug) : null;

    if ($collaboration) {
        $title['title'] = $collaboration['title'];
    }

    return $title;
}
add_filter('document_title_parts', 'laura_floris_collaboration_title_parts');
