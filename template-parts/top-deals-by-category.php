<?php
$deals = [
  [
    'title'    => __('Office Furniture', 'creative-furniture'),
    'banner'   => get_template_directory_uri() . '/dist/images/v2/rectangle-453422.png',
    'link'     => add_query_arg('discount_max', '30', home_url('/product-category/office/')),
    'discount' => '30%'
  ],
  [
    'title'    => __('Living Furniture', 'creative-furniture'),
    'banner'   => get_template_directory_uri() . '/dist/images/v2/rectangle-45340.png',
    'link'     => add_query_arg('discount_max', '30', home_url('/product-category/office/')),
    'discount' => '30%'
  ],
  [
    'title'    => __('Dining Furniture', 'creative-furniture'),
    'banner'   => get_template_directory_uri() . '/dist/images/v2/rectangle-45341.png',
    'link'     => add_query_arg('discount_max', '30', home_url('/product-category/office/')),
    'discount' => '30%'
  ],
  [
    'title'    => __('Outdoor Furniture', 'creative-furniture'),
    'banner'   => get_template_directory_uri() . '/dist/images/v2/rectangle-45342.png',
    'link'     => add_query_arg('discount_max', '30', home_url('/product-category/office/')),
    'discount' => '30%'
  ],
  [
    'title'    => __('Washroom Furniture', 'creative-furniture'),
    'banner'   => get_template_directory_uri() . '/dist/images/v2/rectangle-453426.png',
    'link'     => add_query_arg('discount_max', '30', home_url('/product-category/washroom/')),
    'discount' => '30%'
  ],
  [
    'title'    => __('Hotel Bedroom', 'creative-furniture'),
    'banner'   => get_template_directory_uri() . '/dist/images/v2/rectangle-45344.png',
    'link'     => add_query_arg('discount_max', '30', home_url('/product-category/bedroom/')),
    'discount' => '30%'
  ],
  [
    'title'    => __('Hospitality Furniture', 'creative-furniture'),
    'banner'   => get_template_directory_uri() . '/dist/images/v2/rectangle-45345.png',
    'link'     => add_query_arg('discount_max', '30', home_url('/product-category/hospitality/')),
    'discount' => '30%'
  ],
  [
    'title'    => __('Kids Furniture', 'creative-furniture'),
    'banner'   => get_template_directory_uri() . '/dist/images/v2/rectangle-45346.png',
    'link'     => add_query_arg('discount_max', '30', home_url('/product-category/kids/')),
    'discount' => '30%'
  ],
];
?>

<div class="flex flex-col gap-6 items-center justify-start px-4 mb-12 w-full max-w-full md:w-[1440px] 2xl:w-[1920px] m-auto relative">
    <div class="flex flex-row items-center justify-between self-stretch shrink-0 relative">
        <div class="text-black-primary text-left font-['Raleway-SemiBold',_sans-serif] text-xl md:text-2xl leading-8 font-semibold relative flex items-center justify-start">
            <?php esc_html_e('Top Deals By Category', 'creative-furniture'); ?>
        </div>
        <a href="<?php echo esc_url(add_query_arg('discount_max', '100', wc_get_page_permalink('shop'))); ?>" class="text-[#161616] text-left font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal relative flex items-center justify-start cursor-pointer hover:opacity-80 transition-opacity" style="text-decoration: underline">
          Explore more
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 self-stretch">
        <?php foreach ($deals as $deal) : ?>
            <a href="<?php echo esc_url($deal['link']); ?>" class="flex flex-col gap-4 items-center justify-center relative group">
                <div class="self-stretch shrink-0 h-[300px] md:h-[312px] relative overflow-hidden rounded-sm">
                    <img class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" src="<?php echo esc_url($deal['banner']); ?>" alt="<?php echo esc_attr($deal['title']); ?>" />
                    
                    <div class="w-[76px] h-[72.78px] absolute right-4 top-4">
                        <svg class="w-full h-full absolute inset-0 overflow-visible" width="76" height="73" viewBox="0 0 76 73" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 36.3878C0 32.5064 4.58714 29.3985 5.72036 25.8971C6.90107 22.2668 5.05536 17.0689 7.25393 14.0493C9.47286 10.9957 15.0032 11.1585 18.0568 8.93283C21.0764 6.73426 22.6236 1.41426 26.2539 0.233546C29.7554 -0.899669 34.1186 2.45926 38 2.45926C41.8814 2.45926 46.2446 -0.899669 49.7461 0.240331C53.3764 1.42105 54.9236 6.74105 57.9432 8.93962C60.99 11.1585 66.5271 11.0025 68.7461 14.056C70.9446 17.0757 69.0989 22.2803 70.2796 25.9039C71.4196 29.4053 76 32.5132 76 36.3946C76 40.2761 71.4129 43.3839 70.2796 46.8853C69.0989 50.5157 70.9446 55.7136 68.7461 58.7332C66.5271 61.7868 60.9968 61.6239 57.9432 63.8496C54.9236 66.0482 53.3764 71.3682 49.7461 72.5489C46.2446 73.6889 41.8814 70.33 38 70.33C34.1186 70.33 29.7554 73.6889 26.2539 72.5489C22.6236 71.3682 21.0764 66.0482 18.0568 63.8496C15.01 61.6307 9.47286 61.7868 7.25393 58.7332C5.05536 55.7136 6.90107 50.5089 5.72036 46.8853C4.58714 43.3771 0 40.2693 0 36.3878Z" fill="white" />
                        </svg>
                        <div class="flex flex-col gap-0 items-center justify-center absolute left-[50%] top-[50%]" style="translate: -50% -50%">
                            <div class="text-[#0d0d0d] text-center font-['Raleway-SemiBold',_sans-serif] text-[10.41px] leading-[15px] font-semibold relative">
                              Up TO
                            </div>
                            <div class="text-[#0d0d0d] text-center relative">
                                <span class="text-base leading-6 font-semibold whitespace-nowrap">
                                  <?php echo esc_html(sprintf(__('%s Off', 'creative-furniture'), $deal['discount'])); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col gap-2 items-center justify-center self-stretch shrink-0 relative">
                    <div class="flex flex-row gap-2 items-center justify-start shrink-0 relative">
                        <div class="text-[#3f3f3f] text-right font-['Raleway-SemiBold',_sans-serif] text-base leading-6 font-semibold relative group-hover:text-black transition-colors">
                            <?php echo esc_html($deal['title']); ?>
                        </div>
                        <svg class="shrink-0 w-6 h-6 relative overflow-visible transition-transform group-hover:translate-x-1" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 18L15 12L9 6" stroke="#3F3F3F" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>
