<?php
if ( ! isset( $args['category'] ) ) return;
$category = $args['category'];
$thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true );
$image_url = wp_get_attachment_image_url( $thumbnail_id, 'medium' );
if ( ! $image_url ) $image_url = wc_placeholder_img_src();
$link = get_term_link( $category );
?>
<a href="<?php echo esc_url( $link ); ?>" class="flex flex-col gap-4 items-center justify-center flex-1 relative">
  <div class="rounded-[260px] self-stretch shrink-0 h-[265px] relative overflow-hidden">
    <img class="absolute right-[-0.4px] left-0 bottom-0 top-0" style="background: linear-gradient(to left, #f4f4f4, #f4f4f4); object-fit: cover;" src="<?php echo esc_url( get_template_directory_uri() . '/src/img/v2/products/bg-gray.png' ); ?>">
    <img class="w-[194px] h-[194px] absolute left-[50%] top-[50%] -translate-x-1/2 -translate-y-1/2" style="object-fit: cover; aspect-ratio: 1" src="<?php echo esc_url( $image_url ); ?>">
    <div class="bg-[#ffffff] rounded-[90px] p-2 flex flex-row gap-2.5 items-center justify-start absolute left-[284px] top-5">
      <svg class="shrink-0 w-4 h-4 relative overflow-visible" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.99544 3.42388C6.66254 1.8656 4.43984 1.44643 2.76981 2.87334C1.09977 4.30026 0.864655 6.68598 2.17614 8.3736C3.26655 9.77674 6.56653 12.7361 7.64808 13.6939C7.76908 13.801 7.82958 13.8546 7.90015 13.8757C7.96175 13.8941 8.02914 13.8941 8.09074 13.8757C8.16131 13.8546 8.22181 13.801 8.34281 13.6939C9.42436 12.7361 12.7243 9.77674 13.8147 8.3736C15.1262 6.68598 14.9198 4.28525 13.2211 2.87334C11.5223 1.46144 9.32835 1.8656 7.99544 3.42388Z" stroke="#111111" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"></path>
      </svg>
    </div>
  </div>
  <div class="flex flex-col gap-2 items-center justify-center self-stretch shrink-0 relative">
    <div class="flex flex-row gap-2 items-start justify-start shrink-0 relative">
      <div class="text-[#3f3f3f] text-center font-['Raleway-SemiBold',_sans-serif] text-base leading-6 font-semibold relative flex-1">
        <?php echo esc_html( $category->name ); ?>
      </div>
    </div>
  </div>
</a>
