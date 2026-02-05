<?php
/**
 * Plugin Name: EximEnd Destination Site
 * Description: Imports WooCommerce products, posts, media, users, and reviews from a target site.
 * Version: 1.3
 * Author: Remal Mahmud
 */

if (!defined('ABSPATH')) {
    exit;
}

class EximEnd_Destination_Site_V2 {
    private $source_id_meta_key = 'src_site_obj_id';

    public function __construct() {
        add_action('admin_menu', [$this, 'add_admin_menu']);
        add_action('wp_ajax_exim_import_items', [$this, 'ajax_import_items']);
    }

    public function add_admin_menu() {
        add_menu_page('EximEnd Importer', 'EximEnd Importer', 'manage_options', 'eximend-importer', [$this, 'render_admin_page'], 'dashicons-download', 25);
    }

    public function render_admin_page() {
        ?>
        <div class="wrap">
            <h1>EximEnd Data Importer</h1>
            <p>Enter the source site URL, fetch stats, then begin the import. The process runs in order: Users, Media, Posts, Products, then Reviews.</p>
            
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="source_site_url">Source Site URL</label></th>
                    <td>
                        <input type="text" id="source_site_url" class="regular-text" placeholder="https://your-source-site.com" value="https://creativefurniture.ae/" />
                        <button id="fetch_stats_btn" class="button button-secondary">Fetch Site Statistics</button>
                    </td>
                </tr>
            </table>

            <div id="stats_container" style="display:none; margin-top: 20px;">
                <h2>Site Statistics</h2>
                <div id="stats_output"></div>
                <div style="margin-top:20px;">
                    <button id="start_import_all" class="button button-primary">Start Full Import (All Types)</button>
                </div>
            </div>

            <div id="import_log_container" style="margin-top:20px;">
                <h2>Import Log</h2>
                <div id="import_log" style="height: 400px; overflow-y: scroll; background: #f1f1f1; padding: 10px; border: 1px solid #ccc;"></div>
            </div>
        </div>

        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function() {
                const fetchBtn = document.getElementById('fetch_stats_btn');
                const sourceUrlInput = document.getElementById('source_site_url');
                const statsContainer = document.getElementById('stats_container');
                const statsOutput = document.getElementById('stats_output');
                const importLog = document.getElementById('import_log');
                const startImportAllBtn = document.getElementById('start_import_all');

                let sourceApiBase = '';
                let perPage;

                const logMessage = (message, type = 'info') => {
                    const p = document.createElement('p');
                    p.innerHTML = `[${new Date().toLocaleTimeString()}] ${message}`;
                    p.style.color = type === 'error' ? 'red' : (type === 'success' ? 'green' : 'black');
                    importLog.appendChild(p);
                    importLog.scrollTop = importLog.scrollHeight;
                };

                const setButtonsState = (disabled) => {
                    document.querySelectorAll('.import-btn, #start_import_all').forEach(btn => btn.disabled = disabled);
                };

                fetchBtn.addEventListener('click', async () => {
                    const url = sourceUrlInput.value.trim();
                    if (!url) {
                        alert('Please enter a source site URL.');
                        return;
                    }
                    sourceApiBase = `${url.replace(/\/$/, '')}/wp-json/eximend/v1`;
                    logMessage(`Fetching stats from ${sourceApiBase}/stats`);

                    try {
                        const response = await fetch(`${sourceApiBase}/stats`);
                        if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
                        const stats = await response.json();
                        
                        statsOutput.innerHTML = [
                            { type: 'users', label: 'Users (non-admin)' },
                            { type: 'media', label: 'Media' },
                            { type: 'posts', label: 'Posts' },
                            { type: 'products', label: 'Products' },
                            { type: 'reviews', label: 'Product Reviews' }
                        ].map(s => {
                            const count = (stats[s.type] && stats[s.type].publish || stats[s.type].inherit || 0) || 0;
                            return `<div class="stat-box"><strong>${s.label}:</strong> ${count} items <button class="button import-btn" data-type="${s.type}">Import ${s.label}</button></div>`;
                        }).join('');
                        
                        statsContainer.style.display = 'block';
                        logMessage('Stats loaded successfully.', 'success');
                        
                        document.querySelectorAll('.import-btn').forEach(btn => {
                            btn.addEventListener('click', () => {
                                const dataType = btn.getAttribute('data-type');
                                logMessage(`Starting individual import for ${dataType}...`);
                                setButtonsState(true);
                                startImport(dataType, parseInt(prompt('Enter page number:', 1)) || 1).finally(() => setButtonsState(false));
                            });
                        });

                    } catch (error) {
                        logMessage(`Failed to fetch stats: ${error.message}: ${error.status || ''}`, 'error');
                    }
                });
                
                startImportAllBtn.addEventListener('click', () => {
                    logMessage('Starting full import. This may take a long time.');
                    setButtonsState(true);
                    
                    (async () => {
                        const importOrder = ['users', 'media', 'posts', 'products', 'reviews'];
                        for (const type of importOrder) {
                            logMessage(`----- Starting Full Import for ${type.toUpperCase()} -----`);
                            await startImport(type, 1);
                            logMessage(`----- Finished Full Import for ${type.toUpperCase()} -----`);
                        }
                        logMessage('Full import process complete.', 'success');
                        setButtonsState(false);
                    })();
                });

                const startImport = async (dataType, page) => {
                    if (!perPage) perPage = parseInt(prompt("Perpage request", 20) || 20);
                    logMessage(`Fetching ${dataType} page ${page}...`);
                    try {
                        const sourceUrl = `${sourceApiBase}/${dataType}?page=${page}&per_page=${perPage}`;
                        const response = await fetch(sourceUrl);
                        if (!response.ok) throw new Error(`Fetch failed: ${response.statusText}`);
                        const items = await response.json();

                        if (items.length === 0) {
                            logMessage(`Import for ${dataType} completed. No more items to fetch.`, 'success');
                            return;
                        }

                        logMessage(`Found ${items.length} items for ${dataType} on page ${page}. Sending to backend...`);
                        
                        const formData = new FormData();
                        formData.append('action', 'exim_import_items');
                        formData.append('_ajax_nonce', '<?php echo wp_create_nonce('exim_importer_nonce'); ?>');
                        formData.append('dataType', dataType);
                        formData.append('items', JSON.stringify(items));

                        const backendResponse = await fetch('<?php echo admin_url('admin-ajax.php'); ?>', { method: 'POST', body: formData });
                        const result = await backendResponse.json();

                        if (result.success) {
                            logMessage(result.data, 'success');
                            await startImport(dataType, page + 1);
                        } else {
                            throw new Error(result.data || 'Unknown backend error.');
                        }
                    } catch (error) {
                        logMessage(`An error occurred during ${dataType} import on page ${page}: ${error.message}`, 'error');
                    }
                };
            });
        </script>
        <style>.stat-box { border: 1px solid #ddd; padding: 15px; margin-bottom: 10px; display:flex; justify-content: space-between; align-items: center; } #import_log p { margin: 0; padding: 5px; border-bottom: 1px solid #eee; }</style>
        <?php
    }

    public function ajax_import_items() {
        @set_time_limit(0);
        @ini_set('memory_limit', '1024M');
        ob_start();
        
        // Disable deferred counting and sync to prevent DB "Commands out of sync"
        wp_defer_term_counting(true);
        wp_defer_comment_counting(true);
        if (class_exists('WC_Post_Data')) {
            remove_action('shutdown', array('WC_Post_Data', 'do_deferred_product_sync'), 10);
        }

        check_ajax_referer('exim_importer_nonce');
        if (!current_user_can('manage_options')) wp_send_json_error('Permission denied.');

        $data_type = sanitize_text_field($_POST['dataType']);
        $items = json_decode(stripslashes($_POST['items']), true);

        if (empty($items)) wp_send_json_error('No items received.');

        require_once(ABSPATH . 'wp-admin/includes/file.php');
        require_once(ABSPATH . 'wp-admin/includes/media.php');
        require_once(ABSPATH . 'wp-admin/includes/image.php');

        $processed = 0;
        $skipped = 0;
        
        foreach ($items as $item) {
            $source_id = $item['id'];
            
            $existing_id = $this->get_dest_id($source_id, $data_type);

            if ($existing_id) {
                $skipped++;
                continue;
            }

            switch ($data_type) {
                case 'users': $this->import_user_item($item); break;
                case 'media': $this->import_media_item($item); break;
                case 'posts': $this->import_post_item($item, 'post'); break;
                case 'products': if(class_exists('WooCommerce')) $this->import_product_item($item); break;
                case 'reviews': $this->import_review_item($item); break;
            }
            $processed++;
        }
        
        // Re-enable counting
        wp_defer_term_counting(false);
        wp_defer_comment_counting(false);

        @ob_end_clean();
        wp_send_json_success("Processed {$processed} items, skipped {$skipped} duplicates.");
    }

    private function get_dest_id($source_id, $type) {
        if ($type === 'users') {
            $users = get_users(['meta_key' => $this->source_id_meta_key, 'meta_value' => $source_id, 'fields' => 'ID']);
            return $users[0] ?? null;
        } elseif ($type === 'reviews') {
            global $wpdb;
            $comment_id = $wpdb->get_var($wpdb->prepare("SELECT comment_id FROM {$wpdb->commentmeta} WHERE meta_key = %s AND meta_value = %s", $this->source_id_meta_key, $source_id));
            return $comment_id;
        } else { // posts, products, media
            $query = new WP_Query(['meta_key' => $this->source_id_meta_key, 'meta_value' => $source_id, 'post_type' => 'any', 'post_status' => 'any', 'posts_per_page' => 1]);
            return $query->have_posts() ? $query->posts[0]->ID : null;
        }
    }

    private function import_user_item($item) {
        if (email_exists($item['user_email']) || username_exists($item['user_login'])) return;
        
        $new_user_id = wp_insert_user([
            'user_login' => sanitize_text_field($item['user_login']),
            'user_email' => sanitize_email($item['user_email']),
            'display_name' => sanitize_text_field($item['display_name']),
            'user_pass' => wp_generate_password(),
            'user_registered' => $item['user_registered'],
            'roles' => in_array('administrator', $item['roles']) ? ['subscriber'] : $item['roles'],
        ]);

        if (is_wp_error($new_user_id)) return;
        
        update_user_meta($new_user_id, $this->source_id_meta_key, $item['id']);
        if (!empty($item['meta'])) {
            foreach ($item['meta'] as $key => $values) {
                if (str_starts_with($key, '_')) continue;
                foreach ($values as $value) {
                    add_user_meta($new_user_id, $key, maybe_unserialize($value));
                }
            }
        }
    }

    private function import_media_item($item) {
        add_filter('intermediate_image_sizes', '__return_empty_array');
        add_filter('intermediate_image_sizes_advanced', '__return_empty_array');

        $temp_file = download_url($item['url']);

        if (is_wp_error($temp_file)) {
            remove_filter('intermediate_image_sizes', '__return_empty_array');
            remove_filter('intermediate_image_sizes_advanced', '__return_empty_array');
            return;
        }

        $file_array = ['name' => basename($item['url']), 'tmp_name' => $temp_file];
        $new_id = media_handle_sideload($file_array, 0, $item['title']);

        remove_filter('intermediate_image_sizes', '__return_empty_array');
        remove_filter('intermediate_image_sizes_advanced', '__return_empty_array');

        if (is_wp_error($new_id)) {
            @unlink($temp_file);
            return;
        }
        
        wp_update_post([
            'ID' => $new_id,
            'post_date' => $item['date'],
            'post_date_gmt' => $item['date'],
        ]);

        update_post_meta($new_id, $this->source_id_meta_key, $item['id']);
        update_post_meta($new_id, '_wp_attachment_image_alt', sanitize_text_field($item['alt_text']));
        wp_update_post(['ID' => $new_id, 'post_excerpt' => $item['caption'], 'post_content' => $item['description']]);

        @unlink($temp_file);
    }
    
    private function process_meta_and_taxonomies($new_id, $item) {
        if (!empty($item['meta'])) {
            foreach ($item['meta'] as $key => $values) {
                if (in_array($key, ['_edit_lock', '_edit_last', $this->source_id_meta_key])) continue;
                foreach ($values as $value) {
                    add_post_meta($new_id, $key, maybe_unserialize($value));
                }
            }
        }

        if (!empty($item['taxonomies'])) {
            foreach ($item['taxonomies'] as $tax_slug => $terms) {
                $term_ids = [];
                foreach ($terms as $term) {
                    $existing_term = get_term_by('slug', $term['slug'], $tax_slug);
                    if ($existing_term) {
                        $term_ids[] = $existing_term->term_id;
                    } else {
                        $new_term = wp_insert_term($term['name'], $tax_slug, ['slug' => $term['slug'], 'description' => $term['description'], 'parent' => $term['parent']]);
                        if (!is_wp_error($new_term)) $term_ids[] = $new_term['term_id'];
                    }
                }
                if (!empty($term_ids)) wp_set_object_terms($new_id, $term_ids, $tax_slug);
            }
        }
    }

    private function get_mapped_author_id($source_author_id) {
        return $source_author_id ? ($this->get_dest_id($source_author_id, 'users') ?: get_current_user_id()) : get_current_user_id();
    }

    private function get_mapped_image_id($source_image_url, $source_image_id = 0) {
        if ($source_image_id) {
            $mapped_id = $this->get_dest_id($source_image_id, 'media');
            if ($mapped_id) return $mapped_id;
        }

        if (empty($source_image_url)) return 0;

        global $wpdb;
        $filename = basename(parse_url($source_image_url, PHP_URL_PATH));
        $attachment_id = $wpdb->get_var($wpdb->prepare("SELECT post_id FROM $wpdb->postmeta WHERE meta_key = '_wp_attached_file' AND meta_value LIKE %s", '%'.$filename));
        return $attachment_id ?: 0;
    }

    private function set_featured_image($new_post_id, $source_image_url, $source_image_id = 0) {
        $new_attachment_id = $this->get_mapped_image_id($source_image_url, $source_image_id);
        if ($new_attachment_id) set_post_thumbnail($new_post_id, $new_attachment_id);
    }

    private function import_post_item($item, $post_type) {
        $author_id = $this->get_mapped_author_id($item['author_id']);

        $post_data = [
            'post_title' => $item['title'], 'post_content' => $item['content'], 'post_excerpt' => $item['excerpt'],
            'post_status' => $item['status'], 'post_type' => $post_type, 'post_name' => $item['slug'],
            'post_author' => $author_id, 'post_date' => $item['date'], 'post_date_gmt' => $item['date_gmt'],
            'post_modified' => $item['modified'], 'post_modified_gmt' => $item['modified_gmt'],
            'comment_status' => $item['comment_status'],
        ];
        
        $new_id = wp_insert_post($post_data);
        if (is_wp_error($new_id)) return;

        update_post_meta($new_id, $this->source_id_meta_key, $item['id']);
        $this->process_meta_and_taxonomies($new_id, $item);
        
        $this->set_featured_image($new_id, $item['featured_image_url'], $item['featured_image_id'] ?? 0);
    }

    private function import_product_item($item) {
        $author_id = $this->get_mapped_author_id($item['author_id']);

        $product_data = [
            'post_title' => $item['title'], 'post_content' => $item['content'], 'post_excerpt' => $item['excerpt'],
            'post_status' => $item['status'], 'post_type' => 'product', 'post_name' => $item['slug'],
            'post_author' => $author_id, 'post_date' => $item['date'], 'post_date_gmt' => $item['date_gmt'],
            'post_modified' => $item['modified'], 'post_modified_gmt' => $item['modified_gmt'],
            'comment_status' => $item['comment_status'],
        ];
        
        $new_product_id = wp_insert_post($product_data);
        if (is_wp_error($new_product_id)) return;

        $product = wc_get_product($new_product_id);
        if(!$product) return;

        try {
            $product->set_sku($item['sku']);
        } catch (Exception $e) {
            try {
                $product->set_sku($item['sku'] . '-' . $item['id']);
            } catch (Exception $e) {
                // SKU failed, proceed without it
            }
        }
        $product->set_price($item['price']);
        $product->set_regular_price($item['regular_price']);
        $product->set_sale_price($item['sale_price']);
        
        if ($item['stock_quantity'] !== null) {
            $product->set_manage_stock(true);
            $product->set_stock_quantity($item['stock_quantity']);
        }
        $product->set_stock_status($item['stock_status']);
        $product->set_weight($item['weight']);
        if (is_array($item['dimensions'])) {
            $product->set_length($item['dimensions']['length']);
            $product->set_width($item['dimensions']['width']);
            $product->set_height($item['dimensions']['height']);
        }
        
        $product->save();

        if (!empty($item['variations']) && $item['type'] === 'variable') {
            $this->import_variations($new_product_id, $item['variations']);
        }

        update_post_meta($new_product_id, $this->source_id_meta_key, $item['id']);
        $this->process_meta_and_taxonomies($new_product_id, $item);
        
        $this->set_featured_image($new_product_id, $item['featured_image_url'], $item['featured_image_id'] ?? 0);
        
        if (!empty($item['gallery_image_urls'])) {
            $gallery_ids = [];
            foreach ($item['gallery_image_urls'] as $index => $gallery_image_url) {
                $gallery_image_id = $item['gallery_image_ids'][$index] ?? 0;
                $new_gallery_id = $this->get_mapped_image_id($gallery_image_url, $gallery_image_id);
                if ($new_gallery_id) $gallery_ids[] = $new_gallery_id;
            }
            if (!empty($gallery_ids)) update_post_meta($new_product_id, '_product_image_gallery', implode(',', $gallery_ids));
        }
    }

    private function import_variations($parent_id, $variations) {
        foreach ($variations as $var_item) {
            $existing_id = $this->get_dest_id($var_item['id'], 'product_variation');
            
            $post_data = [
                'post_title' => 'Variation #' . $var_item['id'] . ' of ' . $parent_id,
                'post_status' => 'publish',
                'post_parent' => $parent_id,
                'post_type' => 'product_variation',
                'post_date' => current_time('mysql'),
            ];

            if ($existing_id) {
                $post_data['ID'] = $existing_id;
                wp_update_post($post_data);
                $variation_id = $existing_id;
            } else {
                $variation_id = wp_insert_post($post_data);
            }
            
            if (is_wp_error($variation_id)) continue;

            $variation = new WC_Product_Variation($variation_id);
            try {
                $variation->set_sku($var_item['sku']);
            } catch (Exception $e) {
                try {
                    $variation->set_sku($var_item['sku'] . '-' . $var_item['id']);
                } catch (Exception $e) {
                    // SKU failed, proceed without it
                }
            }
            $variation->set_price($var_item['price']);
            $variation->set_regular_price($var_item['regular_price']);
            $variation->set_sale_price($var_item['sale_price']);
            
            if ($var_item['stock_quantity'] !== null) {
                $variation->set_manage_stock(true);
                $variation->set_stock_quantity($var_item['stock_quantity']);
            }
            $variation->set_stock_status($var_item['stock_status']);
            $variation->set_weight($var_item['weight']);
            if (is_array($var_item['dimensions'])) {
                $variation->set_length($var_item['dimensions']['length']);
                $variation->set_width($var_item['dimensions']['width']);
                $variation->set_height($var_item['dimensions']['height']);
            }
            $variation->set_description($var_item['description']);
            $variation->set_attributes($var_item['attributes']);
            
            $variation->save();

            update_post_meta($variation_id, $this->source_id_meta_key, $var_item['id']);
            $this->set_featured_image($variation_id, $var_item['image_url'], $var_item['image_id'] ?? 0);
             
            if (!empty($var_item['meta'])) {
                foreach ($var_item['meta'] as $key => $values) {
                    if (str_starts_with($key, '_sku') || str_starts_with($key, '_price') || in_array($key, ['_regular_price', '_sale_price', '_stock', '_stock_status', $this->source_id_meta_key])) continue;
                    foreach ($values as $value) {
                         update_post_meta($variation_id, $key, maybe_unserialize($value));
                    }
                }
            }
        }
    }

    private function import_review_item($item) {
        $dest_post_id = $this->get_dest_id($item['post_id'], 'products');
        if (!$dest_post_id) return;
        
        $dest_user_id = $item['user_id'] ? ($this->get_dest_id($item['user_id'], 'users') ?: 0) : 0;
        
        $comment_data = [
            'comment_post_ID' => $dest_post_id, 'comment_author' => $item['author'], 'comment_author_email' => $item['author_email'],
            'comment_author_url' => $item['author_url'], 'comment_author_IP' => $item['author_ip'],
            'comment_date' => $item['date'], 'comment_date_gmt' => $item['date_gmt'], 'comment_content' => $item['content'],
            'comment_parent' => 0, 'user_id' => $dest_user_id, 'comment_approved' => 1
        ];

        $new_comment_id = wp_insert_comment($comment_data);
        if ($new_comment_id && !is_wp_error($new_comment_id) && !empty($item['meta'])) {
             add_comment_meta($new_comment_id, $this->source_id_meta_key, $item['id']);
             foreach ($item['meta'] as $key => $values) {
                if (str_starts_with($key, '_')) continue;
                foreach ($values as $value) {
                    add_comment_meta($new_comment_id, $key, maybe_unserialize($value));
                }
            }
        }
    }
}

new EximEnd_Destination_Site_V2();
