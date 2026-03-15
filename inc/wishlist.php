<?php

class CF_Wishlist {
    private $table_items;
    private $table_tokens;

    public function __construct() {
        global $wpdb;
        $this->table_items = $wpdb->prefix . 'cf_wishlist_items';
        $this->table_tokens = $wpdb->prefix . 'cf_wishlist_share_tokens';
        $this->init_hooks();
    }

    private function init_hooks() {
        add_action('wp_ajax_cf_wishlist_toggle', [$this, 'ajax_toggle']);
        add_action('wp_ajax_nopriv_cf_wishlist_toggle', [$this, 'ajax_toggle']);
        add_action('wp_login', [$this, 'merge_on_login'], 10, 2);
        add_shortcode('cf_wishlist', [$this, 'render_shortcode']);
        add_action('wp_ajax_cf_wishlist_share', [$this, 'ajax_share']);
        add_action('wp_ajax_nopriv_cf_wishlist_share', [$this, 'ajax_share']);
    }

    public function activate() {
        global $wpdb;
        $charset = $wpdb->get_charset_collate();

        $sql1 = "CREATE TABLE IF NOT EXISTS {$this->table_items} (
            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
            user_id BIGINT UNSIGNED NULL,
            session_key VARCHAR(255) NULL,
            product_id BIGINT UNSIGNED NOT NULL,
            created_at DATETIME NOT NULL,
            PRIMARY KEY(id)
        ) $charset;";

        $sql2 = "CREATE TABLE IF NOT EXISTS {$this->table_tokens} (
            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
            token VARCHAR(255) NOT NULL,
            product_ids LONGTEXT NOT NULL,
            created_at DATETIME NOT NULL,
            PRIMARY KEY(id),
            UNIQUE KEY token(token)
        ) $charset;";

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta($sql1);
        dbDelta($sql2);
    }

    public function get_session() {
        if (function_exists('WC') && WC()->session) {
            if (!WC()->session->has_session()) {
                WC()->session->set_customer_session_cookie(true);
            }
            $session_key = WC()->session->get('cf_wishlist_session');
            if (empty($session_key)) {
                $session_key = wp_generate_uuid4();
                WC()->session->set('cf_wishlist_session', $session_key);
            }
            return $session_key;
        }

        $cookie_name = 'cf_wishlist_session';
        if (!empty($_COOKIE[$cookie_name])) {
            return $_COOKIE[$cookie_name];
        }

        $session_key = wp_generate_uuid4();
        if (!headers_sent()) {
            $expires = time() + YEAR_IN_SECONDS;
            setcookie($cookie_name, $session_key, $expires, COOKIEPATH, COOKIE_DOMAIN, is_ssl(), true);
        }
        $_COOKIE[$cookie_name] = $session_key;
        return $session_key;
    }

    public function ajax_toggle() {
        global $wpdb;
        $pid = intval($_POST['product_id']);
        $uid = get_current_user_id();
        $session = $this->get_session();
        $product_title = get_the_title($pid);

        if ($uid) {
            $row = $wpdb->get_row($wpdb->prepare("SELECT id FROM {$this->table_items} WHERE product_id=%d AND user_id=%d", $pid, $uid));
            if ($row) {
                $wpdb->delete($this->table_items, ['id' => $row->id]);
                wp_send_json(['status' => 'removed', 'product_title' => $product_title, 'total' => $this->get_total()]);
            } else {
                $wpdb->insert($this->table_items, ['user_id' => $uid, 'session_key' => null, 'product_id' => $pid, 'created_at' => current_time('mysql')]);
                wp_send_json(['status' => 'added', 'product_title' => $product_title, 'total' => $this->get_total()]);
            }
        } else {
            $row = $wpdb->get_row($wpdb->prepare("SELECT id FROM {$this->table_items} WHERE product_id=%d AND session_key=%s", $pid, $session));
            if ($row) {
                $wpdb->delete($this->table_items, ['id' => $row->id]);
                wp_send_json(['status' => 'removed', 'product_title' => $product_title, 'total' => $this->get_total()]);
            } else {
                $wpdb->insert($this->table_items, ['user_id' => null, 'session_key' => $session, 'product_id' => $pid, 'created_at' => current_time('mysql')]);
                wp_send_json(['status' => 'added', 'product_title' => $product_title, 'total' => $this->get_total()]);
            }
        }
    }

    public function merge_on_login($user_login, $user) {
        global $wpdb;
        $session = $this->get_session();
        $uid = $user->ID;
        $items = $wpdb->get_results($wpdb->prepare("SELECT product_id FROM {$this->table_items} WHERE session_key=%s", $session));
        foreach ($items as $i) {
            $exists = $wpdb->get_var($wpdb->prepare("SELECT id FROM {$this->table_items} WHERE product_id=%d AND user_id=%d", $i->product_id, $uid));
            if (!$exists) {
                $wpdb->insert($this->table_items, ['user_id' => $uid, 'session_key' => null, 'product_id' => $i->product_id, 'created_at' => current_time('mysql')]);
            }
        }
        $wpdb->delete($this->table_items, ['session_key' => $session]);
    }

    public function get_total() {
        global $wpdb;
        $uid = is_user_logged_in() ? get_current_user_id() : null;
        if ($uid) {
            return $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM {$this->table_items} WHERE user_id=%d ORDER BY created_at DESC", $uid));
        } else {
            $session = $this->get_session();
            return $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM {$this->table_items} WHERE session_key=%s ORDER BY created_at DESC", $session));
        }
    }

    public function get_items() {
        global $wpdb;
        $uid = is_user_logged_in() ? get_current_user_id() : null;
        if ($uid) {
            return $wpdb->get_col($wpdb->prepare("SELECT product_id FROM {$this->table_items} WHERE user_id=%d ORDER BY created_at DESC", $uid));
        } else {
            $session = $this->get_session();
            return $wpdb->get_col($wpdb->prepare("SELECT product_id FROM {$this->table_items} WHERE session_key=%s ORDER BY created_at DESC", $session));
        }
    }

    public function render_page() {
        $items = !empty($_GET['wishlist']) ? explode(',', $_GET['wishlist']) : $this->get_items();
        ?>
        <div class="grid grid-cols-1 md:grid-cols-[65fr_35fr] gap-10 px-4 py-10 w-full max-w-full md:w-[1440px] m-auto relative my-0">
            <div class="w-full">
                <h2 class="text-xl sm:text-2xl font-bold mb-6 text-black uppercase tracking-tight">
                    <?php echo (!empty($_GET['wishlist']) ? __('Shared Wishlist','creative-furniture') : __('Your Wishlist','creative-furniture')) . ' (' . count($items) . ')'; ?>
                </h2>
                
                <div class="flex flex-col gap-6">
                    <?php if (empty($items)) : ?>
                        <div class="py-20 text-center bg-gray-50 rounded-2xl border border-dashed border-gray-200">
                            <p class="text-gray-400 text-lg"><?php _e('Your wishlist is empty.', 'creative-furniture'); ?></p>
                            <a href="<?php echo esc_url(home_url('/shop/')); ?>" class="inline-block mt-4 text-[#bd262a] font-bold hover:underline"><?php _e('Browse Products', 'creative-furniture'); ?></a>
                        </div>
                    <?php else : ?>
                        <?php foreach ($items as $pid) : 
                            $p = wc_get_product((int) $pid);
                            if ($p) : ?>
                                <div class="flex gap-5 border-b border-gray-100 pb-6 group items-center">
                                    <div class="shrink-0">
                                        <a href="<?php echo get_permalink($pid); ?>" class="block overflow-hidden -rounded-xl border border-gray-100">
                                            <?php echo get_the_post_thumbnail($pid, 'medium', ['class' => 'w-[140px] lg:w-[180px] 2xl:w-[220px] h-auto aspect-square object-cover transform transition-transform group-hover:scale-105']); ?>
                                        </a>
                                    </div>
                                    <div class="flex flex-col flex-wrap justify-center 2xl:flex-row 2xl:justify-between flex-1">
                                        <div class="flex flex-col">
                                            <a class="text-black text-base sm:text-lg font-bold no-underline hover:text-[#bd262a] transition-colors mb-1" href="<?php echo get_permalink($pid); ?>">
                                                <?php echo $p->get_name(); ?>
                                            </a>
                                            <div class="text-base font-black text-[#bd262a]">
                                                <?php echo $p->get_price_html(); ?>
                                            </div>
                                        </div>
                                        <div class="flex flex-wrap items-center gap-4 mt-4">
                                            <div class="flex items-center border border-gray-200 -rounded-full overflow-hidden bg-white h-10">
                                                <button class="qty-minus px-3 text-black hover:bg-gray-100 transition-colors h-full flex items-center justify-center">-</button>
                                                <input type="number" value="1" min="1" class="w-10 text-center border-none focus:ring-0 text-sm font-bold p-0 bg-transparent h-full qty-input" readonly>
                                                <button class="qty-plus px-3 text-black hover:bg-gray-100 transition-colors h-full flex items-center justify-center">+</button>
                                            </div>
                                            <button class="cf-wishlist-add-to-cart px-8 h-10 bg-black text-white text-xs font-bold -rounded-full hover:bg-[#bd262a] transition-all transform active:scale-95 shadow-md hover:shadow-[#bd262a]/20 uppercase tracking-wider" data-product-id="<?php echo $pid; ?>">
                                                <?php _e('Add to Cart', 'creative-furniture'); ?>
                                            </button>
                                            <button class="cf-wishlist-remove p-0 border-none text-gray-400 hover:text-[#d00] text-xs font-bold cursor-pointer bg-transparent transition-colors flex items-center gap-1 group/remove" data-product-id="<?php echo $pid; ?>">
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                <?php _e('Remove', 'creative-furniture'); ?>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <?php
            $total = 0;
            foreach ($items as $pid) {
                $p = wc_get_product($pid);
                if ($p) $total += floatval($p->get_price());
            }
            ?>

            <div class="w-full lg:sticky lg:top-10 self-start">
                <div class="border border-gray-200 p-8 rounded-2xl bg-gray-50/50">
                    <h3 class="text-base sm:text-xl font-bold mb-4 sm:mb-6 uppercase tracking-tight"><?php _e('Wishlist Summary','creative-furniture'); ?></h3>
                    <div class="flex justify-between mb-4 text-base font-medium">
                        <span><?php _e('Total Items','creative-furniture'); ?></span>
                        <span class="font-bold"><?php echo count($items); ?></span>
                    </div>
                    <div class="flex justify-between mb-4 sm:mb-6 text-base sm:text-lg font-bold text-black border-t border-gray-200 pt-4">
                        <span><?php _e('Total Cost','creative-furniture'); ?></span>
                        <span class="text-[#bd262a]"><?php echo wc_price($total); ?></span>
                    </div>
                    <button class="w-full py-2 sm:py-4 bg-black text-white text-base font-bold hover:bg-[#bd262a] transition-all duration-300 transform active:scale-95 shadow-lg shadow-black/10" id="cf-wishlist-share-btn">
                        <?php _e('Share Wishlist','creative-furniture'); ?>
                    </button>
                    
                    <div class="hidden flex-col gap-3 mt-6 pt-6 border-t border-gray-200 cf-wishlist-share-panel" id="cf-wishlist-share-panel">
                        <input type="text" readonly value="<?php echo esc_url(add_query_arg('wishlist', implode(',', $items), get_the_permalink())); ?>" class="w-full p-3 border border-gray-300 -rounded-xl text-sm bg-white focus:ring-2 focus:ring-black outline-none transition-all cf-wishlist-share-link">
                        <button class="w-full py-3 bg-gray-200 text-black text-sm font-bold -rounded-xl hover:bg-black hover:text-white transition-all cursor-pointer" id="cf-wishlist-copy-link">
                            <?php _e('Copy Link','creative-furniture'); ?>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    public function is_in_wishlist($product_id) {
        global $wpdb;
        $uid = get_current_user_id();
        if ($uid) {
            return (bool)$wpdb->get_var($wpdb->prepare("SELECT id FROM {$this->table_items} WHERE user_id=%d AND product_id=%d", $uid, $product_id));
        } else {
            $session = $this->get_session();
            return (bool)$wpdb->get_var($wpdb->prepare("SELECT id FROM {$this->table_items} WHERE session_key=%s AND product_id=%d", $session, $product_id));
        }
    }

    public function has_any() {
        global $wpdb;
        $uid = get_current_user_id();
        if ($uid) {
            return (bool)$wpdb->get_var($wpdb->prepare("SELECT id FROM {$this->table_items} WHERE user_id=%d LIMIT 1", $uid));
        } else {
            $session = $this->get_session();
            return (bool)$wpdb->get_var($wpdb->prepare("SELECT id FROM {$this->table_items} WHERE session_key=%s LIMIT 1", $session));
        }
    }

    public function render_shortcode($attr = []) {
        ob_start();
        $this->render_page();
        return ob_get_clean();
    }

    public function generate_share_token($product_ids) {
        global $wpdb;
        $token = wp_generate_uuid4();
        $wpdb->insert($this->table_tokens, [
            'token' => $token,
            'product_ids' => implode(',', $product_ids),
            'created_at' => current_time('mysql')
        ]);
        return $token;
    }

    public function get_shared_items($token) {
        global $wpdb;
        $row = $wpdb->get_row($wpdb->prepare("SELECT product_ids FROM {$this->table_tokens} WHERE token=%s", $token));
        if (!$row) return [];
        return array_filter(array_map('intval', explode(',', $row->product_ids)));
    }

    public function ajax_share() {
        $items = $this->get_items();
        if (empty($items)) wp_send_json(['status' => 'empty']);
        $token = $this->generate_share_token($items);
        $url = add_query_arg('wishlist_token', $token, home_url());
        wp_send_json(['status' => 'ok', 'url' => $url]);
    }
}

global $cf_wishlist;
$cf_wishlist = new CF_Wishlist();

register_activation_hook(__FILE__, [$cf_wishlist, 'activate']);

function cf_wishlist_is_in_wishlist($product_id) {
    global $cf_wishlist;
    return $cf_wishlist->is_in_wishlist($product_id);
}

function cf_wishlist_has_any() {
    global $cf_wishlist;
    return $cf_wishlist->has_any();
}

function cf_wishlist_get_items() {
    global $cf_wishlist;
    return $cf_wishlist->get_items();
}

function cf_wishlist_get_total() {
    global $cf_wishlist;
    return $cf_wishlist->get_total();
}