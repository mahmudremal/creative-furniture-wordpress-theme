<?php
global $sellerDash;
$user_id = get_current_user_id();
?>

<div class="space-y-8">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <h2 class="text-2xl font-bold text-black"><?php esc_html_e('My Products', 'creative-furniture'); ?></h2>
        <div class="flex items-center space-x-3">
            <a href="<?php echo esc_url(wc_get_account_endpoint_url('seller-dashboard')); ?>" class="inline-flex items-center space-x-2 px-4 py-2 -rounded-xl border border-white-400 text-white-800 font-medium transition-all hover:bg-white-100">
                <svg class="w-4 h-4 text-black" viewBox="-4.5 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>arrow_left [#335]</title> <g id="Page-1" stroke="none" stroke-width="1" fill="currentColor" fill-rule="evenodd"> <g id="Dribbble-Light-Preview" transform="translate(-345.000000, -6679.000000)"> <g id="icons" transform="translate(56.000000, 160.000000)"> <path d="M299.633777,6519.29231 L299.633777,6519.29231 C299.228878,6518.90256 298.573377,6518.90256 298.169513,6519.29231 L289.606572,6527.55587 C288.797809,6528.33636 288.797809,6529.60253 289.606572,6530.38301 L298.231646,6538.70754 C298.632403,6539.09329 299.27962,6539.09828 299.685554,6538.71753 L299.685554,6538.71753 C300.100809,6538.32879 300.104951,6537.68821 299.696945,6537.29347 L291.802968,6529.67648 C291.398069,6529.28574 291.398069,6528.65315 291.802968,6528.26241 L299.633777,6520.70538 C300.038676,6520.31563 300.038676,6519.68305 299.633777,6519.29231" id="arrow_left-[#335]"> </path> </g> </g> </g> </g></svg>
                <span><?php esc_html_e('Dashboard', 'creative-furniture'); ?></span>
            </a>
            <a href="<?php echo esc_url(wc_get_account_endpoint_url('my-products') . '0/edit'); ?>" class="inline-flex items-center bg-black text-white px-6 py-2.5 -rounded-xl font-semibold transition-all hover:opacity-90">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                <?php esc_html_e('Add Product', 'creative-furniture'); ?>
            </a>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-white-400 overflow-hidden">
        <?php $products = $sellerDash->get_seller_products($user_id, max(1, isset($_GET['paged']) ? $_GET['paged'] : 1)); ?>
        <?php if(!empty($products)): ?>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-white-200 text-black text-xs uppercase tracking-wider">
                            <th class="px-6 py-4 font-bold"><?php esc_html_e('Image', 'creative-furniture'); ?></th>
                            <th class="px-6 py-4 font-bold"><?php esc_html_e('Name', 'creative-furniture'); ?></th>
                            <th class="px-6 py-4 font-bold"><?php esc_html_e('Price', 'creative-furniture'); ?></th>
                            <th class="px-6 py-4 font-bold text-center"><?php esc_html_e('Stock', 'creative-furniture'); ?></th>
                            <th class="px-6 py-4 font-bold"><?php esc_html_e('Status', 'creative-furniture'); ?></th>
                            <th class="px-6 py-4 font-bold text-right"><?php esc_html_e('Actions', 'creative-furniture'); ?></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white-400">
                        <?php foreach($products as $product_post): 
                            $product = wc_get_product($product_post->ID);
                        ?>
                        <tr class="hover:bg-white-100 transition-colors" data-product-id="<?php echo $product->get_id(); ?>">
                            <td class="px-6 py-4">
                                <div class="w-14 h-14 -rounded-lg overflow-hidden border border-white-400">
                                    <?php echo $product->get_image('thumbnail', ['class' => 'w-full h-full object-cover']); ?>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-black font-semibold"><?php echo esc_html($product->get_name()); ?></div>
                            </td>
                            <td class="px-6 py-4 text-black font-medium">
                                <?php echo $product->get_price_html(); ?>
                            </td>
                            <td class="px-6 py-4 text-center text-black">
                                <?php echo $product->get_stock_quantity() ? $product->get_stock_quantity() : '-'; ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php 
                                $status = $product->get_status();
                                $stock_status = $product->get_stock_status();
                                
                                if($status == 'draft') {
                                    echo '<span class="px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-700">' . __('Draft', 'creative-furniture') . '</span>';
                                } elseif($status == 'pending') {
                                    echo '<span class="px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-700">' . __('Pending', 'creative-furniture') . '</span>';
                                } else {
                                    if($stock_status === 'instock') {
                                        echo '<span class="px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">' . __('In Stock', 'creative-furniture') . '</span>';
                                    } else {
                                        echo '<span class="px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700">' . __('Out of Stock', 'creative-furniture') . '</span>';
                                    }
                                }
                                ?>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end space-x-2">
                                    <a href="<?php echo esc_url(wc_get_account_endpoint_url('my-products') . $product->get_id() . '/edit'); ?>" class="p-2 -rounded-lg border border-white-400 text-white-800 transition-all hover:bg-white-200 hover:text-black" title="<?php _e('Edit', 'creative-furniture'); ?>">
                                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M20.1497 7.93997L8.27971 19.81C7.21971 20.88 4.04971 21.3699 3.27971 20.6599C2.50971 19.9499 3.06969 16.78 4.12969 15.71L15.9997 3.84C16.5478 3.31801 17.2783 3.03097 18.0351 3.04019C18.7919 3.04942 19.5151 3.35418 20.0503 3.88938C20.5855 4.42457 20.8903 5.14781 20.8995 5.90463C20.9088 6.66146 20.6217 7.39189 20.0997 7.93997H20.1497Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M21 21H12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                    </a>
                                    <button type="button" class="btn-delete p-2 -rounded-lg border border-white-400 text-red-500 transition-all hover:bg-red-50 hover:border-red-200" data-product-id="<?php echo $product->get_id(); ?>" title="<?php _e('Delete', 'creative-furniture'); ?>">
                                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M18 6V16.2C18 17.8802 18 18.7202 17.673 19.362C17.3854 19.9265 16.9265 20.3854 16.362 20.673C15.7202 21 14.8802 21 13.2 21H10.8C9.11984 21 8.27976 21 7.63803 20.673C7.07354 20.3854 6.6146 19.9265 6.32698 19.362C6 18.7202 6 17.8802 6 16.2V6M4 6H20M16 6L15.7294 5.18807C15.4671 4.40125 15.3359 4.00784 15.0927 3.71698C14.8779 3.46013 14.6021 3.26132 14.2905 3.13878C13.9376 3 13.523 3 12.6936 3H11.3064C10.477 3 10.0624 3 9.70951 3.13878C9.39792 3.26132 9.12208 3.46013 8.90729 3.71698C8.66405 4.00784 8.53292 4.40125 8.27064 5.18807L8 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="p-12 text-center">
                <div class="w-16 h-16 mx-auto bg-white-200 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-white-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </div>
                <p class="text-white-800 text-lg"><?php _e('No products found.', 'creative-furniture'); ?></p>
                <a href="<?php echo esc_url(wc_get_account_endpoint_url('my-products') . '0/edit'); ?>" class="mt-4 inline-block text-black font-semibold hover:underline">
                    <?php _e('Add your first product', 'creative-furniture'); ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.btn-delete');
    
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
                    row.classList.add('opacity-0', 'transition-opacity', 'duration-300');
                    setTimeout(() => row.remove(), 300);
                } else {
                    alert(data.data || 'Error deleting product');
                }
            });
        });
    });
});
</script>