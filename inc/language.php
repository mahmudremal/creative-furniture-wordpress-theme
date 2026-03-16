<?php

class CF_Language {
    private $cookie_name = 'cf_visitor_locale';

    public function __construct() {
        $this->setup_hooks();
    }

    private function setup_hooks() {
        add_action('init', [$this, 'handle_language_switch']);
        add_filter('locale', [$this, 'set_visitor_locale']);
    }

    public function handle_language_switch() {
        if (isset($_GET['set_lang'])) {
            $lang = sanitize_text_field($_GET['set_lang']);
            $allowed_langs = ['en_US', 'ar'];
            
            if (in_array($lang, $allowed_langs)) {
                setcookie($this->cookie_name, $lang, time() + (3600 * 24 * 30), COOKIEPATH, COOKIE_DOMAIN);
                wp_redirect(remove_query_arg('set_lang'));
                exit;
            }
        }
    }

    public function set_visitor_locale($locale) {
        if (isset($_COOKIE[$this->cookie_name])) {
            return sanitize_text_field($_COOKIE[$this->cookie_name]);
        }
        return $locale;
    }

    public function get_current_lang() {
        return isset($_COOKIE[$this->cookie_name]) ? $_COOKIE[$this->cookie_name] : 'en_US';
    }
}

global $cf_language;
$cf_language = new CF_Language();

function cf_language_menu() {
    global $cf_language;
    $current_lang = $cf_language->get_current_lang();
    $is_ar = $current_lang === 'ar';
    
    $en_flag = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAALCAMAAABBPP0LAAAAmVBMVEViZsViZMJiYrf9gnL8eWrlYkjgYkjZYkj8/PujwPybvPz4+PetraBEgfo+fvo3efkydfkqcvj8Y2T8UlL8Q0P8MzP9k4Hz8/Lu7u4DdPj9/VrKysI9fPoDc/EAZ7z7IiLHYkjp6ekCcOTk5OIASbfY/v21takAJrT5Dg6sYkjc3Nn94t2RkYD+y8KeYkjs/v7l5fz0dF22YkjWvcOLAAAAgElEQVR4AR2KNULFQBgGZ5J13KGGKvc/Cw1uPe62eb9+Jr1EUBFHSgxxjP2Eca6AfUSfVlUfBvm1Ui1bqafctqMndNkXpb01h5TLx4b6TIXgwOCHfjv+/Pz+5vPRw7txGWT2h6yO0/GaYltIp5PT1dEpLNPL/SdWjYjAAZtvRPgHJX4Xio+DSrkAAAAASUVORK5CYII=';
    $ar_flag = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAALCAMAAABBPP0LAAAANlBMVEUAYjMTYDs3R0AvV0NObzE3dSoTWzhAZjgyfEY0gl1EcDFqpIhKj28TVzaLs41ol1JSaF1JW1NzUHm9AAAAPUlEQVR4AY2MtQEAMAgE447tv2xKvuQqeEtRcikZ/9p6b9X/Mdfeaw4PnPvehQhNvpcnJYiInIqraqYpyAd1AAFxIEreLQAAAABJRU5ErkJggg==';

    $active_flag = $is_ar ? $ar_flag : $en_flag;
    $active_label = $is_ar ? 'العربية' : 'English';

    $en_link = add_query_arg('set_lang', 'en_US');
    $ar_link = add_query_arg('set_lang', 'ar');

    // ob_start();
    ?>
    <ul id="language-switcher-menu" class="menu">
        <li id="menu-item-142" class="pll-parent-menu-item menu-item menu-item-type-custom menu-item-object-custom current-menu-parent menu-item-has-children menu-item-142">
            <a href="#pll_switcher">
                <img src="<?php echo $active_flag; ?>" alt="" width="16" height="11" style="width: 16px; height: 11px;">
                <span style="margin-left:0.3em;"><?php echo $active_label; ?></span>
            </a>
            <ul class="sub-menu">
                <li id="menu-item-142-en" class="lang-item lang-item-en <?php echo !$is_ar ? 'current-lang' : ''; ?> menu-item menu-item-type-custom menu-item-object-custom menu-item-142-en">
                    <a href="<?php echo esc_url($en_link); ?>" hreflang="en-US" lang="en-US">
                        <img src="<?php echo $en_flag; ?>" alt="" width="16" height="11" style="width: 16px; height: 11px;">
                        <span style="margin-left:0.3em;">English</span>
                    </a>
                </li>
                <li id="menu-item-142-ar" class="lang-item lang-item-ar <?php echo $is_ar ? 'current-lang' : ''; ?> menu-item menu-item-type-custom menu-item-object-custom menu-item-142-ar">
                    <a href="<?php echo esc_url($ar_link); ?>" hreflang="ar" lang="ar">
                        <img src="<?php echo $ar_flag; ?>" alt="" width="16" height="11" style="width: 16px; height: 11px;">
                        <span style="margin-left:0.3em;">العربية</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
    <?php
    // return ob_get_clean();
}
