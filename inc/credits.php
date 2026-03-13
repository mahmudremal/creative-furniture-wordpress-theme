<?php
class DevCredits {

    public function __construct() {
        $this->setup_hooks();
    }

    protected function setup_hooks() {
        add_action('wp_footer', [$this, 'add_footer_credit']);
        add_action('wp_head', [$this, 'add_developer_meta_tag']);
        add_action('admin_menu', [$this, 'add_developer_menu']);
        add_action('dev_profile_sync_weekly', [$this, 'refresh_dev_info']);

        if (!wp_next_scheduled('dev_profile_sync_weekly')) {
            wp_schedule_event(time(), 'weekly', 'dev_profile_sync_weekly');
        }
    }

    public function add_footer_credit() {
        ?>
        <script type="application/ld+json">
            {
                "@context": "https://schema.org",
                "@type": "WebSite",
                "creator": {
					"@type": "Person",
					"name": "Remal Mahmud",
					"url": "https://www.mahmudremal.com/"
                },
                "url": "<?php echo esc_url(home_url('/')); ?>"
            }
        </script>
        <?php
    }

    public function add_developer_meta_tag() {
        echo '<meta name="developer" content="Remal Mahmud, https://www.mahmudremal.com/">';
    }

    public function add_developer_menu() {
        add_menu_page(
            __('Developer', 'creative-furniture'),
            __('Developer', 'creative-furniture'),
            'manage_options',
            'dev-info',
            [$this, 'render_dev_info_page'],
            'dashicons-external',
            100
        );
    }

    private function get_dev_content() {
        $file_path = get_template_directory() . '/dist/library/dev-profile.md';
        $last_updated = file_exists($file_path) ? filemtime($file_path) : 0;
        $content = file_exists($file_path) ? file_get_contents($file_path) : '';
        $week_in_seconds = 604800;

        if (empty($content) || (time() - $last_updated) > $week_in_seconds || isset($_GET['refresh_dev_info'])) {
            $this->refresh_dev_info();
            $content = file_exists($file_path) ? file_get_contents($file_path) : '';
        }

        return $content;
    }

    public function refresh_dev_info() {
        $file_path = get_template_directory() . '/dist/library/dev-profile.md';
        $urls = [
            'https://raw.githubusercontent.com/mahmudremal/mahmudremal/main/SUPPORT.md',
            'https://raw.githubusercontent.com/mahmudremal/mahmudremal/main/README.md'
        ];

        foreach ($urls as $url) {
            $response = wp_remote_get($url, ['timeout' => 15]);
            if (!is_wp_error($response) && wp_remote_retrieve_response_code($response) === 200) {
                $content = wp_remote_retrieve_body($response);
                file_put_contents($file_path, $content);
                break;
            }
        }
    }

    public function render_dev_info_page() {
        $content = $this->get_dev_content();
        ?>
        <div class="wrap dev-info-wrap" style="max-width: 900px; margin: 40px auto; padding: 0 20px;">
            <div style="background: white; border-radius: 24px; box-shadow: 0 20px 50px rgba(0,0,0,0.05); overflow: hidden; border: 1px solid #f0f0f0;">
                <div style="background: #000; padding: 40px; color: white; display: flex; align-items: center; justify-content: space-between;">
                    <div>
                        <h1 style="color: white; margin: 0; font-size: 32px; font-weight: 800; letter-spacing: -0.02em;"><?php _e('Developer Support', 'creative-furniture'); ?></h1>
                        <p style="margin: 10px 0 0 0; opacity: 0.7; font-size: 16px;"><?php _e('Get in touch with the creator of this theme.', 'creative-furniture'); ?></p>
                    </div>
                    <a href="?page=dev-info&refresh_dev_info=1" class="button" style="background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); color: white; border-radius: 12px; padding: 8px 16px; height: auto; font-weight: 600;"><?php _e('Refresh Content', 'creative-furniture'); ?></a>
                </div>
                
                <div id="markdown-preview" style="padding: 60px; line-height: 1.8; color: #333; font-size: 16px;">
                    <div class="loading-state" style="text-align: center; padding: 40px;">
                        <span class="spinner is-active" style="float: none;"></span>
                        <p><?php _e('Loading developer profile...', 'creative-furniture'); ?></p>
                    </div>
                </div>

                <div style="background: #f9f9f9; padding: 30px 60px; border-top: 1px solid #eee; display: flex; justify-content: space-between; align-items: center;">
                    <div style="font-size: 14px; color: #888;">
                        <?php 
                        $file_path = get_template_directory() . '/dist/library/dev-profile.md';
                        $last_upd = file_exists($file_path) ? filemtime($file_path) : 0;
                        if ($last_upd) {
                            printf(__('Last sync: %s ago', 'creative-furniture'), human_time_diff($last_upd, time()));
                        }
                        ?>
                    </div>
                    <div style="display: flex; gap: 15px;">
                        <a href="https://www.mahmudremal.com" target="_blank" style="text-decoration: none; color: #000; font-weight: 700; font-size: 14px;"><?php _e('Official Website', 'creative-furniture'); ?> →</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script> -->
        <script src="<?php echo get_template_directory_uri(); ?>/dist/library/js/marked.min.js"></script>
        <style>
            .dev-info-wrap #markdown-preview h1 { font-size: 2.5em; font-weight: 800; margin-bottom: 30px; border-bottom: 2px solid #f0f0f0; padding-bottom: 10px; }
            .dev-info-wrap #markdown-preview h2 { font-size: 1.8em; font-weight: 700; margin-top: 40px; margin-bottom: 20px; color: #000; }
            .dev-info-wrap #markdown-preview h3 { font-size: 1.4em; font-weight: 700; margin-top: 30px; }
            .dev-info-wrap #markdown-preview p { margin-bottom: 20px; }
            .dev-info-wrap #markdown-preview a { color: #000; text-decoration: underline; font-weight: 600; }
            .dev-info-wrap #markdown-preview img { max-width: 100%; border-radius: 12px; margin: 20px 0; }
            .dev-info-wrap #markdown-preview code { background: #f4f4f4; padding: 3px 6px; border-radius: 6px; font-family: monospace; font-size: 0.9em; }
            .dev-info-wrap #markdown-preview blockquote { border-left: 4px solid #000; padding-left: 20px; color: #666; font-style: italic; margin: 30px 0; }
            .dev-info-wrap #markdown-preview ul { list-style: disc; margin-left: 20px; margin-bottom: 20px; }
            .dev-info-wrap #markdown-preview table { width: 100%; border-collapse: collapse; margin: 30px 0; }
            .dev-info-wrap #markdown-preview th, .dev-info-wrap #markdown-preview td { padding: 12px; border: 1px solid #eee; text-align: left; }
            .dev-info-wrap #markdown-preview th { background: #f9f9f9; }
        </style>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const rawMarkdown = <?php echo json_encode($content); ?>;
                const previewElement = document.getElementById('markdown-preview');
                if (rawMarkdown) {
                    previewElement.innerHTML = marked.parse(rawMarkdown);
                } else {
                    previewElement.innerHTML = '<p><?php _e('Unable to load developer information. Please check your internet connection or try refreshing.', 'creative-furniture'); ?></p>';
                }
            });
        </script>
        <?php
    }
}
new DevCredits();