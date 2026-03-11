<?php
if (!isset($args['title']) || !isset($args['link']) || !isset($args['query'])) return;
$query = (array) $args['query'] || [];
$title = $args['title'];
$link = $args['link'];
?>
<div class="flex flex-col gap-6 items-center justify-start w-full md:w-[1440px] m-auto">
  <div class="flex flex-row items-center justify-between self-stretch shrink-0 relative">
    <div class="text-black-primary text-left font-['Raleway-SemiBold',_sans-serif] text-2xl leading-8 font-semibold relative flex items-center justify-start">
      <?php echo esc_html($title); ?>
    </div>
    <a href="<?php echo esc_url($link); ?>" class="text-[#161616] text-left font-['Raleway-Regular',_sans-serif] text-sm leading-[18px] font-normal relative flex items-center justify-start" style="text-decoration: underline">
      <?php esc_html_e( 'Explore more', 'creative-furniture' ); ?>
    </a>
  </div>
  <div class="w-full relative">
    <div class="relative overflow-hidden">
      <div class="blaze-slider" data-slider="products" data-config="<?php echo esc_attr(json_encode(['all' => ['loop' => false, 'slidesToShow' => 5, 'slidesToScroll' => 2, 'slideGap' => '16px']])); ?>">
        <div class="blaze-container">
          <div class="blaze-track-container">
            <div class="blaze-track">
              <?php for ($i=1; $i <= 15; $i++) get_template_part('template-parts/product-card-extended', null, ['product_id' => ($i % 5) + 1]); ?>
              <?php
              // $posts = new WP_Query([
              //   'post_type' => 'product',
              //   'posts_per_page' => 12,
              //   // 'fields' => 'ids',
              //   // ...$query
              // ]);
              // $posts = wc_get_products([]);
              // print_r($posts);wp_die();
              ?>
              <?php // while ( $posts->have_posts() ) : $posts->the_post(); ?>
              <?php // get_template_part( 'template-parts/product-card', 'extended', array('viewType' => 'grid', 'badge' => true, 'estimateShipping' => true, 'showCategory' => false) ); // here need to use product loop template with wc_get_products ?>
            <?php // endwhile; ?>

            
              <!-- here need to implmenet product looping on the args params $query -->
              <?php woocommerce_product_loop_start(); ?>
              <?php
              if ( wc_get_loop_prop( 'total' ) ) {
                while ( have_posts() ) {
                  the_post();
                  wc_get_template_part( 'content', 'product' );
                }
              }
              ?>
              <?php woocommerce_product_loop_end(); ?>
            
            
            </div>
          </div>

          <div class="blaze-prev bg-[#000000] p-0.5 flex flex-row gap-2.5 items-center justify-start shrink-0 absolute left-0 top-[50%] rotate-180 cursor-pointer">
            <svg class="shrink-0 w-7 h-7 relative overflow-visible" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M10.5 21L17.5 14L10.5 7" stroke="white" stroke-width="2.33333" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
          </div>
          <div class="blaze-next bg-[#000000] p-0.5 flex flex-row gap-2.5 items-center justify-start shrink-0 absolute right-0 top-[50%] cursor-pointer">
            <svg class="shrink-0 w-7 h-7 relative overflow-visible" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M10.5 21L17.5 14L10.5 7" stroke="white" stroke-width="2.33333" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
          </div>

          <div class="blaze-progress shrink-0 w-[386px] h-0.5 relative overflow-visible bg-[#D2D2D2] mt-8 mx-auto">
            <div class="blaze-progress-bar h-full bg-black transition-all duration-300" style="width: 10%;"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

