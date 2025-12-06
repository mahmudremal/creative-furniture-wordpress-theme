<?php
defined( 'ABSPATH' ) || exit;

$product_id = isset($product_id) ? $product_id : 0;
$product = $product_id ? wc_get_product($product_id) : null;
$is_edit = $product && $product_id > 0;

// Security check for edit
if ($is_edit && $product->get_meta('_seller_id') != get_current_user_id()) {
    echo '<div class="woocommerce-error">' . __('You do not have permission to edit this product.', 'creative-furniture') . '</div>';
    return;
}

// Pre-fill data
$title = $is_edit ? $product->get_name() : '';
$description = $is_edit ? $product->get_description() : '';
$short_description = $is_edit ? $product->get_short_description() : '';
$regular_price = $is_edit ? $product->get_regular_price() : '';
$sale_price = $is_edit ? $product->get_sale_price() : '';
$sku = $is_edit ? $product->get_sku() : '';
$manage_stock = $is_edit ? $product->get_manage_stock() : false;
$stock_quantity = $is_edit ? $product->get_stock_quantity() : '';
$stock_status = $is_edit ? $product->get_stock_status() : 'instock';
$weight = $is_edit ? $product->get_weight() : '';
$length = $is_edit ? $product->get_length() : '';
$width = $is_edit ? $product->get_width() : '';
$height = $is_edit ? $product->get_height() : '';
$image_id = $is_edit ? $product->get_image_id() : '';
$image_url = $image_id ? wp_get_attachment_image_url($image_id, 'thumbnail') : '';

?>

<div class="product-form-wrapper">
    <div class="product-form-header">
        <h3><?php echo $is_edit ? __('Edit Product', 'creative-furniture') : __('Add New Product', 'creative-furniture'); ?></h3>
        <a href="<?php echo esc_url(wc_get_account_endpoint_url('my-products')); ?>" class="btn btn-secondary"><?php _e('Back to Products', 'creative-furniture'); ?></a>
    </div>

    <form id="seller-product-form" class="seller-product-form" enctype="multipart/form-data">
        <input type="hidden" name="product_id" value="<?php echo esc_attr($product_id); ?>">
        <input type="hidden" name="action" value="<?php echo $is_edit ? 'update_seller_product' : 'create_seller_product'; ?>">
        <input type="hidden" name="nonce" value="<?php echo wp_create_nonce('seller_product_nonce'); ?>">

        <div class="form-section">
            <h4><?php _e('General Information', 'creative-furniture'); ?></h4>
            <div class="form-group">
                <label for="product_name"><?php _e('Product Name', 'creative-furniture'); ?> <span class="required">*</span></label>
                <input type="text" id="product_name" name="product_name" value="<?php echo esc_attr($title); ?>" required>
            </div>

            <div class="form-group">
                <label for="description"><?php _e('Description', 'creative-furniture'); ?></label>
                <?php 
                // Use textarea for simplicity with AJAX, or wp_editor if we handle saving carefully
                ?>
                <textarea id="description" name="description" rows="10"><?php echo esc_textarea($description); ?></textarea>
            </div>

            <div class="form-group">
                <label for="short_description"><?php _e('Short Description', 'creative-furniture'); ?></label>
                <textarea id="short_description" name="short_description" rows="5"><?php echo esc_textarea($short_description); ?></textarea>
            </div>
        </div>

        <div class="form-section">
            <h4><?php _e('Pricing', 'creative-furniture'); ?></h4>
            <div class="form-row">
                <div class="form-group">
                    <label for="regular_price"><?php _e('Regular Price', 'creative-furniture'); ?> (<?php echo get_woocommerce_currency_symbol(); ?>) <span class="required">*</span></label>
                    <input type="number" id="regular_price" name="regular_price" value="<?php echo esc_attr($regular_price); ?>" step="0.01" required>
                </div>
                <div class="form-group">
                    <label for="sale_price"><?php _e('Sale Price', 'creative-furniture'); ?> (<?php echo get_woocommerce_currency_symbol(); ?>)</label>
                    <input type="number" id="sale_price" name="sale_price" value="<?php echo esc_attr($sale_price); ?>" step="0.01">
                </div>
            </div>
        </div>

        <div class="form-section">
            <h4><?php _e('Inventory', 'creative-furniture'); ?></h4>
            <div class="form-row">
                <div class="form-group">
                    <label for="sku"><?php _e('SKU', 'creative-furniture'); ?></label>
                    <input type="text" id="sku" name="sku" value="<?php echo esc_attr($sku); ?>">
                </div>
                <div class="form-group">
                    <label for="stock_status"><?php _e('Stock Status', 'creative-furniture'); ?></label>
                    <select id="stock_status" name="stock_status">
                        <option value="instock" <?php selected($stock_status, 'instock'); ?>><?php _e('In Stock', 'creative-furniture'); ?></option>
                        <option value="outofstock" <?php selected($stock_status, 'outofstock'); ?>><?php _e('Out of Stock', 'creative-furniture'); ?></option>
                        <option value="onbackorder" <?php selected($stock_status, 'onbackorder'); ?>><?php _e('On Backorder', 'creative-furniture'); ?></option>
                    </select>
                </div>
            </div>
            <div class="form-group checkbox-group">
                <label>
                    <input type="checkbox" id="manage_stock" name="manage_stock" value="yes" <?php checked($manage_stock, true); ?>>
                    <?php _e('Manage Stock?', 'creative-furniture'); ?>
                </label>
            </div>
            <div class="form-group stock-qty-group" style="<?php echo $manage_stock ? '' : 'display:none;'; ?>">
                <label for="stock_quantity"><?php _e('Stock Quantity', 'creative-furniture'); ?></label>
                <input type="number" id="stock_quantity" name="stock_quantity" value="<?php echo esc_attr($stock_quantity); ?>">
            </div>
        </div>

        <div class="form-section">
            <h4><?php _e('Shipping', 'creative-furniture'); ?></h4>
            <div class="form-row">
                <div class="form-group">
                    <label for="weight"><?php _e('Weight (kg)', 'creative-furniture'); ?></label>
                    <input type="number" id="weight" name="weight" value="<?php echo esc_attr($weight); ?>" step="0.01">
                </div>
                <div class="form-group">
                    <label><?php _e('Dimensions (cm)', 'creative-furniture'); ?></label>
                    <div class="dimensions-inputs">
                        <input type="number" name="length" placeholder="<?php _e('Length', 'creative-furniture'); ?>" value="<?php echo esc_attr($length); ?>" step="0.1">
                        <input type="number" name="width" placeholder="<?php _e('Width', 'creative-furniture'); ?>" value="<?php echo esc_attr($width); ?>" step="0.1">
                        <input type="number" name="height" placeholder="<?php _e('Height', 'creative-furniture'); ?>" value="<?php echo esc_attr($height); ?>" step="0.1">
                    </div>
                </div>
            </div>
        </div>

        <div class="form-section">
            <h4><?php _e('Product Image', 'creative-furniture'); ?></h4>
            <div class="form-group">
                <?php if ($image_url): ?>
                    <img src="<?php echo esc_url($image_url); ?>" alt="Product Image" class="preview-image" style="max-width: 150px; margin-bottom: 10px; display: block;">
                <?php endif; ?>
                <input type="file" name="product_image" accept="image/*">
                <p class="description"><?php _e('Upload a main image for your product.', 'creative-furniture'); ?></p>
            </div>
        </div>

        <div class="form-section">
            <h4><?php _e('Categories', 'creative-furniture'); ?></h4>
            <div class="categories-list" style="max-height: 200px; overflow-y: auto; border: 1px solid #ddd; padding: 10px;">
                <?php
                $product_cats = $is_edit ? $product->get_category_ids() : [];
                $categories = get_terms(['taxonomy' => 'product_cat', 'hide_empty' => false]);
                foreach ($categories as $category) {
                    ?>
                    <label style="display: block; margin-bottom: 5px;">
                        <input type="checkbox" name="product_cats[]" value="<?php echo $category->term_id; ?>" <?php checked(in_array($category->term_id, $product_cats)); ?>>
                        <?php echo esc_html($category->name); ?>
                    </label>
                    <?php
                }
                ?>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary btn-large">
                <?php echo $is_edit ? __('Update Product', 'creative-furniture') : __('Create Product', 'creative-furniture'); ?>
            </button>
        </div>
    </form>
</div>

<script>
jQuery(document).ready(function($) {
    // Toggle stock quantity
    $('#manage_stock').change(function() {
        if ($(this).is(':checked')) {
            $('.stock-qty-group').slideDown();
        } else {
            $('.stock-qty-group').slideUp();
        }
    });

    // Form submission
    $('#seller-product-form').on('submit', function(e) {
        e.preventDefault();
        
        var form = $(this);
        var formData = new FormData(this);
        var submitBtn = form.find('button[type="submit"]');
        var originalText = submitBtn.text();
        
        submitBtn.prop('disabled', true).text('<?php _e('Processing...', 'creative-furniture'); ?>');
        
        $.ajax({
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    alert(response.data.message || '<?php _e('Success!', 'creative-furniture'); ?>');
                    if (response.data.redirect) {
                        window.location.href = response.data.redirect;
                    }
                } else {
                    alert(response.data || '<?php _e('Error processing request', 'creative-furniture'); ?>');
                }
            },
            error: function() {
                alert('<?php _e('System error. Please try again.', 'creative-furniture'); ?>');
            },
            complete: function() {
                submitBtn.prop('disabled', false).text(originalText);
            }
        });
    });
});
</script>

<style>
.product-form-wrapper { max-width: 100%; margin: 0 auto; }
.product-form-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
.form-section { background: #fff; padding: 20px; margin-bottom: 20px; border: 1px solid #eee; border-radius: 4px; }
.form-section h4 { margin-top: 0; margin-bottom: 15px; border-bottom: 1px solid #eee; padding-bottom: 10px; }
.form-group { margin-bottom: 15px; }
.form-group label { display: block; margin-bottom: 5px; font-weight: 500; }
.form-group input[type="text"], 
.form-group input[type="number"], 
.form-group textarea, 
.form-group select { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
.form-row { display: flex; gap: 20px; }
.form-row .form-group { flex: 1; }
.dimensions-inputs { display: flex; gap: 10px; }
.dimensions-inputs input { flex: 1; }
.required { color: red; }
</style>
