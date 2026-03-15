<?php

defined( 'ABSPATH' ) || exit;
?>
<div class="h-[381px] overflow-hidden w-full max-w-full md:w-[1440px] m-auto relative">
    <div class="absolute right-0 left-0 bottom-0 top-0 overflow-hidden">
        <img class="h-[607px] w-full" src="<?php echo esc_url(get_template_directory_uri()); ?>/dist/images/v2/rectangle-453201.png" style="background: linear-gradient( to left, rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2) );object-fit: cover;">
        <div class="flex flex-col gap-14 items-center justify-center w-[476px] absolute left-[50%] top-[50%]" style="translate: -50% -50%">
            <div class="text-[#ffffff] text-center font-['Raleway-SemiBold',_sans-serif] text-5xl leading-[62px] font-semibold relative w-[655px]">
                <?php esc_html_e('My Account', 'creative-furniture'); ?>
            </div>
        </div>
    </div>
    <div class="flex flex-col gap-12 items-center justify-center absolute left-[50%] top-[calc(50%_-_30px)]" style="translate: -50%">
        <div class="flex flex-col gap-2 items-center justify-center self-stretch shrink-0 h-[62px] relative"></div>
    </div>
</div>
<div class="flex flex-col gap-8 md:gap-14 w-full max-w-full md:w-[1440px] m-auto">
    <?php
    do_action( 'woocommerce_account_navigation' ); ?>
    <div class="woocommerce-MyAccount-content px-4">
        <?php do_action( 'woocommerce_account_content' ); ?>
    </div>
</div>

<style>
.woocommerce-account .entry-content>.woocommerce {
    padding: 0 !important;
}
</style>