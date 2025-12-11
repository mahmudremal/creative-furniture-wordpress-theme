<?php

add_action('add_meta_boxes', function() {
    add_meta_box('tabby_installments', 'Tabby Installments', function($post) {
        $down = get_post_meta($post->ID, '_tabby_downpayment', true);
        $months = get_post_meta($post->ID, '_tabby_months', true);
        ?>
        <p>
            <label>Downpayment:</label>
            <input type="number" step="0.01" name="tabby_downpayment" value="<?php echo esc_attr($down); ?>">
        </p>
        <p>
            <label>Installment Months:</label>
            <input type="number" name="tabby_months" value="<?php echo esc_attr($months); ?>">
        </p>
        <?php
    }, 'product', 'side');
});

add_action('save_post_product', function($post_id) {
    if (isset($_POST['tabby_downpayment'])) {
        update_post_meta($post_id, '_tabby_downpayment', sanitize_text_field($_POST['tabby_downpayment']));
    }
    if (isset($_POST['tabby_months'])) {
        update_post_meta($post_id, '_tabby_months', sanitize_text_field($_POST['tabby_months']));
    }
});


function tabby_render_installments($product) {
    if (!$product) return;

    $price = floatval($product->get_price());
    $down = floatval(get_post_meta($product->get_id(), '_tabby_downpayment', true));
    $default_months = intval(get_post_meta($product->get_id(), '_tabby_months', true));

    if (empty($default_months)) $default_months = 4;
    if ($down > 0 && $down < $price) $remaining = $price - $down;
    else $remaining = $price;

    ?>
    <!-- <div id="tabby-box" data-price="<?php echo esc_attr($price); ?>" data-down="<?php echo esc_attr($down); ?>">
        <div>
            <select id="tabby-months">
                <?php for ($i=1; $i<=12; $i++): ?>
                    <option value="<?php echo $i; ?>" <?php selected($i, $default_months); ?>><?php echo $i; ?> months</option>
                <?php endfor; ?>
            </select>
        </div>
        <div id="tabby-result"></div>
    </div> -->

    <div class="cf-payment-text">
        <span class="cf-payment-label"><?php esc_html_e('As low as', 'creative-furniture'); ?></span>
        <span class="cf-payment-amount"><span><?php echo esc_html($remaining / $default_months); ?></span> /month</span>
        <span class="cf-payment-label"><?php echo sprintf(
            __('%s or %s interest-free payments.', 'creative-furniture'),
            !empty($down) ? sprintf(__('on downpayment %s', 'creative-furniture'), '<strong>'.$down.'</strong>') : '',
            '<select class="tabbyCalc" data-price="'. esc_attr($price) . '" data-down="'. esc_attr($down) . '">
                '.
                implode(
                    '',
                    array_map(function($i) use ($default_months) {
                        return '<option value="'.$i.'"'. ($i == $default_months ? ' selected' : '').'> '.$i.' months</option>';
                    }, range(1, 12))
                )
                .'
            </select>'
        ); ?></span>
        <a href="https://tabby.ai/en-AE/pay-later<?php // echo esc_attr(get_post_meta($product->get_id(), '_tabby_url', true)); ?>" class="cf-payment-link" target="_blank"><?php esc_html_e('Learn More', 'creative-furniture'); ?></a>
    </div>
    <div class="cf-payment-badge">
        <svg width="53" height="16" viewBox="0 0 53 16" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M46.5788 3.07157L43.3517 15.3967V15.4356H45.879L49.106 3.11045H46.5788V3.07157ZM6.68735 10.0701C6.29855 10.2645 5.90974 10.3422 5.48206 10.3422C4.5878 10.3422 4.08236 10.1867 4.0046 9.44798V9.4091C4.0046 9.37022 4.0046 9.37022 4.0046 9.33134V7.1929V6.95962V5.44328V4.82119V4.58791V3.14933L1.74952 3.42149C3.26586 3.11045 4.12124 1.94403 4.12124 0.738731V0H1.594V3.46037L1.43848 3.49925V9.87566C1.51624 11.6642 2.72154 12.7528 4.62668 12.7528C5.32653 12.7528 6.06526 12.5973 6.64847 12.3251L6.68735 10.0701Z" fill="#292929"/>
            <path d="M7.07626 2.60468L0 3.69334V5.48185L7.07626 4.39319V2.60468ZM7.07626 5.24856L0 6.33722V8.04796L7.07626 6.95931V5.24856ZM15.0079 6.06505C14.8913 4.08215 13.6471 2.87685 11.6253 2.87685C10.4589 2.87685 9.48686 3.34341 8.82589 4.19879C8.16492 5.05416 7.81499 6.29834 7.81499 7.81468C7.81499 9.33102 8.16492 10.5752 8.82589 11.4306C9.48686 12.2859 10.4589 12.7136 11.6253 12.7136C13.6471 12.7136 14.8913 11.5472 15.0079 9.52542V12.5192H17.5351V3.11013L15.0079 3.49893V6.06505ZM15.1634 7.81468C15.1634 9.56431 14.2303 10.7307 12.7917 10.7307C11.3142 10.7307 10.42 9.64207 10.42 7.81468C10.42 5.98729 11.3142 4.89864 12.7917 4.89864C13.4916 4.89864 14.1136 5.1708 14.5413 5.71513C14.9301 6.22058 15.1634 6.95931 15.1634 7.81468ZM24.8836 2.87685C22.8618 2.87685 21.6176 4.04326 21.501 6.06505V0.349609L18.9737 0.738415V12.5192H21.501V9.52542C21.6176 11.5472 22.8618 12.7136 24.8836 12.7136C27.2553 12.7136 28.6939 10.8862 28.6939 7.81468C28.6939 4.74311 27.2553 2.87685 24.8836 2.87685ZM23.756 10.7307C22.3174 10.7307 21.3843 9.60319 21.3843 7.81468C21.3843 6.95931 21.6176 6.22058 22.0064 5.71513C22.4341 5.1708 23.0173 4.89864 23.756 4.89864C25.2335 4.89864 26.1277 5.98729 26.1277 7.81468C26.1277 9.64207 25.2335 10.7307 23.756 10.7307ZM35.5368 2.87685C33.515 2.87685 32.2709 4.04326 32.1542 6.06505V0.349609L29.627 0.738415V12.5192H32.1542V9.52542C32.2709 11.5472 33.515 12.7136 35.5368 12.7136C37.9086 12.7136 39.3471 10.8862 39.3471 7.81468C39.3471 4.74311 37.9086 2.87685 35.5368 2.87685ZM34.4093 10.7307C32.9707 10.7307 32.0376 9.60319 32.0376 7.81468C32.0376 6.95931 32.2709 6.22058 32.6597 5.71513C33.0874 5.1708 33.6706 4.89864 34.4093 4.89864C35.8868 4.89864 36.781 5.98729 36.781 7.81468C36.781 9.64207 35.8868 10.7307 34.4093 10.7307ZM39.3471 3.07125H42.0299L44.2072 12.5192H41.7966L39.3471 3.07125ZM51.1668 4.04326V3.30453H50.8558V3.14901H51.6723V3.30453H51.3612V4.04326H51.1668ZM51.7112 4.04326V3.11013H52.0222L52.1777 3.53782C52.2166 3.65446 52.2555 3.69334 52.2555 3.73222C52.2555 3.69334 52.2944 3.65446 52.3332 3.53782L52.4888 3.11013H52.7998V4.04326H52.6054V3.30453L52.3332 4.04326H52.1388L51.9056 3.30453V4.04326H51.7112Z" fill="#292929"/>
        </svg>
    </div>
    <?php
}
