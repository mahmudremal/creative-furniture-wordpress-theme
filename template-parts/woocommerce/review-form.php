<?php
defined( 'ABSPATH' ) || exit;

if ( ! comments_open() ) {
    return;
}

$product_id = get_the_ID();
?>

<div id="review-form-wrapper" class="hidden flex-col gap-8 items-start justify-start self-stretch shrink-0 relative mt-10">
    <div class="flex flex-col gap-6 w-full">
        <h3 class="text-[#111111] text-left font-['Raleway-SemiBold',_sans-serif] text-xl font-semibold relative"><?php esc_html_e('Submit Your Review', 'creative-furniture'); ?></h3>
        
        <form action="<?php echo esc_url( site_url( 'wp-comments-post.php' ) ); ?>" method="post" id="commentform" class="flex flex-col gap-6 w-full">
            
            <div class="flex flex-col gap-3">
                <span class="text-[#363636] text-left font-['Raleway-Medium',_sans-serif] text-sm font-medium"><?php esc_html_e('Your overall rating', 'creative-furniture'); ?></span>
                <div class="flex flex-row gap-1" id="rating-stars">
                    <?php for ( $i = 1; $i <= 5; $i++ ) : ?>
                        <button type="button" data-value="<?php echo $i; ?>" class="star-rating-btn cursor-pointer transition-transform hover:scale-110">
                            <svg class="shrink-0 w-6 h-6 relative overflow-visible pointer-events-none" width="24" height="24" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.7065 14.0005C11.5999 14.0009 11.4947 13.9757 11.3999 13.9271L7.99986 12.1471L4.59986 13.9271C4.37461 14.0456 4.10159 14.0254 3.89614 13.8753C3.6907 13.7251 3.58868 13.471 3.63319 13.2205L4.29986 9.46713L1.55319 6.80046C1.37856 6.6262 1.31445 6.36974 1.38653 6.13379C1.46535 5.89208 1.67481 5.71624 1.92653 5.68046L5.72653 5.12713L7.39986 1.70713C7.51125 1.47713 7.74431 1.33105 7.99986 1.33105C8.25541 1.33105 8.48847 1.47713 8.59986 1.70713L10.2932 5.12046L14.0932 5.67379C14.3449 5.70957 14.5544 5.88541 14.6332 6.12713C14.7053 6.36307 14.6412 6.61953 14.4665 6.79379L11.7199 9.46046L12.3865 13.2138C12.4351 13.469 12.331 13.7292 12.1199 13.8805C11.9991 13.9651 11.8538 14.0073 11.7065 14.0005Z" fill="#373737"/>
                            </svg>
                        </button>
                    <?php endfor; ?>
                    <input type="hidden" name="rating" id="selected-rating" value="5">
                </div>
            </div>

            <div class="flex flex-col gap-2">
                <label for="comment" class="text-[#363636] text-left font-['Raleway-Medium',_sans-serif] text-sm font-medium"><?php esc_html_e('Your Review', 'creative-furniture'); ?></label>
                <textarea name="comment" id="comment" rows="5" placeholder="<?php esc_attr_e('Write your comments here...', 'creative-furniture'); ?>" class="w-full border border-[#dbdbdb] p-4 text-[#363636] font-['Raleway-Regular',_sans-serif] text-sm focus:border-[#111111] outline-none transition-colors" required></textarea>
            </div>

            <?php if ( ! is_user_logged_in() ) : ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex flex-col gap-2">
                        <label for="author" class="text-[#363636] text-left font-['Raleway-Medium',_sans-serif] text-sm font-medium"><?php esc_html_e('Name', 'creative-furniture'); ?></label>
                        <input type="text" name="author" id="author" placeholder="<?php esc_attr_e('Your Name', 'creative-furniture'); ?>" class="w-full border border-[#dbdbdb] p-4 text-[#363636] font-['Raleway-Regular',_sans-serif] text-sm focus:border-[#111111] outline-none transition-colors" required>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="email" class="text-[#363636] text-left font-['Raleway-Medium',_sans-serif] text-sm font-medium"><?php esc_html_e('Email', 'creative-furniture'); ?></label>
                        <input type="email" name="email" id="email" placeholder="<?php esc_attr_e('Your Email', 'creative-furniture'); ?>" class="w-full border border-[#dbdbdb] p-4 text-[#363636] font-['Raleway-Regular',_sans-serif] text-sm focus:border-[#111111] outline-none transition-colors" required>
                    </div>
                </div>
            <?php endif; ?>

            <div>
                <button type="submit" class="bg-[#111111] border border-[#111111] text-white pt-4 pr-10 pb-4 pl-10 text-base font-semibold font-['Raleway-SemiBold',_sans-serif] hover:bg-white hover:text-[#111111] transition-colors">
                    <?php esc_html_e('Submit Review', 'creative-furniture'); ?>
                </button>
            </div>

            <input type="hidden" name="comment_post_ID" value="<?php echo esc_attr( $product_id ); ?>">
            <input type="hidden" name="comment_parent" value="0">
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const writeReviewBtn = document.querySelector('#write-review-btn');
    const reviewFormWrapper = document.querySelector('#review-form-wrapper');
    const starBtns = document.querySelectorAll('.star-rating-btn');
    const ratingInput = document.querySelector('#selected-rating');

    if (writeReviewBtn && reviewFormWrapper) {
        writeReviewBtn.addEventListener('click', function() {
            reviewFormWrapper.classList.toggle('hidden');
            reviewFormWrapper.classList.toggle('flex');
            if (!reviewFormWrapper.classList.contains('hidden')) {
                reviewFormWrapper.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    }

    starBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const val = parseInt(this.getAttribute('data-value'));
            ratingInput.value = val;
            
            starBtns.forEach((sBtn, index) => {
                const svgPath = sBtn.querySelector('path');
                if (index < val) {
                    svgPath.setAttribute('fill', '#373737');
                } else {
                    svgPath.setAttribute('fill', '#dbdbdb');
                }
            });
        });
    });
});
</script>
