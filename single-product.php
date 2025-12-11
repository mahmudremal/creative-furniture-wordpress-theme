<?php
defined('ABSPATH') || exit;

get_header();


$plus_minus_icons = '
<span>
    <svg class="cf-accordion-icon cf-accordion-icon-minus" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M5.8335 14H22.1668" stroke="#737373" stroke-width="2.33333" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
    <svg class="cf-accordion-icon cf-accordion-icon-plus" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M14.0002 5.83301V22.1663M5.8335 13.9997H22.1668" stroke="#737373" stroke-width="2.33333" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
</span>
';

?>

<div class="cf-single-product">
    <?php while (have_posts()) : the_post(); global $product; ?>
        
    
        <div class="cf-product-container">
            <div class="cf-product-gallery">
                <?php // woocommerce_show_product_images(); ?>
				<?php wc_get_template('single-product/product-image.php'); ?>
            </div>

            <div class="cf-product-details">
                <form class="cart cf-cart-form" action="<?php echo esc_url( admin_url('admin-ajax.php?action=cf_add_to_cart') ); ?>" method="post" enctype='multipart/form-data'>
                    <input type="hidden" name="action" value="cf_add_to_cart">
                    <?php wp_nonce_field( 'cf_add_to_cart_nonce' ); ?>

                    <div class="cf-product-header">
                        <h1 class="cf-product-title"><?php the_title(); ?></h1>
                        <button type="button" class="cf-wishlist-btn product-wishlist-btn <?php echo esc_attr(function_exists('cf_wishlist_is_in_wishlist') && cf_wishlist_is_in_wishlist($product->get_id()) ? 'active' : ''); ?>" aria-label="<?php esc_attr_e('Add to wishlist', 'creative-furniture'); ?>" data-product-id="<?php echo esc_attr( $product->get_id() ); ?>">
                            <svg width="19" height="17" viewBox="0 0 19 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.16112 2.61481C7.495 0.666961 4.71662 0.142996 2.62908 1.92664C0.541533 3.71028 0.247636 6.69244 1.88699 8.80196C3.25001 10.5559 7.37497 14.255 8.72691 15.4523C8.87817 15.5863 8.95379 15.6532 9.04201 15.6796C9.119 15.7025 9.20325 15.7025 9.28024 15.6796C9.36845 15.6532 9.44408 15.5863 9.59533 15.4523C10.9473 14.255 15.0722 10.5559 16.4352 8.80196C18.0746 6.69244 17.8166 3.69152 15.6932 1.92664C13.5697 0.161759 10.8272 0.666961 9.16112 2.61481Z" stroke="#717171" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>

                        </button>
                    </div>

                    <div class="cf-product-price">
                        <?php echo $product->get_price_html(); ?>
                    </div>

                    <!-- <?php if ($product->is_type('variable')) : ?>
                        <div class="cf-variations-form">
                            <?php
                            $attributes = $product->get_variation_attributes();
                            foreach ($attributes as $attribute_name => $options) :
                                $attribute_label = wc_attribute_label($attribute_name);
                                ?>
                                <div class="cf-variation-group">
                                    <label class="cf-variation-label"><?php echo esc_html($attribute_label); ?></label>
                                    
                                    <?php if (sanitize_title($attribute_label) === 'color') : ?>
                                        <div class="cf-color-swatches">
                                            <?php foreach ($options as $option) : ?>
                                                <button type="button" class="cf-color-swatch" data-value="<?php echo esc_attr($option); ?>" style="background-color: <?php echo esc_attr(strtolower($option)); ?>;" aria-label="<?php echo esc_attr($option); ?>" name="<?php echo esc_attr(sanitize_title($attribute_name)); ?>">
                                                </button>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php else : ?>
                                        <select class="cf-variation-select" name="<?php echo esc_attr(sanitize_title($attribute_name)); ?>" data-attribute_name="attribute_<?php echo esc_attr(sanitize_title($attribute_name)); ?>">
                                            <option value=""><?php echo esc_html__('Select', 'creative-furniture') . ' ' . esc_html($attribute_label); ?></option>
                                            <?php foreach ($options as $option) : ?>
                                                <option value="<?php echo esc_attr($option); ?>"><?php echo esc_html($option); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?> -->

                    <!--  -->
                    <?php if ($product->is_type('variable')) : ?>
                        <div class="cf-variations-form">
                            <?php
                            $attributes = $product->get_variation_attributes();
                            $available_variations = $product->get_available_variations();
                            
                            foreach ($attributes as $attribute_name => $options) :
                                $attribute_label = wc_attribute_label($attribute_name);
                                $attribute_slug = sanitize_title($attribute_name);
                                $is_color = (strpos(strtolower($attribute_label), 'color') !== false || strpos(strtolower($attribute_slug), 'color') !== false);
                                ?>
                                <div class="cf-variation-group">
                                    <label class="cf-variation-label"><?php echo esc_html($attribute_label); ?></label>
                                    
                                    <?php if ($is_color) : ?>
                                        <div class="cf-variation-swatches cf-color-swatches">
                                            <?php foreach ($options as $option) :
                                                $image_url = '';
                                                foreach ($available_variations as $variation) {
                                                    if ($variation['attributes']['attribute_' . $attribute_slug] === $option && !empty($variation['image']['thumb_src'])) {
                                                        $image_url = $variation['image']['thumb_src'];
                                                        break;
                                                    }
                                                }
                                                ?>
                                                <button type="button" class="cf-variation-swatch <?php echo $image_url ? 'has-image' : 'has-color'; ?>" data-value="<?php echo esc_attr($option); ?>" aria-label="<?php echo esc_attr($option); ?>" name="<?php echo esc_attr($attribute_slug); ?>">
                                                    <?php if ($image_url) : ?>
                                                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($option); ?>">
                                                    <?php else : ?>
                                                        <span class="cf-color-box" style="background-color: <?php echo esc_attr(strtolower($option)); ?>;"></span>
                                                    <?php endif; ?>
                                                </button>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php else : ?>
                                        <select class="cf-variation-select" name="<?php echo esc_attr($attribute_slug); ?>" data-attribute_name="attribute_<?php echo esc_attr($attribute_slug); ?>">
                                            <option value=""><?php echo esc_html__('Select', 'creative-furniture') . ' ' . esc_html($attribute_label); ?></option>
                                            <?php foreach ($options as $option) : ?>
                                                <option value="<?php echo esc_attr($option); ?>"><?php echo esc_html($option); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <!--  -->

                    <?php if (function_exists('wc_get_template')) : ?>
                        <div class="cf-payment-info">
                            <?php if (function_exists('tabby_render_installments')) : ?>
                                <?php tabby_render_installments($product); ?>
                            <?php endif; ?>
                            
                        </div>
                    <?php endif; ?>

                    <div class="cf-cart-controls">
                        <div class="cf-quantity-selector">
                            <button type="button" class="cf-qty-btn cf-qty-minus" aria-label="<?php esc_attr_e('Decrease quantity', 'creative-furniture'); ?>">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5 12H19" stroke="#111111" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>

                            </button>
                            <input type="number" name="quantity" class="cf-qty-input" value="1" min="1" aria-label="<?php esc_attr_e('Quantity', 'creative-furniture'); ?>">
                            <button type="button" class="cf-qty-btn cf-qty-plus" aria-label="<?php esc_attr_e('Increase quantity', 'creative-furniture'); ?>">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 5V19M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                        <button type="submit" class="cf-add-to-cart">
                            <?php esc_html_e('Add to Cart', 'creative-furniture'); ?>
                        </button>
                    </div>

                    <input type="hidden" name="product_id" value="<?php echo esc_attr($product->get_id()); ?>">
                    <?php if ($product->is_type('variable')) : ?>
                        <input type="hidden" name="variation_id" class="cf-variation-id" value="">
                    <?php endif; ?>

                    
                    <div class="cf-product-actions">
                        <a href="https://wa.me/971566736852" class="cf-customization-btn">
                            <span><?php esc_html_e('WhatsApp us for Customization', 'creative-furniture'); ?></span>
                        </a>
                    </div>

                </form>

                <div class="cf-product-accordion">
                    <div class="cf-accordion-item cf-accordion-active">
                        <button type="button" class="cf-accordion-header">
                            <h3><?php esc_html_e('Description', 'creative-furniture'); ?></h3>
							<?php echo $plus_minus_icons; ?>
                        </button>
                        <div class="cf-accordion-content">
                            <ul class="cf-description-list">
                                <?php 
                                $description = $product->get_description();
                                if ($description) {
                                    echo wp_kses_post(wpautop($description));
                                } else {
                                    $items = [
                                        __('Logistics context: Your dedicated point of', 'creative-furniture'),
                                        __('Logistics context: Your dedicated point of contact for all shipment updates, order status, and service levels.', 'creative-furniture'),
                                        __('Logistics context', 'creative-furniture'),
                                    ];
                                    foreach ($items as $item) {
                                        echo '<li>' . esc_html($item) . '</li>';
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>

                    <div class="cf-accordion-item">
                        <button type="button" class="cf-accordion-header">
                            <h3><?php esc_html_e('Additional information', 'creative-furniture'); ?></h3>
							<?php echo $plus_minus_icons; ?>
                        </button>
                        <div class="cf-accordion-content">
                            <?php do_action('woocommerce_product_additional_information', $product); ?>
                        </div>
                    </div>

                    <div class="cf-accordion-item">
                        <button type="button" class="cf-accordion-header">
                            <h3><?php esc_html_e('Care & Instructions', 'creative-furniture'); ?></h3>
                            <?php echo $plus_minus_icons; ?>
                        </button>
                        <div class="cf-accordion-content">
                            <?php 
                            $care_instructions = get_post_meta(get_the_ID(), '_care_instructions', true) ?: get_option('_care_instructions', __('Care instructions not avaialble.', 'creative-furniture'));
                            echo $care_instructions ? wp_kses_post(wpautop($care_instructions)) : '<p>' . esc_html__('Care instructions coming soon.', 'creative-furniture') . '</p>';
                            ?>
                        </div>
                    </div>

                    <div class="cf-accordion-item">
                        <button type="button" class="cf-accordion-header">
                            <h3><?php esc_html_e('Warranty & Installation', 'creative-furniture'); ?></h3>
                            <?php echo $plus_minus_icons; ?>
                        </button>
                        <div class="cf-accordion-content">
                            <?php 
                            $warranty = get_post_meta(get_the_ID(), '_warranty_installation', true) ?: get_option('_warranty_installation', __('Warrenty policy not avaialble.', 'creative-furniture'));
                            echo $warranty ? wp_kses_post(wpautop($warranty)) : '<p>' . esc_html__('Warranty information coming soon.', 'creative-furniture') . '</p>';
                            ?>
                        </div>
                    </div>

                    <div class="cf-accordion-item">
                        <button type="button" class="cf-accordion-header">
                            <h3><?php esc_html_e('T&C', 'creative-furniture'); ?></h3>
                            <?php echo $plus_minus_icons; ?>
                        </button>
                        <div class="cf-accordion-content">
                            <?php 
                            $terms = get_post_meta(get_the_ID(), '_terms_conditions', true) ?: get_option('_terms_conditions', __('Terms & Conditions not available.', 'creative-furniture'));
                            echo $terms ? wp_kses_post(wpautop($terms)) : '<p>' . esc_html__('Terms & Conditions coming soon.', 'creative-furniture') . '</p>';
                            ?>
                        </div>
                    </div>

                    <div class="cf-accordion-item">
                        <button type="button" class="cf-accordion-header">
                            <h3><?php esc_html_e('Reviews', 'creative-furniture'); ?></h3>
                            <?php echo $plus_minus_icons; ?>
                        </button>
                        <div class="cf-accordion-content">
                            <?php comments_template(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="cf-related-products">
            <div class="cf-related-header">
                <h2 class="cf-related-title">
                    <span class="cf-title-regular"><?php esc_html_e('You may', 'creative-furniture'); ?></span>
                    <span class="cf-title-italic"><?php esc_html_e('like', 'creative-furniture'); ?></span>
                </h2>
                <div class="cf-related-nav">
                    <button type="button" class="cf-nav-btn cf-nav-prev" aria-label="<?php esc_attr_e('Previous', 'creative-furniture'); ?>">
                        <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M17.5 21L10.5 14L17.5 7" stroke="currentColor" stroke-width="2.33333" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
                    </button>
                    <button type="button" class="cf-nav-btn cf-nav-next" aria-label="<?php esc_attr_e('Next', 'creative-furniture'); ?>">
                        <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M10.5 21L17.5 14L10.5 7" stroke="currentColor" stroke-width="2.33333" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
                    </button>
                </div>
            </div>

            <?php woocommerce_related_products(['posts_per_page' => 4, 'columns' => 4]); ?>
        </div>

    <?php endwhile; ?>
</div>

<?php
get_footer();
?>