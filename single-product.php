<?php
defined('ABSPATH') || exit;

get_header();
?>

<div class="cf-single-product">
    <?php while (have_posts()) : the_post(); global $product; ?>
        
        <div class="cf-product-container">
            <div class="cf-product-gallery">
                <?php // woocommerce_show_product_images(); ?>
				<?php wc_get_template('single-product/product-image.php'); ?>
            </div>

            <div class="cf-product-details">
                <div class="cf-product-header">
                    <h1 class="cf-product-title"><?php the_title(); ?></h1>
                    <button class="cf-wishlist-btn" aria-label="<?php esc_attr_e('Add to wishlist', 'creative-furniture'); ?>">
                        <svg width="19" height="17" viewBox="0 0 19 17" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M9.16112 2.61481C7.495 0.666961 4.71662 0.142996 2.62908 1.92664C0.541533 3.71028 0.247636 6.69244 1.88699 8.80196C3.25001 10.5559 7.37497 14.255 8.72691 15.4523C8.87817 15.5863 8.95379 15.6532 9.04201 15.6796C9.119 15.7025 9.20325 15.7025 9.28024 15.6796C9.36845 15.6532 9.44408 15.5863 9.59533 15.4523C10.9473 14.255 15.0722 10.5559 16.4352 8.80196C18.0746 6.69244 17.8166 3.69152 15.6932 1.92664C13.5697 0.161759 10.8272 0.666961 9.16112 2.61481Z" stroke="#717171" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>

                    </button>
                </div>

                <div class="cf-product-price">
                    <?php echo $product->get_price_html(); ?>
                </div>

                <?php if ($product->is_type('variable')) : ?>
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
                                            <button type="button" class="cf-color-swatch" data-value="<?php echo esc_attr($option); ?>" style="background-color: <?php echo esc_attr(strtolower($option)); ?>;" aria-label="<?php echo esc_attr($option); ?>">
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
                <?php endif; ?>

                <div class="cf-product-actions">
                    <button class="cf-size-select">
                        <span><?php esc_html_e('Select Size', 'creative-furniture'); ?></span>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M6 9L12 15L18 9" stroke="#2B2B2B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
                    </button>
                    <button class="cf-customization-btn">
                        <span><?php esc_html_e('Customization Size', 'creative-furniture'); ?></span>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
                    </button>
                </div>

                <?php if (function_exists('wc_get_template')) : ?>
                    <div class="cf-payment-info">
                        <div class="cf-payment-text">
                            <span class="cf-payment-label"><?php esc_html_e('As low as', 'creative-furniture'); ?></span>
                            <span class="cf-payment-amount">284.22/month</span>
                            <span class="cf-payment-label"><?php esc_html_e('or 4 interest-free payments.', 'creative-furniture'); ?></span>
                            <a href="#" class="cf-payment-link"><?php esc_html_e('Learn More', 'creative-furniture'); ?></a>
                        </div>
                        <div class="cf-payment-badge">
                            <svg width="53" height="16" viewBox="0 0 53 16" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M46.5788 3.07157L43.3517 15.3967V15.4356H45.879L49.106 3.11045H46.5788V3.07157ZM6.68735 10.0701C6.29855 10.2645 5.90974 10.3422 5.48206 10.3422C4.5878 10.3422 4.08236 10.1867 4.0046 9.44798V9.4091C4.0046 9.37022 4.0046 9.37022 4.0046 9.33134V7.1929V6.95962V5.44328V4.82119V4.58791V3.14933L1.74952 3.42149C3.26586 3.11045 4.12124 1.94403 4.12124 0.738731V0H1.594V3.46037L1.43848 3.49925V9.87566C1.51624 11.6642 2.72154 12.7528 4.62668 12.7528C5.32653 12.7528 6.06526 12.5973 6.64847 12.3251L6.68735 10.0701Z" fill="#292929"/>
								<path d="M7.07626 2.60468L0 3.69334V5.48185L7.07626 4.39319V2.60468ZM7.07626 5.24856L0 6.33722V8.04796L7.07626 6.95931V5.24856ZM15.0079 6.06505C14.8913 4.08215 13.6471 2.87685 11.6253 2.87685C10.4589 2.87685 9.48686 3.34341 8.82589 4.19879C8.16492 5.05416 7.81499 6.29834 7.81499 7.81468C7.81499 9.33102 8.16492 10.5752 8.82589 11.4306C9.48686 12.2859 10.4589 12.7136 11.6253 12.7136C13.6471 12.7136 14.8913 11.5472 15.0079 9.52542V12.5192H17.5351V3.11013L15.0079 3.49893V6.06505ZM15.1634 7.81468C15.1634 9.56431 14.2303 10.7307 12.7917 10.7307C11.3142 10.7307 10.42 9.64207 10.42 7.81468C10.42 5.98729 11.3142 4.89864 12.7917 4.89864C13.4916 4.89864 14.1136 5.1708 14.5413 5.71513C14.9301 6.22058 15.1634 6.95931 15.1634 7.81468ZM24.8836 2.87685C22.8618 2.87685 21.6176 4.04326 21.501 6.06505V0.349609L18.9737 0.738415V12.5192H21.501V9.52542C21.6176 11.5472 22.8618 12.7136 24.8836 12.7136C27.2553 12.7136 28.6939 10.8862 28.6939 7.81468C28.6939 4.74311 27.2553 2.87685 24.8836 2.87685ZM23.756 10.7307C22.3174 10.7307 21.3843 9.60319 21.3843 7.81468C21.3843 6.95931 21.6176 6.22058 22.0064 5.71513C22.4341 5.1708 23.0173 4.89864 23.756 4.89864C25.2335 4.89864 26.1277 5.98729 26.1277 7.81468C26.1277 9.64207 25.2335 10.7307 23.756 10.7307ZM35.5368 2.87685C33.515 2.87685 32.2709 4.04326 32.1542 6.06505V0.349609L29.627 0.738415V12.5192H32.1542V9.52542C32.2709 11.5472 33.515 12.7136 35.5368 12.7136C37.9086 12.7136 39.3471 10.8862 39.3471 7.81468C39.3471 4.74311 37.9086 2.87685 35.5368 2.87685ZM34.4093 10.7307C32.9707 10.7307 32.0376 9.60319 32.0376 7.81468C32.0376 6.95931 32.2709 6.22058 32.6597 5.71513C33.0874 5.1708 33.6706 4.89864 34.4093 4.89864C35.8868 4.89864 36.781 5.98729 36.781 7.81468C36.781 9.64207 35.8868 10.7307 34.4093 10.7307ZM39.3471 3.07125H42.0299L44.2072 12.5192H41.7966L39.3471 3.07125ZM51.1668 4.04326V3.30453H50.8558V3.14901H51.6723V3.30453H51.3612V4.04326H51.1668ZM51.7112 4.04326V3.11013H52.0222L52.1777 3.53782C52.2166 3.65446 52.2555 3.69334 52.2555 3.73222C52.2555 3.69334 52.2944 3.65446 52.3332 3.53782L52.4888 3.11013H52.7998V4.04326H52.6054V3.30453L52.3332 4.04326H52.1388L51.9056 3.30453V4.04326H51.7112Z" fill="#292929"/>
							</svg>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="cf-cart-controls">
                    <div class="cf-quantity-selector">
                        <button class="cf-qty-btn cf-qty-minus" aria-label="<?php esc_attr_e('Decrease quantity', 'creative-furniture'); ?>">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M5 12H19" stroke="#111111" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>

                        </button>
                        <input type="number" class="cf-qty-input" value="1" min="1" aria-label="<?php esc_attr_e('Quantity', 'creative-furniture'); ?>">
                        <button class="cf-qty-btn cf-qty-plus" aria-label="<?php esc_attr_e('Increase quantity', 'creative-furniture'); ?>">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M12 5V19M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
                        </button>
                    </div>
                    <button class="cf-add-to-cart">
                        <?php esc_html_e('Add to Cart', 'creative-furniture'); ?>
                    </button>
                </div>

                <div class="cf-product-accordion">
                    <div class="cf-accordion-item cf-accordion-active">
                        <button class="cf-accordion-header">
                            <h3><?php esc_html_e('Description', 'creative-furniture'); ?></h3>
							<svg class="cf-accordion-icon" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M5.8335 14H22.1668" stroke="#737373" stroke-width="2.33333" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>

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
                        <button class="cf-accordion-header">
                            <h3><?php esc_html_e('Additional information', 'creative-furniture'); ?></h3>
							<svg class="cf-accordion-icon" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M14.0002 5.83301V22.1663M5.8335 13.9997H22.1668" stroke="#737373" stroke-width="2.33333" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
                        </button>
                        <div class="cf-accordion-content">
                            <?php do_action('woocommerce_product_additional_information', $product); ?>
                        </div>
                    </div>

                    <div class="cf-accordion-item">
                        <button class="cf-accordion-header">
                            <h3><?php esc_html_e('Care & Instructions', 'creative-furniture'); ?></h3>
                            <svg class="cf-accordion-icon" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M14.0002 5.83301V22.1663M5.8335 13.9997H22.1668" stroke="#737373" stroke-width="2.33333" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
                        </button>
                        <div class="cf-accordion-content">
                            <?php 
                            $care_instructions = get_post_meta(get_the_ID(), '_care_instructions', true);
                            echo $care_instructions ? wp_kses_post(wpautop($care_instructions)) : '<p>' . esc_html__('Care instructions coming soon.', 'creative-furniture') . '</p>';
                            ?>
                        </div>
                    </div>

                    <div class="cf-accordion-item">
                        <button class="cf-accordion-header">
                            <h3><?php esc_html_e('Warranty & Installation', 'creative-furniture'); ?></h3>
                            <svg class="cf-accordion-icon" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M14.0002 5.83301V22.1663M5.8335 13.9997H22.1668" stroke="#737373" stroke-width="2.33333" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
                        </button>
                        <div class="cf-accordion-content">
                            <?php 
                            $warranty = get_post_meta(get_the_ID(), '_warranty_installation', true);
                            echo $warranty ? wp_kses_post(wpautop($warranty)) : '<p>' . esc_html__('Warranty information coming soon.', 'creative-furniture') . '</p>';
                            ?>
                        </div>
                    </div>

                    <div class="cf-accordion-item">
                        <button class="cf-accordion-header">
                            <h3><?php esc_html_e('T&C', 'creative-furniture'); ?></h3>
                            <svg class="cf-accordion-icon" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M14.0002 5.83301V22.1663M5.8335 13.9997H22.1668" stroke="#737373" stroke-width="2.33333" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
                        </button>
                        <div class="cf-accordion-content">
                            <?php 
                            $terms = get_post_meta(get_the_ID(), '_terms_conditions', true);
                            echo $terms ? wp_kses_post(wpautop($terms)) : '<p>' . esc_html__('Terms & Conditions coming soon.', 'creative-furniture') . '</p>';
                            ?>
                        </div>
                    </div>

                    <div class="cf-accordion-item">
                        <button class="cf-accordion-header">
                            <h3><?php esc_html_e('Reviews', 'creative-furniture'); ?></h3>
                            <svg class="cf-accordion-icon" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M14.0002 5.83301V22.1663M5.8335 13.9997H22.1668" stroke="#737373" stroke-width="2.33333" stroke-linecap="round" stroke-linejoin="round"/>
							</svg>
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
                    <button class="cf-nav-btn cf-nav-prev" aria-label="<?php esc_attr_e('Previous', 'creative-furniture'); ?>">
                        <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M17.5 21L10.5 14L17.5 7" stroke="currentColor" stroke-width="2.33333" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
                    </button>
                    <button class="cf-nav-btn cf-nav-next" aria-label="<?php esc_attr_e('Next', 'creative-furniture'); ?>">
                        <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M10.5 21L17.5 14L10.5 7" stroke="currentColor" stroke-width="2.33333" stroke-linecap="round" stroke-linejoin="round"/>
						</svg>
                    </button>
                </div>
            </div>

            <?php woocommerce_related_products([
                'posts_per_page' => 4,
                'columns' => 4,
            ]); ?>
        </div>

    <?php endwhile; ?>
</div>

<?php
get_footer();
?>