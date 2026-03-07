<?php get_header(); ?>
<div class="relative flex flex-col gap-20">



  <div class="mt-4 w-[1440px] m-auto relative">
    <div class="blaze-slider" data-slider="hero" data-config="<?php echo esc_attr(json_encode(['all' => ['loop' => false, 'slidesToShow' => 1, 'slidesToScroll' => 1,]])); ?>">
      <div class="blaze-container">
        <div class="blaze-track-container">
          <div class="blaze-track">
            <?php for ($i=1; $i <= 5; $i++) : ?>
            <div class="relative h-[673px]">
              <img class="h-[673px] absolute right-0 left-0 top-[50%]" style="translate: 0 -50%; object-fit: cover" src="https://creativefurniture.local/wp-content/themes/creative-furniture/src/img/v2/smart-furniture-for-modern-offices-hero-1.png">
              <div class="flex flex-col gap-52 items-start justify-start w-[476px] absolute left-[100px] top-[50%]" style="translate: 0 -50%">
                <div class="flex flex-col gap-3 items-start justify-start self-stretch shrink-0 relative">
                  <div class="text-[#010101] text-left font-['Raleway-SemiBold',_sans-serif] text-[38px] leading-[48px] font-semibold relative self-stretch">
                    Smart Furniture for Modern Offices
                  </div>
                  <div class="text-[#2f2f2f] text-left font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal relative self-stretch" style="opacity: 0.8">
                    Design, supply, and installation services for startups, enterprises,
                    and commercial spaces.
                  </div>
                </div>
                <div class="bg-[#000000] border-solid border-[transparent] border pt-3.5 pr-8 pb-3.5 pl-8 flex flex-row gap-2.5 items-center justify-center shrink-0 relative">
                  <div class="text-[#ffffff] text-center font-['Raleway-SemiBold',_sans-serif] text-base leading-6 font-semibold relative flex items-center justify-center">
                    Shop Furniture
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
  <div class="pr-6 pl-6 flex flex-col gap-6 items-center justify-start w-[1440px] m-auto">
    <div class="flex flex-row items-center justify-between self-stretch shrink-0 relative">
      <div class="text-[#242424] text-left font-['Raleway-SemiBold',_sans-serif] text-2xl leading-8 font-semibold relative flex items-center justify-start">
        <?php echo esc_html__( 'Shop by Category', 'creative-furniture' ); ?>
      </div>
    </div>
    <div class="flex flex-row gap-4 items-center justify-start self-stretch shrink-0 relative">
      <?php
      $categories = get_terms([
        'taxonomy'   => 'product_cat',
        'hide_empty' => false,
        'number'     => 5,
        'slug'       => explode(',', 'home,office,hospitality,unique,outdoor')
      ]);
      if (!is_wp_error($categories) && !empty($categories)) {
        foreach ($categories as $category) {
          get_template_part('template-parts/category-card-rounded', null, ['category' => $category]);
        }
      }
      ?>
    </div>
  </div>
  <div class="bg-[#f9f9f9] pl-[100px] flex flex-col gap-6 items-center justify-start w-[1440px] m-auto overflow-hidden">
    <div class="flex flex-row items-center justify-between self-stretch flex-1 relative">
      <div class="flex flex-col gap-10 items-start justify-start shrink-0 w-[476px] relative">
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
        <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="border-solid border-[#353535] border-b pb-2 flex flex-row gap-2 items-start justify-start shrink-0 relative">
          <div class="text-[#161616] text-left font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal relative flex items-center justify-start">
            <?php echo esc_html__( 'Explore Collection', 'creative-furniture' ); ?>
          </div>
          <svg class="shrink-0 w-6 h-6 relative overflow-visible" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="#353535" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
          </svg>
        </a>
      </div>
      <img class="shrink-0 w-[724px] h-[433px] relative" style="object-fit: cover" src="<?php echo esc_url(get_template_directory_uri() . '/src/img/v2/modern-home-furniture-collection.png'); ?>">
    </div>
  </div>

  <?php get_template_part('template-parts/export-cat-collection-block', null, ['title' => __('Best Sellers', 'domain'), 'link' => '#', 'query' => []]); ?>

  <div class="flex flex-col gap-7 items-start justify-start w-[1440px] m-auto relative">
    <div class="flex flex-row items-center justify-between self-stretch shrink-0 relative">
      <div class="text-black-primary text-left font-['Raleway-SemiBold',_sans-serif] text-2xl leading-8 font-semibold relative flex items-center justify-start">
        New Arrivals
      </div>
      <a href="#" class="text-[#161616] text-left font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal relative flex items-center justify-start" style="text-decoration: underline">
        Explore more
      </a>
    </div>
    <div class="flex flex-row gap-4 items-center justify-start self-stretch shrink-0 relative">
      <a href="#" class="bg-[#f4f4f4] p-6 flex flex-col gap-4 items-center justify-center flex-1 relative">
        <div class="self-stretch shrink-0 h-[267px] relative overflow-hidden">
          <img class="absolute right-[0.33px] left-0 bottom-0 top-0" style="object-fit: cover" src="https://creativefurniture.local/wp-content/themes/creative-furniture/src/img/v2/rectangle-453430.png">
          <svg class="h-[auto] absolute left-0 top-52 overflow-visible" width="405" height="59" viewBox="0 0 405 59" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 56.5C144.013 56.5 189.487 57.5 333.5 57.5L404.5 0" stroke="#BD262A" stroke-width="3.5"></path>
            <path d="M405 59V2L334.5 59H405Z" fill="#F4F4F4"></path>
          </svg>
        </div>
        <div class="flex flex-row gap-2 items-center justify-center shrink-0 w-[405.33px] h-[30px] relative">
          <div class="text-[#3f3f3f] text-right font-['Raleway-SemiBold',_sans-serif] text-base leading-6 font-semibold relative">
            LOUNGE SEATING
          </div>
          <div class="text-[#484848] text-left font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal relative">
            Comfort meets style.
          </div>
        </div>
      </a>
      <a href="#" class="bg-[#f4f4f4] p-6 flex flex-col gap-4 items-center justify-center flex-1 relative">
        <div class="self-stretch shrink-0 h-[267px] relative overflow-hidden">
          <img class="absolute right-[0.33px] left-0 bottom-0 top-0" style="object-fit: cover" src="https://creativefurniture.local/wp-content/themes/creative-furniture/src/img/v2/rectangle-453431.png">
        </div>
        <div class="flex flex-row gap-2 items-center justify-center shrink-0 w-[405.33px] h-[30px] relative">
          <div class="text-[#3f3f3f] text-right font-['Raleway-SemiBold',_sans-serif] text-base leading-6 font-semibold relative">
            DINING COLLECTION
          </div>
          <div class="text-[#484848] text-left font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal relative">
            Elevated dining design.
          </div>
        </div>
      </a>
      <a href="#" class="bg-[#f4f4f4] p-6 flex flex-col gap-4 items-center justify-center flex-1 relative">
        <div class="self-stretch shrink-0 h-[267px] relative overflow-hidden">
          <img class="absolute right-[0.33px] left-0 bottom-0 top-0" style="object-fit: cover" src="https://creativefurniture.local/wp-content/themes/creative-furniture/src/img/v2/rectangle-453432.png">
        </div>
        <div class="flex flex-row gap-2 items-center justify-center shrink-0 w-[405.33px] h-[30px] relative">
          <div class="text-[#3f3f3f] text-right font-['Raleway-SemiBold',_sans-serif] text-base leading-6 font-semibold relative">
            LIVING ESSENTIALS
          </div>
          <div class="text-[#484848] text-left font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal relative">
            Modern accent pieces.
          </div>
        </div>
      </a>
    </div>
  </div>
  
  <div class="flex flex-col gap-7 items-start justify-start w-[1440px] m-auto">
    <div class="flex flex-row items-center justify-between self-stretch shrink-0 relative">
      <div class="text-black-primary text-left font-['Raleway-SemiBold',_sans-serif] text-2xl leading-8 font-semibold relative flex items-center justify-start">
        This Season’s Top Picks
      </div>
      <a href="#" class="text-[#161616] text-left font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal relative flex items-center justify-start" style="text-decoration: underline">
        Explore more
      </a>
    </div>
    <div class="self-stretch shrink-0 h-[437px] relative">
      <div class="pr-[100px] pl-[100px] flex flex-row items-center justify-between w-[1392px] h-[437px] absolute left-0 top-0" style="
          background: linear-gradient(
            96.56deg,
            rgba(244, 244, 244, 1) 0%,
            rgba(255, 255, 255, 0) 100%
          );
          background: url(https://creativefurniture.local/wp-content/themes/creative-furniture/src/img/v2/frame-21214531531.png) center;
          background-size: cover;
          background-repeat: no-repeat;
        ">
        <div class="flex flex-col gap-10 items-center justify-center shrink-0 w-[476px] relative">
          <div class="flex flex-col gap-2 items-center justify-center self-stretch shrink-0 relative">
            <div class="text-[#000000] text-left font-['Raleway-Bold',_sans-serif] text-lg leading-[26px] font-bold relative">
              Top Picks
            </div>
            <div class="text-center font-['Raleway-Bold',_sans-serif] text-[28px] leading-10 font-bold relative self-stretch">
              <span>
                <span class="_15-off-for-outdoor-collection-span">15% Off</span>
                <span class="_15-off-for-outdoor-collection-span2"></span>
                <span class="_15-off-for-outdoor-collection-span3">
                  For Outdoor
                  <br>
                  Collection
                </span>
              </span>
            </div>
            <div class="text-[#2f2f2f] text-center font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal relative self-stretch" style="opacity: 0.8">
              Premium furniture engineered for style, performance, and long-term
              durability.
            </div>
          </div>
          <div class="bg-[#000000] border-solid border-[transparent] border pt-3.5 pr-8 pb-3.5 pl-8 flex flex-row gap-2.5 items-center justify-center shrink-0 relative">
            <div class="text-[#ffffff] text-center font-['Raleway-SemiBold',_sans-serif] text-base leading-6 font-semibold relative flex items-center justify-center">
              View Details
            </div>
          </div>
        </div>
        <div class="bg-[#bd262a] p-0.5 flex flex-row gap-2.5 items-center justify-start shrink-0 absolute right-[35px] top-[50%]" style="translate: 0 -50%">
          <svg class="shrink-0 w-7 h-7 relative overflow-visible" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10.5 21L17.5 14L10.5 7" stroke="white" stroke-width="2.33333" stroke-linecap="round" stroke-linejoin="round"></path>
          </svg>
        </div>
      </div>
      <svg class="h-[auto] absolute left-0 top-[378.5px] overflow-visible" width="1395" height="62" viewBox="0 0 1395 62" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0 56.5C512.758 56.5 772.242 56.5 1285 56.5L1392.5 0" stroke="#BD262A" stroke-width="3.5"></path>
        <path d="M1395 61.5L1392.5 2L1285.5 59L1395 61.5Z" fill="white"></path>
      </svg>
    </div>
  </div>

  <?php get_template_part('template-parts/export-cat-collection-block', null, ['title' => __('Explore Office Chair', 'domain'), 'link' => '#', 'query' => []]); ?>
  
  <div class="bg-[#000000] h-[88px] w-[1440px] m-auto overflow-hidden relative">
    <div class="w-[341px] h-16 absolute left-0 top-[50%]" style="translate: 0 -50%">
      <svg class="w-[312px] h-[58px] absolute left-0 top-[3px] overflow-visible" width="312" height="58" viewBox="0 0 312 58" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0 0H312L277.689 29L312 58H0V0Z" fill="#9D0004" fill-opacity="0.48"></path>
      </svg>
      <div class="text-[#ffffff] text-center font-['Raleway-SemiBold',_sans-serif] text-2xl leading-8 font-semibold absolute left-8 top-4">
        Limited Time Offer
      </div>
    </div>
    <div class="text-[#ffffff] text-center absolute left-[50%] top-[50%]" style="translate: -50% -50%">
      <span>
        <span class="enjoy-30-off-your-first-order-span">Enjoy</span>
        <span class="enjoy-30-off-your-first-order-span2"></span>
        <span class="enjoy-30-off-your-first-order-span3">30% Off</span>
        <span class="enjoy-30-off-your-first-order-span4"></span>
        <span class="enjoy-30-off-your-first-order-span">Your First Order</span>
      </span>
    </div>
    <div class="border-solid border-[#ffffff] border-b pb-2 flex flex-row gap-2 items-start justify-start absolute left-[1312px] top-[28.5px]">
      <div class="text-[#ffffff] text-left font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal relative flex items-center justify-start">
        Shop Now
      </div>
      <svg class="shrink-0 w-6 h-6 relative overflow-visible" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M5 12H19M19 12L12 5M19 12L12 19" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
      </svg>
    </div>
  </div>

  <div class="flex flex-col gap-7 items-start justify-start w-[1440px] m-auto relative">
    <div class="flex flex-row items-center justify-between self-stretch shrink-0 relative">
      <div class="text-black-primary text-left font-['Raleway-SemiBold',_sans-serif] text-2xl leading-8 font-semibold relative flex items-center justify-start">
        Shop the Look
      </div>
      <a href="#" class="text-[#161616] text-left font-['Lato-Regular',_sans-serif] text-lg leading-6 font-normal relative flex items-center justify-start" style="text-decoration: underline; opacity: 0">
        Explore more
      </a>
    </div>
    <div class="flex flex-row gap-4 items-start justify-start self-stretch shrink-0 relative">
      <div class="flex flex-col gap-4 items-start justify-start shrink-0 relative">
        <div class="shrink-0 w-[431px] h-[415px] relative overflow-hidden" style="
            background: url(https://creativefurniture.local/wp-content/themes/creative-furniture/src/img/v2/frame-16100692210.png) center;
            background-size: cover;
            background-repeat: no-repeat;
          ">
          <div class="bg-[rgba(255,255,255,0.11)] rounded-[26px] p-2.5 flex flex-row gap-2.5 items-center justify-start absolute left-[216px] top-24" style="backdrop-filter: blur(4px)">
            <div class="bg-[#ffffff] rounded-[50%] shrink-0 w-3 h-3 relative"></div>
          </div>
          <div class="bg-[rgba(255,255,255,0.11)] rounded-[26px] p-2.5 flex flex-row gap-2.5 items-center justify-start absolute left-[334px] top-[86px]" style="backdrop-filter: blur(4px)">
            <div class="bg-[#ffffff] rounded-[50%] shrink-0 w-3 h-3 relative"></div>
          </div>
          <div class="bg-[rgba(255,255,255,0.11)] rounded-[26px] p-2.5 flex flex-row gap-2.5 items-center justify-start absolute left-[194px] top-[282px]" style="backdrop-filter: blur(4px)">
            <div class="bg-[#ffffff] rounded-[50%] shrink-0 w-3 h-3 relative"></div>
          </div>
        </div>
        <div class="shrink-0 w-[431px] h-[315px] relative overflow-hidden" style="
            background: url(https://creativefurniture.local/wp-content/themes/creative-furniture/src/img/v2/frame-16100692200.png) center;
            background-size: cover;
            background-repeat: no-repeat;
          ">
          <div class="bg-[rgba(255,255,255,0.11)] rounded-[26px] p-2.5 flex flex-row gap-2.5 items-center justify-start absolute left-[170px] top-[54px]" style="backdrop-filter: blur(4px)">
            <div class="bg-[#ffffff] rounded-[50%] shrink-0 w-3 h-3 relative"></div>
          </div>
          <div class="bg-[rgba(255,255,255,0.11)] rounded-[26px] p-2.5 flex flex-row gap-2.5 items-center justify-start absolute left-[164px] top-[191px]" style="backdrop-filter: blur(4px)">
            <div class="bg-[#ffffff] rounded-[50%] shrink-0 w-3 h-3 relative"></div>
          </div>
          <div class="bg-[rgba(255,255,255,0.11)] rounded-[26px] p-2.5 flex flex-row gap-2.5 items-center justify-start absolute left-[62px] top-[181px]" style="backdrop-filter: blur(4px)">
            <div class="bg-[#ffffff] rounded-[50%] shrink-0 w-3 h-3 relative"></div>
          </div>
          <div class="bg-[rgba(255,255,255,0.11)] rounded-[26px] p-2.5 flex flex-row gap-2.5 items-center justify-start absolute left-[305px] top-[171px]" style="backdrop-filter: blur(4px)">
            <div class="bg-[#ffffff] rounded-[50%] shrink-0 w-3 h-3 relative"></div>
          </div>
        </div>
      </div>
      <div class="flex flex-col gap-4 items-start justify-center self-stretch flex-1 relative">
        <div class="self-stretch shrink-0 h-[303px] relative overflow-hidden" style="
            background: url(https://creativefurniture.local/wp-content/themes/creative-furniture/src/img/v2/frame-16100692251.png) center;
            background-size: cover;
            background-repeat: no-repeat;
          ">
          <div class="bg-[rgba(255,255,255,0.11)] rounded-[26px] p-2.5 flex flex-row gap-2.5 items-center justify-start absolute left-[276px] top-[136px]" style="backdrop-filter: blur(4px)">
            <div class="bg-[#ffffff] rounded-[50%] shrink-0 w-3 h-3 relative"></div>
          </div>
          <div class="bg-[rgba(255,255,255,0.11)] rounded-[26px] p-2.5 flex flex-row gap-2.5 items-center justify-start absolute left-[110px] top-[238px]" style="backdrop-filter: blur(4px)">
            <div class="bg-[#ffffff] rounded-[50%] shrink-0 w-3 h-3 relative"></div>
          </div>
          <div class="bg-[rgba(255,255,255,0.11)] rounded-[26px] p-2.5 flex flex-row gap-2.5 items-center justify-start absolute left-[490px] top-[146px]" style="backdrop-filter: blur(4px)">
            <div class="bg-[#ffffff] rounded-[50%] shrink-0 w-3 h-3 relative"></div>
          </div>
          <div class="bg-[rgba(255,255,255,0.11)] rounded-[26px] p-2.5 flex flex-row gap-2.5 items-center justify-start absolute left-[571px] top-[238px]" style="backdrop-filter: blur(4px)">
            <div class="bg-[#ffffff] rounded-[50%] shrink-0 w-3 h-3 relative"></div>
          </div>
          <div class="bg-[rgba(255,255,255,0.11)] rounded-[26px] p-2.5 flex flex-row gap-2.5 items-center justify-start absolute left-[738px] top-[182px] group" style="backdrop-filter: blur(4px)">
            <div class="bg-[#ffffff] rounded-[50%] shrink-0 w-3 h-3 relative"></div>
            
            <!-- Product detail -->
            <div class="bg-[#ffffff] rounded-lg p-2 flex flex-row gap-2 items-center justify-start absolute 
            opacity-0 group-hover:opacity-100
            h-0 group-hover:h-auto
            w-2/1 group-hover:w-auto
            transition-all delay-75 duration-75 ease-in-out
            overflow-hidden
            " style="transform-origin: 0 0;transform: rotate(-0.029deg) scale(1, 1) translateY( -100%);top: -10px;left: -55px;">
              <svg class="shrink-0 w-[31px] h-[31px] absolute left-[calc(50%_-_-15.78px)] top-[82.97px] overflow-visible" style="transform: translate(-28.92px, -23.25px)" width="31" height="31" viewBox="0 0 31 31" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M15.5 31L2.07661 7.75L28.9234 7.75L15.5 31Z" fill="white"></path>
              </svg>
              <div class="flex flex-col gap-1 items-start justify-start shrink-0 w-[94.36px] relative" style="transform-origin: 0 0; transform: rotate(0deg) scale(1, 1)">
                <div class="text-[#151515] text-left font-['Raleway-Regular',_sans-serif] text-[10px] leading-[15px] font-normal relative self-stretch overflow-hidden" style="text-overflow: ellipsis">
                  Wooden Finish Veneer with Metal Frame
                </div>
                <div class="text-[#0f0f0f] text-right font-['Raleway-Medium',_sans-serif] text-xs leading-[18px] font-medium relative" style="transform-origin: 0 0; transform: rotate(0.029deg) scale(1, 1)">
                  AED3,575.00
                </div>
              </div>
              <svg class="shrink-0 w-5 h-5 relative overflow-visible" width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7.50769 15.0063L12.5051 10.0038L7.50256 5.00635" stroke="#151515" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </div>
            
          </div>
        </div>
        <div class="flex flex-row gap-4 items-start justify-start self-stretch flex-1 relative">
          <div class="self-stretch flex-1 relative overflow-hidden" style="
              background: url(https://creativefurniture.local/wp-content/themes/creative-furniture/src/img/v2/frame-16100692220.png) center;
              background-size: cover;
              background-repeat: no-repeat;
            ">
            <div class="bg-[rgba(255,255,255,0.11)] rounded-[26px] p-2.5 flex flex-row gap-2.5 items-center justify-start absolute left-[375px] top-[257px]" style="backdrop-filter: blur(4px)">
              <div class="bg-[#ffffff] rounded-[50%] shrink-0 w-3 h-3 relative"></div>
            </div>
            <div class="bg-[rgba(255,255,255,0.11)] rounded-[26px] p-2.5 flex flex-row gap-2.5 items-center justify-start absolute left-[232px] top-[27px]" style="backdrop-filter: blur(4px)">
              <div class="bg-[#ffffff] rounded-[50%] shrink-0 w-3 h-3 relative"></div>
            </div>
            <div class="bg-[rgba(255,255,255,0.11)] rounded-[26px] p-2.5 flex flex-row gap-2.5 items-center justify-start absolute left-[226px] top-[225px]" style="backdrop-filter: blur(4px)">
              <div class="bg-[#ffffff] rounded-[50%] shrink-0 w-3 h-3 relative"></div>
            </div>
          </div>
          <div class="self-stretch flex-1 relative overflow-hidden" style="
              background: url(https://creativefurniture.local/wp-content/themes/creative-furniture/src/img/v2/frame-16100692261.png) center;
              background-size: cover;
              background-repeat: no-repeat;
            ">
            <div class="bg-[rgba(255,255,255,0.11)] rounded-[26px] p-2.5 flex flex-row gap-2.5 items-center justify-start absolute left-[116.5px] top-[163px]" style="backdrop-filter: blur(4px)">
              <div class="bg-[#ffffff] rounded-[50%] shrink-0 w-3 h-3 relative"></div>
            </div>
            <div class="bg-[rgba(255,255,255,0.11)] rounded-[26px] p-2.5 flex flex-row gap-2.5 items-center justify-start absolute left-[89.5px] top-[300px]" style="backdrop-filter: blur(4px)">
              <div class="bg-[#ffffff] rounded-[50%] shrink-0 w-3 h-3 relative"></div>
            </div>
            <div class="bg-[rgba(255,255,255,0.11)] rounded-[26px] p-2.5 flex flex-row gap-2.5 items-center justify-start absolute left-[299.5px] top-[322px]" style="backdrop-filter: blur(4px)">
              <div class="bg-[#ffffff] rounded-[50%] shrink-0 w-3 h-3 relative"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php get_template_part('template-parts/export-cat-collection-block', null, ['title' => __('Explore Desk', 'domain'), 'link' => '#', 'query' => []]); ?>

  <div class="flex flex-col gap-7 items-start justify-start w-[1440px] m-auto">
    <div class="flex flex-row items-center justify-between self-stretch shrink-0 relative">
      <div class="text-black-primary text-left font-['Raleway-SemiBold',_sans-serif] text-2xl leading-8 font-semibold relative flex items-center justify-start">
        Deal Zone
      </div>
      <a href="#" class="text-[#161616] text-left font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal relative flex items-center justify-start" style="text-decoration: underline">
        Explore more
      </a>
    </div>
    <div class="grid grid-cols-3 gap-4 items-center justify-start self-stretch shrink-0 relative">
      <a href="#" class="bg-[#fef6ee] shrink-0 h-[156px] relative overflow-hidden" target="_blank">
        <div class="flex flex-row gap-2 items-center justify-start absolute left-6 top-[50%]" style="translate: 0 -50%">
          <div class="flex flex-col gap-2 items-start justify-center shrink-0 relative">
            <div class="text-[#000000] text-right font-['Raleway-SemiBold',_sans-serif] text-2xl leading-8 font-semibold relative">
              Maximum
            </div>
            <div class="text-[#bd262a] text-right font-['Raleway-SemiBold',_sans-serif] text-2xl leading-8 font-semibold relative">
              60% Off
            </div>
          </div>
        </div>
        <div class="bg-[#bd262a] rounded-[25px] p-0.5 flex flex-row gap-2.5 items-center justify-start absolute right-[226px] top-[50%]" style="translate: 0 -50%">
          <svg class="shrink-0 w-7 h-7 relative overflow-visible" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M8.16667 19.8332L19.8333 8.1665M19.8333 8.1665H8.16667M19.8333 8.1665V19.8332" stroke="white" stroke-width="2.33333" stroke-linecap="round" stroke-linejoin="round"></path>
          </svg>
        </div>
        <img class="w-[148px] h-[148px] absolute right-[9px] top-[calc(50%_-_73px)]" style="object-fit: cover; aspect-ratio: 1" src="https://creativefurniture.local/wp-content/themes/creative-furniture/src/img/v2/_408654916-3365999-c-cae-8-42-ed-8-cec-7-c-4-b-14271978-10.png">
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
        <div class="bg-[#bd262a] rounded-[25px] p-0.5 flex flex-row gap-2.5 items-center justify-start absolute right-[226px] top-[50%]" style="translate: 0 -50%">
          <svg class="shrink-0 w-7 h-7 relative overflow-visible" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M8.16669 19.8332L19.8334 8.1665M19.8334 8.1665H8.16669M19.8334 8.1665V19.8332" stroke="white" stroke-width="2.33333" stroke-linecap="round" stroke-linejoin="round"></path>
          </svg>
        </div>
        <img class="w-[151px] h-[151px] absolute right-0.5 top-0" style="object-fit: cover; aspect-ratio: 1" src="https://creativefurniture.local/wp-content/themes/creative-furniture/src/img/v2/_13586893-340-10.png">
      </a>
      <a href="#" class="bg-[#fef6ee] shrink-0 h-[156px] relative overflow-hidden" target="_blank">
        <div class="flex flex-row gap-2 items-center justify-start absolute left-6 top-[50%]" style="translate: 0 -50%">
          <div class="flex flex-col gap-2 items-start justify-center shrink-0 relative">
            <div class="text-[#000000] text-right font-['Raleway-SemiBold',_sans-serif] text-2xl leading-8 font-semibold relative">
              Best Buys
            </div>
            <div class="text-[#bd262a] text-right font-['Raleway-SemiBold',_sans-serif] text-lg leading-[26px] font-semibold relative">
              Under AED 10000
            </div>
          </div>
        </div>
        <div class="bg-[#bd262a] rounded-[25px] p-0.5 flex flex-row gap-2.5 items-center justify-start absolute right-[194px] top-[50%]" style="translate: 0 -50%">
          <svg class="shrink-0 w-7 h-7 relative overflow-visible" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M8.16663 19.8332L19.8333 8.1665M19.8333 8.1665H8.16663M19.8333 8.1665V19.8332" stroke="white" stroke-width="2.33333" stroke-linecap="round" stroke-linejoin="round"></path>
          </svg>
        </div>
        <img class="w-[161px] h-[161px] absolute right-[9px] top-[calc(50%_-_83px)]" style="object-fit: cover; aspect-ratio: 1" src="https://creativefurniture.local/wp-content/themes/creative-furniture/src/img/v2/_23043947-realistic-1-luxury-chairs-2-10.png">
        <div class="bg-[#000000] p-0.5 flex flex-row gap-2.5 items-center justify-start absolute right-0 top-[50%]" style="translate: 0 -50%">
          <svg class="shrink-0 w-7 h-7 relative overflow-visible" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10.5 21L17.5 14L10.5 7" stroke="white" stroke-width="2.33333" stroke-linecap="round" stroke-linejoin="round"></path>
          </svg>
        </div>
      </a>
    </div>
  </div>

  <div class="bg-[#f9f9f9] pr-[100px] flex flex-col gap-6 items-center justify-start relative w-[1440px] m-auto">
    <div class="flex flex-row items-center justify-between self-stretch flex-1 relative">
      <img class="shrink-0 w-[808px] h-[433px] relative" style="object-fit: cover" src="https://creativefurniture.local/wp-content/themes/creative-furniture/src/img/v2/rectangle-45411.png">
      <div class="flex flex-col gap-10 items-center justify-center shrink-0 w-[476px] relative">
        <div class="flex flex-col gap-4 items-center justify-start self-stretch shrink-0 relative">
          <div class="text-center font-['Raleway-Bold',_sans-serif] text-[28px] leading-10 font-bold relative self-stretch">
            <span>
              <span class="limited-time-deals-on-shoe-rack-span">
                Limited-time deals on
                <br>
              </span>
              <span class="limited-time-deals-on-shoe-rack-span2">
                Shoe Rack
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
            View Details
          </div>
        </div>
      </div>
    </div>
    <div class="bg-[#000000] p-0.5 flex flex-row gap-2.5 items-center justify-start shrink-0 absolute right-6 top-[50%]" style="translate: 0 -50%">
      <svg class="shrink-0 w-7 h-7 relative overflow-visible" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M10.5 21L17.5 14L10.5 7" stroke="white" stroke-width="2.33333" stroke-linecap="round" stroke-linejoin="round"></path>
      </svg>
    </div>
  </div>
  
  <?php get_template_part('template-parts/export-cat-collection-block', null, ['title' => __('Explore Living Furniture', 'domain'), 'link' => '#', 'query' => []]); ?>

  <div class="flex flex-col gap-6 items-center justify-start w-[1440px] m-auto relative">
    <div class="flex flex-row items-center justify-between self-stretch shrink-0 relative">
      <div class="text-black-primary text-left font-['Raleway-SemiBold',_sans-serif] text-2xl leading-8 font-semibold relative flex items-center justify-start">
        Top Deals By Category
      </div>
      <a href="#" class="text-[#161616] text-left font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal relative flex items-center justify-start" style="text-decoration: underline">
        Explore more
      </a>
    </div>
    <div class="flex flex-col gap-6 items-start justify-start self-stretch shrink-0 relative">
      <div class="flex flex-row gap-4 items-center justify-start self-stretch shrink-0 relative">
        <a href="#" class="flex flex-col gap-4 items-center justify-center flex-1 relative">
          <div class="self-stretch shrink-0 h-[312px] relative overflow-hidden">
            <img class="absolute right-0 left-0 bottom-0 top-0" style="object-fit: cover" src="https://creativefurniture.local/wp-content/themes/creative-furniture/src/img/v2/rectangle-453422.png">
            <div class="bg-[#a30f13] rounded-[50%] w-[212px] h-[200px] absolute left-[50%] top-[-135px]" style="translate: -50%"></div>
            <div class="flex flex-col gap-0 items-center justify-center absolute left-[50%] top-[calc(50%_-_146px)]" style="translate: -50%">
              <div class="text-[#ffffff] text-center font-['Raleway-SemiBold',_sans-serif] text-[13.454545974731445px] leading-[16.82px] font-semibold relative">
                Up TO
              </div>
              <div class="text-[#ffffff] text-center font-['Raleway-Bold',_sans-serif] text-[13.454545974731445px] leading-[20.18px] font-bold relative">
                30% Off
              </div>
            </div>
          </div>
          <div class="flex flex-col gap-2 items-center justify-center self-stretch shrink-0 relative">
            <div class="flex flex-row gap-2 items-center justify-start shrink-0 relative">
              <div class="text-[#3f3f3f] text-right font-['Raleway-SemiBold',_sans-serif] text-base leading-6 font-semibold relative">
                Office Furniture
              </div>
              <svg class="shrink-0 w-6 h-6 relative overflow-visible" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9 18L15 12L9 6" stroke="#3F3F3F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </div>
          </div>
        </a>
        <a href="#" class="flex flex-col gap-4 items-center justify-center flex-1 relative">
          <div class="self-stretch shrink-0 h-[312px] relative overflow-hidden">
            <img class="absolute right-0 left-0 bottom-0 top-0" style="object-fit: cover" src="https://creativefurniture.local/wp-content/themes/creative-furniture/src/img/v2/rectangle-453423.png">
            <svg class="w-[186px] h-10 absolute left-0 top-5 overflow-visible" width="186" height="40" viewBox="0 0 186 40" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M0 0H186L165.545 20L186 40H0V0Z" fill="black"></path>
            </svg>
            <div class="flex flex-row gap-2 items-center justify-start absolute left-[15px] top-[calc(50%_-_128px)]">
              <div class="text-[#ffffff] text-center font-['Raleway-SemiBold',_sans-serif] text-sm leading-5 font-semibold relative">
                Up TO
              </div>
              <div class="text-[#ffffff] text-center font-['Raleway-SemiBold',_sans-serif] text-base leading-6 font-semibold relative" style="text-decoration: underline">
                20% Off
              </div>
            </div>
          </div>
          <div class="flex flex-col gap-2 items-center justify-center self-stretch shrink-0 relative">
            <div class="flex flex-row gap-2 items-center justify-start shrink-0 relative">
              <div class="text-[#3f3f3f] text-right font-['Raleway-SemiBold',_sans-serif] text-base leading-6 font-semibold relative">
                Living Furniture
              </div>
              <svg class="shrink-0 w-6 h-6 relative overflow-visible" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9 18L15 12L9 6" stroke="#3F3F3F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </div>
          </div>
        </a>
        <a href="#" class="flex flex-col gap-4 items-center justify-center flex-1 relative">
          <div class="self-stretch shrink-0 h-[312px] relative overflow-hidden">
            <img class="absolute right-0 left-0 bottom-0 top-0" style="object-fit: cover" src="https://creativefurniture.local/wp-content/themes/creative-furniture/src/img/v2/rectangle-453424.png">
            <svg class="w-[186px] h-10 absolute left-0 top-5 overflow-visible" width="186" height="40" viewBox="0 0 186 40" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M0 0H186L165.545 20L186 40H0V0Z" fill="black"></path>
            </svg>
            <div class="flex flex-row gap-2 items-center justify-start absolute left-[15px] top-[calc(50%_-_128px)]">
              <div class="text-[#ffffff] text-center font-['Raleway-SemiBold',_sans-serif] text-sm leading-5 font-semibold relative">
                Up TO
              </div>
              <div class="text-[#ffffff] text-center font-['Raleway-SemiBold',_sans-serif] text-base leading-6 font-semibold relative" style="text-decoration: underline">
                15% Off
              </div>
            </div>
          </div>
          <div class="flex flex-col gap-2 items-center justify-center self-stretch shrink-0 relative">
            <div class="flex flex-row gap-2 items-center justify-start shrink-0 relative">
              <div class="text-[#3f3f3f] text-right font-['Raleway-SemiBold',_sans-serif] text-base leading-6 font-semibold relative">
                Dining Furniture
              </div>
              <svg class="shrink-0 w-6 h-6 relative overflow-visible" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9 18L15 12L9 6" stroke="#3F3F3F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </div>
          </div>
        </a>
        <a href="#" class="flex flex-col gap-4 items-center justify-center flex-1 relative">
          <div class="self-stretch shrink-0 h-[312px] relative overflow-hidden">
            <img class="absolute right-0 left-0 bottom-0 top-0" style="object-fit: cover" src="https://creativefurniture.local/wp-content/themes/creative-furniture/src/img/v2/rectangle-453425.png">
            <svg class="w-[186px] h-10 absolute left-0 top-5 overflow-visible" width="186" height="40" viewBox="0 0 186 40" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M0 0H186L165.545 20L186 40H0V0Z" fill="black"></path>
            </svg>
            <div class="flex flex-row gap-2 items-center justify-start absolute left-[15px] top-[calc(50%_-_128px)]">
              <div class="text-[#ffffff] text-center font-['Raleway-SemiBold',_sans-serif] text-sm leading-5 font-semibold relative">
                Up TO
              </div>
              <div class="text-[#ffffff] text-center font-['Raleway-SemiBold',_sans-serif] text-base leading-6 font-semibold relative" style="text-decoration: underline">
                35% Off
              </div>
            </div>
          </div>
          <div class="flex flex-col gap-2 items-center justify-center self-stretch shrink-0 relative">
            <div class="flex flex-row gap-2 items-center justify-start shrink-0 relative">
              <div class="text-[#3f3f3f] text-right font-['Raleway-SemiBold',_sans-serif] text-xl leading-[30px] font-semibold relative">
                Outdoor Furniture
              </div>
              <svg class="shrink-0 w-6 h-6 relative overflow-visible" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9 18L15 12L9 6" stroke="#3F3F3F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </div>
          </div>
        </a>
      </div>
      <div class="flex flex-row gap-4 items-center justify-start self-stretch shrink-0 relative">
        <a href="#" class="flex flex-col gap-4 items-center justify-center flex-1 relative">
          <div class="self-stretch shrink-0 h-[312px] relative overflow-hidden">
            <img class="absolute right-0 left-0 bottom-0 top-0" style="object-fit: cover" src="https://creativefurniture.local/wp-content/themes/creative-furniture/src/img/v2/rectangle-453426.png">
            <svg class="w-[186px] h-10 absolute left-0 top-5 overflow-visible" width="186" height="40" viewBox="0 0 186 40" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M0 0H186L165.545 20L186 40H0V0Z" fill="black"></path>
            </svg>
            <div class="flex flex-row gap-2 items-center justify-start absolute left-[15px] top-[calc(50%_-_128px)]">
              <div class="text-[#ffffff] text-center font-['Raleway-SemiBold',_sans-serif] text-sm leading-5 font-semibold relative">
                Up TO
              </div>
              <div class="text-[#ffffff] text-center font-['Raleway-SemiBold',_sans-serif] text-base leading-6 font-semibold relative" style="text-decoration: underline">
                10% Off
              </div>
            </div>
          </div>
          <div class="flex flex-col gap-2 items-center justify-center self-stretch shrink-0 relative">
            <div class="flex flex-row gap-2 items-center justify-start shrink-0 relative">
              <div class="text-[#3f3f3f] text-right font-['Raleway-SemiBold',_sans-serif] text-base leading-6 font-semibold relative">
                Washroom Furniture
              </div>
              <svg class="shrink-0 w-6 h-6 relative overflow-visible" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9 18L15 12L9 6" stroke="#3F3F3F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </div>
          </div>
        </a>
        <a href="#" class="flex flex-col gap-4 items-center justify-center flex-1 relative">
          <div class="self-stretch shrink-0 h-[312px] relative overflow-hidden">
            <img class="absolute right-0 left-0 bottom-0 top-0" style="object-fit: cover" src="https://creativefurniture.local/wp-content/themes/creative-furniture/src/img/v2/rectangle-453427.png">
            <svg class="w-[186px] h-10 absolute left-0 top-5 overflow-visible" width="186" height="40" viewBox="0 0 186 40" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M0 0H186L165.545 20L186 40H0V0Z" fill="black"></path>
            </svg>
            <div class="flex flex-row gap-2 items-center justify-start absolute left-[15px] top-[calc(50%_-_128px)]">
              <div class="text-[#ffffff] text-center font-['Raleway-SemiBold',_sans-serif] text-sm leading-5 font-semibold relative">
                Up TO
              </div>
              <div class="text-[#ffffff] text-center font-['Raleway-SemiBold',_sans-serif] text-base leading-6 font-semibold relative" style="text-decoration: underline">
                25% Off
              </div>
            </div>
          </div>
          <div class="flex flex-col gap-2 items-center justify-center self-stretch shrink-0 relative">
            <div class="flex flex-row gap-2 items-center justify-start shrink-0 relative">
              <div class="text-[#3f3f3f] text-right font-['Raleway-SemiBold',_sans-serif] text-base leading-6 font-semibold relative">
                Hotel Bedroom
              </div>
              <svg class="shrink-0 w-6 h-6 relative overflow-visible" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9 18L15 12L9 6" stroke="#3F3F3F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </div>
          </div>
        </a>
        <a href="#" class="flex flex-col gap-4 items-center justify-center flex-1 relative">
          <div class="self-stretch shrink-0 h-[312px] relative overflow-hidden">
            <img class="absolute right-0 left-0 bottom-0 top-0" style="object-fit: cover" src="https://creativefurniture.local/wp-content/themes/creative-furniture/src/img/v2/rectangle-453428.png">
            <svg class="w-[186px] h-10 absolute left-0 top-5 overflow-visible" width="186" height="40" viewBox="0 0 186 40" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M0 0H186L165.545 20L186 40H0V0Z" fill="black"></path>
            </svg>
            <div class="flex flex-row gap-2 items-center justify-start absolute left-[15px] top-[calc(50%_-_128px)]">
              <div class="text-[#ffffff] text-center font-['Raleway-SemiBold',_sans-serif] text-sm leading-5 font-semibold relative">
                Up TO
              </div>
              <div class="text-[#ffffff] text-center font-['Raleway-SemiBold',_sans-serif] text-base leading-6 font-semibold relative" style="text-decoration: underline">
                60% Off
              </div>
            </div>
          </div>
          <div class="flex flex-col gap-2 items-center justify-center self-stretch shrink-0 relative">
            <div class="flex flex-row gap-2 items-center justify-start shrink-0 relative">
              <div class="text-[#3f3f3f] text-right font-['Raleway-SemiBold',_sans-serif] text-base leading-6 font-semibold relative">
                Hospitality Furniture
              </div>
              <svg class="shrink-0 w-6 h-6 relative overflow-visible" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9 18L15 12L9 6" stroke="#3F3F3F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </div>
          </div>
        </a>
        <a href="#" class="flex flex-col gap-4 items-center justify-center flex-1 relative">
          <div class="self-stretch shrink-0 h-[312px] relative overflow-hidden">
            <img class="absolute right-0 left-0 bottom-0 top-0" style="object-fit: cover" src="https://creativefurniture.local/wp-content/themes/creative-furniture/src/img/v2/rectangle-453429.png">
            <svg class="w-[186px] h-10 absolute left-0 top-5 overflow-visible" width="186" height="40" viewBox="0 0 186 40" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M0 0H186L165.545 20L186 40H0V0Z" fill="black"></path>
            </svg>
            <div class="flex flex-row gap-2 items-center justify-start absolute left-[15px] top-[calc(50%_-_128px)]">
              <div class="text-[#ffffff] text-center font-['Raleway-SemiBold',_sans-serif] text-sm leading-5 font-semibold relative">
                Up TO
              </div>
              <div class="text-[#ffffff] text-center font-['Raleway-SemiBold',_sans-serif] text-base leading-6 font-semibold relative" style="text-decoration: underline">
                40% Off
              </div>
            </div>
          </div>
          <div class="flex flex-col gap-2 items-center justify-center self-stretch shrink-0 relative">
            <div class="flex flex-row gap-2 items-center justify-start shrink-0 relative">
              <div class="text-[#3f3f3f] text-right font-['Raleway-SemiBold',_sans-serif] text-xl leading-[30px] font-semibold relative">
                Kids Furniture
              </div>
              <svg class="shrink-0 w-6 h-6 relative overflow-visible" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9 18L15 12L9 6" stroke="#3F3F3F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>

  
</div>
<?php get_footer(); ?>

<script>
class ExtendedBlazeSlider extends BlazeSlider {
  constructor(el, config) {
    super(el, config)
    this._events = {}
  }

  on(name, cb) {
    if (!this._events[name]) this._events[name] = new Set()
    this._events[name].add(cb)
  }

  off(name, cb) {
    this._events[name]?.delete(cb)
  }

  emit(name, ...args) {
    this._events[name]?.forEach(fn => fn(...args))
  }

  next(n) {
    const prev = this.stateIndex
    super.next(n)

    if (prev !== this.stateIndex) {
      this.emit("slide", ...this.get_slide_event_params())
    }
  }

  prev(n) {
    const prev = this.stateIndex
    super.prev(n)

    if (prev !== this.stateIndex) {
      this.emit("slide", ...this.get_slide_event_params())
    }
  }
  get_slide_event_params() {
    const page = this.states[this.stateIndex]
    return [this.stateIndex, page.next.stateIndex, page.prev.stateIndex, (this.states?.length - 1)]
  }
}
document.querySelectorAll('.blaze-slider').forEach(element => {
  const sliderOf = element.dataset?.slider;
  const config = element.dataset?.config ? JSON.parse(element.dataset?.config??'{}') : {
    all: {
      // Layout
      // slidesToShow: 1,
      // slidesToScroll: 1,
      // slideGap: 0,
      // Loop
      loop: false,
      // // Autoplay
      // enableAutoplay: false,
      // OnInteraction: true,
      // autoplayInterval: 3000,
      // autoplayDirection: 'to left',
      // // Pagination
      // enablePagination: false,
      // // Transition
      // transitionDuration: 500,
      // transitionTimingFunction: 'ease',
    },
    // '(max-width: 900px)': {
    //   slidesToShow: 2,
    // },
    // '(max-width: 500px)': {
    //   slidesToShow: 1,
    // },
  };
  // console.log(config)
  const slider = window.slider = new ExtendedBlazeSlider(element, config);
  slider.on("slide", (pageIndex, next, prev, total) => {
    // alert('Page Index: ' + pageIndex + '\nNext: ' + next + '\nPrev: ' + prev + '\nTotal: ' + total);
    if (!slider.config?.loop) {
      const prevEl = slider.el.querySelector('.blaze-prev');
      const nextEl = slider.el.querySelector('.blaze-next');
      if (true) {
        if (pageIndex == 0) prevEl.classList.add('hidden')
        else prevEl.classList.remove('hidden')
      }
      if (true) {
        if (pageIndex == total) nextEl.classList.add('hidden')
        else nextEl.classList.remove('hidden')
      }
    }
    if (sliderOf == 'products') {
      const progressBar = slider.el.querySelector('.blaze-progress-bar');
      if (progressBar) {
        progressBar.style.width = ((pageIndex + 1) / (total + 1)) * 100 + '%';
      }
    }
  });
});

</script>

