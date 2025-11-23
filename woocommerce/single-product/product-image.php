<?php
defined('ABSPATH') || exit;

global $product;

$attachment_ids = $product->get_gallery_image_ids();
$main_image_id = $product->get_image_id();

if ($main_image_id) {
    array_unshift($attachment_ids, $main_image_id);
}

$total_images = count($attachment_ids);
?>

<div class="cf-product-gallery-wrapper">
    <?php if (!empty($attachment_ids)) : ?>
        <?php if ($total_images === 1) : ?>
            <div class="cf-gallery-single">
                <?php echo wp_get_attachment_image($attachment_ids[0], 'full', false, ['class' => 'cf-gallery-img']); ?>
            </div>
        <?php elseif ($total_images === 2) : ?>
            <div class="cf-gallery-two">
                <?php foreach ($attachment_ids as $attachment_id) : ?>
                    <div class="cf-gallery-item">
                        <?php echo wp_get_attachment_image($attachment_id, 'full', false, ['class' => 'cf-gallery-img']); ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php elseif ($total_images === 3) : ?>
            <div class="cf-gallery-three">
                <div class="cf-gallery-item cf-gallery-large">
                    <?php echo wp_get_attachment_image($attachment_ids[0], 'full', false, ['class' => 'cf-gallery-img']); ?>
                </div>
                <div class="cf-gallery-item">
                    <?php echo wp_get_attachment_image($attachment_ids[1], 'full', false, ['class' => 'cf-gallery-img']); ?>
                </div>
                <div class="cf-gallery-item">
                    <?php echo wp_get_attachment_image($attachment_ids[2], 'full', false, ['class' => 'cf-gallery-img']); ?>
                </div>
            </div>
        <?php else : ?>
            <div class="cf-gallery-grid">
                <?php foreach (array_slice($attachment_ids, 0, 4) as $index => $attachment_id) : ?>
                    <div class="cf-gallery-item <?php echo $index === 0 ? 'cf-gallery-large' : ''; ?>" data-index="<?php echo esc_attr($index); ?>">
                        <?php echo wp_get_attachment_image($attachment_id, 'full', false, ['class' => 'cf-gallery-img']); ?>
                        <?php if ($index === 3 && $total_images > 4) : ?>
                            <div class="cf-gallery-overlay">
                                <span class="cf-gallery-more">+<?php echo ($total_images - 4); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    <?php else : ?>
        <div class="cf-gallery-single">
            <?php echo wc_placeholder_img('full'); ?>
        </div>
    <?php endif; ?>

    <?php if ($total_images > 1) : ?>
        <div class="cf-gallery-lightbox" style="display: none;">
            <div class="cf-lightbox-overlay"></div>
            <div class="cf-lightbox-container">
                <button class="cf-lightbox-close" aria-label="<?php esc_attr_e('Close', 'creative-furniture'); ?>">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 4L4 12M4 4L12 12" stroke="#484848" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
                <button class="cf-lightbox-prev" aria-label="<?php esc_attr_e('Previous', 'creative-furniture'); ?>">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15 18L9 12L15 6" stroke="#111111" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
                <button class="cf-lightbox-next" aria-label="<?php esc_attr_e('Next', 'creative-furniture'); ?>">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 18L15 12L9 6" stroke="#111111" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
                <div class="cf-lightbox-content">
                    <?php foreach ($attachment_ids as $index => $attachment_id) : ?>
                        <div class="cf-lightbox-slide" data-slide="<?php echo esc_attr($index); ?>">
                            <?php echo wp_get_attachment_image($attachment_id, 'full', false, ['class' => 'cf-lightbox-img']); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="cf-lightbox-counter">
                    <span class="cf-current-slide">1</span> / <span class="cf-total-slides"><?php echo esc_html($total_images); ?></span>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>