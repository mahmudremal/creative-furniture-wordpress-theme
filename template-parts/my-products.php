<?php
$user_id = get_current_user_id();
$products = get_seller_products($user_id);
$edit_product_id = isset($_GET['edit']) ? intval($_GET['edit']) : 0;
$edit_product = $edit_product_id ? wc_get_product($edit_product_id) : null;

if($edit_product && $edit_product->get_meta('_seller_id') != $user_id) {
    $edit_product = null;
}
?>

<div class="my-products">
    <div class="my-products__header">
        <h2><?php _e('My Products', 'textdomain'); ?></h2>
        <a href="<?php echo esc_url(wc_get_account_endpoint_url('seller-dashboard')); ?>" class="btn btn-secondary">
            <svg>arrow-left</svg>
            <?php _e('Back to Dashboard', 'textdomain'); ?>
        </a>
    </div>

    <?php if($edit_product): ?>
    <div class="product-edit-form">
        <h3><?php _e('Edit Product', 'textdomain'); ?></h3>
        <form id="editProductForm" class="product-form">
            <input type="hidden" name="product_id" value="<?php echo $edit_product->get_id(); ?>">
            
            <div class="form-group">
                <label for="product_name"><?php _e('Product Name', 'textdomain'); ?></label>
                <input type="text" id="product_name" name="product_name" value="<?php echo esc_attr($edit_product->get_name()); ?>" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="regular_price"><?php _e('Regular Price', 'textdomain'); ?></label>
                    <input type="number" id="regular_price" name="regular_price" value="<?php echo esc_attr($edit_product->get_regular_price()); ?>" step="0.01" required>
                </div>

                <div class="form-group">
                    <label for="sale_price"><?php _e('Sale Price', 'textdomain'); ?></label>
                    <input type="number" id="sale_price" name="sale_price" value="<?php echo esc_attr($edit_product->get_sale_price()); ?>" step="0.01">
                </div>
            </div>

            <div class="form-group">
                <label for="description"><?php _e('Description', 'textdomain'); ?></label>
                <textarea id="description" name="description" rows="5"><?php echo esc_textarea($edit_product->get_description()); ?></textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="stock_quantity"><?php _e('Stock Quantity', 'textdomain'); ?></label>
                    <input type="number" id="stock_quantity" name="stock_quantity" value="<?php echo esc_attr($edit_product->get_stock_quantity()); ?>" min="0">
                </div>

                <div class="form-group">
                    <label for="stock_status"><?php _e('Stock Status', 'textdomain'); ?></label>
                    <select id="stock_status" name="stock_status">
                        <option value="instock" <?php selected($edit_product->get_stock_status(), 'instock'); ?>><?php _e('In Stock', 'textdomain'); ?></option>
                        <option value="outofstock" <?php selected($edit_product->get_stock_status(), 'outofstock'); ?>><?php _e('Out of Stock', 'textdomain'); ?></option>
                    </select>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <svg>save</svg>
                    <?php _e('Save Changes', 'textdomain'); ?>
                </button>
                <a href="<?php echo esc_url(wc_get_account_endpoint_url('my-products')); ?>" class="btn btn-secondary">
                    <?php _e('Cancel', 'textdomain'); ?>
                </a>
            </div>
        </form>
    </div>
    <?php endif; ?>

    <div class="products-list">
        <h3><?php _e('Product List', 'textdomain'); ?></h3>
        
        <?php if(!empty($products)): ?>
        <div class="products-table">
            <table>
                <thead>
                    <tr>
                        <th><?php _e('Image', 'textdomain'); ?></th>
                        <th><?php _e('Name', 'textdomain'); ?></th>
                        <th><?php _e('Price', 'textdomain'); ?></th>
                        <th><?php _e('Stock', 'textdomain'); ?></th>
                        <th><?php _e('Status', 'textdomain'); ?></th>
                        <th><?php _e('Actions', 'textdomain'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($products as $product_post): 
                        $product = wc_get_product($product_post->ID);
                    ?>
                    <tr data-product-id="<?php echo $product->get_id(); ?>">
                        <td>
                            <?php echo $product->get_image('thumbnail'); ?>
                        </td>
                        <td><?php echo esc_html($product->get_name()); ?></td>
                        <td><?php echo $product->get_price_html(); ?></td>
                        <td><?php echo $product->get_stock_quantity() ? $product->get_stock_quantity() : '-'; ?></td>
                        <td>
                            <span class="stock-status status-<?php echo esc_attr($product->get_stock_status()); ?>">
                                <?php echo $product->get_stock_status() === 'instock' ? __('In Stock', 'textdomain') : __('Out of Stock', 'textdomain'); ?>
                            </span>
                        </td>
                        <td class="actions">
                            <a href="<?php echo esc_url(add_query_arg('edit', $product->get_id(), wc_get_account_endpoint_url('my-products'))); ?>" class="btn-icon" title="<?php _e('Edit', 'textdomain'); ?>">
                                <svg>edit</svg>
                            </a>
                            <button type="button" class="btn-icon btn-delete" data-product-id="<?php echo $product->get_id(); ?>" title="<?php _e('Delete', 'textdomain'); ?>">
                                <svg>trash</svg>
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
        <p class="no-products"><?php _e('No products found.', 'textdomain'); ?></p>
        <?php endif; ?>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const editForm = document.getElementById('editProductForm');
    const deleteButtons = document.querySelectorAll('.btn-delete');
    
    if(editForm) {
        editForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(editForm);
            formData.append('action', 'update_seller_product');
            formData.append('nonce', '<?php echo wp_create_nonce('seller_product_nonce'); ?>');
            
            fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    window.location.href = '<?php echo esc_url(wc_get_account_endpoint_url('my-products')); ?>';
                } else {
                    alert(data.data || 'Error updating product');
                }
            });
        });
    }
    
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            if(!confirm('<?php _e('Are you sure you want to delete this product?', 'textdomain'); ?>')) {
                return;
            }
            
            const productId = this.getAttribute('data-product-id');
            const row = this.closest('tr');
            
            const formData = new FormData();
            formData.append('action', 'delete_seller_product');
            formData.append('product_id', productId);
            formData.append('nonce', '<?php echo wp_create_nonce('seller_product_nonce'); ?>');
            
            fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    row.remove();
                } else {
                    alert(data.data || 'Error deleting product');
                }
            });
        });
    });
});
</script>