<?php
$user_id = get_current_user_id();
$edit_product_id = isset($_GET['edit']) ? intval($_GET['edit']) : 0;

?>

<div class="my-products">
    <div class="my-products__header">
        <h2><?php _e('My Products', 'creative-furniture'); ?></h2>
        <a href="<?php echo esc_url(wc_get_account_endpoint_url('seller-dashboard')); ?>" class="btn btn-secondary">
            <svg viewBox="-4.5 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#9D8465"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>arrow_left [#335]</title> <desc>Created with Sketch.</desc> <defs> </defs> <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="Dribbble-Light-Preview" transform="translate(-345.000000, -6679.000000)" fill="#9D8465"> <g id="icons" transform="translate(56.000000, 160.000000)"> <path d="M299.633777,6519.29231 L299.633777,6519.29231 C299.228878,6518.90256 298.573377,6518.90256 298.169513,6519.29231 L289.606572,6527.55587 C288.797809,6528.33636 288.797809,6529.60253 289.606572,6530.38301 L298.231646,6538.70754 C298.632403,6539.09329 299.27962,6539.09828 299.685554,6538.71753 L299.685554,6538.71753 C300.100809,6538.32879 300.104951,6537.68821 299.696945,6537.29347 L291.802968,6529.67648 C291.398069,6529.28574 291.398069,6528.65315 291.802968,6528.26241 L299.633777,6520.70538 C300.038676,6520.31563 300.038676,6519.68305 299.633777,6519.29231" id="arrow_left-[#335]"> </path> </g> </g> </g> </g></svg>
            <?php _e('Back to Dashboard', 'creative-furniture'); ?>
        </a>
    </div>

    <?php if(!empty($edit_product_id)): ?>
        <?php
        $edit_product = $edit_product_id ? wc_get_product((int) $edit_product_id) : null;
        // if($edit_product && $edit_product->get_meta('_seller_id') != $user_id) {
        //     $edit_product = null;
        // }
        ?>
        <?php if(!$edit_product): ?>
            <div>
                <?php _e("You don't have sufficient permission to modify this product you are requesting. Please contact support.", 'creative-furniture'); ?>
            </div>
        <?php else: ?>
        <div class="product-edit-form">
            <h3><?php _e('Edit Product', 'creative-furniture'); ?></h3>
            <form id="editProductForm" class="product-form">
                <input type="hidden" name="product_id" value="<?php echo $edit_product->get_id(); ?>">
                
                <div class="form-group">
                    <label for="product_name"><?php _e('Product Name', 'creative-furniture'); ?></label>
                    <input type="text" id="product_name" name="product_name" value="<?php echo esc_attr($edit_product->get_name()); ?>" required>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="regular_price"><?php _e('Regular Price', 'creative-furniture'); ?></label>
                        <input type="number" id="regular_price" name="regular_price" value="<?php echo esc_attr($edit_product->get_regular_price()); ?>" step="0.01" required>
                    </div>

                    <div class="form-group">
                        <label for="sale_price"><?php _e('Sale Price', 'creative-furniture'); ?></label>
                        <input type="number" id="sale_price" name="sale_price" value="<?php echo esc_attr($edit_product->get_sale_price()); ?>" step="0.01">
                    </div>
                </div>

                <div class="form-group">
                    <label for="description"><?php _e('Description', 'creative-furniture'); ?></label>
                    <textarea id="description" name="description" rows="5"><?php echo esc_textarea($edit_product->get_description()); ?></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="stock_quantity"><?php _e('Stock Quantity', 'creative-furniture'); ?></label>
                        <input type="number" id="stock_quantity" name="stock_quantity" value="<?php echo esc_attr($edit_product->get_stock_quantity()); ?>" min="0">
                    </div>

                    <div class="form-group">
                        <label for="stock_status"><?php _e('Stock Status', 'creative-furniture'); ?></label>
                        <select id="stock_status" name="stock_status">
                            <option value="instock" <?php selected($edit_product->get_stock_status(), 'instock'); ?>><?php _e('In Stock', 'creative-furniture'); ?></option>
                            <option value="outofstock" <?php selected($edit_product->get_stock_status(), 'outofstock'); ?>><?php _e('Out of Stock', 'creative-furniture'); ?></option>
                        </select>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M7 3V6.4C7 6.96005 7 7.24008 7.10899 7.45399C7.20487 7.64215 7.35785 7.79513 7.54601 7.89101C7.75992 8 8.03995 8 8.6 8H15.4C15.9601 8 16.2401 8 16.454 7.89101C16.6422 7.79513 16.7951 7.64215 16.891 7.45399C17 7.24008 17 6.96005 17 6.4V4M17 21V14.6C17 14.0399 17 13.7599 16.891 13.546C16.7951 13.3578 16.6422 13.2049 16.454 13.109C16.2401 13 15.9601 13 15.4 13H8.6C8.03995 13 7.75992 13 7.54601 13.109C7.35785 13.2049 7.20487 13.3578 7.10899 13.546C7 13.7599 7 14.0399 7 14.6V21M21 9.32548V16.2C21 17.8802 21 18.7202 20.673 19.362C20.3854 19.9265 19.9265 20.3854 19.362 20.673C18.7202 21 17.8802 21 16.2 21H7.8C6.11984 21 5.27976 21 4.63803 20.673C4.07354 20.3854 3.6146 19.9265 3.32698 19.362C3 18.7202 3 17.8802 3 16.2V7.8C3 6.11984 3 5.27976 3.32698 4.63803C3.6146 4.07354 4.07354 3.6146 4.63803 3.32698C5.27976 3 6.11984 3 7.8 3H14.6745C15.1637 3 15.4083 3 15.6385 3.05526C15.8425 3.10425 16.0376 3.18506 16.2166 3.29472C16.4184 3.4184 16.5914 3.59135 16.9373 3.93726L20.0627 7.06274C20.4086 7.40865 20.5816 7.5816 20.7053 7.78343C20.8149 7.96237 20.8957 8.15746 20.9447 8.36154C21 8.59171 21 8.8363 21 9.32548Z" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                        <?php _e('Save Changes', 'creative-furniture'); ?>
                    </button>
                    <a href="<?php echo esc_url(wc_get_account_endpoint_url('my-products')); ?>" class="btn btn-secondary">
                        <?php _e('Cancel', 'creative-furniture'); ?>
                    </a>
                </div>
            </form>
        </div>
        <?php endif; ?>
    <?php else: ?>
        <div class="products-list">
            <!-- <h3><?php _e('Product List', 'creative-furniture'); ?></h3> -->
            
            <?php $products = get_seller_products($user_id, max(1, isset($_GET['paged']) ? $_GET['paged'] : 1)); ?>
            <?php if(!empty($products)): ?>
                <div class="products-table">
                    <table>
                        <thead>
                            <tr>
                                <th><?php _e('Image', 'creative-furniture'); ?></th>
                                <th><?php _e('Name', 'creative-furniture'); ?></th>
                                <th><?php _e('Price', 'creative-furniture'); ?></th>
                                <th><?php _e('Stock', 'creative-furniture'); ?></th>
                                <th><?php _e('Status', 'creative-furniture'); ?></th>
                                <th><?php _e('Actions', 'creative-furniture'); ?></th>
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
                                        <?php echo $product->get_stock_status() === 'instock' ? __('In Stock', 'creative-furniture') : __('Out of Stock', 'creative-furniture'); ?>
                                    </span>
                                </td>
                                <td class="actions">
                                    <a href="<?php echo esc_url(add_query_arg('edit', $product->get_id(), wc_get_account_endpoint_url('my-products'))); ?>" class="btn-icon" title="<?php _e('Edit', 'creative-furniture'); ?>">
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M20.1497 7.93997L8.27971 19.81C7.21971 20.88 4.04971 21.3699 3.27971 20.6599C2.50971 19.9499 3.06969 16.78 4.12969 15.71L15.9997 3.84C16.5478 3.31801 17.2783 3.03097 18.0351 3.04019C18.7919 3.04942 19.5151 3.35418 20.0503 3.88938C20.5855 4.42457 20.8903 5.14781 20.8995 5.90463C20.9088 6.66146 20.6217 7.39189 20.0997 7.93997H20.1497Z" stroke="#9D8465" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M21 21H12" stroke="#9D8465" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                    </a>
                                    <button type="button" class="btn-icon btn-delete" data-product-id="<?php echo $product->get_id(); ?>" title="<?php _e('Delete', 'creative-furniture'); ?>">
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M18 6V16.2C18 17.8802 18 18.7202 17.673 19.362C17.3854 19.9265 16.9265 20.3854 16.362 20.673C15.7202 21 14.8802 21 13.2 21H10.8C9.11984 21 8.27976 21 7.63803 20.673C7.07354 20.3854 6.6146 19.9265 6.32698 19.362C6 18.7202 6 17.8802 6 16.2V6M4 6H20M16 6L15.7294 5.18807C15.4671 4.40125 15.3359 4.00784 15.0927 3.71698C14.8779 3.46013 14.6021 3.26132 14.2905 3.13878C13.9376 3 13.523 3 12.6936 3H11.3064C10.477 3 10.0624 3 9.70951 3.13878C9.39792 3.26132 9.12208 3.46013 8.90729 3.71698C8.66405 4.00784 8.53292 4.40125 8.27064 5.18807L8 6" stroke="#9D8465" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p class="no-products"><?php _e('No products found.', 'creative-furniture'); ?></p>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const editForm = document.getElementById('editProductForm');
    const deleteButtons = document.querySelectorAll('.actions .btn-delete');
    
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
            if(!confirm('<?php _e('Are you sure you want to delete this product?', 'creative-furniture'); ?>')) {
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