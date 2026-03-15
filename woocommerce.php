<?php get_header(); ?>

<?php
$shop_title = woocommerce_page_title(false);
$shop_description = "Prints, limited editions and digital works selected from Laura Floris' visual universe.";
$shop_action_url = function_exists('laura_floris_get_cart_page_url') ? laura_floris_get_cart_page_url() : home_url('/cart/');
$shop_action_label = 'Open cart';
$shop_eyebrow = 'Shop';
$is_shop_page = function_exists('is_shop') && is_shop();
$is_cart_page = function_exists('is_cart') && is_cart();
if (function_exists('is_checkout') && is_checkout() && !is_order_received_page()) {
    $shop_title = 'Checkout';
    $shop_description = 'Complete your order, review your details and finalize the purchase in a clean, guided flow.';
    $shop_action_url = function_exists('laura_floris_get_cart_page_url') ? laura_floris_get_cart_page_url() : home_url('/cart/');
    $shop_action_label = 'Back to cart';
    $shop_eyebrow = 'Secure checkout';
} elseif ($is_cart_page) {
    $shop_title = 'Your cart';
    $shop_description = 'Review the selected works, adjust quantities and continue to checkout when everything looks right.';
    $shop_action_url = function_exists('laura_floris_get_shop_url') ? laura_floris_get_shop_url() : home_url('/shop/');
    $shop_action_label = 'Continue shopping';
    $shop_eyebrow = 'Cart';
} elseif (function_exists('is_product') && is_product()) {
    $shop_action_url = function_exists('laura_floris_get_checkout_page_url') ? laura_floris_get_checkout_page_url() : home_url('/checkout/');
    $shop_action_label = 'Go to checkout';
    $shop_eyebrow = 'Product';
}

if ($is_shop_page) {
    $shop_action_url = '';
}
?>

<main class="laura-shop-shell px-6 pb-16 pt-10 md:px-10 md:pt-8">
    <div class="mx-auto max-w-7xl">
        <?php if (!$is_cart_page) : ?>
            <header class="laura-shop-hero<?php echo $is_shop_page ? ' laura-shop-hero--minimal' : ''; ?>">
                <?php if ($is_shop_page) : ?>
                    <div class="laura-shop-hero__shop-heading">
                        <h1 class="laura-shop-hero__title laura-shop-hero__title--shop">Shop</h1>
                        <span class="laura-shop-hero__brand-shop-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none">
                                <path d="M7.5 8V7.3C7.5 4.92 9.47 3 11.9 3C14.33 3 16.3 4.92 16.3 7.3V8" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M5.3 8H18.5L17.65 20.2H6.15L5.3 8Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"></path>
                                <path d="M9.4 11.5V12.1" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"></path>
                                <path d="M14.4 11.5V12.1" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"></path>
                            </svg>
                        </span>
                    </div>
                <?php else : ?>
                    <p class="laura-shop-hero__eyebrow"><?php echo esc_html($shop_eyebrow); ?></p>
                <?php endif; ?>
                <div class="laura-shop-hero__content">
                    <div>
                        <?php if (!$is_shop_page) : ?>
                            <h1 class="laura-shop-hero__title"><?php echo esc_html($shop_title); ?></h1>
                        <?php endif; ?>
                        <p class="laura-shop-hero__description"><?php echo esc_html($shop_description); ?></p>
                    </div>
                    <?php if (!empty($shop_action_url)) : ?>
                        <a href="<?php echo esc_url($shop_action_url); ?>" class="laura-shop-hero__cart-link"><?php echo esc_html($shop_action_label); ?></a>
                    <?php endif; ?>
                </div>
            </header>
        <?php endif; ?>

        <div class="laura-shop-layout">
            <?php woocommerce_content(); ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>

