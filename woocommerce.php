<?php get_header(); ?>

<?php
$shop_title = woocommerce_page_title(false);
$shop_description = "Prints, limited editions and digital works selected from Laura Floris' visual universe.";
$shop_action_url = function_exists('laura_floris_get_cart_page_url') ? laura_floris_get_cart_page_url() : home_url('/cart/');
$shop_action_label = 'Open cart';
$shop_eyebrow = 'Shop';
$shop_highlights = function_exists('laura_floris_get_shop_highlights') ? laura_floris_get_shop_highlights() : array();

if (function_exists('is_checkout') && is_checkout() && !is_order_received_page()) {
    $shop_title = 'Checkout';
    $shop_description = 'Complete your order, review your details and finalize the purchase in a clean, guided flow.';
    $shop_action_url = function_exists('laura_floris_get_cart_page_url') ? laura_floris_get_cart_page_url() : home_url('/cart/');
    $shop_action_label = 'Back to cart';
    $shop_eyebrow = 'Secure checkout';
} elseif (function_exists('is_cart') && is_cart()) {
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
?>

<main class="laura-shop-shell px-6 pb-16 pt-10 md:px-10 md:pt-8">
    <div class="mx-auto max-w-7xl">
        <header class="laura-shop-hero">
            <p class="laura-shop-hero__eyebrow"><?php echo esc_html($shop_eyebrow); ?></p>
            <div class="laura-shop-hero__content">
                <div>
                    <h1 class="laura-shop-hero__title"><?php echo esc_html($shop_title); ?></h1>
                    <p class="laura-shop-hero__description"><?php echo esc_html($shop_description); ?></p>
                </div>
                <?php if (!empty($shop_action_url)) : ?>
                    <a href="<?php echo esc_url($shop_action_url); ?>" class="laura-shop-hero__cart-link"><?php echo esc_html($shop_action_label); ?></a>
                <?php endif; ?>
            </div>
            <?php if (!empty($shop_highlights) && function_exists('is_shop') && (is_shop() || is_product_taxonomy())) : ?>
                <div class="laura-shop-hero__highlights">
                    <?php foreach ($shop_highlights as $highlight) : ?>
                        <div class="laura-shop-hero__highlight">
                            <p><?php echo esc_html($highlight['label']); ?></p>
                            <span><?php echo esc_html($highlight['value']); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </header>

        <div class="laura-shop-layout">
            <?php woocommerce_content(); ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>

