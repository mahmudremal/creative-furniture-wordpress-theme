<?php

class CustomerReviews {

    public function __construct() {
        add_action('wp_ajax_filter_reviews', [$this, 'filter_reviews']);
        add_action('wp_ajax_nopriv_filter_reviews', [$this, 'filter_reviews']);
        add_action('wp_enqueue_scripts', [$this, 'localize_ajax']);
    }

    public function localize_ajax() {
        if (is_product()) {
            global $product;
	        wp_enqueue_script( 'cf-reviews', get_template_directory_uri() . '/dist/js/reviews.js', [], filemtime(get_template_directory() . '/dist/js/reviews.js'), true );
            wp_localize_script('cf-reviews', 'cf_reviews_obj', [
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce'    => wp_create_nonce('cf_reviews_nonce'),
                'product_id' => method_exists($product, 'get_id') ? $product->get_id() : get_the_ID()
            ]);
        }
    }

    public function filter_reviews() {
        check_ajax_referer('cf_reviews_nonce', 'nonce');

        $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
        $keyword    = isset($_POST['keyword']) ? sanitize_text_field($_POST['keyword']) : '';
        $sortby     = isset($_POST['sortby']) ? sanitize_text_field($_POST['sortby']) : 'recent';
        $rating     = isset($_POST['rating']) ? sanitize_text_field($_POST['rating']) : 'all';

        if (!$product_id) {
            wp_send_json_error('Invalid Product ID');
        }

        $args = [
            'post_id' => $product_id,
            'status'  => 'approve',
            'type'    => 'review',
            'search'  => $keyword,
        ];

        if ($sortby === 'recent') {
            $args['orderby'] = 'comment_date';
            $args['order']   = 'DESC';
        } elseif ($sortby === 'oldest') {
            $args['orderby'] = 'comment_date';
            $args['order']   = 'ASC';
        }

        if ($rating !== 'all') {
            $args['meta_query'] = [
                [
                    'key'     => 'rating',
                    'value'   => intval($rating),
                    'compare' => '=',
                ],
            ];
        }

        $reviews = get_comments($args);

        ob_start();
        if ($reviews) {
            foreach ($reviews as $comment) {
                $rating_val = intval(get_comment_meta($comment->comment_ID, 'rating', true));
                $verified = true; // As per the current template logic
                ?>
                <div class="border-solid border-[#dbdbdb] border-b pb-4 flex flex-col gap-4 items-start justify-start self-stretch shrink-0 relative">
                    <div class="flex flex-row gap-11 items-start justify-start self-stretch shrink-0 relative">
                        <div class="flex flex-row items-start justify-between flex-1 relative">
                            <div class="flex flex-col gap-4 items-start justify-start flex-1 relative">
                                <div class="flex flex-row gap-[5.33px] items-center justify-start shrink-0 relative">
                                    <div class="flex flex-row gap-0 items-center justify-start shrink-0 relative">
                                        <?php for ($i = 1; $i <= 5; $i++) : ?>
                                            <svg class="shrink-0 w-4 h-4 relative overflow-visible" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M11.7065 14.0005C11.5999 14.0009 11.4947 13.9757 11.3999 13.9271L7.99986 12.1471L4.59986 13.9271C4.37461 14.0456 4.10159 14.0254 3.89614 13.8753C3.6907 13.7251 3.58868 13.471 3.63319 13.2205L4.29986 9.46713L1.55319 6.80046C1.37856 6.6262 1.31445 6.36974 1.38653 6.13379C1.46535 5.89208 1.67481 5.71624 1.92653 5.68046L5.72653 5.12713L7.39986 1.70713C7.51125 1.47713 7.74431 1.33105 7.99986 1.33105C8.25541 1.33105 8.48847 1.47713 8.59986 1.70713L10.2932 5.12046L14.0932 5.67379C14.3449 5.70957 14.5544 5.88541 14.6332 6.12713C14.7053 6.36307 14.6412 6.61953 14.4665 6.79379L11.7199 9.46046L12.3865 13.2138C12.4351 13.469 12.331 13.7292 12.1199 13.8805C11.9991 13.9651 11.8538 14.0073 11.7065 14.0005Z" fill="<?php echo $i <= $rating_val ? '#373737' : '#dbdbdb'; ?>"/>
                                            </svg>
                                        <?php endfor; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="text-[#676767] text-right font-['Raleway-Regular',_sans-serif] text-sm font-normal relative">
                                <?php printf(_x('%s ago', '%s = human-readable time difference', 'woocommerce'), human_time_diff(get_comment_date('U', $comment->comment_ID), current_time('timestamp'))); ?>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col gap-3 items-start justify-start relative">
                        <div class="flex flex-col gap-1 items-start justify-start self-stretch shrink-0 relative">
                            <div class="text-[#000000] text-left font-['Raleway-SemiBold',_sans-serif] text-sm leading-5 font-semibold relative self-stretch">
                                <?php echo esc_html($comment->comment_author); ?>
                            </div>
                            <?php if ($verified) : ?>
                                <div class="flex flex-row gap-1 items-center justify-start shrink-0 relative">
                                    <svg class="shrink-0 w-4 h-4 relative overflow-visible" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip_verified_<?php echo $comment->comment_ID; ?>)">
                                            <path d="M6.00016 7.99967L7.3335 9.33301L10.3335 6.33301M6.13476 13.7336C6.35326 13.7047 6.57399 13.764 6.74805 13.898L7.5502 14.5136C7.81536 14.7173 8.18422 14.7173 8.44864 14.5136L9.28117 13.8743C9.43671 13.7551 9.63299 13.7025 9.82705 13.7284L10.8684 13.8654C11.1995 13.9091 11.5188 13.7247 11.6469 13.4158L12.0476 12.447C12.1224 12.2655 12.2661 12.1218 12.4476 12.047L13.4164 11.6462C13.7252 11.5188 13.9097 11.1988 13.866 10.8677L13.7341 9.86407C13.7052 9.64556 13.7645 9.42482 13.8986 9.25075L14.5141 8.44855C14.7178 8.18337 14.7178 7.81449 14.5141 7.55006L13.8749 6.71749C13.7556 6.56194 13.703 6.36565 13.7289 6.17158L13.866 5.13013C13.9097 4.79902 13.7252 4.47977 13.4164 4.35163L12.4476 3.9509C12.2661 3.87609 12.1224 3.73239 12.0476 3.55091L11.6469 2.58205C11.5195 2.27317 11.1995 2.08873 10.8684 2.13243L9.82705 2.26946C9.63299 2.29613 9.43671 2.24354 9.28191 2.12502L8.44938 1.48578C8.18422 1.28208 7.81536 1.28208 7.55094 1.48578L6.71842 2.12502C6.56288 2.24354 6.3666 2.29613 6.17254 2.27094L5.13114 2.13391C4.80006 2.09021 4.48083 2.27465 4.35269 2.58353L3.95272 3.55239C3.87717 3.73313 3.73348 3.87683 3.55276 3.95238L2.58395 4.35237C2.27508 4.48051 2.09066 4.79976 2.13436 5.13087L2.27138 6.17232C2.29656 6.36639 2.24398 6.56268 2.12547 6.71749L1.48626 7.55006C1.28257 7.81524 1.28257 8.18411 1.48626 8.44855L2.12547 9.28112C2.24472 9.43667 2.2973 9.63296 2.27138 9.82703L2.13436 10.8685C2.09066 11.1996 2.27508 11.5188 2.58395 11.647L3.55276 12.0477C3.73422 12.1225 3.87791 12.2662 3.95272 12.4477L4.35343 13.4166C4.48083 13.7254 4.8008 13.9099 5.13188 13.8662L6.13476 13.7336Z" stroke="#111111" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round"/>
                                        </g>
                                        <defs>
                                            <clipPath id="clip_verified_<?php echo $comment->comment_ID; ?>"><rect width="16" height="16" fill="white"/></clipPath>
                                        </defs>
                                    </svg>
                                    <div class="text-[#404040] text-left font-['Raleway-Regular',_sans-serif] text-sm font-normal relative">Verified Buyer</div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="flex flex-col gap-2 items-start justify-start self-stretch shrink-0 relative">
                            <div class="text-[#3c3c3c] text-left font-['Raleway-Regular',_sans-serif] text-xs leading-[18px] font-normal relative self-stretch">
                                <?php echo esc_html($comment->comment_content); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo '<p class="text-[#676767] font-[\'Raleway-Regular\',_sans-serif] text-sm">No reviews matching your criteria.</p>';
        }
        $html = ob_get_clean();

        wp_send_json_success($html);
    }
}
$customer_reviews = new CustomerReviews();