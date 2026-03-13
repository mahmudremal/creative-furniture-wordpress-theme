<?php
/**
 * Template Name: Order Tracking
 */

get_header();

$order = null;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id']) && isset($_POST['billing_email'])) {
    $order_id = sanitize_text_field($_POST['order_id']);
    $billing_email = sanitize_email($_POST['billing_email']);
    
    $order = wc_get_order($order_id);
    
    if (!$order || $order->get_billing_email() !== $billing_email) {
        $error = __('Order not found. Please check your Order ID and Billing Email.', 'creative-furniture');
        $order = null;
    }
}
?>

<div class="relative flex flex-col gap-10 pb-20">
    <!-- Breadcrumbs -->
    <div class="flex flex-row gap-2 items-center justify-start px-4 md:px-0 w-full max-w-full md:w-[1440px] m-auto relative pt-10">
        <div class="text-[#989898] text-left font-['Raleway-Medium',_sans-serif] text-base leading-6 font-medium relative flex items-center justify-start">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e('Home', 'creative-furniture'); ?></a>
        </div>
        <div class="text-[#989898] text-left font-['Raleway-Medium',_sans-serif] text-base leading-6 font-medium relative flex items-center justify-start">
            /
        </div>
        <div class="text-[#000000] text-left font-['Raleway-Medium',_sans-serif] text-base leading-6 font-medium relative flex items-center justify-start">
            <?php esc_html_e('Order Tracking', 'creative-furniture'); ?>
        </div>
    </div>

    <?php if (!$order) : ?>
    <div class="h-[381px] overflow-hidden px-4 md:px-0 w-full max-w-full md:w-[1440px] m-auto relative">
      <img class="h-[607px] absolute right-0 left-0 top-[calc(50%_-_404.5px)] w-full w-full" style="
          object-fit: cover;
        " src="<?php echo get_template_directory_uri(); ?>/dist/images/v2/rectangle-453201.png">
      <div class="flex flex-col gap-14 items-center justify-center w-[476px] absolute left-[50%] top-[50%] z-10" style="translate: -50% -50%">
        <div class="text-[#ffffff] text-center font-['Raleway-SemiBold',_sans-serif] text-5xl leading-[62px] font-semibold relative w-[655px]">
          <?php esc_html_e('Order Tracking', 'creative-furniture'); ?>
        </div>
      </div>
      <div class="absolute inset-0 bg-black/20"></div>
    </div>

    <div class="flex py-10 justify-center px-4 md:px-0">
        <form method="POST" action="" class="flex flex-col gap-8 items-start justify-start w-[687px] m-auto relative">
            <div class="text-[#383838] text-left font-['Raleway-Regular',_sans-serif] text-base leading-6 font-normal relative self-stretch">
                <?php echo sprintf(esc_html(__('To track your order please enter your Order ID in the box below and press the "%sTrack%s" button. This was given to you on your receipt and in the confirmation email you should have received.', 'creative-furniture')), '<strong>', '</strong>'); ?>
            </div>
            <?php if ($error): ?>
                <div class="text-red-500 text-sm font-semibold self-stretch"><?php echo esc_html($error); ?></div>
            <?php endif; ?>
            <div class="flex flex-col gap-10 items-start justify-start self-stretch shrink-0 relative">
                <div class="flex flex-col gap-4 items-start justify-start self-stretch shrink-0 relative">
                    <div class="flex flex-col gap-3 items-start justify-start self-stretch shrink-0 relative">
                        <label for="order_id" class="text-[#031424] text-left font-['Raleway-SemiBold',_sans-serif] text-base leading-6 font-semibold relative self-stretch">
                        <?php esc_html_e('Order ID', 'creative-furniture'); ?>
                        </label>
                        <input type="text" id="order_id" name="order_id" required class="border-solid border-[#cbcbcb] border p-4 flex flex-row gap-2.5 items-center justify-start self-stretch shrink-0 h-14 relative text-[#000]" placeholder="<?php esc_attr_e('Found in your order confirmation email.', 'creative-furniture'); ?>">
                    </div>
                    <div class="flex flex-col gap-3 items-start justify-start self-stretch shrink-0 relative">
                        <label for="billing_email" class="text-[#031424] text-left font-['Raleway-SemiBold',_sans-serif] text-base leading-6 font-semibold relative self-stretch">
                        <?php esc_html_e('Billing Email', 'creative-furniture'); ?>
                        </label>
                        <input type="email" id="billing_email" name="billing_email" required class="border-solid border-[#cbcbcb] border p-4 flex flex-row gap-2.5 items-center justify-start self-stretch shrink-0 h-14 relative text-[#000]" placeholder="<?php esc_attr_e('Email you used during checkout', 'creative-furniture'); ?>">
                    </div>
                </div>
                <button type="submit" class="bg-[#000000] pt-[13px] pr-[22px] pb-[13px] pl-[22px] flex flex-row gap-2.5 items-center justify-center self-stretch shrink-0 relative">
                    <div class="text-[#ffffff] text-left font-['Raleway-SemiBold',_sans-serif] text-base leading-6 font-semibold relative">
                        <?php esc_html_e('Order Track', 'creative-furniture'); ?>
                    </div>
                </button>
            </div>
        </form>
    </div>
    <?php else : ?>

    <div class="flex flex-col gap-10 py-5 px-4 md:px-0 w-full max-w-full md:w-[1440px] m-auto relative">
        <div class="flex flex-col gap-3 items-start justify-start w-full md:w-[461px] relative">
            <h1 class="text-black-primary text-left font-['Raleway-SemiBold',_sans-serif] text-2xl leading-8 font-semibold relative self-stretch flex items-center justify-start">
                <?php esc_html_e('Order ID:', 'creative-furniture'); ?> <?php echo esc_html($order->get_order_number()); ?>
            </h1>
        </div>
        <div class="flex flex-wrap gap-10 items-start">
            <div class="flex flex-col gap-12 items-start justify-start relative flex-1">
                <div class="flex flex-col gap-6 items-start justify-start shrink-0 w-full relative">
                    <div class="border-solid border-[#d9d9d9] border-b pb-2.5 flex flex-row gap-2.5 items-center justify-start self-stretch shrink-0 relative">
                        <div class="text-[#363636] text-left font-['Raleway-SemiBold',_sans-serif] text-xl leading-[30px] font-semibold relative flex items-center justify-start">
                            <?php esc_html_e('Order Items', 'creative-furniture'); ?>
                        </div>
                    </div>
                    <div class="flex flex-col gap-5 w-full">
                        <?php foreach ($order->get_items() as $item_id => $item) : 
                            $product = $item->get_product();
                            ?>
                        <div class="border-solid border-[#d9d9d9] border-b pb-5 flex flex-row gap-6 items-center justify-start self-stretch shrink-0 relative">
                            <div class="flex flex-row gap-4 items-center justify-start flex-1 relative">
                                <div class="bg-[#d9d9d9] shrink-0 w-[98px] h-[98px] relative overflow-hidden">
                                    <?php if ($product) echo $product->get_image('thumbnail', ['class' => 'w-full h-full object-cover']); ?>
                                </div>
                                <div class="flex flex-col gap-3 items-start justify-center self-stretch flex-1 relative">
                                    <div class="flex flex-col gap-1 items-start justify-start self-stretch shrink-0 relative">
                                        <div class="text-[#000000] text-left font-['Raleway-Medium',_sans-serif] text-base leading-6 font-medium relative self-stretch">
                                        <?php echo esc_html($item->get_name()); ?>
                                        </div>
                                    </div>
                                    <div class="flex flex-col gap-0.5 items-start justify-start self-stretch shrink-0 relative">
                                        <?php foreach ($item->get_formatted_meta_data() as $meta) : ?>
                                        <div class="text-left font-['Raleway-Regular',_sans-serif] text-xs leading-[18px] font-normal relative self-stretch flex items-center justify-start">
                                        <span>
                                            <span class="font-semibold"><?php echo esc_html($meta->display_key); ?>:</span>
                                            <span><?php echo wp_kses_post($meta->display_value); ?></span>
                                        </span>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-row gap-[66px] items-center justify-end shrink-0 relative">
                                <div class="text-[rgba(0,0,0,0.70)] text-right font-['Raleway-SemiBold',_sans-serif] text-base leading-6 font-semibold relative">
                                    <?php echo $order->get_formatted_line_subtotal($item); ?>
                                </div>
                            </div>
                            <div class="bg-[#818080] rounded-[62px] p-2.5 flex flex-col gap-2.5 items-center justify-center shrink-0 w-6 h-6 absolute left-[86px] top-[-12px]">
                                <div class="text-[#ffffff] text-center font-['Aspekta-400',_sans-serif] text-base leading-[18px] font-normal relative w-3.5 h-4 flex items-center justify-center">
                                <?php echo esc_html($item->get_quantity()); ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <div class="flex flex-col gap-6 items-start justify-start shrink-0 w-full relative">
                    <div class="border-solid border-[#d9d9d9] border-b pb-2.5 flex flex-row gap-2.5 items-center justify-start self-stretch shrink-0 relative">
                        <div class="text-[#363636] text-left font-['Raleway-SemiBold',_sans-serif] text-xl leading-[30px] font-semibold relative flex items-center justify-start">
                            <?php esc_html_e('Overview', 'creative-furniture'); ?>
                        </div>
                    </div>
                    <div class="flex flex-col gap-3 items-start justify-start self-stretch shrink-0 relative">
                        <div class="flex flex-row items-center justify-between self-stretch shrink-0 relative">
                            <div class="text-[#373737] text-left font-['Raleway-Medium',_sans-serif] text-sm leading-5 font-medium relative"><?php esc_html_e('Order ID', 'creative-furniture'); ?></div>
                            <div class="text-[#464646] text-right font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal uppercase relative">#<?php echo esc_html($order->get_order_number()); ?></div>
                        </div>
                        <div class="flex flex-row items-center justify-between self-stretch shrink-0 relative">
                            <div class="text-[#373737] text-left font-['Raleway-Medium',_sans-serif] text-sm leading-5 font-medium relative"><?php esc_html_e('Date', 'creative-furniture'); ?></div>
                            <div class="text-[#464646] text-right font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal relative"><?php echo esc_html($order->get_date_created()->format('M d, Y')); ?></div>
                        </div>
                        <div class="flex flex-row items-center justify-between self-stretch shrink-0 relative">
                            <div class="text-[#373737] text-left font-['Raleway-Medium',_sans-serif] text-sm leading-5 font-medium relative"><?php esc_html_e('Est Delivery', 'creative-furniture'); ?></div>
                            <div class="text-[#464646] text-right font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal relative">
                                <?php
                                    $estimated_delivery = get_post_meta($order->get_id(), '_estimated_delivery', true);
                                    echo $estimated_delivery ? esc_html($estimated_delivery) : '-';
                                ?>
                            </div>
                        </div>
                        <div class="flex flex-row items-center justify-between self-stretch shrink-0 relative">
                            <div class="text-[#373737] text-left font-['Raleway-Medium',_sans-serif] text-sm leading-5 font-medium relative"><?php esc_html_e('Address', 'creative-furniture'); ?></div>
                            <div class="text-[#464646] text-right font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal relative text-right">
                                <?php echo esc_html($order->get_shipping_address_1()); ?><br>
                                <?php echo esc_html($order->get_shipping_city() . ', ' . $order->get_shipping_state() . ', ' . $order->get_shipping_postcode()); ?>
                            </div>
                        </div>
                        <div class="flex flex-row items-center justify-between self-stretch shrink-0 relative">
                            <div class="text-[#373737] text-left font-['Raleway-Medium',_sans-serif] text-sm leading-5 font-medium relative"><?php esc_html_e('Email', 'creative-furniture'); ?></div>
                            <div class="text-[#464646] text-right font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal relative uppercase"><?php echo esc_html($order->get_billing_email()); ?></div>
                        </div>
                        <div class="flex flex-row items-center justify-between self-stretch shrink-0 relative">
                            <div class="text-[#373737] text-left font-['Raleway-Medium',_sans-serif] text-sm leading-5 font-medium relative"><?php esc_html_e('Phone', 'creative-furniture'); ?></div>
                            <div class="text-[#464646] text-right font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal relative"><?php echo esc_html($order->get_billing_phone()); ?></div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col gap-6 items-start justify-start shrink-0 w-full relative">
                    <div class="border-solid border-[#d9d9d9] border-b pb-2.5 flex flex-row gap-2.5 items-center justify-start self-stretch shrink-0 relative">
                        <div class="text-[#363636] text-left font-['Raleway-SemiBold',_sans-serif] text-xl leading-[30px] font-semibold relative flex items-center justify-start">
                            <?php esc_html_e('Order Summary', 'creative-furniture'); ?>
                        </div>
                    </div>
                    <div class="flex flex-col gap-3 w-full border-solid border-[#d9d9d9] border-b pb-5">
                        <div class="flex flex-row items-center justify-between self-stretch shrink-0 relative">
                            <div class="text-[#373737] text-left font-['Raleway-Medium',_sans-serif] text-sm leading-5 font-medium relative"><?php esc_html_e('Subtotal (Incl.Vat)', 'creative-furniture'); ?></div>
                            <div class="text-[#464646] text-right font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal uppercase relative"><?php echo $order->get_formatted_order_total(); ?></div>
                        </div>
                        <div class="flex flex-row items-center justify-between self-stretch shrink-0 relative">
                            <div class="text-[#373737] text-left font-['Raleway-Medium',_sans-serif] text-sm leading-5 font-medium relative"><?php esc_html_e('Shipping Charge', 'creative-furniture'); ?></div>
                            <div class="text-[#464646] text-right font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal relative">
                                <?php 
                                    echo $order->get_shipping_total() > 0 
                                        ? wc_price($order->get_shipping_total()) 
                                        : __('Free Shipping', 'creative-furniture'); 
                                ?>
                            </div>
                        </div>
                        <div class="flex flex-row items-center justify-between self-stretch shrink-0 relative">
                            <div class="text-[#373737] text-left font-['Raleway-Medium',_sans-serif] text-sm leading-5 font-medium relative"><?php esc_html_e('Payment method', 'creative-furniture'); ?></div>
                            <div class="text-[#464646] text-right font-['Raleway-Regular',_sans-serif] text-sm leading-5 font-normal relative"><?php echo esc_html($order->get_payment_method_title()); ?></div>
                        </div>
                        <div class="flex flex-row items-center justify-between self-stretch shrink-0 relative mt-2">
                            <div class="text-[#373737] text-left font-['Raleway-SemiBold',_sans-serif] text-base leading-6 font-semibold relative"><?php esc_html_e('Total', 'creative-furniture'); ?></div>
                            <div class="text-[#464646] text-right font-['Raleway-SemiBold',_sans-serif] text-base leading-6 font-semibold uppercase relative"><?php echo $order->get_formatted_order_total(); ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status Timeline -->
            <div class="bg-[#f8f8f8] -rounded-lg p-4 md:p-8 flex flex-col gap-6 items-start justify-start w-full md:w-[500px] shrink-0 sticky top-10 self-start">
                <div class="border-solid border-[#efefef] border-b pb-3 w-full">
                    <div class="text-black-primary text-left font-['Raleway-SemiBold',_sans-serif] text-2xl font-semibold relative flex items-center justify-start">
                        <?php esc_html_e('Order Status Guide', 'creative-furniture'); ?>
                    </div>
                </div>
                <?php
                $current_status = $order->get_status();
                $status_guide = [
                    'pending' => [
                        'label' => __('Order confirmed', 'creative-furniture'),
                        'desc' => __('Your order has been successfully placed and confirmed.', 'creative-furniture'),
                    ],
                    'processing' => [
                        'label' => __('Processing', 'creative-furniture'),
                        'desc' => __('Your items are being prepared and packed for shipment.', 'creative-furniture'),
                    ],
                    'shipped' => [
                        'label' => __('Shipped', 'creative-furniture'),
                        'desc' => __('Your order has left our warehouse and is on its way.', 'creative-furniture'),
                    ],
                    'out-for-delivery' => [
                        'label' => __('Out for Delivery', 'creative-furniture'),
                        'desc' => __('Your package is currently on the way to your address.', 'creative-furniture'),
                    ],
                    'completed' => [
                        'label' => __('Delivered', 'creative-furniture'),
                        'desc' => __('Your order has been successfully delivered.', 'creative-furniture'),
                    ],
                ];

                $status_order = ['pending', 'processing', 'shipped', 'out-for-delivery', 'completed'];
                $current_index = array_search($current_status, $status_order);
                if ($current_index === false) $current_index = 0;

                foreach ($status_guide as $status_key => $guide) :
                    $status_index = array_search($status_key, $status_order);
                    $is_active = $status_index <= $current_index;
                    $bg_color = $is_active ? 'bg-[#000000]' : 'bg-[#cecece]';
                ?>
                <div class="flex flex-row items-start justify-between self-stretch shrink-0 relative">
                    <div class="flex flex-row gap-4 items-center justify-start shrink-0 relative">
                        <div class="<?php echo $bg_color; ?> rounded-full p-2 flex items-center justify-center shrink-0 w-7 md:w-10 h-auto aspect-square relative">
                            <svg class="shrink-0 w-4 md:w-6 h-auto aspect-square relative overflow-visible" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 6L9 17L4 12" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </div>
                        <div class="flex flex-col gap-1 items-start justify-center relative">
                            <div class="text-[#111] text-left font-['Raleway-SemiBold',_sans-serif] text-base leading-6 font-semibold relative">
                                <?php echo esc_html($guide['label']); ?>
                            </div>
                            <div class="text-[#666] text-left font-['Raleway-Regular',_sans-serif] text-sm leading-tight font-normal relative max-w-[280px]">
                                <?php echo esc_html($guide['desc']); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<?php get_footer(); ?>