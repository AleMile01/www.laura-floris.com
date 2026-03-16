<?php
/**
 * Mini-cart content for the cart drawer.
 *
 * @package LauraFloris
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_mini_cart');
?>

<?php if (!WC()->cart->is_empty()) : ?>
    <ul class="woocommerce-mini-cart cart_list product_list_widget <?php echo esc_attr($args['list_class']); ?>">
        <?php
        do_action('woocommerce_before_mini_cart_contents');

        foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
            $_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
            $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

            if (!$_product || !$_product->exists() || $cart_item['quantity'] <= 0 || !apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key)) {
                continue;
            }

            $product_name      = apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key);
            $thumbnail         = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);
            $product_price     = apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key);
            $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
            ?>
            <li class="woocommerce-mini-cart-item mini_cart_item">
                <?php
                echo apply_filters(
                    'woocommerce_cart_item_remove_link',
                    sprintf(
                        '<a href="%1$s" class="remove remove_from_cart_button" aria-label="%2$s" data-product_id="%3$s" data-cart_item_key="%4$s" data-product_sku="%5$s">&times;</a>',
                        esc_url(wc_get_cart_remove_url($cart_item_key)),
                        esc_attr(sprintf(__('Remove %s from cart', 'woocommerce'), wp_strip_all_tags($product_name))),
                        esc_attr($product_id),
                        esc_attr($cart_item_key),
                        esc_attr($_product->get_sku())
                    ),
                    $cart_item_key
                );

                if ($product_permalink) {
                    printf('<a href="%1$s">%2$s</a>', esc_url($product_permalink), $thumbnail . wp_kses_post($product_name));
                } else {
                    echo wp_kses_post($thumbnail . $product_name);
                }

                echo wc_get_formatted_cart_item_data($cart_item); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                ?>
                <span class="quantity"><?php echo sprintf('%1$s × %2$s', esc_html($cart_item['quantity']), wp_kses_post($product_price)); ?></span>
            </li>
            <?php
        }

        do_action('woocommerce_mini_cart_contents');
        ?>
    </ul>

    <?php do_action('woocommerce_after_mini_cart_contents'); ?>
<?php else : ?>
    <p class="woocommerce-mini-cart__empty-message"><?php esc_html_e('No products in the cart.', 'woocommerce'); ?></p>
<?php endif; ?>

<?php do_action('woocommerce_after_mini_cart'); ?>
