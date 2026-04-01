<?php $theme_directory_uri = get_template_directory_uri(); ?>

  <div class="w-full max-w-full md:w-[1440px] 2xl:w-[1920px] m-auto relative">
    <div class="blaze-slider" data-slider="hero" data-config="<?php echo esc_attr(json_encode(['all' => ['loop' => false, 'slidesToShow' => 1, 'slidesToScroll' => 1]])); ?>">
      <div class="blaze-container">
        <div class="blaze-track-container">
          <div class="blaze-track">
            <?php for ($i=1; $i <= 5; $i++) : ?>
            <div class="relative h-[296px] sm:h-[450px] md:h-[673px] 2xl:h-[750px]">
              <img class="absolute right-0 left-0 top-[50%] w-full h-full" style="translate: 0 -50%; object-fit: cover" src="<?php echo esc_url($theme_directory_uri); ?>/dist/images/v2/smart-furniture-for-modern-offices-hero-1.png">
              <div class="flex flex-col gap-7 sm:gap-36 md:gap-52 items-center sm:items-start justify-start w-full md:w-[476px] absolute left-0 sm:left-4 md:left-[50px] lg:left-[100px] top-[50%]" style="translate: 0 -50%">
                <div class="flex flex-col gap-1 sm:gap-3 items-start justify-start self-stretch shrink-0 relative w-2/3 sm:w-full m-auto">
                  <div class="text-[#010101] text-center sm:text-left font-['Raleway-SemiBold',_sans-serif] text-2xl sm:text-[38px] leading-8 sm:leading-[48px] font-semibold relative self-stretch">
                    <?php esc_html_e('Smart Furniture for Modern Offices', 'creative-furniture'); ?>
                  </div>
                  <div class="text-[#2f2f2f] text-center sm:text-left font-['Raleway-Regular',_sans-serif] text-[10px] leading-[15px] font-normal sm:text-sm sm:leading-5 relative self-stretch">
                    <?php esc_html_e('Design, supply, and installation services for startups, enterprises, and commercial spaces.', 'creative-furniture'); ?>
                  </div>
                </div>
                <a href="/shop" class="bg-[#000000] border-solid border-[transparent] border px-3 sm:px-4 py-1 sm:py-1.5 md:px-8 md:py-3.5 flex flex-row gap-2.5 items-center justify-center shrink-0 relative">
                  <span class="text-[#ffffff] text-center font-['Raleway-SemiBold',_sans-serif] text-xs sm:text-base leading-6 font-semibold relative flex items-center justify-center">
                    <?php esc_html_e('Shop Furniture', 'creative-furniture'); ?>
                  </span>
                </a>
              </div>
              <svg class="h-[auto] absolute left-0 bottom-0 overflow-visible w-full" width="1442" height="101" viewBox="0 0 1442 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 99C512.758 99 818.742 99 1331.5 99L1440.5 0" stroke="#BD262A" stroke-width="3.5"></path>
                <path d="M1440 100.51L1442 2.5L1333 101L1440 100.51Z" fill="white"></path>
              </svg>
            </div>
            <?php endfor; ?>
          </div>
        </div>

        <div class="blaze-prev bg-[#000000] p-0 sm:p-2 flex flex-row gap-2.5 items-center justify-start absolute left-8 top-[50%] hidden" style="translate: 0 -50%">
          <svg class="shrink-0 w-7 h-7 relative overflow-visible rotate-180" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10.5 21L17.5 14L10.5 7" stroke="white" stroke-width="2.33333" stroke-linecap="round" stroke-linejoin="round"></path>
          </svg>
        </div>
        <div class="blaze-next bg-[#000000] p-0 sm:p-2 flex flex-row gap-2.5 items-center justify-start absolute right-8 top-[50%]" style="translate: 0 -50%">
          <svg class="shrink-0 w-7 h-7 relative overflow-visible" width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M10.5 21L17.5 14L10.5 7" stroke="white" stroke-width="2.33333" stroke-linecap="round" stroke-linejoin="round"></path>
          </svg>
        </div>
        <!-- <div class="blaze-pagination"></div> -->
      </div>
    </div>
  </div>