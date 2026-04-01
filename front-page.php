<?php get_header(); ?>
<?php $theme_directory_uri = get_template_directory_uri(); ?>
<div class="relative flex flex-col gap-8 sm:gap-10 md:gap-20">

  <?php get_template_part('template-parts/frontpage-hero', null, []); ?>

  <div class="pr-6 pl-6 flex flex-col gap-6 items-center justify-start w-full max-w-full md:w-[1440px] 2xl:w-[1920px] m-auto relative">
    <div class="blaze-slider w-full" data-slider="hero" data-config="<?php echo esc_attr(json_encode(['all' => ['loop' => false, 'slidesToShow' => 5, 'slidesToScroll' => 1, 'slideGap' => '16px'], '(max-width: 900px)' => ['slidesToShow' => 3], '(max-width: 500px)' => ['slidesToShow' => 2.5]])); ?>">
      <div class="blaze-container flex flex-col gap-6">
        <div class="flex flex-row items-center justify-between self-stretch shrink-0 relative">
          <h3 class="text-[#242424] text-left font-['Raleway-SemiBold',_sans-serif] text-base sm:text-2xl leading-6 sm:leading-8 font-semibold relative flex items-center justify-start">
            <?php echo esc_html__( 'Shop by Category', 'creative-furniture' ); ?>
          </h3>
          <div class="flex sm:hidden flex-row gap-1 items-center justify-start shrink-0 relative">
            <svg class="blaze-prev shrink-0 w-4 h-4 relative overflow-visible" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M10 12L6 8L10 4" stroke="#BFBFBF" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
            <div class="blaze-next flex flex-row gap-[5.71px] items-center justify-start shrink-0 relative">
              <svg class="shrink-0 w-4 h-4 relative overflow-visible" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M6 12L10 8L6 4" stroke="var(--ui-light-black-primary, #111111)" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </div>
          </div>
        </div>
        <?php $categories = get_front_page_shop_categories(); ?>
        <div class="w-full block relative">
          <div class="blaze-track-container">
            <div class="blaze-track">
              <?php
                if (!is_wp_error($categories) && !empty($categories)) {
                  foreach ($categories as $category) {
                    get_template_part('template-parts/category-card-rounded', null, ['category' => $category]);
                  }
                }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="lg:px-4 w-full">
    <div class="flex flex-col items-center justify-start w-full max-w-full md:w-[1440px] 2xl:w-[1920px] m-auto relative overflow-hidden">
      <div class="blaze-slider w-full" data-slider="hero" data-config="<?php echo esc_attr(json_encode(['all' => ['loop' => true, 'slidesToShow' => 1, 'slidesToScroll' => 1, 'slideGap' => '16px']])); ?>">
        <div class="blaze-container w-full">
          <div class="blaze-track-container">
            <div class="blaze-track">
              <?php // for ($i = 1; $i <= 5; $i++): ?>
                <div class="bg-[#f9f9f9] xl:pl-[100px] flex">
                  <div class="flex flex-wrap items-center justify-between self-stretch flex-1 relative px-4 md:px-0 pb-6 sm:pb-0 gap-7">
                    <div class="flex flex-col gap-6 sm:gap-10 items-center md:items-start justify-start shrink-0 w-full md:w-[476px] md:px-7 pt-5 md:py-10 relative">
                      <div class="flex flex-col gap-3 items-center md:items-start justify-start self-stretch shrink-0 relative">
                        <div class="rounded-[48px] border-solid border-[#eeeeee] border pt-1.5 pr-3.5 pb-1.5 pl-3.5 flex flex-row gap-2.5 items-center justify-center shrink-0 relative">
                          <div class="text-[#3f3f3f] text-left font-['Raleway-Regular',_sans-serif] text-[10px] sm:text-sm leading-5 font-normal relative">
                            <?php echo esc_html__( 'Latest Collection', 'creative-furniture' ); ?>
                          </div>
                        </div>
                        <h2 class="text-[#010101] text-center md:text-left font-['Raleway-SemiBold',_sans-serif] text-base sm:text-2xl md:text-[32px] leading-6 sm:leading-8 md:leading-[44px] font-semibold relative self-stretch">
                          <?php echo esc_html__( 'Modern Home Furniture Collection', 'creative-furniture' ); ?>
                        </h2>
                        <div class="text-[#2f2f2f] text-center md:text-left font-['Raleway-Regular',_sans-serif] text-xs text-[10px] leading-4 sm:text-sm sm:leading-5 font-normal relative self-stretch" style="opacity: 0.8">
                          <?php echo esc_html__( 'Premium pieces crafted to enhance everyday living with refined aesthetics and lasting comfort.', 'creative-furniture' ); ?>
                        </div>
                      </div>
                      <a href="<?php echo esc_url(add_query_arg('query', 'home', wc_get_page_permalink('shop'))); ?>" class="text-[#161616] border-solid border-[#353535] border-b pb-2 flex flex-row gap-2 items-start justify-start shrink-0 relative">
                        <div class="text-left font-['Raleway-Regular',_sans-serif] text-xs leading-[18px] sm:text-sm sm:leading-5 font-normal relative flex items-center justify-start">
                          <?php echo esc_html__( 'Explore Collection', 'creative-furniture' ); ?>
                        </div>
                        <svg class="shrink-0 w-4 sm:w-6 h-4 sm:h-6 relative overflow-visible" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="#353535" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                      </a>
                    </div>
                    <img class="shrink-0 w-full md:w-[724px] h-auto md:h-[433px] 2xl:w-[924px] 2xl:h-[550px] relative aspect-[5/4] md:aspect-unset" style="object-fit: cover" src="<?php echo esc_url($theme_directory_uri . '/dist/images/v2/modern-home-furniture-collection.png'); ?>">
                  </div>
                </div>
              <?php // endfor; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="flex flex-col gap-7 px-4 md:p-4 items-start justify-start w-full max-w-full md:w-[1440px] 2xl:w-[1920px] m-auto relative">
    <div class="flex flex-row items-center justify-between self-stretch shrink-0 relative">
      <div class="text-black-primary text-left font-['Raleway-SemiBold',_sans-serif] text-xl sm:text-2xl leading-8 font-semibold relative flex items-center justify-start">
        <?php esc_html_e('New Arrivals', 'creative-furniture'); ?>
      </div>
      <a href="<?php echo esc_url(add_query_arg('orderby', 'date', wc_get_page_permalink('shop'))); ?>" class="text-[#161616] text-left font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal relative flex items-center justify-start" style="text-decoration: underline">
        <?php esc_html_e('Explore more', 'creative-furniture'); ?>
      </a>
    </div>
    <div class="gap-4 items-center justify-start self-stretch shrink-0 relative">
      <div class="blaze-slider new-arrivals-slider" data-slider="hero" data-config="<?php echo esc_attr(json_encode(['all' => ['loop' => false, 'slidesToShow' => 3, 'slidesToScroll' => 1, 'slideGap' => '16px', 'enablePagination' => true], '(min-width: 1536px)' => ['slidesToShow' => 3], '(max-width: 900px)' => ['slidesToShow' => 2], '(max-width: 500px)' => ['slidesToShow' => 1]])); ?>">
        <div class="blaze-container">
          <div class="blaze-track-container">
            <div class="blaze-track">
              <a href="<?php echo esc_url(add_query_arg('query', 'lounge', add_query_arg('orderby', 'date', wc_get_page_permalink('shop')))); ?>" class="bg-[#f4f4f4] p-2 md:p-6 flex flex-col gap-4 items-center justify-between md:justify-center -flex-1 relative">
                <div class="relative overflow-hidden w-full 2xl:h-[400px]">
                  <img class="w-full h-full" style="object-fit: cover" src="<?php echo esc_url($theme_directory_uri); ?>/dist/images/v2/rectangle-453430.png">
                </div>
                <div class="flex flex-row gap-2 items-center justify-center shrink-0 w-full md:w-[405.33px] h-[30px] relative">
                  <div class="text-[#3f3f3f] text-right font-['Raleway-SemiBold',_sans-serif] text-sm md:text-base leading-4 md:leading-6 font-semibold relative">
                    <?php esc_html_e('LOUNGE SEATING', 'creative-furniture'); ?>
                  </div>
                  <div class="text-[#484848] text-left font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal relative">
                    <?php esc_html_e('Comfort meets style.', 'creative-furniture'); ?>
                  </div>
                </div>
              </a>
              <a href="<?php echo esc_url(add_query_arg('query', 'dining', add_query_arg('orderby', 'date', wc_get_page_permalink('shop')))); ?>" class="bg-[#f4f4f4] p-2 md:p-6 flex flex-col gap-4 items-center justify-between md:justify-center -flex-1 relative">
                <div class="relative overflow-hidden w-full 2xl:h-[400px]">
                  <img class="w-full h-full" style="object-fit: cover" src="<?php echo esc_url($theme_directory_uri); ?>/dist/images/v2/rectangle-453431.png">
                </div>
                <div class="flex flex-row gap-2 items-center justify-center shrink-0 w-full md:w-[405.33px] h-[30px] relative">
                  <div class="text-[#3f3f3f] text-right font-['Raleway-SemiBold',_sans-serif] text-sm md:text-base leading-4 md:leading-6 font-semibold relative">
                    <?php esc_html_e('DINING COLLECTION', 'creative-furniture'); ?>
                  </div>
                  <div class="text-[#484848] text-left font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal relative">
                    <?php esc_html_e('Elevated dining design.', 'creative-furniture'); ?>
                  </div>
                </div>
              </a>
              <a href="<?php echo esc_url(add_query_arg('query', 'living', add_query_arg('orderby', 'date', wc_get_page_permalink('shop')))); ?>" class="bg-[#f4f4f4] p-2 md:p-6 flex flex-col gap-4 items-center justify-between md:justify-center -flex-1 relative">
                <div class="relative overflow-hidden w-full 2xl:h-[400px]">
                  <img class="w-full h-full" style="object-fit: cover" src="<?php echo esc_url($theme_directory_uri); ?>/dist/images/v2/rectangle-453432.png">
                </div>
                <div class="flex flex-row gap-2 items-center justify-center shrink-0 w-full md:w-[405.33px] h-[30px] relative">
                  <div class="text-[#3f3f3f] text-right font-['Raleway-SemiBold',_sans-serif] text-sm md:text-base leading-4 md:leading-6 font-semibold relative">
                    <?php esc_html_e('LIVING ESSENTIALS', 'creative-furniture'); ?>
                  </div>
                  <div class="text-[#484848] text-left font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal relative">
                    <?php esc_html_e('Modern accent pieces.', 'creative-furniture'); ?>
                  </div>
                </div>
              </a>
              <a href="<?php echo esc_url(add_query_arg('query', 'dining', add_query_arg('orderby', 'date', wc_get_page_permalink('shop')))); ?>" class="bg-[#f4f4f4] p-2 md:p-6 flex flex-col gap-4 items-center justify-between md:justify-center -flex-1 relative">
                <div class="relative overflow-hidden w-full 2xl:h-[400px]">
                  <img class="w-full h-full" style="object-fit: cover" src="<?php echo esc_url($theme_directory_uri); ?>/dist/images/v2/rectangle-453431.png">
                </div>
                <div class="flex flex-row gap-2 items-center justify-center shrink-0 w-full md:w-[405.33px] h-[30px] relative">
                  <div class="text-[#3f3f3f] text-right font-['Raleway-SemiBold',_sans-serif] text-sm md:text-base leading-4 md:leading-6 font-semibold relative">
                    <?php esc_html_e('DINING COLLECTION', 'creative-furniture'); ?>
                  </div>
                  <div class="text-[#484848] text-left font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal relative">
                    <?php esc_html_e('Elevated dining design.', 'creative-furniture'); ?>
                  </div>
                </div>
              </a>
            </div>
          </div>
          <div class="blaze-pagination flex sm:hidden items-center justify-center gap-2 mt-5"></div>
        </div>
      </div>
    </div>
    <style>
    .new-arrivals-slider .blaze-pagination button {background: #d9d9d9;cursor: pointer;border: none;border-radius: 50%;width: 8px;height: 8px;padding: 0;font-size: 0;transition: opacity .2s,transform .2s}
    .new-arrivals-slider .blaze-pagination button.active {background: #cccccc;transform: scale(1.2)}
    </style>
  </div>

  <div class="w-full lg:px-4">
    <div class="flex flex-col gap-7 items-start justify-start sm:bg-[#f4f4f4] w-full max-w-full md:w-[1440px] 2xl:w-[1920px] m-auto relative">
      <div class="flex flex-col sm:flex-row gap-4 md:gap-7 justify-between p-4 pb-8 sm:pb-4 items-center w-full">
        <div class="flex flex-col gap-2 items-start justify-start p-4 pb-0 sm:pb-4">
          <div class="text-[#010101] text-center sm:text-left font-['Raleway-SemiBold',_sans-serif] text-xl sm:text-2xl leading-8 font-semibold relative self-stretch" >
            <?php esc_html_e('Trusted Member of the BNI Network', 'creative-furniture'); ?>
          </div>
          <div class="text-[#4d4d4d] text-center sm:text-left font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal relative self-stretch" >
            <?php echo nl2br(esc_html(sprintf(__('As a member of BNI, Creative Furniture builds strong professional relationships, shares valuable referrals, and contributes to a %s trusted global business network.', 'creative-furniture'), "\n"))); ?>
          </div>
        </div>
        <img
          class="w-[170px] sm:w-[200px] md:w-[234px]"
          style="object-fit: cover; aspect-ratio: 234/91"
          src="<?php echo esc_url($theme_directory_uri . '/dist/images/v2/image-2780.png'); ?>"
        />
      </div>
    </div>
  </div>
  
  <?php get_template_part('template-parts/export-cat-collection-block', null, ['title' => __('Best Sellers', 'creative-furniture'), 'link' => add_query_arg('orderby', 'popularity', wc_get_page_permalink('shop')), 'query' => [], 'type' => 'bestsellers']); ?>

  <div class="flex flex-col gap-7 items-start justify-start w-full max-w-full md:w-[1440px] 2xl:w-[1920px] m-auto relative">
    <div class="w-full flex flex-col gap-4 px-4 --md:px-0">
      <div class="w-full flex flex-row items-center justify-between self-stretch shrink-0 gap-4 relative">
        <div class="text-black-primary text-left font-['Raleway-SemiBold',_sans-serif] text-xl sm:text-2xl leading-8 font-semibold relative flex items-center justify-start">
          <?php esc_html_e("This Season's Top Picks", 'creative-furniture'); ?>
        </div>
        <a href="/shop" class="text-[#161616] text-left font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal relative flex items-center justify-start" style="text-decoration: underline">
          <?php esc_html_e('Explore more', 'creative-furniture'); ?>
        </a>
      </div>
    </div>
    <div class="w-full">
      <div class="blaze-slider" data-slider="hero" data-config="<?php echo esc_attr(json_encode(['all' => ['loop' => true, 'slidesToShow' => 1, 'slidesToScroll' => 1], '(min-width: 1536px)' => ['slidesToShow' => 1], '(max-width: 900px)' => ['slidesToShow' => 1]])); ?>">
        <div class="blaze-container">
          <div class="blaze-track-container">
            <div class="blaze-track">
              <?php for ($i = 1; $i <= 5; $i++): ?>
                <div class="self-stretch shrink-0 h-[320px] md:h-[437px] 2xl:h-[550px] relative">
                  <div class="md:pr-[100px] md:pl-[100px] flex flex-row items-center justify-between h-[320px] md:h-[437px] 2xl:h-[550px] absolute left-0 top-0 bg-center bg-cover bg-no-repeat w-full" style="background-image: url(<?php echo esc_url($theme_directory_uri); ?>/dist/images/v2/frame-21214531531.png);">
                    <div class="absolute inset-0 bg-[linear-gradient(180deg,rgba(244,244,244,1)_20%,rgba(255,255,255,0)_100%)] sm:bg-[linear-gradient(96.56deg,rgba(244,244,244,1)_15%,rgba(255,255,255,0)_100%)]"></div>
                    <div class="flex flex-col gap-10 items-center justify-center shrink-0 px-4 w-full md:w-[476px] relative">
                      <div class="flex flex-col gap-2 items-center justify-center self-stretch shrink-0 relative">
                        <div class="text-[#000000] text-left font-['Raleway-Bold',_sans-serif] text-lg leading-[26px] font-bold relative">
                          <?php esc_html_e('Top Picks', 'creative-furniture'); ?>
                        </div>
                        <div class="text-center font-['Raleway-Bold',_sans-serif] text-xl sm:text-2xl md:text-[28px] leading-6 sm:leading-8 md:leading-10 font-bold relative self-stretch">
                          <span>
                            <span class="text-[#BD262A]"><?php echo esc_html(sprintf(__('%s Off', 'creative-furniture'), '15%')); ?></span>
                            <span class="">
                              <?php echo nl2br(esc_html(sprintf(__('For Outdoor %s Collection', 'creative-furniture'), "\n"))); ?>
                            </span>
                          </span>
                        </div>
                        <div class="text-[#2f2f2f] text-center font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal relative self-stretch" style="opacity: 0.8">
                          <?php esc_html_e('Premium furniture engineered for style, performance, and long-term durability.', 'creative-furniture'); ?>
                        </div>
                      </div>
                      <a href="<?php echo esc_url(add_query_arg('query', 'outdoor', add_query_arg('discount_min', '15', wc_get_page_permalink('shop')))); ?>" class="bg-[#000000] border-solid border-[transparent] border py-2 sm:py-3.5 px-6 sm:px-8 flex flex-row gap-2.5 items-center justify-center shrink-0 relative cursor-pointer">
                        <span class="text-[#ffffff] text-center font-['Raleway-SemiBold',_sans-serif] text-base leading-6 font-semibold relative flex items-center justify-center">
                          <?php esc_html_e('View Details', 'creative-furniture'); ?>
                        </span>
                      </a>
                    </div>
                  </div>
                  <svg class="h-auto w-full absolute left-0 overflow-visible" width="1395" height="62" viewBox="0 0 1395 62" fill="none" xmlns="http://www.w3.org/2000/svg" style="bottom: -5px;">
                    <path d="M0 56.5C512.758 56.5 772.242 56.5 1285 56.5L1395 0" stroke="#BD262A" stroke-width="3.5" />
                    <path d="M1395 62L1395 0L1285 59L1395 62Z" fill="white" />
                  </svg>
                </div>
              <?php endfor; ?>
            </div>
          </div>
          <div class="blaze-next bg-[#bd262a] p-0.5 flex flex-row gap-2.5 items-center justify-start shrink-0 absolute right-[35px] top-[50%] cursor-pointer" style="translate: 0 -50%">
            <svg class="shrink-0 w-7 h-7 relative overflow-visible" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M10.5 21L17.5 14L10.5 7" stroke="white" stroke-width="2.33333" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php get_template_part('template-parts/export-cat-collection-block', null, ['title' => __('Explore Office Chair', 'creative-furniture'), 'link' => add_query_arg('query', 'Office Chair', wc_get_page_permalink('shop')), 'query' => ['orderby' => 'rand'], 'type' => 'chairs']); ?>
  

  <div class="bg-[#000000] min-h-[88px] grid grid-cols-1 md:grid-cols-3 items-center justify-center md:justify-between py-4 gap-4 overflow-hidden w-full max-w-full md:w-[1440px] 2xl:w-[1920px] m-auto relative">
    <div class="hidden md:block w-[341px] h-16 shrink-0 relative">
      <svg
        class="w-full md:w-[312px] h-[58px] absolute left-0 top-[3px] overflow-visible"
        width="312"
        height="58"
        viewBox="0 0 312 58"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          d="M0 0H312L277.689 29L312 58H0V0Z"
          fill="#9D0004"
          fill-opacity="0.48"
        />
      </svg>
      <div class="text-[#ffffff] text-center font-['Raleway-SemiBold',_sans-serif] text-2xl leading-8 font-semibold absolute left-8 top-4" >
        <?php esc_html_e('Limited Time Offer', 'creative-furniture'); ?>
      </div>
    </div>
    
    <div class="flex md:hidden items-center justify-center">
      <div class="-bg-[#9D0004]/50 px-4 py-1.5 rounded-full text-center relative">
        <svg class="w-[189px] h-7" width="189" height="28" viewBox="0 0 189 28" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M0 0H189L172.684 14L189 28H0L14.8947 14L0 0Z" fill="#9D0004" fill-opacity="0.48"></path>
        </svg>
        <span class="text-[#ffffff] text-[10px] sm:text-xs font-semibold uppercase tracking-wider absolute left-1/2 top-1/2 overflow-visible -translate-x-1/2 -translate-y-1/2"><?php esc_html_e('Limited Time Offer', 'creative-furniture'); ?></span>
      </div>
    </div>

    <div class="text-[#ffffff] text-center md:flex-1">
      <span class="text-base md:text-xl">
        <?php echo sprintf(__('Enjoy %s 30%% Off %s Your First Order', 'creative-furniture'), '<span class="text-[20px] md:text-[28px] font-bold">', '</span>'); ?>
      </span>
    </div>
    
    <div class="flex flex-row items-center justify-center md:justify-end gap-2 lg:pr-4">
      <a href="/shop" class="border-solid border-[#ffffff] border-b pb-2 flex flex-row gap-2 items-center justify-start shrink-0" >
        <span class="text-[#ffffff] text-left font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal relative flex items-center justify-start" >
          <?php esc_html_e('Shop Now', 'creative-furniture'); ?>
        </span>
        <svg class="shrink-0 w-5 h-5 md:w-6 md:h-6 relative overflow-visible" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
      </a>
    </div>
  </div>

  <?php get_template_part('template-parts/shop-the-look-hotspots', null, []); ?>

  <?php get_template_part('template-parts/export-cat-collection-block', null, ['title' => __('Explore Desk', 'creative-furniture'), 'link' => home_url('/shop'), 'query' => [], 'type' => 'desks']); ?>

  <div class="flex flex-col gap-7 items-start justify-start px-4 --md:px-0 w-full max-w-full md:w-[1440px] 2xl:w-[1920px] m-auto relative">
    <div class="flex flex-row items-center justify-between self-stretch shrink-0 relative">
      <div class="text-black-primary text-left font-['Raleway-SemiBold',_sans-serif] text-xl sm:text-2xl leading-8 font-semibold relative flex items-center justify-start">
        <?php esc_html_e('Deal Zone', 'creative-furniture'); ?>
      </div>
      <a href="/shop" class="text-[#161616] text-left font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal relative flex items-center justify-start" style="text-decoration: underline">
        <?php esc_html_e('Explore more', 'creative-furniture'); ?>
      </a>
    </div>
    <div class="blaze-slider w-full" data-slider="hero" data-config="<?php echo esc_attr(json_encode(['all' => ['loop' => true, 'gap' => '12px', 'slidesToShow' => 3, 'slidesToScroll' => 1], '(min-width: 1536px)' => ['slidesToShow' => 4], '(max-width: 900px)' => ['slidesToShow' => 2], '(max-width: 500px)' => ['slidesToShow' => 1]])); ?>">
      <div class="blaze-container w-full">
        <div class="blaze-track-container w-full">
          <div class="blaze-track w-full">
            <?php for ($i=1; $i <= 2; $i++) : ?>
            <a href="<?php echo esc_url(add_query_arg('discount_max', '60', wc_get_page_permalink('shop'))); ?>" class="bg-[#fef6ee] shrink-0 h-[156px] relative overflow-hidden" target="_blank">
              <div class="flex flex-row gap-2 items-center justify-start absolute left-6 top-[50%]" style="translate: 0 -50%">
                <div class="flex flex-col gap-2 items-start justify-center shrink-0 relative">
                  <div class="text-[#000000] text-right font-['Raleway-SemiBold',_sans-serif] text-base sm:text-xl md:text-2xl leading-8 font-semibold relative">
                    <?php esc_html_e('Maximum', 'creative-furniture'); ?>
                  </div>
                  <div class="text-[#bd262a] text-right font-['Raleway-SemiBold',_sans-serif] text-xl sm:text-2xl leading-6 sm:leading-8 font-semibold relative">
                    60% Off
                  </div>
                </div>
              </div>
              <div class="bg-[#bd262a] rounded-[25px] p-0.5 flex flex-row gap-2.5 items-center justify-start absolute right-1/2 md:right-[226px] top-[50%]" style="translate: 0 -50%">
                <svg class="shrink-0 w-7 h-7 relative overflow-visible" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M8.16667 19.8332L19.8333 8.1665M19.8333 8.1665H8.16667M19.8333 8.1665V19.8332" stroke="white" stroke-width="2.33333" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
              </div>
              <img class="w-[148px] h-[148px] absolute right-[9px] top-[calc(50%_-_73px)]" style="object-fit: cover; aspect-ratio: 1" src="<?php echo esc_url($theme_directory_uri); ?>/dist/images/v2/_408654916-3365999-c-cae-8-42-ed-8-cec-7-c-4-b-14271978-10.png">
            </a>
            <a href="<?php echo esc_url(add_query_arg('discount_min', '0.1', wc_get_page_permalink('shop'))); ?>" class="bg-[#fef6ee] shrink-0 h-[156px] relative overflow-hidden" target="_blank">
              <div class="flex flex-row gap-2 items-center justify-start absolute left-6 top-[50%]" style="translate: 0 -50%">
                <div class="flex flex-col gap-2 items-start justify-center shrink-0 relative">
                  <div class="text-[#000000] text-right font-['Raleway-SemiBold',_sans-serif] text-base sm:text-xl md:text-2xl leading-8 font-semibold relative">
                    Decor on
                  </div>
                  <div class="text-[#bd262a] text-right font-['Raleway-SemiBold',_sans-serif] text-xl sm:text-2xl leading-6 sm:leading-8 font-semibold relative">
                    Sale
                  </div>
                </div>
              </div>
              <div class="bg-[#bd262a] rounded-[25px] p-0.5 flex flex-row gap-2.5 items-center justify-start absolute right-1/2 md:right-[226px] top-[50%]" style="translate: 0 -50%">
                <svg class="shrink-0 w-7 h-7 relative overflow-visible" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M8.16669 19.8332L19.8334 8.1665M19.8334 8.1665H8.16669M19.8334 8.1665V19.8332" stroke="white" stroke-width="2.33333" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
              </div>
              <img class="w-[151px] h-[151px] absolute right-0.5 top-0" style="object-fit: cover; aspect-ratio: 1" src="<?php echo esc_url($theme_directory_uri); ?>/dist/images/v2/_13586893-340-10.png">
            </a>
            <a href="<?php echo esc_url(add_query_arg('max_price', '10000', wc_get_page_permalink('shop'))); ?>" class="bg-[#fef6ee] shrink-0 h-[156px] relative overflow-hidden" target="_blank">
              <div class="flex flex-row gap-2 items-center justify-start absolute left-6 top-[50%]" style="translate: 0 -50%">
                <div class="flex flex-col gap-2 items-start justify-center shrink-0 relative">
                  <div class="text-[#000000] text-right font-['Raleway-SemiBold',_sans-serif] text-base sm:text-xl md:text-2xl leading-8 font-semibold relative">
                    <?php esc_html_e('Best Buys', 'creative-furniture'); ?>
                  </div>
                  <div class="text-[#bd262a] text-right font-['Raleway-SemiBold',_sans-serif] text-base sm:text-lg leading-5 sm:leading-[26px] font-semibold relative">
                    <?php echo esc_html(sprintf(__('Under AED %s', 'creative-furniture'), 10000)); ?>
                  </div>
                </div>
              </div>
              <div class="bg-[#bd262a] rounded-[25px] p-0.5 flex flex-row gap-2.5 items-center justify-start absolute right-[194px] top-[50%]" style="translate: 0 -50%">
                <svg class="shrink-0 w-7 h-7 relative overflow-visible" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M8.16663 19.8332L19.8333 8.1665M19.8333 8.1665H8.16663M19.8333 8.1665V19.8332" stroke="white" stroke-width="2.33333" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
              </div>
              <img class="w-[161px] h-[161px] absolute right-[9px] top-[calc(50%_-_83px)]" style="object-fit: cover; aspect-ratio: 1" src="<?php echo esc_url($theme_directory_uri); ?>/dist/images/v2/_23043947-realistic-1-luxury-chairs-2-10.png">
            </a>
            <?php endfor; ?>
          </div>
        </div>
        <div class="blaze-next bg-[#000000] p-0.5 flex flex-row gap-2.5 items-center justify-start absolute right-0 top-[50%] cursor-pointer" style="translate: 0 -50%">
          <svg class="shrink-0 w-7 h-7 relative overflow-visible" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10.5 21L17.5 14L10.5 7" stroke="white" stroke-width="2.33333" stroke-linecap="round" stroke-linejoin="round"></path>
          </svg>
        </div>
      </div>
    </div>
    <!-- <div class="grid grid-cols-3 gap-4 items-center justify-start self-stretch shrink-0 relative">
    </div> -->
  </div>

  <div class="flex flex-col w-full max-w-full md:w-[1440px] 2xl:w-[1920px] m-auto relative">
    <div class="blaze-slider w-full" data-slider="hero" data-config="<?php echo esc_attr(json_encode(['all' => ['loop' => true, 'slidesToShow' => 1, 'slidesToScroll' => 1, 'slideGap' => '16px']])); ?>">
      <div class="blaze-container w-full">
        <div class="blaze-track-container">
          <div class="blaze-track">
            <?php for ($i = 1;$i <= 5; $i++): ?>
            <div class="bg-[#f9f9f9] flex flex-col md:flex-row md:flex-wrap items-center gap-0 sm:gap-6 justify-start sm:justify-between 2xl:justify-start self-stretch -flex-1 relative">
              <img class="shrink-0 w-full md:max-w-full md:w-[808px] h-[250px] md:h-[433px] 2xl:w-[1000px] 2xl:h-[500px] relative" style="object-fit: cover" src="<?php echo esc_url($theme_directory_uri); ?>/dist/images/v2/rectangle-45411.png">
              <div class="flex flex-col gap-6 sm:gap-10 items-center justify-center shrink-0 w-full md:w-[476px] py-7 md:py-10 px-7 2xl:ml-[120px] relative">
                <div class="flex flex-col gap-4 items-center justify-start self-stretch shrink-0 relative">
                  <div class="text-center font-['Raleway-Bold',_sans-serif] text-xl sm:text-[28px] md:text-2xl leading-6 sm:leading-8 md:leading-10 font-bold relative self-stretch">
                    <span>
                      <span>
                        <?php esc_html_e('Limited-time deals on', 'creative-furniture'); ?>
                        <br>
                      </span>
                      <span>
                        <?php esc_html_e('Shoe Rack', 'creative-furniture'); ?>
                      </span>
                    </span>
                  </div>
                  <div class="flex flex-row gap-2 items-start justify-start shrink-0 relative">
                    <div class="text-[#bd262a] text-center font-['Raleway-SemiBold',_sans-serif] text-base sm:text-xl md:text-2xl leading-4 sm:leading-6 md:leading-8 font-semibold relative" style="opacity: 0.8">
                      AED3,575.00
                    </div>
                    <div class="text-[#171717] text-center font-['Raleway-Regular',_sans-serif] text-base sm:text-xl md:text-2xl leading-4 sm:leading-6 md:leading-8 font-normal relative" style="text-decoration: line-through; opacity: 0.8">
                      AED3,575.00
                    </div>
                  </div>
                </div>
                <a href="<?php echo esc_url('#'); ?>" class="bg-[#000000] border-solid border-[transparent] border py-2 sm:py-3.5 px-6 sm:px-8 flex flex-row gap-2.5 items-center justify-center shrink-0 relative">
                  <span class="text-[#ffffff] text-center font-['Raleway-SemiBold',_sans-serif] text-base leading-6 font-semibold relative flex items-center justify-center">
                    <?php esc_html_e('View Details', 'creative-furniture'); ?>
                  </span>
                </a>
              </div>
            </div>
            <?php endfor; ?>
          </div>
        </div>
        <div class="blaze-next bg-[#000000] p-0.5 flex flex-row gap-2.5 items-center justify-start shrink-0 absolute right-6 top-[50%] cursor-pointer" style="translate: 0 -50%">
          <svg class="shrink-0 w-7 h-7 relative overflow-visible" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10.5 21L17.5 14L10.5 7" stroke="white" stroke-width="2.33333" stroke-linecap="round" stroke-linejoin="round"></path>
          </svg>
        </div>
      </div>
    </div>
    
  </div>
  
  <?php get_template_part('template-parts/export-cat-collection-block', null, ['title' => __('Explore Living Furniture', 'creative-furniture'), 'link' => add_query_arg('query', 'living', wc_get_page_permalink('shop')), 'query' => [], 'type' => 'living']); ?>

  <div class="h-[350px] md:h-[453px] 2xl:h-[550px] w-full max-w-full md:w-[1440px] 2xl:w-[1920px] m-auto relative overflow-hidden" style="background-image: url('<?php echo esc_url($theme_directory_uri); ?>/dist/images/v2/vector-40.png');background-position: center center;background-attachment: fixed;background-repeat: repeat;padding: 0px 0px 0px 0px;">
    <div class="w-full h-full absolute right-0 bottom-0 overflow-visible" style="background: linear-gradient(0deg, #ffffff20 0%, #33333380 100%);"></div>
    <div class="flex flex-col gap-5 items-center justify-center w-full md:w-[476px] absolute left-[50%] top-[50%]" style="translate: -50% -50%" >
      <div class="flex flex-col gap-2 items-center justify-center self-stretch shrink-0 relative" >
        <div class="text-[#ffffff] text-center font-['Lato-Bold',_sans-serif] text-[28px] sm:text-[32px] leading-8 sm:leading-[44px] font-bold relative self-stretch" >
          <?php echo nl2br(esc_html(sprintf(__('Ready to Upgrade Your %s Interior?', 'creative-furniture'), "\n"))); ?>
        </div>
      </div>
      <a href="<?php echo esc_url(add_query_arg('query', 'interior', wc_get_page_permalink('shop'))); ?>" class="border-solid border-[transparent] border px-6 sm:px-8 py-2 sm:py-3.5 flex flex-row gap-2.5 items-center justify-center shrink-0 relative bg-[#ffffff] text-[#000000] hover:bg-[#000000] hover:text-white" >
        <span class="text-center font-['Raleway-SemiBold',_sans-serif] text-base leading-6 font-semibold relative flex items-center justify-center" >
          <?php esc_html_e('Start Shopping', 'creative-furniture'); ?>
        </span>
      </a>
    </div>
  </div>

  
  
  <?php get_template_part('template-parts/clients-reviews', null, []); ?>
  
  <?php get_template_part('template-parts/our-clients', null, []); ?>

  <?php get_template_part('template-parts/top-deals-by-category', null, []); ?>

  
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    tippy('.hotspot-indicator', {
      allowHTML: true,
      interactive: true,
      placement: 'top',
      theme: 'light',
      arrow: true,
      animation: 'fade',
    });
  });
</script>
<style>
  .tippy-content {
    padding: 0 !important;
  }
</style>
<?php get_footer(); ?>
