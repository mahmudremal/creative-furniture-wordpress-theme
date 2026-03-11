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

<div class="flex flex-col gap-4 w-full">
    <?php if (!empty($attachment_ids)) : ?>
        <div class="bg-[#f4f4f4] w-full aspect-[789/660] relative overflow-hidden flex items-center justify-center">
            <?php echo wp_get_attachment_image($attachment_ids[0], 'full', false, ['class' => 'w-auto h-full object-contain transition-transform duration-500', 'id' => 'cf-main-product-image']); ?>
        </div>

        <?php if ($total_images > 1) : ?>
            <div class="flex flex-row flex-wrap gap-4">
                <?php foreach ($attachment_ids as $index => $attachment_id) : ?>
                    <div class="bg-[#f4f4f4] w-24 md:w-32 lg:w-[163px] aspect-[163/160] relative overflow-hidden flex items-center justify-center cursor-pointer hover:opacity-80 transition-opacity cf-thumbnail" data-full-url="<?php echo esc_url(wp_get_attachment_image_url($attachment_id, 'full')); ?>">
                        <?php echo wp_get_attachment_image($attachment_id, 'woocommerce_thumbnail', false, ['class' => 'max-w-[80%] max-h-[80%] object-contain']); ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    <?php else : ?>
        <div class="bg-[#f4f4f4] w-full aspect-[789/660] relative overflow-hidden flex items-center justify-center">
            <?php echo wc_placeholder_img('full', ['class' => 'max-w-[80%] max-h-[80%] object-contain']); ?>
        </div>
    <?php endif; ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const mainImage = document.getElementById('cf-main-product-image');
    const thumbnails = document.querySelectorAll('.cf-thumbnail');
    
    thumbnails.forEach(thumb => {
        thumb.addEventListener('click', function() {
            const fullUrl = this.getAttribute('data-full-url');
            if (mainImage && fullUrl) {
                mainImage.src = fullUrl;
                mainImage.srcset = ''; // Clear srcset to force new image
            }
        });
    });
});
</script>
