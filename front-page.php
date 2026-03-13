<?php get_header(); ?>
<?php
$theme_directory_uri = get_template_directory_uri();
?>
<div class="relative flex flex-col gap-14 md:gap-20">



  <div class="w-full max-w-full md:w-[1440px] m-auto relative">
    <div class="blaze-slider" data-slider="hero" data-config="<?php echo esc_attr(json_encode(['all' => ['loop' => false, 'slidesToShow' => 1, 'slidesToScroll' => 1]])); ?>">
      <div class="blaze-container">
        <div class="blaze-track-container">
          <div class="blaze-track">
            <?php for ($i=1; $i <= 5; $i++) : ?>
            <div class="relative h-[450px] md:h-[673px]">
              <img class="h-[450px] md:h-[673px] absolute right-0 left-0 top-[50%]" style="translate: 0 -50%; object-fit: cover" src="<?php echo esc_url($theme_directory_uri); ?>/dist/images/v2/smart-furniture-for-modern-offices-hero-1.png">
              <div class="flex flex-col gap-36 md:gap-52 items-start justify-start w-full md:w-[476px] absolute left-4 md:left-[50px] lg:left-[100px] top-[50%]" style="translate: 0 -50%">
                <div class="flex flex-col gap-3 items-start justify-start self-stretch shrink-0 relative">
                  <div class="text-[#010101] text-left font-['Raleway-SemiBold',_sans-serif] text-[38px] leading-[48px] font-semibold relative self-stretch">
                    <?php esc_html_e('Smart Furniture for Modern Offices', 'creative-furniture'); ?>
                  </div>
                  <div class="text-[#2f2f2f] text-left font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal relative self-stretch" style="opacity: 0.8">
                    <?php esc_html_e('Design, supply, and installation services for startups, enterprises, and commercial spaces.', 'creative-furniture'); ?>
                  </div>
                </div>
                <div class="bg-[#000000] border-solid border-[transparent] border pt-3.5 pr-8 pb-3.5 pl-8 flex flex-row gap-2.5 items-center justify-center shrink-0 relative">
                  <div class="text-[#ffffff] text-center font-['Raleway-SemiBold',_sans-serif] text-base leading-6 font-semibold relative flex items-center justify-center">
                    <?php esc_html_e('Shop Furniture', 'creative-furniture'); ?>
                  </div>
                </div>
              </div>
              <svg class="h-[auto] absolute left-0 bottom-0 overflow-visible" width="1442" height="101" viewBox="0 0 1442 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 99C512.758 99 818.742 99 1331.5 99L1440.5 0" stroke="#BD262A" stroke-width="3.5"></path>
                <path d="M1440 100.51L1442 2.5L1333 101L1440 100.51Z" fill="white"></path>
              </svg>
            </div>
            <?php endfor; ?>
          </div>
        </div>

        <div class="blaze-prev bg-[#000000] p-2 flex flex-row gap-2.5 items-center justify-start absolute left-8 top-[50%] hidden" style="translate: 0 -50%">
          <svg class="shrink-0 w-7 h-7 relative overflow-visible rotate-180" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10.5 21L17.5 14L10.5 7" stroke="white" stroke-width="2.33333" stroke-linecap="round" stroke-linejoin="round"></path>
          </svg>
        </div>
        <div class="blaze-next bg-[#000000] p-2 flex flex-row gap-2.5 items-center justify-start absolute right-8 top-[50%]" style="translate: 0 -50%">
          <svg class="shrink-0 w-7 h-7 relative overflow-visible" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10.5 21L17.5 14L10.5 7" stroke="white" stroke-width="2.33333" stroke-linecap="round" stroke-linejoin="round"></path>
          </svg>
        </div>
        <!-- <div class="blaze-pagination"></div> -->
      </div>
    </div>
  </div>

  <div class="pr-6 pl-6 flex flex-col gap-6 items-center justify-start w-full max-w-full md:w-[1440px] m-auto">
    <div class="flex flex-row items-center justify-between self-stretch shrink-0 relative">
      <div class="text-[#242424] text-left font-['Raleway-SemiBold',_sans-serif] text-2xl leading-8 font-semibold relative flex items-center justify-start">
        <?php echo esc_html__( 'Shop by Category', 'creative-furniture' ); ?>
      </div>
    </div>
    <?php
      $categories = get_terms([
        'taxonomy'   => 'product_cat',
        'hide_empty' => false,
        'number'     => 5,
        'slug'       => explode(',', 'home,office,hospitality,unique,outdoor')
      ]);
    ?>
    <div class="hidden sm:grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 items-center justify-start self-stretch shrink-0 relative">
      <?php
      if (!is_wp_error($categories) && !empty($categories)) {
        foreach ($categories as $category) {
          get_template_part('template-parts/category-card-rounded', null, ['category' => $category]);
        }
      }
      ?>
    </div>
    <div class="w-full block sm:hidden relative">
      <div class="blaze-slider" data-slider="hero" data-config="<?php echo esc_attr(json_encode(['all' => ['loop' => false, 'slidesToShow' => 1, 'slidesToScroll' => 1]])); ?>">
        <div class="blaze-container">
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

          <!-- arrow -->
        </div>
      </div>
    </div>
  </div>

  <div class="lg:px-4 w-full">
    <div class="bg-[#f9f9f9] lg:pl-[100px] flex flex-col gap-6 items-center justify-start w-full max-w-full md:w-[1440px] m-auto overflow-hidden">
      <div class="flex flex-wrap items-center justify-between self-stretch flex-1 relative px-4 md:px-7 py-10 lg:p-0 gap-7">
        <div class="flex flex-col gap-10 items-start justify-start shrink-0 w-full md:w-[476px] relative">
          <div class="flex flex-col gap-3 items-start justify-start self-stretch shrink-0 relative">
            <div class="rounded-[48px] border-solid border-[#eeeeee] border pt-1.5 pr-3.5 pb-1.5 pl-3.5 flex flex-row gap-2.5 items-center justify-center shrink-0 relative">
              <div class="text-[#3f3f3f] text-left font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal relative">
                <?php echo esc_html__( 'Latest Collection', 'creative-furniture' ); ?>
              </div>
            </div>
            <div class="text-[#010101] text-left font-['Raleway-SemiBold',_sans-serif] text-[32px] leading-[44px] font-semibold relative self-stretch">
              <?php echo esc_html__( 'Modern Home Furniture Collection', 'creative-furniture' ); ?>
            </div>
            <div class="text-[#2f2f2f] text-left font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal relative self-stretch" style="opacity: 0.8">
              <?php echo esc_html__( 'Premium pieces crafted to enhance everyday living with refined aesthetics and lasting comfort.', 'creative-furniture' ); ?>
            </div>
          </div>
          <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="text-[#161616] border-solid border-[#353535] border-b pb-2 flex flex-row gap-2 items-start justify-start shrink-0 relative">
            <div class="text-left font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal relative flex items-center justify-start">
              <?php echo esc_html__( 'Explore Collection', 'creative-furniture' ); ?>
            </div>
            <svg class="shrink-0 w-6 h-6 relative overflow-visible" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="#353535" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
          </a>
        </div>
        <img class="shrink-0 w-[724px] h-[433px] relative" style="object-fit: cover" src="<?php echo esc_url($theme_directory_uri . '/dist/images/v2/modern-home-furniture-collection.png'); ?>">
      </div>
    </div>
  </div>

  <div class="flex flex-col gap-7 px-4 md:p-4 items-start justify-start w-full max-w-full md:w-[1440px] m-auto relative">
    <div class="flex flex-row items-center justify-between self-stretch shrink-0 relative">
      <div class="text-black-primary text-left font-['Raleway-SemiBold',_sans-serif] text-xl sm:text-2xl leading-8 font-semibold relative flex items-center justify-start">
        <?php esc_html_e('New Arrivals', 'creative-furniture'); ?>
      </div>
      <a href="/shop" class="text-[#161616] text-left font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal relative flex items-center justify-start" style="text-decoration: underline">
        <?php esc_html_e('Explore more', 'creative-furniture'); ?>
      </a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 items-center justify-start self-stretch shrink-0 relative">
      <a href="#" class="bg-[#f4f4f4] p-6 flex flex-col gap-4 items-center justify-center flex-1 relative">
        <div class="self-stretch shrink-0 lg:h-[267px] relative overflow-hidden">
          <img class="w-full" style="object-fit: cover" src="<?php echo esc_url($theme_directory_uri); ?>/dist/images/v2/rectangle-453430.png">
          <!-- <svg class="w-full h-[auto] absolute left-0 top-52 overflow-visible" width="405" height="59" viewBox="0 0 405 59" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 56.5C144.013 56.5 189.487 57.5 333.5 57.5L404.5 0" stroke="#BD262A" stroke-width="3.5"></path>
            <path d="M405 59V2L334.5 59H405Z" fill="#F4F4F4"></path>
          </svg> -->
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
      <a href="#" class="bg-[#f4f4f4] p-6 flex flex-col gap-4 items-center justify-center flex-1 relative">
        <div class="self-stretch shrink-0 lg:h-[267px] relative overflow-hidden">
          <img class="w-full" style="object-fit: cover" src="<?php echo esc_url($theme_directory_uri); ?>/dist/images/v2/rectangle-453431.png">
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
      <a href="#" class="bg-[#f4f4f4] p-6 flex flex-col gap-4 items-center justify-center flex-1 relative">
        <div class="self-stretch shrink-0 lg:h-[267px] relative overflow-hidden">
          <img class="w-full" style="object-fit: cover" src="<?php echo esc_url($theme_directory_uri); ?>/dist/images/v2/rectangle-453432.png">
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
    </div>
  </div>

  <div class="w-full lg:px-4">
    <div class="flex flex-col gap-7 items-start justify-start bg-[#f4f4f4] w-full max-w-full md:w-[1440px] m-auto relative">
      <div class="flex flex-col sm:flex-row gap-7 justify-between p-4 items-center w-full">
        <div class="flex flex-col gap-2 items-start justify-start p-4">
          <div class="text-[#010101] text-center sm:text-left font-['Raleway-SemiBold',_sans-serif] text-2xl leading-8 font-semibold relative self-stretch" >
            <?php esc_html_e('Trusted Member of the BNI Network', 'creative-furniture'); ?>
          </div>
          <div class="text-[#4d4d4d] text-center sm:text-left font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal relative self-stretch" >
            <?php echo nl2br(esc_html(sprintf(__('As a member of BNI, Creative Furniture builds strong professional relationships, shares valuable referrals, and contributes to a %s trusted global business network.', 'creative-furniture'), '\n'))); ?>
          </div>
        </div>
        <img
          class="w-[234px] h-[91px]"
          style="object-fit: cover; aspect-ratio: 234/91"
          src="<?php echo esc_url($theme_directory_uri . '/dist/images/v2/image-2780.png'); ?>"
        />
      </div>
    </div>
  </div>
  
  <?php get_template_part('template-parts/export-cat-collection-block', null, ['title' => __('Best Sellers', 'creative-furniture'), 'link' => home_url('/shop'), 'query' => [], 'type' => 'bestsellers']); ?>

  <div class="flex flex-col gap-7 items-start justify-start w-full max-w-full md:w-[1440px] m-auto relative">
    <div class="w-full flex flex-col gap-4 px-4 --md:px-0">
      <div class="w-full flex flex-row items-center justify-between self-stretch shrink-0 gap-4 relative">
        <div class="text-black-primary text-left font-['Raleway-SemiBold',_sans-serif] text-xl sm:text-2xl leading-8 font-semibold relative flex items-center justify-start">
          <?php esc_html_e('This Season’s Top Picks', 'creative-furniture'); ?>
        </div>
        <a href="/shop" class="text-[#161616] text-left font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal relative flex items-center justify-start" style="text-decoration: underline">
          <?php esc_html_e('Explore more', 'creative-furniture'); ?>
        </a>
      </div>
    </div>
    <div class="w-full">
      <div class="blaze-slider" data-slider="hero" data-config="<?php echo esc_attr(json_encode(['all' => ['loop' => true, 'slidesToShow' => 1, 'slidesToScroll' => 1]])); ?>">
        <div class="blaze-container">
          <div class="blaze-track-container">
            <div class="blaze-track">
              <?php for ($i = 1; $i <= 5; $i++): ?>
                <div class="self-stretch shrink-0 h-[437px] relative">
                  <div class="md:pr-[100px] md:pl-[100px] flex flex-row items-center justify-between h-[437px] absolute left-0 top-0 bg-center no-repeat bg-cover w-full" style="
                      background-image: linear-gradient( 96.56deg, rgba(244, 244, 244, 1) 20%, rgba(255, 255, 255, 0) 100% ), url(<?php echo esc_url($theme_directory_uri); ?>/dist/images/v2/frame-21214531531.png);
                      background-position: center;
                      background-repeat: no-repeat;
                      background-size: cover;
                    ">
                    <div class="flex flex-col gap-10 items-center justify-center shrink-0 px-4 w-full md:w-[476px] relative">
                      <div class="flex flex-col gap-2 items-center justify-center self-stretch shrink-0 relative">
                        <div class="text-[#000000] text-left font-['Raleway-Bold',_sans-serif] text-lg leading-[26px] font-bold relative">
                          <?php esc_html_e('Top Picks', 'creative-furniture'); ?>
                        </div>
                        <div class="text-center font-['Raleway-Bold',_sans-serif] text-[28px] leading-10 font-bold relative self-stretch">
                          <span>
                            <span class="text-[#BD262A]"><?php echo esc_html(sprintf(__('%s Off', 'creative-furniture'), '15%')); ?></span>
                            <span class=""></span>
                            <span class="">
                              <?php echo nl2br(esc_html(sprintf(__('For Outdoor %s Collection', 'creative-furniture'), '\n'))); ?>
                            </span>
                          </span>
                        </div>
                        <div class="text-[#2f2f2f] text-center font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal relative self-stretch" style="opacity: 0.8">
                          <?php esc_html_e('Premium furniture engineered for style, performance, and long-term durability.', 'creative-furniture'); ?>
                        </div>
                      </div>
                      <a href="#" class="bg-[#000000] border-solid border-[transparent] border pt-3.5 pr-8 pb-3.5 pl-8 flex flex-row gap-2.5 items-center justify-center shrink-0 relative cursor-pointer">
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

  <?php get_template_part('template-parts/export-cat-collection-block', null, ['title' => __('Explore Office Chair', 'creative-furniture'), 'link' => home_url('/shop'), 'query' => ['orderby' => 'rand'], 'type' => 'chairs']); ?>
  

  <div class="bg-[#000000] min-h-[88px] grid grid-cols-1 md:grid-cols-3 items-center justify-center md:justify-between py-4 gap-4 overflow-hidden w-full max-w-full md:w-[1440px] m-auto relative">
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
      <div class="bg-[#9D0004]/50 px-4 py-1.5 rounded-full text-center">
        <span class="text-[#ffffff] text-xs font-semibold uppercase tracking-wider"><?php esc_html_e('Limited Time Offer', 'creative-furniture'); ?></span>
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

  <div class="flex flex-col gap-7 items-start justify-start px-4 w-full max-w-full md:w-[1440px] m-auto relative">
    <div class="flex flex-row items-center justify-between self-stretch shrink-0 relative">
      <div class="text-black-primary text-left font-['Raleway-SemiBold',_sans-serif] text-xl sm:text-2xl leading-8 font-semibold relative flex items-center justify-start">
        <?php esc_html_e('Shop the Look', 'creative-furniture'); ?>
      </div>
      <a href="/shop" class="text-[#161616] text-left font-['Lato-Regular',_sans-serif] text-lg leading-6 font-normal relative flex items-center justify-start" style="text-decoration: underline; opacity: 0">
        <?php esc_html_e('Explore more', 'creative-furniture'); ?>
      </a>
    </div>
    <div class="flex flex-col md:flex-row gap-4 items-start justify-start self-stretch shrink-0 relative">
      <div class="flex flex-col gap-4 items-start justify-start w-full md:w-auto shrink-0 relative">
        <div class="shrink-0 w-full md:w-[431px] h-[415px] relative overflow-hidden" style="
            background: url(<?php echo esc_url($theme_directory_uri); ?>/dist/images/v2/frame-16100692210.png) center;
            background-size: cover;
            background-repeat: no-repeat;
          ">
          <?php
          $hotspots_top_left = [
            ['top' => '96px', 'left' => '216px', 'name' => 'Accent Piece 1', 'price' => 'AED 1,500.00'],
            ['top' => '86px', 'left' => '334px', 'name' => 'Accent Piece 2', 'price' => 'AED 900.00'],
            ['top' => '282px', 'left' => '194px', 'name' => 'Accent Piece 3', 'price' => 'AED 2,100.00'],
          ];
          foreach ($hotspots_top_left as $spot) : ?>
          <div class="bg-[rgba(255,255,255,0.11)] rounded-[26px] p-2.5 flex flex-row gap-2.5 items-center justify-start absolute hotspot-indicator" 
               style="backdrop-filter: blur(4px); top: <?php echo $spot['top']; ?>; left: <?php echo $spot['left']; ?>;"
               data-tippy-content='<div class="bg-[#ffffff] rounded-lg p-2 flex flex-row gap-2 items-center justify-start relative shadow-lg min-w-[150px]">
                  <div class="flex flex-col gap-1 items-start justify-start flex-1">
                    <div class="text-[#151515] text-left font-Raleway text-[10px] leading-[15px] font-normal uppercase"><?php echo esc_html($spot['name']); ?></div>
                    <div class="text-[#0f0f0f] text-right font-Raleway text-xs leading-[18px] font-medium"><?php echo esc_html($spot['price']); ?></div>
                  </div>
                  <svg class="shrink-0 w-5 h-5 relative overflow-visible" width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.50769 15.0063L12.5051 10.0038L7.50256 5.00635" stroke="#151515" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"></path>
                  </svg>
               </div>'>
            <div class="bg-[#ffffff] rounded-[50%] shrink-0 w-3 h-3 relative"></div>
          </div>
          <?php endforeach; ?>
        </div>
        <div class="shrink-0 w-full md:w-[431px] h-[315px] relative overflow-hidden" style="
            background: url(<?php echo esc_url($theme_directory_uri); ?>/dist/images/v2/frame-16100692200.png) center;
            background-size: cover;
            background-repeat: no-repeat;
          ">
          <?php
          $hotspots_bottom_left = [
            ['top' => '54px', 'left' => '170px', 'name' => 'Living Item 1', 'price' => 'AED 750.00'],
            ['top' => '191px', 'left' => '164px', 'name' => 'Living Item 2', 'price' => 'AED 1,100.00'],
            ['top' => '181px', 'left' => '62px', 'name' => 'Living Item 3', 'price' => 'AED 450.00'],
            ['top' => '171px', 'left' => '305px', 'name' => 'Living Item 4', 'price' => 'AED 1,350.00'],
          ];
          foreach ($hotspots_bottom_left as $spot) : ?>
          <div class="bg-[rgba(255,255,255,0.11)] rounded-[26px] p-2.5 flex flex-row gap-2.5 items-center justify-start absolute hotspot-indicator" 
               style="backdrop-filter: blur(4px); top: <?php echo $spot['top']; ?>; left: <?php echo $spot['left']; ?>;"
               data-tippy-content='<div class="bg-[#ffffff] rounded-lg p-2 flex flex-row gap-2 items-center justify-start relative shadow-lg min-w-[150px]">
                  <div class="flex flex-col gap-1 items-start justify-start flex-1">
                    <div class="text-[#151515] text-left font-Raleway text-[10px] leading-[15px] font-normal uppercase"><?php echo esc_html($spot['name']); ?></div>
                    <div class="text-[#0f0f0f] text-right font-Raleway text-xs leading-[18px] font-medium"><?php echo esc_html($spot['price']); ?></div>
                  </div>
                  <svg class="shrink-0 w-5 h-5 relative overflow-visible" width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.50769 15.0063L12.5051 10.0038L7.50256 5.00635" stroke="#151515" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"></path>
                  </svg>
               </div>'>
            <div class="bg-[#ffffff] rounded-[50%] shrink-0 w-3 h-3 relative"></div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="flex flex-col gap-4 items-start justify-center self-stretch flex-1 w-full relative">
        <?php
        $hotspots_top_right = [
          [
            'top' => '136px',
            'left' => '276px',
            'product_id' => 123,
            'product_name' => 'Wooden Finish Veneer with Metal Frame',
            'product_price' => 'AED3,575.00',
          ],
          [
            'top' => '238px',
            'left' => '110px',
            'product_id' => 124,
            'product_name' => 'Product Name 2',
            'product_price' => 'AED1,200.00',
          ],
          [
            'top' => '146px',
            'left' => '490px',
            'product_id' => 125,
            'product_name' => 'Product Name 3',
            'product_price' => 'AED2,500.00',
          ],
          [
            'top' => '238px',
            'left' => '571px',
            'product_id' => 126,
            'product_name' => 'Product Name 4',
            'product_price' => 'AED800.00',
          ],
          [
            'top' => '182px',
            'left' => '738px',
            'product_id' => 127,
            'product_name' => 'Product Name 5',
            'product_price' => 'AED4,000.00',
          ]
        ];
        ?>
        <div class="self-stretch shrink-0 h-[303px] relative overflow-hidden" style="
            background: url(<?php echo esc_url($theme_directory_uri); ?>/dist/images/v2/frame-16100692251.png) center;
            background-size: cover;
            background-repeat: no-repeat;
          ">
          <?php foreach ($hotspots_top_right as $index => $spot) : ?>
          <div class="bg-[rgba(255,255,255,0.11)] rounded-[26px] p-2.5 flex flex-row gap-2.5 items-center justify-start absolute hotspot-indicator" 
               style="backdrop-filter: blur(4px); top: <?php echo esc_attr($spot['top']); ?>; left: <?php echo esc_attr($spot['left']); ?>;"
               data-tippy-content='<div class="bg-[#ffffff] rounded-lg p-2 flex flex-row gap-2 items-center justify-start relative shadow-lg min-w-[150px]">
                  <div class="flex flex-col gap-1 items-start justify-start flex-1">
                    <div class="text-[#151515] text-left font-Raleway text-[10px] leading-[15px] font-normal uppercase"><?php echo esc_html($spot['product_name']); ?></div>
                    <div class="text-[#0f0f0f] text-right font-Raleway text-xs leading-[18px] font-medium"><?php echo esc_html($spot['product_price']); ?></div>
                  </div>
                  <svg class="shrink-0 w-5 h-5 relative overflow-visible" width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M7.50769 15.0063L12.5051 10.0038L7.50256 5.00635" stroke="#151515" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"></path>
                  </svg>
               </div>'>
            <div class="bg-[#ffffff] rounded-[50%] shrink-0 w-3 h-3 relative"></div>
          </div>
          <?php endforeach; ?>
        </div>
        <div class="flex flex-col sm:flex-row gap-4 items-start justify-start self-stretch flex-1 relative">
          <div class="self-stretch flex-1 w-full h-[300px] sm:h-auto relative overflow-hidden" style="
              background: url(<?php echo esc_url($theme_directory_uri); ?>/dist/images/v2/frame-16100692220.png) center;
              background-size: cover;
              background-repeat: no-repeat;
            ">
            <?php
            $hotspots_bottom_middle = [
              ['top' => '257px', 'left' => '375px', 'name' => 'Middle Item 1', 'price' => 'AED 850.00'],
              ['top' => '27px', 'left' => '232px', 'name' => 'Middle Item 2', 'price' => 'AED 1,200.00'],
              ['top' => '225px', 'left' => '226px', 'name' => 'Middle Item 3', 'price' => 'AED 950.00'],
            ];
            foreach ($hotspots_bottom_middle as $spot) : ?>
            <div class="bg-[rgba(255,255,255,0.11)] rounded-[26px] p-2.5 flex flex-row gap-2.5 items-center justify-start absolute hotspot-indicator" 
                 style="backdrop-filter: blur(4px); top: <?php echo $spot['top']; ?>; left: <?php echo $spot['left']; ?>;"
                 data-tippy-content='<div class="bg-[#ffffff] rounded-lg p-2 flex flex-row gap-2 items-center justify-start relative shadow-lg min-w-[150px]">
                    <div class="flex flex-col gap-1 items-start justify-start flex-1">
                      <div class="text-[#151515] text-left font-Raleway text-[10px] leading-[15px] font-normal uppercase"><?php echo esc_html($spot['name']); ?></div>
                      <div class="text-[#0f0f0f] text-right font-Raleway text-xs leading-[18px] font-medium"><?php echo esc_html($spot['price']); ?></div>
                    </div>
                    <svg class="shrink-0 w-5 h-5 relative overflow-visible" width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M7.50769 15.0063L12.5051 10.0038L7.50256 5.00635" stroke="#151515" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                 </div>'>
              <div class="bg-[#ffffff] rounded-[50%] shrink-0 w-3 h-3 relative"></div>
            </div>
            <?php endforeach; ?>
          </div>
          <div class="self-stretch flex-1 w-full h-[300px] sm:h-auto relative overflow-hidden" style="
              background: url(<?php echo esc_url($theme_directory_uri); ?>/dist/images/v2/frame-16100692261.png) center;
              background-size: cover;
              background-repeat: no-repeat;
            ">
            <?php
            $hotspots_bottom_right = [
              ['top' => '163px', 'left' => '116.5px', 'name' => 'End Item 1', 'price' => 'AED 1,850.00'],
              ['top' => '300px', 'left' => '89.5px', 'name' => 'End Item 2', 'price' => 'AED 2,200.00'],
              ['top' => '322px', 'left' => '299.5px', 'name' => 'End Item 3', 'price' => 'AED 3,950.00'],
            ];
            foreach ($hotspots_bottom_right as $spot) : ?>
            <div class="bg-[rgba(255,255,255,0.11)] rounded-[26px] p-2.5 flex flex-row gap-2.5 items-center justify-start absolute hotspot-indicator" 
                 style="backdrop-filter: blur(4px); top: <?php echo $spot['top']; ?>; left: <?php echo $spot['left']; ?>;"
                 data-tippy-content='<div class="bg-[#ffffff] rounded-lg p-2 flex flex-row gap-2 items-center justify-start relative shadow-lg min-w-[150px]">
                    <div class="flex flex-col gap-1 items-start justify-start flex-1">
                      <div class="text-[#151515] text-left font-Raleway text-[10px] leading-[15px] font-normal uppercase"><?php echo esc_html($spot['name']); ?></div>
                      <div class="text-[#0f0f0f] text-right font-Raleway text-xs leading-[18px] font-medium"><?php echo esc_html($spot['price']); ?></div>
                    </div>
                    <svg class="shrink-0 w-5 h-5 relative overflow-visible" width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M7.50769 15.0063L12.5051 10.0038L7.50256 5.00635" stroke="#151515" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                 </div>'>
              <div class="bg-[#ffffff] rounded-[50%] shrink-0 w-3 h-3 relative"></div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php get_template_part('template-parts/export-cat-collection-block', null, ['title' => __('Explore Desk', 'creative-furniture'), 'link' => home_url('/shop'), 'query' => [], 'type' => 'desks']); ?>

  <div class="flex flex-col gap-7 items-start justify-start px-4 --md:px-0 w-full max-w-full md:w-[1440px] m-auto">
    <div class="flex flex-row items-center justify-between self-stretch shrink-0 relative">
      <div class="text-black-primary text-left font-['Raleway-SemiBold',_sans-serif] text-xl sm:text-2xl leading-8 font-semibold relative flex items-center justify-start">
        <?php esc_html_e('Deal Zone', 'creative-furniture'); ?>
      </div>
      <a href="/shop" class="text-[#161616] text-left font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal relative flex items-center justify-start" style="text-decoration: underline">
        <?php esc_html_e('Explore more', 'creative-furniture'); ?>
      </a>
    </div>
    <div class="blaze-slider w-full" data-slider="hero" data-config="<?php echo esc_attr(json_encode(['all' => ['loop' => true, 'gap' => '12px', 'slidesToShow' => 3, 'slidesToScroll' => 1], '(max-width: 900px)' => ['slidesToShow' => 2], '(max-width: 500px)' => ['slidesToShow' => 1]])); ?>">
      <div class="blaze-container w-full">
        <div class="blaze-track-container w-full">
          <div class="blaze-track w-full">
            <a href="#" class="bg-[#fef6ee] shrink-0 h-[156px] relative overflow-hidden" target="_blank">
              <div class="flex flex-row gap-2 items-center justify-start absolute left-6 top-[50%]" style="translate: 0 -50%">
                <div class="flex flex-col gap-2 items-start justify-center shrink-0 relative">
                  <div class="text-[#000000] text-right font-['Raleway-SemiBold',_sans-serif] text-2xl leading-8 font-semibold relative">
                    <?php esc_html_e('Maximum', 'creative-furniture'); ?>
                  </div>
                  <div class="text-[#bd262a] text-right font-['Raleway-SemiBold',_sans-serif] text-2xl leading-8 font-semibold relative">
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
            <a href="#" class="bg-[#fef6ee] shrink-0 h-[156px] relative overflow-hidden" target="_blank">
              <div class="flex flex-row gap-2 items-center justify-start absolute left-6 top-[50%]" style="translate: 0 -50%">
                <div class="flex flex-col gap-2 items-start justify-center shrink-0 relative">
                  <div class="text-[#000000] text-right font-['Raleway-SemiBold',_sans-serif] text-2xl leading-8 font-semibold relative">
                    Decor on
                  </div>
                  <div class="text-[#bd262a] text-right font-['Raleway-SemiBold',_sans-serif] text-2xl leading-8 font-semibold relative">
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
            <a href="#" class="bg-[#fef6ee] shrink-0 h-[156px] relative overflow-hidden" target="_blank">
              <div class="flex flex-row gap-2 items-center justify-start absolute left-6 top-[50%]" style="translate: 0 -50%">
                <div class="flex flex-col gap-2 items-start justify-center shrink-0 relative">
                  <div class="text-[#000000] text-right font-['Raleway-SemiBold',_sans-serif] text-2xl leading-8 font-semibold relative">
                    <?php esc_html_e('Best Buys', 'creative-furniture'); ?>
                  </div>
                  <div class="text-[#bd262a] text-right font-['Raleway-SemiBold',_sans-serif] text-lg leading-[26px] font-semibold relative">
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
            <a href="#" class="bg-[#fef6ee] shrink-0 h-[156px] relative overflow-hidden" target="_blank">
              <div class="flex flex-row gap-2 items-center justify-start absolute left-6 top-[50%]" style="translate: 0 -50%">
                <div class="flex flex-col gap-2 items-start justify-center shrink-0 relative">
                  <div class="text-[#000000] text-right font-['Raleway-SemiBold',_sans-serif] text-2xl leading-8 font-semibold relative">
                    <?php esc_html_e('Maximum', 'creative-furniture'); ?>
                  </div>
                  <div class="text-[#bd262a] text-right font-['Raleway-SemiBold',_sans-serif] text-2xl leading-8 font-semibold relative">
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
            <a href="#" class="bg-[#fef6ee] shrink-0 h-[156px] relative overflow-hidden" target="_blank">
              <div class="flex flex-row gap-2 items-center justify-start absolute left-6 top-[50%]" style="translate: 0 -50%">
                <div class="flex flex-col gap-2 items-start justify-center shrink-0 relative">
                  <div class="text-[#000000] text-right font-['Raleway-SemiBold',_sans-serif] text-2xl leading-8 font-semibold relative">
                    <?php esc_html_e('Decor on', 'creative-furniture'); ?>
                  </div>
                  <div class="text-[#bd262a] text-right font-['Raleway-SemiBold',_sans-serif] text-2xl leading-8 font-semibold relative">
                    <?php esc_html_e('Sale', 'creative-furniture'); ?>
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
            <a href="#" class="bg-[#fef6ee] shrink-0 h-[156px] relative overflow-hidden" target="_blank">
              <div class="flex flex-row gap-2 items-center justify-start absolute left-6 top-[50%]" style="translate: 0 -50%">
                <div class="flex flex-col gap-2 items-start justify-center shrink-0 relative">
                  <div class="text-[#000000] text-right font-['Raleway-SemiBold',_sans-serif] text-2xl leading-8 font-semibold relative">
                    <?php esc_html_e('Best Buys', 'creative-furniture'); ?>
                  </div>
                  <div class="text-[#bd262a] text-right font-['Raleway-SemiBold',_sans-serif] text-lg leading-[26px] font-semibold relative">
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

  <div class="bg-[#f9f9f9] flex flex-col w-full max-w-full md:w-[1440px] m-auto relative">
    <div class="blaze-slider w-full" data-slider="hero" data-config="<?php echo esc_attr(json_encode(['all' => ['loop' => true, 'slidesToShow' => 1, 'slidesToScroll' => 1]])); ?>">
      <div class="blaze-container w-full">
        <div class="blaze-track-container">
          <div class="blaze-track">
            <?php for ($i = 1;$i <= 5; $i++): ?>
            <div class="flex flex-col md:flex-row items-center justify-between self-stretch -flex-1 relative">
              <img class="shrink-0 w-full md:w-[808px] h-[250px] md:h-[433px] relative" style="object-fit: cover" src="<?php echo esc_url($theme_directory_uri); ?>/dist/images/v2/rectangle-45411.png">
              <div class="flex flex-col gap-10 items-center justify-center shrink-0 w-full md:w-[476px] py-7 md:py-10 px-7 relative">
                <div class="flex flex-col gap-4 items-center justify-start self-stretch shrink-0 relative">
                  <div class="text-center font-['Raleway-Bold',_sans-serif] text-[28px] leading-10 font-bold relative self-stretch">
                    <span>
                      <span class="limited-time-deals-on-shoe-rack-span">
                        <?php esc_html_e('Limited-time deals on', 'creative-furniture'); ?>
                        <br>
                      </span>
                      <span class="limited-time-deals-on-shoe-rack-span2">
                        <?php esc_html_e('Shoe Rack', 'creative-furniture'); ?>
                      </span>
                    </span>
                  </div>
                  <div class="flex flex-row gap-2 items-start justify-start shrink-0 relative">
                    <div class="text-[#bd262a] text-center font-['Raleway-SemiBold',_sans-serif] text-2xl leading-8 font-semibold relative" style="opacity: 0.8">
                      AED3,575.00
                    </div>
                    <div class="text-[#171717] text-center font-['Raleway-Regular',_sans-serif] text-2xl leading-8 font-normal relative" style="text-decoration: line-through; opacity: 0.8">
                      AED3,575.00
                    </div>
                  </div>
                </div>
                <div class="bg-[#000000] border-solid border-[transparent] border pt-3.5 pr-8 pb-3.5 pl-8 flex flex-row gap-2.5 items-center justify-center shrink-0 relative">
                  <div class="text-[#ffffff] text-center font-['Raleway-SemiBold',_sans-serif] text-base leading-6 font-semibold relative flex items-center justify-center">
                    <?php esc_html_e('View Details', 'creative-furniture'); ?>
                  </div>
                </div>
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
  
  <?php get_template_part('template-parts/export-cat-collection-block', null, ['title' => __('Explore Living Furniture', 'creative-furniture'), 'link' => home_url('/shop'), 'query' => [], 'type' => 'living']); ?>


  <div class="h-[350px] md:h-[453px] w-full max-w-full md:w-[1440px] m-auto relative overflow-hidden"
  style="
    background-image: url('<?php echo esc_url($theme_directory_uri); ?>/dist/images/v2/vector-40.png');
    background-position: center center;
    background-attachment: fixed;
    background-repeat: repeat;
    padding: 0px 0px 0px 0px;
  "
  >
    <div class="w-full h-full absolute right-0 bottom-0 overflow-visible" style="background: linear-gradient(0deg, #ffffff20 0%, #33333380 100%);"></div>
    <div class="flex flex-col gap-5 items-center justify-center w-full md:w-[476px] absolute left-[50%] top-[50%]" style="translate: -50% -50%" >
      <div class="flex flex-col gap-2 items-center justify-center self-stretch shrink-0 relative" >
        <div class="text-[#ffffff] text-center font-['Lato-Bold',_sans-serif] text-[32px] leading-[44px] font-bold relative self-stretch" >
          <?php echo nl2br(esc_html(sprintf(__('Ready to Upgrade Your %s Interior?', 'creative-furniture'), "\n"))); ?>
        </div>
      </div>
      <a href="/shop" class="border-solid border-[transparent] border pt-3.5 pr-8 pb-3.5 pl-8 flex flex-row gap-2.5 items-center justify-center shrink-0 relative bg-[#ffffff] text-[#000000] hover:bg-[#000000] hover:text-white" >
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
