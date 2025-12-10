<?php
/**
 * Custom “No Products Found” Template
 */

defined('ABSPATH') || exit;
?>

<section class="wc-empty-products">
    <div class="wc-empty-inner">

        <div class="wc-empty-icon">
            <svg width="70" height="70" fill="none" stroke="currentColor" stroke-width="1.6">
                <circle cx="32" cy="32" r="22"></circle>
                <path d="M22 22 L42 42"></path>
                <path d="M42 22 L22 42"></path>
            </svg>
        </div>

        <h2 class="wc-empty-title"><?php echo esc_html(__('No Products Found', 'creative-furniture')); ?></h2>

        <p class="wc-empty-text">
            <?php echo esc_html(__("We couldn't find any products that match your search or filter criteria.", 'creative-furniture')); ?>
        </p>

        <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="wc-empty-btn">
            <?php echo esc_html(__('Browse All Products', 'creative-furniture')); ?>
        </a>
    </div>
</section>
