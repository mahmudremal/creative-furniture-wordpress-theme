<?php

add_shortcode('mymc_currency_switcher','mymc_currency_switcher_shortcode');
add_filter('woocommerce_currency','mymc_filter_currency');
add_filter('woocommerce_currency_symbol','mymc_currency_symbol',10,2);
add_filter('woocommerce_product_get_price','mymc_convert_price',10,2);
add_filter('woocommerce_product_get_regular_price','mymc_convert_price',10,2);
add_filter('woocommerce_product_get_sale_price','mymc_convert_price',10,2);
add_filter('woocommerce_variation_prices_price','mymc_variation_prices_price',10,3);
add_filter('woocommerce_variation_prices_regular_price','mymc_variation_prices_price',10,3);
add_filter('woocommerce_variation_prices_sale_price','mymc_variation_prices_price',10,3);
add_filter('woocommerce_get_price_html','mymc_price_html',10,2);
add_action('init','mymc_init');

global $wcCurrencry;

function mymc_init(){
    global $wcCurrencry;
    $wcCurrencry = get_option('woocommerce_currency');
    if(isset($_GET['mymc_currency'])){
        $c = sanitize_text_field($_GET['mymc_currency']);
        setcookie('mymc_currency', $c, time() + 30 * DAY_IN_SECONDS, '/', defined('COOKIE_DOMAIN') ? COOKIE_DOMAIN : '');
        $_COOKIE['mymc_currency'] = $c;
        wp_safe_redirect(remove_query_arg('mymc_currency'));
        exit;
    }
}

function mymc_allowed_currencies(){
    return array('AED','USD','EUR');
}

function mymc_current_currency(){
    static $currency = null;global $wcCurrencry;
    if($currency !== null) return $currency;
    $allowed = mymc_allowed_currencies();
    if(!empty($_COOKIE['mymc_currency'])){
        $c = sanitize_text_field($_COOKIE['mymc_currency']);
        if(in_array($c, $allowed, true)){
            $currency = $c;
            return $currency;
        }
    }
    $currency = $wcCurrencry;
    return $currency;
}

function mymc_fetch_rates(){
    static $cache = null;global $wcCurrencry;
    if($cache !== null) return $cache;
    $base = $wcCurrencry;
    $transient_key = 'mymc_rates_' . $base;
    $rates = get_transient($transient_key);
    if($rates !== false){
        $cache = $rates;
        return $rates;
    }
    $symbols = implode(',', mymc_allowed_currencies());
    $url = "https://api.exchangerate.host/latest?base=" . rawurlencode($base) . "&symbols=" . rawurlencode($symbols);
    $response = wp_remote_get($url, array('timeout' => 10));
    if(is_wp_error($response)) return false;
    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);
    if(!empty($data['rates']) && is_array($data['rates'])){
        set_transient($transient_key, $data['rates'], DAY_IN_SECONDS);
        $cache = $data['rates'];
        return $cache;
    }
    return false;
}

function mymc_convert_price($price, $product = null){
    static $current = null;
    static $base = null;
    static $rates = null;
    global $wcCurrencry;

    if($current === null){
        $current = mymc_current_currency();
        $base = $wcCurrencry;
        $rates = mymc_fetch_rates();
    }

    if($current === $base) return $price;
    if(empty($rates) || empty($rates[$current])) return $price;

    $decimals = wc_get_price_decimals();
    $converted = floatval($price) * floatval($rates[$current]);
    return round($converted, $decimals);
}

function mymc_variation_prices_price($price, $variation, $product){
    return mymc_convert_price($price, $product);
}

function mymc_filter_currency($currency){
    return mymc_current_currency();
}

function mymc_currency_symbol($symbol, $currency){
    $map = array('USD' => '$', 'EUR' => '€', 'AED' => 'د.إ');
    if(isset($map[$currency])) return $map[$currency];
    return $symbol;
}

function mymc_currency_switcher_shortcode($atts){
    $atts = shortcode_atts(['show_label' => 'yes'], $atts, 'mymc_currency_switcher');
    $current = mymc_current_currency();
    $allowed = mymc_allowed_currencies();
    $out = '<form method="get" id="mymc-switcher" style="display:inline-block;">';
    if ('yes' === $atts['show_label']) {
        $out .= '<label for="mymc_currency_select" style="margin-right: 5px;font-size: 0;">' . esc_html__('Currency:', 'woocommerce') . '</label>';
    }
    $out .= '<select name="mymc_currency" id="mymc_currency_select" onchange="this.form.submit();">';
    foreach($allowed as $c){
        $sel = $c === $current ? ' selected' : '';
        $out .= '<option value="'.esc_attr($c).'"'.$sel.'>'.esc_html($c).'</option>';
    }
    $out .= '</select>';
    $out .= '</form>';
    return $out;
}

function mymc_price_html($price_html, $product){
    global $wcCurrencry;
    if(is_admin()) return $price_html;
    $currency = mymc_current_currency();
    if($currency === $wcCurrencry) return $price_html;
    $raw_price = $product->get_price();
    return wc_price($raw_price, array('currency' => $currency));
}
