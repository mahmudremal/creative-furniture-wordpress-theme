<?php
if ( ! isset( $args['product_id'] ) ) return;
$product_id = $args['product_id'];
?>

<a href="#" class="flex relative">
  <div class="flex flex-col gap-4 items-start justify-start flex-1">
    <div class="self-stretch shrink-0 h-[294px] relative overflow-hidden">
      <img class="absolute right-[-0.4px] left-0 bottom-0 top-0" src="<?php echo esc_url(get_template_directory_uri() . '/src/img/v2/products/bg-gray.png'); ?>" style="
        background: linear-gradient(to left, #f4f4f4, #f4f4f4);
        object-fit: cover;
      ">
      <img class="w-[257.73px] h-[257.73px] absolute left-[50%] top-[50%]" style="translate: -50% -50%; object-fit: cover; aspect-ratio: 1" src="<?php echo esc_url(get_template_directory_uri() . '/src/img/v2/products/product-'.$product_id.'.png'); ?>">
      <div class="bg-[#000000] pt-1 pr-2 pb-1 pl-2 flex flex-row gap-7 items-center justify-start absolute left-0 top-0 overflow-hidden">
        <div class="text-[#ffffff] text-left font-['Raleway-SemiBold',_sans-serif] text-xs leading-[18px] font-semibold relative flex items-center justify-start">
          - 20%
        </div>
      </div>
      <div class="bg-[#ffffff] rounded-[90px] p-2 flex flex-row gap-2.5 items-center justify-start absolute left-[284px] top-5">
        <svg class="shrink-0 w-4 h-4 relative overflow-visible" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" clip-rule="evenodd" d="M7.99544 3.42388C6.66254 1.8656 4.43984 1.44643 2.76981 2.87334C1.09977 4.30026 0.864655 6.68598 2.17614 8.3736C3.26655 9.77674 6.56653 12.7361 7.64808 13.6939C7.76908 13.801 7.82958 13.8546 7.90015 13.8757C7.96175 13.8941 8.02914 13.8941 8.09074 13.8757C8.16131 13.8546 8.22181 13.801 8.34281 13.6939C9.42436 12.7361 12.7243 9.77674 13.8147 8.3736C15.1262 6.68598 14.9198 4.28525 13.2211 2.87334C11.5223 1.46144 9.32835 1.8656 7.99544 3.42388Z" stroke="var(--ui-light-black-primary, #111111)" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"></path>
        </svg>
      </div>
    </div>
    <div class="flex flex-col gap-2 items-start justify-start self-stretch shrink-0 relative">
      <div class="text-[#141414] text-left font-['Raleway-SemiBold',_sans-serif] text-sm leading-5 font-semibold relative self-stretch flex items-center justify-start">
        Arian Reception Desk with 3 Drawer Cabinet in Walnut Finish
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
          AED3,575.00
        </div>
        <div class="text-[#8f8f8f] text-right font-['Raleway-Regular',_sans-serif] text-sm leading-[30px] font-normal relative" style="text-decoration: line-through">
          AED3,575.00
        </div>
      </div>
    </div>
  </div>
</a>
