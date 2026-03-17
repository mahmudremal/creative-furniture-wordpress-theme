<?php
if ( ! isset( $args['category'] ) ) return;
$category = $args['category'];
$thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true );
$image_url = wp_get_attachment_image_url( $thumbnail_id, 'medium' );
if ( ! $image_url ) $image_url = wc_placeholder_img_src();
$link = get_term_link( $category );
?>
<a href="<?php echo esc_url( $link ); ?>" class="flex flex-col gap-4 items-center justify-center -flex-1 relative">
  <div class="self-stretch shrink-0 relative overflow-hidden">
    <div class="aspect-square max-h-[265px] 2xl:max-h-[325px] rounded-[260px] bg-[#F4F4F4] relative m-auto">
      <img class="w-[194px] 2xl:w-[235px] aspect-square absolute left-[50%] top-[50%] -translate-x-1/2 -translate-y-1/2" style="object-fit: cover; aspect-ratio: 1" src="<?php echo esc_url( $image_url ); ?>">
    </div>
  </div>
  <div class="flex flex-col gap-2 items-center justify-center self-stretch shrink-0 relative">
    <div class="flex flex-row gap-2 items-start justify-start shrink-0 relative">
      <div class="text-[#3f3f3f] text-center font-['Raleway-SemiBold',_sans-serif] text-base leading-6 font-semibold relative flex-1">
        <?php echo esc_html( get_term_meta($category->term_id, 'shorthand', true) ?: $category->name ); ?>
      </div>
    </div>
  </div>
</a>
