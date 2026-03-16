<?php $theme_directory_uri = get_template_directory_uri(); ?>
<?php
$hotspots = (object) [
  'top_left' => [
    ['top' => '96px', 'left' => '216px', 'href' => '#', 'name' => 'Accent Piece 1', 'price' => 'AED 1,500.00'],
    ['top' => '86px', 'left' => '334px', 'href' => '#', 'name' => 'Accent Piece 2', 'price' => 'AED 900.00'],
    ['top' => '282px', 'left' => '194px', 'href' => '#', 'name' => 'Accent Piece 3', 'price' => 'AED 2,100.00'],
  ],
  'bottom_left' => [
    ['top' => '54px', 'left' => '170px', 'href' => '#', 'name' => 'Living Item 1', 'price' => 'AED 750.00'],
    ['top' => '191px', 'left' => '164px', 'href' => '#', 'name' => 'Living Item 2', 'price' => 'AED 1,100.00'],
    ['top' => '181px', 'left' => '62px', 'href' => '#', 'name' => 'Living Item 3', 'price' => 'AED 450.00'],
    ['top' => '171px', 'left' => '305px', 'href' => '#', 'name' => 'Living Item 4', 'price' => 'AED 1,350.00'],
  ],
  'top_right' => [
    [ 'top' => '136px', 'left' => '276px', 'href' => '#', 'name' => 'Wooden Finish Veneer with Metal Frame', 'price' => 'AED3,575.00' ],
    [ 'top' => '238px', 'left' => '110px', 'href' => '#', 'name' => 'Product Name 2', 'price' => 'AED1,200.00' ],
    [ 'top' => '146px', 'left' => '490px', 'href' => '#', 'name' => 'Product Name 3', 'price' => 'AED2,500.00' ],
    [ 'top' => '238px', 'left' => '571px', 'href' => '#', 'name' => 'Product Name 4', 'price' => 'AED800.00' ],
    [ 'top' => '182px', 'left' => '738px', 'href' => '#', 'name' => 'Product Name 5', 'price' => 'AED4,000.00' ]
  ],
  'bottom_middle' => [
    ['top' => '257px', 'left' => '375px', 'href' => '#', 'name' => 'Middle Item 1', 'price' => 'AED 850.00'],
    ['top' => '27px', 'left' => '232px', 'href' => '#', 'name' => 'Middle Item 2', 'price' => 'AED 1,200.00'],
    ['top' => '225px', 'left' => '226px', 'href' => '#', 'name' => 'Middle Item 3', 'price' => 'AED 950.00'],
  ],
  'bottom_right' => [
    ['top' => '163px', 'left' => '116.5px', 'href' => '#', 'name' => 'End Item 1', 'price' => 'AED 1,850.00'],
    ['top' => '300px', 'left' => '89.5px', 'href' => '#', 'name' => 'End Item 2', 'price' => 'AED 2,200.00'],
    ['top' => '322px', 'left' => '299.5px', 'href' => '#', 'name' => 'End Item 3', 'price' => 'AED 3,950.00'],
  ]
];

$tippyContent = function ($spot) {
  return '
  <a href="'. esc_url($spot['href']) . '" class="bg-[#ffffff] -rounded-lg p-2 flex flex-row gap-2 items-center justify-start relative shadow-lg min-w-[150px]">
    <div class="flex flex-col gap-1 items-start justify-start flex-1">
      <div class="text-[#151515] text-left font-Raleway text-[10px] leading-[15px] font-normal uppercase">'. esc_html($spot['name']) . '</div>
      <div class="text-[#0f0f0f] text-right font-Raleway text-xs leading-[18px] font-medium">'. esc_html($spot['price']) . '</div>
    </div>
    <svg class="shrink-0 w-5 h-5 relative overflow-visible" width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M7.50769 15.0063L12.5051 10.0038L7.50256 5.00635" stroke="#151515" stroke-width="1.66667" stroke-linecap="round" stroke-linejoin="round"></path>
    </svg>
  </a>
  ';
}
?>

  <div class="flex flex-col gap-7 items-start justify-start px-4 w-full max-w-full md:w-[1440px] m-auto relative">
    <div class="flex flex-row items-center justify-between self-stretch shrink-0 relative">
      <h3 class="text-black-primary text-left font-['Raleway-SemiBold',_sans-serif] text-xl sm:text-2xl leading-8 font-semibold relative flex items-center justify-start">
        <?php esc_html_e('Shop the Look', 'creative-furniture'); ?>
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
    <div class="flex flex-col md:flex-row flex-wrap gap-4 items-start justify-start self-stretch shrink-0 relative">
      <div class="hidden sm:flex flex-col gap-4 items-start justify-start w-full md:w-auto shrink-0 relative">
        <div class="shrink-0 w-full md:w-[431px] h-[415px] relative overflow-hidden" style="background: url(<?php echo esc_url($theme_directory_uri); ?>/dist/images/v2/frame-16100692210.png) center;background-size: cover;background-repeat: no-repeat;">
          <?php foreach ($hotspots->top_left as $spot) : ?>
          <div class="bg-[rgba(255,255,255,0.11)] rounded-[26px] p-2.5 flex flex-row gap-2.5 items-center justify-start absolute hotspot-indicator" 
               style="backdrop-filter: blur(4px); top: <?php echo esc_attr($spot['top']); ?>; left: <?php echo esc_attr($spot['left']); ?>;"
               data-tippy-content="<?php echo esc_attr($tippyContent($spot)); ?>">
            <div class="bg-[#ffffff] rounded-[50%] shrink-0 w-3 h-3 relative"></div>
          </div>
          <?php endforeach; ?>
        </div>
        <div class="shrink-0 w-full md:w-[431px] h-[315px] relative overflow-hidden" style="background: url(<?php echo esc_url($theme_directory_uri); ?>/dist/images/v2/frame-16100692200.png) center;background-size: cover;background-repeat: no-repeat;">
          <?php foreach ($hotspots->bottom_left as $spot) : ?>
          <div class="bg-[rgba(255,255,255,0.11)] rounded-[26px] p-2.5 flex flex-row gap-2.5 items-center justify-start absolute hotspot-indicator" 
               style="backdrop-filter: blur(4px); top: <?php echo esc_attr($spot['top']); ?>; left: <?php echo esc_attr($spot['left']); ?>;"
               data-tippy-content="<?php echo esc_attr($tippyContent($spot)); ?>">
            <div class="bg-[#ffffff] rounded-[50%] shrink-0 w-3 h-3 relative"></div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="hidden sm:flex flex-col gap-4 items-start justify-center self-stretch flex-1 w-full relative">
        <div class="self-stretch shrink-0 h-[303px] relative overflow-hidden" style="background: url(<?php echo esc_url($theme_directory_uri); ?>/dist/images/v2/frame-16100692251.png) center;background-size: cover;background-repeat: no-repeat;">
          <?php foreach ($hotspots->top_right as $index => $spot) : ?>
          <div class="bg-[rgba(255,255,255,0.11)] rounded-[26px] p-2.5 flex flex-row gap-2.5 items-center justify-start absolute hotspot-indicator" 
               style="backdrop-filter: blur(4px); top: <?php echo esc_attr(esc_attr($spot['top'])); ?>; left: <?php echo esc_attr(esc_attr($spot['left'])); ?>;"
               data-tippy-content="<?php echo esc_attr($tippyContent($spot)); ?>">
            <div class="bg-[#ffffff] rounded-[50%] shrink-0 w-3 h-3 relative"></div>
          </div>
          <?php endforeach; ?>
        </div>
        <div class="flex flex-col sm:flex-row gap-4 items-start justify-start self-stretch flex-1 relative">
          <div class="self-stretch flex-1 w-full h-[300px] sm:h-auto relative overflow-hidden" style="background: url(<?php echo esc_url($theme_directory_uri); ?>/dist/images/v2/frame-16100692220.png) center;background-size: cover;background-repeat: no-repeat;">
            <?php foreach ($hotspots->bottom_middle as $spot) : ?>
            <div class="bg-[rgba(255,255,255,0.11)] rounded-[26px] p-2.5 flex flex-row gap-2.5 items-center justify-start absolute hotspot-indicator" 
                 style="backdrop-filter: blur(4px); top: <?php echo esc_attr($spot['top']); ?>; left: <?php echo esc_attr($spot['left']); ?>;"
                 data-tippy-content="<?php echo esc_attr($tippyContent($spot)); ?>">
              <div class="bg-[#ffffff] rounded-[50%] shrink-0 w-3 h-3 relative"></div>
            </div>
            <?php endforeach; ?>
          </div>
          <div class="self-stretch flex-1 w-full h-[300px] sm:h-auto relative overflow-hidden" style="background: url(<?php echo esc_url($theme_directory_uri); ?>/dist/images/v2/frame-16100692261.png) center;background-size: cover;background-repeat: no-repeat;">
            <?php foreach ($hotspots->bottom_right as $spot) : ?>
            <div class="bg-[rgba(255,255,255,0.11)] rounded-[26px] p-2.5 flex flex-row gap-2.5 items-center justify-start absolute hotspot-indicator" 
                 style="backdrop-filter: blur(4px); top: <?php echo esc_attr($spot['top']); ?>; left: <?php echo esc_attr($spot['left']); ?>;"
                 data-tippy-content="<?php echo esc_attr($tippyContent($spot)); ?>">
              <div class="bg-[#ffffff] rounded-[50%] shrink-0 w-3 h-3 relative"></div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
      

    </div>
  </div>
