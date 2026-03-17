<?php

add_action('add_meta_boxes', function () {
    add_meta_box(
        'fp_shop_by_category',
        'Front Page Settings',
        'fp_shop_by_category_callback',
        'page',
        'normal',
        'high'
    );
});

function fp_shop_by_category_callback($post) {
    if (get_option('page_on_front') != $post->ID) return;

    $value = get_post_meta($post->ID, '_fp_shop_by_category', true);

    wp_nonce_field('fp_shop_by_category_nonce', 'fp_shop_by_category_nonce_field');

    echo '<div style="padding:10px;border:1px solid #ddd;border-radius:6px;background:#fafafa;">';
    echo '<label><strong>Shop by Category (IDs comma separated)</strong></label>';
    echo '<input type="text" name="fp_shop_by_category" value="' . esc_attr($value) . '" style="width:100%;margin-top:8px;" placeholder="e.g. 12,15,8,20">';
    echo '</div>';
}

add_action('save_post', function ($post_id) {
    if (!isset($_POST['fp_shop_by_category_nonce_field'])) return;
    if (!wp_verify_nonce($_POST['fp_shop_by_category_nonce_field'], 'fp_shop_by_category_nonce')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (get_post_type($post_id) !== 'page') return;

    if (isset($_POST['fp_shop_by_category'])) {
        $value = sanitize_text_field($_POST['fp_shop_by_category']);
        update_post_meta($post_id, '_fp_shop_by_category', $value);
    }
});

function get_front_page_shop_categories() {
    $front_page_id = get_option('page_on_front');
    if (!$front_page_id) return [];

    $ids_string = get_post_meta($front_page_id, '_fp_shop_by_category', true);
    if (!$ids_string) return [];

    $ids = array_filter(array_map('intval', explode(',', $ids_string)));

    if (empty($ids)) return [];

    return get_terms([
        'taxonomy'   => 'product_cat',
        'include'    => $ids,
        'hide_empty' => false,
        'orderby'    => 'include', // preserves order
    ]);
}

add_action('product_cat_add_form_fields', function () {
    ?>
    <div class="form-field">
        <label for="shorthand">Shorthand</label>
        <input type="text" name="shorthand" id="shorthand" value="">
        <p class="description">Short name for this category.</p>
    </div>
    <?php
});

add_action('product_cat_edit_form_fields', function ($term) {
    $value = get_term_meta($term->term_id, 'shorthand', true);
    ?>
    <tr class="form-field">
        <th scope="row"><label for="shorthand">Shorthand</label></th>
        <td>
            <input type="text" name="shorthand" id="shorthand" value="<?php echo esc_attr($value); ?>">
            <p class="description">Short name for this category.</p>
        </td>
    </tr>
    <?php
});

add_action('created_product_cat', 'save_product_cat_shorthand');
add_action('edited_product_cat', 'save_product_cat_shorthand');

function save_product_cat_shorthand($term_id) {
    if (isset($_POST['shorthand'])) {
        update_term_meta($term_id, 'shorthand', sanitize_text_field($_POST['shorthand']));
    }
}