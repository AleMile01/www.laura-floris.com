<?php
/**
 * Cart page template override.
 *
 * @package LauraFloris
 */

defined('ABSPATH') || exit;

$shop_url = function_exists('laura_floris_get_shop_url') ? laura_floris_get_shop_url() : home_url('/shop/');
$checkout_url = function_exists('laura_floris_get_checkout_page_url') ? laura_floris_get_checkout_page_url() : home_url('/checkout/');
?>

<?php do_action('woocommerce_before_cart'); ?>

<section class="laura-cart-page">
    <div class="laura-cart-page__layout">
        <div class="laura-cart-page__main">
            <?php if (WC()->cart && WC()->cart->is_empty()) : ?>
                <div class="laura-cart-empty">
                    <p class="laura-cart-empty__eyebrow"><?php esc_html_e('Your selection is empty', 'laura-floris'); ?></p>
                    <h3 class="laura-cart-empty__title"><?php esc_html_e('Start from the shop and build your collection.', 'laura-floris'); ?></h3>
                    <p class="laura-cart-empty__description"><?php esc_html_e('Explore prints, limited works and digital pieces curated from Laura Floris visual universe.', 'laura-floris'); ?></p>
                    <a class="laura-cart-empty__link" href="<?php echo esc_url($shop_url); ?>"><?php esc_html_e('Browse the shop', 'laura-floris'); ?></a>
                </div>
            <?php else : ?>
                <form class="woocommerce-cart-form laura-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
                    <?php do_action('woocommerce_before_cart_table'); ?>

                    <div class="laura-cart-table">
                        <?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) : ?>
                            <?php
                            $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                            $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

                            if (!$_product || !$_product->exists() || $cart_item['quantity'] <= 0 || !apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
                                continue;
                            }

                            $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
                            ?>
                            <article class="laura-cart-card">
                                <div class="laura-cart-card__media">
                                    <?php
                                    $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);

                                    if ($product_permalink) {
                                        printf('<a href="%1$s">%2$s</a>', esc_url($product_permalink), $thumbnail);
                                    } else {
                                        echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                    }
                                    ?>
                                </div>

                                <div class="laura-cart-card__content">
                                    <div class="laura-cart-card__header">
                                        <div>
                                            <p class="laura-cart-card__label"><?php esc_html_e('Selected work', 'laura-floris'); ?></p>
                                            <h3 class="laura-cart-card__name">
                                                <?php
                                                if ($product_permalink) {
                                                    printf('<a href="%1$s">%2$s</a>', esc_url($product_permalink), wp_kses_post($_product->get_name()));
                                                } else {
                                                    echo wp_kses_post($_product->get_name());
                                                }
                                                ?>
                                            </h3>
                                        </div>
                                        <div class="laura-cart-card__remove">
                                            <?php
                                            echo apply_filters(
                                                'woocommerce_cart_item_remove_link',
                                                sprintf(
                                                    '<a href="%1$s" class="remove" aria-label="%2$s" data-product_id="%3$s" data-product_sku="%4$s">%5$s</a>',
                                                    esc_url(wc_get_cart_remove_url($cart_item_key)),
                                                    esc_attr(sprintf(__('Remove %s from cart', 'woocommerce'), wp_strip_all_tags($_product->get_name()))),
                                                    esc_attr($product_id),
                                                    esc_attr($_product->get_sku()),
                                                    esc_html__('Remove', 'laura-floris')
                                                ),
                                                $cart_item_key
                                            );
                                            ?>
                                        </div>
                                    </div>

                                    <div class="laura-cart-card__meta">
                                        <?php echo wc_get_formatted_cart_item_data($cart_item); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                                        <?php if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) : ?>
                                            <p class="backorder_notification"><?php esc_html_e('Available on backorder', 'woocommerce'); ?></p>
                                        <?php endif; ?>
                                    </div>

                                    <div class="laura-cart-card__footer">
                                        <div class="laura-cart-card__price">
                                            <span><?php esc_html_e('Unit price', 'laura-floris'); ?></span>
                                            <strong><?php echo wp_kses_post(WC()->cart->get_product_price($_product)); ?></strong>
                                        </div>
                                        <div class="laura-cart-card__quantity">
                                            <label for="quantity_<?php echo esc_attr($cart_item_key); ?>"><?php esc_html_e('Quantity', 'laura-floris'); ?></label>
                                            <?php
                                            if ($_product->is_sold_individually()) {
                                                $product_quantity = sprintf('1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key);
                                            } else {
                                                $product_quantity = woocommerce_quantity_input(
                                                    array(
                                                        'input_name'   => "cart[{$cart_item_key}][qty]",
                                                        'input_value'  => $cart_item['quantity'],
                                                        'max_value'    => $_product->get_max_purchase_quantity(),
                                                        'min_value'    => '0',
                                                        'product_name' => $_product->get_name(),
                                                        'input_id'     => 'quantity_' . $cart_item_key,
                                                    ),
                                                    $_product,
                                                    false
                                                );
                                            }

                                            echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                            ?>
                                        </div>
                                        <div class="laura-cart-card__subtotal">
                                            <span><?php esc_html_e('Subtotal', 'laura-floris'); ?></span>
                                            <strong><?php echo wp_kses_post(apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key)); ?></strong>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>

                    <div class="laura-cart-form__actions">
                        <?php if (wc_coupons_enabled()) : ?>
                            <div class="laura-cart-coupon">
                                <label for="coupon_code" class="screen-reader-text"><?php esc_html_e('Coupon:', 'woocommerce'); ?></label>
                                <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e('Coupon code', 'woocommerce'); ?>" />
                                <button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e('Apply coupon', 'woocommerce'); ?>"><?php esc_html_e('Apply coupon', 'woocommerce'); ?></button>
                                <?php do_action('woocommerce_cart_coupon'); ?>
                            </div>
                        <?php endif; ?>

                        <div class="laura-cart-form__buttons">
                            <a class="laura-cart-form__continue" href="<?php echo esc_url($shop_url); ?>"><?php esc_html_e('Continue shopping', 'laura-floris'); ?></a>
                            <button type="submit" class="button" name="update_cart" value="<?php esc_attr_e('Update cart', 'woocommerce'); ?>"><?php esc_html_e('Update cart', 'woocommerce'); ?></button>
                        </div>

                        <?php do_action('woocommerce_cart_actions'); ?>
                        <?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>
                    </div>

                    <?php do_action('woocommerce_after_cart_table'); ?>
                </form>

                <aside class="laura-cart-page__sidebar">
                    <div class="laura-cart-totals">
                        <div class="laura-cart-totals__header">
                            <p class="laura-cart-totals__eyebrow"><?php esc_html_e('Order summary', 'laura-floris'); ?></p>
                            <h3><?php esc_html_e('Everything ready for checkout.', 'laura-floris'); ?></h3>
                        </div>
                        <?php do_action('woocommerce_cart_collaterals'); ?>
                        <a class="laura-cart-totals__checkout" href="<?php echo esc_url($checkout_url); ?>"><?php esc_html_e('Proceed to checkout', 'laura-floris'); ?></a>
                    </div>
                </aside>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php do_action('woocommerce_after_cart'); ?>
