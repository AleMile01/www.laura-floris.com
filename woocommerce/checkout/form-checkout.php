<?php
/**
 * Checkout form template override.
 *
 * @package LauraFloris
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_checkout_form', $checkout);

if (!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in()) {
    echo esc_html(apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce')));
    return;
}

$shop_url = function_exists('laura_floris_get_shop_url') ? laura_floris_get_shop_url() : home_url('/shop/');
$cart_url = function_exists('laura_floris_get_cart_page_url') ? laura_floris_get_cart_page_url() : home_url('/cart/');
?>

<section class="laura-checkout-page">
    <div class="laura-checkout-page__intro">
        <div>
            <p class="laura-checkout-page__eyebrow"><?php esc_html_e('Secure checkout', 'laura-floris'); ?></p>
            <h2 class="laura-checkout-page__title"><?php esc_html_e('Complete your order in one calm, integrated flow.', 'laura-floris'); ?></h2>
        </div>
        <div class="laura-checkout-page__actions">
            <a href="<?php echo esc_url($cart_url); ?>" class="laura-checkout-page__link laura-checkout-page__link--secondary"><?php esc_html_e('Back to cart', 'laura-floris'); ?></a>
            <a href="<?php echo esc_url($shop_url); ?>" class="laura-checkout-page__link"><?php esc_html_e('Keep browsing', 'laura-floris'); ?></a>
        </div>
    </div>

    <div class="laura-checkout-steps" aria-label="<?php esc_attr_e('Checkout steps', 'laura-floris'); ?>">
        <span class="is-active"><?php esc_html_e('1. Details', 'laura-floris'); ?></span>
        <span class="is-active"><?php esc_html_e('2. Delivery', 'laura-floris'); ?></span>
        <span class="is-active"><?php esc_html_e('3. Payment', 'laura-floris'); ?></span>
    </div>

    <form name="checkout" method="post" class="checkout woocommerce-checkout laura-checkout-form" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data" aria-label="<?php esc_attr_e('Checkout', 'woocommerce'); ?>">
        <div class="laura-checkout-form__main">
            <?php if ($checkout->get_checkout_fields()) : ?>
                <?php do_action('woocommerce_checkout_before_customer_details'); ?>

                <div class="laura-checkout-form__customer" id="customer_details">
                    <div class="laura-checkout-card">
                        <?php do_action('woocommerce_checkout_billing'); ?>
                    </div>
                    <div class="laura-checkout-card">
                        <?php do_action('woocommerce_checkout_shipping'); ?>
                    </div>
                </div>

                <?php do_action('woocommerce_checkout_after_customer_details'); ?>
            <?php endif; ?>
        </div>

        <aside class="laura-checkout-form__sidebar">
            <div class="laura-checkout-card laura-checkout-card--summary">
                <div class="laura-checkout-card__header">
                    <p class="laura-checkout-card__eyebrow"><?php esc_html_e('Order review', 'laura-floris'); ?></p>
                    <h3 id="order_review_heading"><?php esc_html_e('Your final summary', 'laura-floris'); ?></h3>
                </div>
                <div id="order_review" class="woocommerce-checkout-review-order">
                    <?php do_action('woocommerce_checkout_order_review'); ?>
                </div>
            </div>
        </aside>
    </form>
</section>

<?php do_action('woocommerce_after_checkout_form', $checkout); ?>
