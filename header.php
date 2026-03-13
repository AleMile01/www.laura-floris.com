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
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/logo.webp'); ?>" class="h-10" alt="<?php bloginfo('name'); ?>">
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

<button id="menu-toggle" type="button" class="laura-mobile-toggle fixed right-4 top-4 z-[70] inline-flex h-14 w-14 items-center justify-center rounded-full border border-neutral-200 bg-white/95 text-neutral-900 shadow-lg transition hover:bg-neutral-900 hover:text-white md:hidden" aria-controls="mobile-menu" aria-expanded="false" aria-label="Apri il menu">
    <span class="sr-only">Apri il menu</span>
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

<button id="back-to-top" type="button" class="pointer-events-none fixed bottom-6 right-6 z-[65] inline-flex h-14 w-14 translate-y-4 items-center justify-center rounded-full bg-neutral-900 text-white opacity-0 shadow-lg transition duration-300 hover:opacity-85" aria-label="Torna in alto">
    <svg viewBox="0 0 20 20" fill="none" aria-hidden="true">
        <path d="M5 12.5L10 7.5L15 12.5" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"></path>
    </svg>
</button>

<div id="contact-fab" class="contact-fab fixed bottom-6 left-6 z-[66] flex flex-col items-start gap-3">
    <a href="https://www.instagram.com/laurafloris" target="_blank" rel="noreferrer" class="contact-fab__action" aria-label="Instagram">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <rect x="2" y="2" width="20" height="20" rx="5" stroke="currentColor" stroke-width="1.8"></rect>
            <circle cx="12" cy="12" r="4" stroke="currentColor" stroke-width="1.8"></circle>
            <circle cx="17.5" cy="6.5" r="1" fill="currentColor"></circle>
        </svg>
    </a>
    <a href="mailto:laflorisart@gmail.com" class="contact-fab__action" aria-label="Email">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <rect x="2" y="4" width="20" height="16" rx="2" stroke="currentColor" stroke-width="1.8"></rect>
            <polyline points="22,6 12,13 2,6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"></polyline>
        </svg>
    </a>
    <button id="contact-fab-toggle" type="button" class="contact-fab__toggle" aria-expanded="false" aria-controls="contact-fab" aria-label="Open contact options">
        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M5 7.75C5 6.78 5.78 6 6.75 6H17.25C18.22 6 19 6.78 19 7.75V14.25C19 15.22 18.22 16 17.25 16H10.5L7.2 18.55C6.62 18.99 5.8 18.58 5.8 17.86V16C5.34 15.72 5 15.03 5 14.25V7.75Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"></path>
            <path d="M8 10.5H16" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"></path>
            <path d="M8 13H13.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"></path>
        </svg>
    </button>
</div>

<div class="site-content">
