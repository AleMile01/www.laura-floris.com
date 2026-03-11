<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class('min-h-screen bg-white text-neutral-900'); ?>>
<?php wp_body_open(); ?>

<header id="site-header" class="fixed inset-x-0 top-0 z-50 hidden border-b border-neutral-200 bg-white/90 backdrop-blur transition-transform duration-300 md:block">
    <div class="mx-auto relative flex max-w-7xl items-center justify-between px-6 py-5 md:px-10">
        <a href="<?php echo esc_url(home_url('/')); ?>" id="navbar-logo" class="pointer-events-none text-sm font-black uppercase tracking-[0.35em] opacity-0 transition-all duration-300 md:text-base" aria-hidden="true">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo.png'); ?>" class="h-10" alt="<?php bloginfo('name'); ?>">
        </a>

        <?php
        wp_nav_menu(array(
            'theme_location' => 'primary',
            'container'      => 'nav',
            'container_class'=> 'main-navigation absolute left-1/2 hidden -translate-x-1/2 md:block',
            'menu_class'     => 'flex gap-8 text-sm font-medium uppercase tracking-[0.2em]',
            'fallback_cb'    => 'laura_floris_menu_fallback',
        ));
        ?>
    </div>
</header>

<button id="menu-toggle" class="laura-mobile-toggle fixed right-4 top-4 z-[70] inline-flex h-14 w-14 items-center justify-center rounded-full border border-neutral-200 bg-white/95 text-neutral-900 shadow-lg transition hover:bg-neutral-900 hover:text-white md:hidden" aria-controls="mobile-menu" aria-expanded="false" aria-label="Apri menu">
    <span class="sr-only">Apri menu</span>
    <span class="flex h-5 w-5 flex-col items-center justify-between">
        <span class="block h-0.5 w-5 bg-current transition-transform duration-300"></span>
        <span class="block h-0.5 w-5 bg-current transition-opacity duration-300"></span>
        <span class="block h-0.5 w-5 bg-current transition-transform duration-300"></span>
    </span>
</button>

<div id="mobile-menu-overlay" class="pointer-events-none fixed inset-0 z-[55] bg-black/0 opacity-0 transition duration-300 md:hidden"></div>
<aside id="mobile-menu" class="pointer-events-none fixed right-0 top-0 z-[60] flex h-screen w-[min(22rem,88vw)] translate-x-full flex-col bg-white px-6 pb-8 pt-24 shadow-2xl transition-transform duration-300 md:hidden" aria-hidden="true">
    <?php
    wp_nav_menu(array(
        'theme_location' => 'primary',
        'container'      => 'nav',
        'menu_class'     => 'flex flex-col gap-6 text-base font-medium uppercase tracking-[0.2em]',
        'fallback_cb'    => 'laura_floris_mobile_menu_fallback',
    ));
    ?>
</aside>

<button id="back-to-top" class="pointer-events-none fixed bottom-6 right-6 z-[65] inline-flex h-14 w-14 translate-y-4 items-center justify-center rounded-full bg-neutral-900 text-white opacity-0 shadow-lg transition duration-300 hover:opacity-85" aria-label="Torna in alto">
    <span class="text-lg leading-none">↑</span>
</button>

<div class="site-content">
