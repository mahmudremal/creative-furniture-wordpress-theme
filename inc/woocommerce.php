<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package Creative_Furniture
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */
function creative_furniture_woocommerce_setup() {
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 150,
			'single_image_width'    => 300,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'default_columns' => 4,
				'min_columns'     => 1,
				'max_columns'     => 6,
			),
		)
	);
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'creative_furniture_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function creative_furniture_woocommerce_scripts() {
	// wp_enqueue_style( 'creative-furniture-woocommerce-style', get_template_directory_uri() . '/woocommerce.css', array(), _S_VERSION );

	// $font_path   = WC()->plugin_url() . '/assets/fonts/';
	// $inline_font = '@font-face {
	// 		font-family: "star";
	// 		src: url("' . $font_path . 'star.eot");
	// 		src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
	// 			url("' . $font_path . 'star.woff") format("woff"),
	// 			url("' . $font_path . 'star.ttf") format("truetype"),
	// 			url("' . $font_path . 'star.svg#star") format("svg");
	// 		font-weight: normal;
	// 		font-style: normal;
	// 	}';

	// wp_add_inline_style( 'creative-furniture-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'creative_furniture_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function creative_furniture_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'creative_furniture_woocommerce_active_body_class' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function creative_furniture_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'creative_furniture_woocommerce_related_products_args' );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'creative_furniture_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function creative_furniture_woocommerce_wrapper_before() {
		?>
			<main id="primary" class="site-main">
		<?php
	}
}
add_action( 'woocommerce_before_main_content', 'creative_furniture_woocommerce_wrapper_before' );

if ( ! function_exists( 'creative_furniture_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function creative_furniture_woocommerce_wrapper_after() {
		?>
			</main><!-- #main -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'creative_furniture_woocommerce_wrapper_after' );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'creative_furniture_woocommerce_header_cart' ) ) {
			creative_furniture_woocommerce_header_cart();
		}
	?>
 */

if ( ! function_exists( 'creative_furniture_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function creative_furniture_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		creative_furniture_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'creative_furniture_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'creative_furniture_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function creative_furniture_woocommerce_cart_link() {
		?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'creative-furniture' ); ?>">
			<?php
			$item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'creative-furniture' ),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
		</a>
		<?php
	}
}

if ( ! function_exists( 'creative_furniture_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function creative_furniture_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php creative_furniture_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
				$instance = array(
					'title' => '',
				);

				the_widget( 'WC_Widget_Cart', $instance );
				?>
			</li>
		</ul>
		<?php
	}
}


add_action('wp_ajax_get_cart_items', 'creative_furniture_get_cart_items');
add_action('wp_ajax_nopriv_get_cart_items', 'creative_furniture_get_cart_items');

function creative_furniture_get_cart_items() {
    if ( ! class_exists( 'WC_Cart' ) || ! WC()->cart ) {
        wp_send_json_error(['message' => 'Cart not available']);
    }

    if ( is_null( WC()->cart ) ) {
        wc_load_cart();
    }

    $cart_items = [];
    $subtotal   = WC()->cart->get_cart_subtotal();

    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
        $_product = $cart_item['data'];

        if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 ) {
            $cart_items[] = [
                'id'       => $_product->get_id(),
                'name'     => $_product->get_name(),
                'price'    => wc_price( $_product->get_price() ),
                // 'subtotal' => WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ),
                'image'    => wp_get_attachment_image_url( $_product->get_image_id(), 'thumbnail' ),
                'url'      => get_permalink( $_product->get_id() ),
                ...$cart_item
            ];
        }
    }
    wp_send_json_success([
        'items'    => $cart_items,
        'subtotal' => $subtotal,
		'cart' => wc_get_cart_url(),
		'checkout' => wc_get_checkout_url()
    ]);
}

add_action('wp_ajax_get_product_quickview', 'creative_furniture_get_product_quickview');
add_action('wp_ajax_nopriv_get_product_quickview', 'creative_furniture_get_product_quickview');

function creative_furniture_get_product_quickview() {
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    
    if (!$product_id) {
        wp_send_json_error(['message' => 'Invalid product ID']);
    }
    
    $product = wc_get_product($product_id);
    
    if (!$product) {
        wp_send_json_error(['message' => 'Product not found']);
    }
    
    $images = [];
    $image_ids = $product->get_gallery_image_ids();
    $main_image = wp_get_attachment_image_url($product->get_image_id(), 'medium');
    if ($main_image) {
        $images[] = $main_image;
    }
    foreach ($image_ids as $image_id) {
        $images[] = wp_get_attachment_image_url($image_id, 'medium');
    }
    
    $variations = [];
    if ($product->is_type('variable')) {
        $attributes = $product->get_variation_attributes();
        
        foreach ($attributes as $attr_name => $options) {
            $attr_key = sanitize_title($attr_name);
            $variations[$attr_key] = [];
            
            if ($attr_key === 'pa_material' || $attr_key === 'material') {
                foreach ($options as $option) {
                    $term = get_term_by('slug', $option, $attr_name);
                    $color = get_term_meta($term->term_id, 'color', true);
                    $variations['material'][] = [
                        'name' => $option,
                        'color' => $color ?: '#cccccc'
                    ];
                }
            } else {
                $variations[$attr_key] = $options;
            }
        }
    }
    
    wp_send_json([
        'title' => $product->get_name(),
        'price' => $product->get_price_html(),
        'description' => wp_trim_words($product->get_short_description() ?: $product->get_description(), 30),
        'images' => $images,
        'variations' => $variations,
        'permalink' => get_permalink($product_id)
    ]);
}

add_action('wp_ajax_add_to_cart_quickview', 'creative_furniture_add_to_cart_quickview');
add_action('wp_ajax_nopriv_add_to_cart_quickview', 'creative_furniture_add_to_cart_quickview');

function creative_furniture_add_to_cart_quickview() {
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
    
    if (!$product_id) {
        wp_send_json_error(['message' => 'Invalid product ID']);
    }
    
    $product = wc_get_product($product_id);
    
    if ($product->is_type('variable')) {
        $variation_data = [];
        foreach ($_POST as $key => $value) {
            if (strpos($key, 'attribute_') === 0 || in_array($key, ['size', 'material'])) {
                $attr_key = 'attribute_' . (strpos($key, 'attribute_') === 0 ? str_replace('attribute_', '', $key) : $key);
                $variation_data[$attr_key] = sanitize_text_field($value);
            }
        }
        
        $variation_id = $product->get_matching_variation($variation_data);
        if ($variation_id) {
            WC()->cart->add_to_cart($product_id, $quantity, $variation_id, $variation_data);
        } else {
            wp_send_json_error(['message' => 'Please select all options']);
        }
    } else {
        WC()->cart->add_to_cart($product_id, $quantity);
    }
    
    wp_send_json_success([
        'message' => 'Product added to cart',
        'cart_count' => WC()->cart->get_cart_contents_count()
    ]);
}

add_action('wp_ajax_cf_add_to_cart', 'cf_ajax_add_to_cart');
add_action('wp_ajax_nopriv_cf_add_to_cart', 'cf_ajax_add_to_cart');

function cf_ajax_add_to_cart() {
    check_ajax_referer('cf-add-to-cart', 'nonce');

    $product_id = absint($_POST['product_id']);
    $quantity = absint($_POST['quantity']);
    $variation_id = isset($_POST['variation_id']) ? absint($_POST['variation_id']) : 0;
    $variation = isset($_POST['variation']) ? $_POST['variation'] : [];

    if ($variation_id) {
        $added = WC()->cart->add_to_cart($product_id, $quantity, $variation_id, $variation);
    } else {
        $added = WC()->cart->add_to_cart($product_id, $quantity);
    }

    if ($added) {
        wp_send_json_success([
            'message' => __('Product added to cart', 'creative-furniture'),
            'cart_count' => WC()->cart->get_cart_contents_count(),
            'cart_url' => wc_get_cart_url()
        ]);
    } else {
        wp_send_json_error([
            'message' => __('Failed to add product to cart', 'creative-furniture')
        ]);
    }
}

add_action('wp_ajax_cf_get_variation', 'cf_ajax_get_variation');
add_action('wp_ajax_nopriv_cf_get_variation', 'cf_ajax_get_variation');

function cf_ajax_get_variation() {
    check_ajax_referer('cf-get-variation', 'nonce');

    $product_id = absint($_POST['product_id']);
    $attributes = isset($_POST['attributes']) ? json_decode(stripslashes($_POST['attributes']), true) : [];

    if (!$attributes || !is_array($attributes)) {
        wp_send_json_error(['message' => __('Invalid attributes', 'creative-furniture')]);
        return;
    }

    $product = wc_get_product($product_id);
    
    if (!$product || !$product->is_type('variable')) {
        wp_send_json_error(['message' => __('Invalid product', 'creative-furniture')]);
        return;
    }

    $data_store = WC_Data_Store::load('product');
    $variation_id = $data_store->find_matching_product_variation($product, $attributes);

    if ($variation_id) {
        $variation = wc_get_product($variation_id);
        wp_send_json_success([
            'variation_id' => $variation_id,
            'price_html' => $variation->get_price_html(),
            'is_in_stock' => $variation->is_in_stock()
        ]);
    } else {
        wp_send_json_error(['message' => __('No matching variation found', 'creative-furniture')]);
    }
}









add_action('wp_ajax_get_product_filters', 'get_product_filters_handler');
add_action('wp_ajax_nopriv_get_product_filters', 'get_product_filters_handler');

function get_product_filters_handler() {
    check_ajax_referer('filters_nonce', 'nonce');
    
    $categories = get_terms([
        'taxonomy' => 'product_cat',
        'hide_empty' => true,
        'orderby' => 'name',
        'order' => 'ASC'
    ]);
    
    $colors = get_terms([
        'taxonomy' => 'pa_color',
        'hide_empty' => true,
        'orderby' => 'name'
    ]);
    
    $finishes = get_terms([
        'taxonomy' => 'pa_finish',
        'hide_empty' => true,
        'orderby' => 'name'
    ]);
    
    $tags = get_terms([
        'taxonomy' => 'product_tag',
        'hide_empty' => true,
        'orderby' => 'name'
    ]);
    
    global $wpdb;
    $price_range = $wpdb->get_row("
        SELECT 
            MIN(CAST(meta_value AS DECIMAL(10,2))) as min_price,
            MAX(CAST(meta_value AS DECIMAL(10,2))) as max_price
        FROM {$wpdb->postmeta}
        WHERE meta_key = '_price'
        AND meta_value != ''
    ");
    
    $response = [
        'categories' => array_map(function($cat) {
            return [
                'id' => $cat->term_id,
                'name' => $cat->name,
                'slug' => $cat->slug,
                'count' => $cat->count
            ];
        }, $categories),
        'colors' => array_map(function($color) {
            $hex = get_term_meta($color->term_id, 'color_hex', true);
            return [
                'id' => $color->term_id,
                'name' => $color->name,
                'slug' => $color->slug,
                'hex' => $hex ?: '#000000'
            ];
        }, $colors),
        'finishes' => array_map(function($finish) {
            return [
                'id' => $finish->term_id,
                'name' => $finish->name,
                'slug' => $finish->slug
            ];
        }, $finishes),
        'tags' => array_map(function($tag) {
            return [
                'id' => $tag->term_id,
                'name' => $tag->name,
                'slug' => $tag->slug
            ];
        }, $tags),
        'priceRange' => [
            'min' => floatval($price_range->min_price ?? 0),
            'max' => floatval($price_range->max_price ?? 10000)
        ]
    ];
    
    wp_send_json_success($response);
}

add_action('wp_enqueue_scripts', 'enqueue_filters_scripts');
function enqueue_filters_scripts() {
    wp_localize_script('your-react-bundle', 'wpFilters', [
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('filters_nonce')
    ]);
}

add_action('pre_get_posts', 'apply_product_filters');
function apply_product_filters($query) {
    if (!is_admin() && $query->is_main_query() && (is_shop() || is_product_category())) {
        
        if (isset($_GET['category'])) {
            $cats = explode(',', sanitize_text_field($_GET['category']));
            $query->set('tax_query', array_merge(
                $query->get('tax_query') ?: [],
                [[
                    'taxonomy' => 'product_cat',
                    'field' => 'slug',
                    'terms' => $cats
                ]]
            ));
        }
        
        if (isset($_GET['color'])) {
            $colors = explode(',', sanitize_text_field($_GET['color']));
            $query->set('tax_query', array_merge(
                $query->get('tax_query') ?: [],
                [[
                    'taxonomy' => 'pa_color',
                    'field' => 'slug',
                    'terms' => $colors
                ]]
            ));
        }
        
        if (isset($_GET['finish'])) {
            $finishes = explode(',', sanitize_text_field($_GET['finish']));
            $query->set('tax_query', array_merge(
                $query->get('tax_query') ?: [],
                [[
                    'taxonomy' => 'pa_finish',
                    'field' => 'slug',
                    'terms' => $finishes
                ]]
            ));
        }
        
        if (isset($_GET['tag'])) {
            $tags = explode(',', sanitize_text_field($_GET['tag']));
            $query->set('tax_query', array_merge(
                $query->get('tax_query') ?: [],
                [[
                    'taxonomy' => 'product_tag',
                    'field' => 'slug',
                    'terms' => $tags
                ]]
            ));
        }
        
        if (isset($_GET['min_price']) || isset($_GET['max_price'])) {
            $meta_query = $query->get('meta_query') ?: [];
            
            if (isset($_GET['min_price'])) {
                $meta_query[] = [
                    'key' => '_price',
                    'value' => floatval($_GET['min_price']),
                    'compare' => '>=',
                    'type' => 'NUMERIC'
                ];
            }
            
            if (isset($_GET['max_price'])) {
                $meta_query[] = [
                    'key' => '_price',
                    'value' => floatval($_GET['max_price']),
                    'compare' => '<=',
                    'type' => 'NUMERIC'
                ];
            }
            
            $query->set('meta_query', $meta_query);
        }
    }
}