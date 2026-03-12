<?php
if ( ! isset( $args['product_id'] ) ) return;
$product_id = $args['product_id'];
$product = wc_get_product($product_id);
if (!$product) return;

$title = $product->get_name();
$permalink = $product->get_permalink();
$image_id = $product->get_image_id();
$image_url = $image_id ? wp_get_attachment_image_url($image_id, 'full') : wc_placeholder_img_src();
$regular_price = $product->get_regular_price();
$sale_price = $product->get_sale_price();
$price_html = $product->get_price_html();

$percentage = 0;
if ($product->is_on_sale() && $regular_price > 0) {
    $percentage = round((($regular_price - $sale_price) / $regular_price) * 100);
}
?>

<a href="<?php echo esc_url($permalink); ?>" class="flex relative">
  <div class="flex flex-col gap-4 items-start justify-start flex-1">
    <div class="self-stretch shrink-0 h-[294px] relative overflow-hidden">
      <div class="absolute inset-0 bg-[#f4f4f4]"></div>
      <img class="w-full h-full absolute left-[50%] top-[50%] object-contain" style="translate: -50% -50%; aspect-ratio: 1" src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($title); ?>">
      <?php if ($percentage > 0) : ?>
      <div class="bg-[#000000] pt-1 pr-2 pb-1 pl-2 flex flex-row gap-7 items-center justify-start absolute left-0 top-0 overflow-hidden">
        <div class="text-[#ffffff] text-left font-['Raleway-SemiBold',_sans-serif] text-xs leading-[18px] font-semibold relative flex items-center justify-start">
          - <?php echo esc_html($percentage); ?>%
        </div>
      </div>
      <?php endif; ?>
      <div class="bg-[#ffffff] rounded-[90px] p-2 flex flex-row gap-2.5 items-center justify-start absolute right-5 top-5">
        <svg class="shrink-0 w-4 h-4 relative overflow-visible" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" clip-rule="evenodd" d="M7.99544 3.42388C6.66254 1.8656 4.43984 1.44643 2.76981 2.87334C1.09977 4.30026 0.864655 6.68598 2.17614 8.3736C3.26655 9.77674 6.56653 12.7361 7.64808 13.6939C7.76908 13.801 7.82958 13.8546 7.90015 13.8757C7.96175 13.8941 8.02914 13.8941 8.09074 13.8757C8.16131 13.8546 8.22181 13.801 8.34281 13.6939C9.42436 12.7361 12.7243 9.77674 13.8147 8.3736C15.1262 6.68598 14.9198 4.28525 13.2211 2.87334C11.5223 1.46144 9.32835 1.8656 7.99544 3.42388Z" stroke="var(--ui-light-black-primary, #111111)" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
      </div>
    </div>
    <div class="flex flex-col gap-2 items-start justify-start self-stretch shrink-0 relative">
      <div class="text-[#141414] text-left font-['Raleway-SemiBold',_sans-serif] text-sm leading-5 font-semibold relative self-stretch flex items-center justify-start line-clamp-2">
        <?php echo esc_html($title); ?>
      </div>
      <div class="flex flex-row gap-3 items-center justify-start shrink-0 relative">
        <div class="flex flex-row gap-1 items-center justify-start shrink-0 relative">
          <div class="bg-[#000000] rounded-[20px] shrink-0 w-2.5 h-2.5 relative" style="aspect-ratio: 1"></div>
          <div class="bg-[#ab9a8d] rounded-[20px] shrink-0 w-2.5 h-2.5 relative" style="aspect-ratio: 1"></div>
          <div class="bg-[#ceb492] rounded-[20px] shrink-0 w-2.5 h-2.5 relative" style="aspect-ratio: 1"></div>
          <div class="bg-[#9c7a52] rounded-[20px] shrink-0 w-2.5 h-2.5 relative" style="aspect-ratio: 1"></div>
        </div>
        <div class="text-[#3f3f3f] text-right font-['Raleway-Medium',_sans-serif] text-sm leading-5 font-medium relative">
          + more options
        </div>
      </div>
      <div class="flex flex-row gap-2 items-start justify-start shrink-0 relative">
        <div class="text-[#3f3f3f] text-right font-['Raleway-SemiBold',_sans-serif] text-base leading-6 font-semibold relative">
          <?php echo $price_html; ?>
        </div>
      </div>
    </div>
  </div>
</a>
