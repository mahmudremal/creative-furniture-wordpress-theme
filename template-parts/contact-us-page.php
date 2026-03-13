<?php
if (!defined('ABSPATH')) {
    exit;
}

global $wpdb;
$table_name = $wpdb->prefix . 'contact_us';

// Detail View
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $submission = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $id));

    if ($submission) {
        ?>
        <div class="wrap">
            <h1 class="wp-heading-inline"><?php esc_html_e('Submission Details', 'creative-furniture'); ?></h1>
            <a href="?page=contact-us" class="page-title-action"><?php esc_html_e('Back to List', 'creative-furniture'); ?></a>
            <hr class="wp-header-end">

            <div class="card" style="max-width: 800px; margin-top: 20px; padding: 20px; background: #fff; border: 1px solid #ccd0d4; box-shadow: 0 1px 1px rgba(0,0,0,.04);">
                <table class="form-table">
                    <tr>
                        <th scope="row"><?php esc_html_e('Full Name', 'creative-furniture'); ?></th>
                        <td><?php echo esc_html(join(' ', [$submission->firstname, $submission->lastname])); ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('Email', 'creative-furniture'); ?></th>
                        <td><a href="mailto:<?php echo esc_attr($submission->email); ?>"><?php echo esc_html($submission->email); ?></a></td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('Phone', 'creative-furniture'); ?></th>
                        <td><?php echo esc_html($submission->phone); ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('Message', 'creative-furniture'); ?></th>
                        <td><?php echo nl2br(esc_html($submission->message)); ?></td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('Submitted At', 'creative-furniture'); ?></th>
                        <td><?php echo esc_html(date_i18n(get_option('date_format') . ' ' . get_option('time_format'), strtotime($submission->created_at))); ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <?php
        return;
    }
}

// Search
$search = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';
$where = '';
if (!empty($search)) {
    $where = $wpdb->prepare("WHERE firstname LIKE %s OR lastname LIKE %s OR email LIKE %s OR message LIKE %s", 
        '%' . $wpdb->esc_like($search) . '%', 
        '%' . $wpdb->esc_like($search) . '%', 
        '%' . $wpdb->esc_like($search) . '%', 
        '%' . $wpdb->esc_like($search) . '%'
    );
}

// Pagination
$per_page = 20;
$current_page = isset($_GET['paged']) ? max(1, intval($_GET['paged'])) : 1;
$offset = ($current_page - 1) * $per_page;

$total_items = $wpdb->get_var("SELECT COUNT(*) FROM $table_name $where");
$total_pages = ceil($total_items / $per_page);

$results = $wpdb->get_results($wpdb->prepare("SELECT * FROM $table_name $where ORDER BY created_at DESC LIMIT %d OFFSET %d", $per_page, $offset));
?>

<div class="wrap">
    <h1 class="wp-heading-inline"><?php esc_html_e('Contact Us Submissions', 'creative-furniture'); ?></h1>
    <hr class="wp-header-end">

    <form method="get" class="search-box p-4" style="margin: 10px 0;">
        <input type="hidden" name="page" value="contact-us">
        <p class="search-box">
            <label class="screen-reader-text" for="post-search-input"><?php esc_html_e('Search Submissions:', 'creative-furniture'); ?></label>
            <input type="search" id="post-search-input" name="s" value="<?php echo esc_attr($search); ?>">
            <input type="submit" id="search-submit" class="button" value="<?php esc_attr_e('Search Submissions', 'creative-furniture'); ?>">
        </p>
    </form>

    <div class="tablenav top">
        <div class="tablenav-pages">
            <span class="displaying-num"><?php echo esc_html(sprintf(__('%s items', 'creative-furniture'), $total_items)); ?></span>
            <?php if ($total_pages > 1) : ?>
                <span class="pagination-links">
                    <?php if ($current_page > 1) : ?>
                        <a class="prev-page button" href="<?php echo add_query_arg('paged', $current_page - 1); ?>"><span class="screen-reader-text"><?php esc_html_e('Previous page', 'creative-furniture'); ?></span><span aria-hidden="true">‹</span></a>
                    <?php endif; ?>
                    <span class="paging-input">
                        <span class="tablenav-paging-text"><?php echo $current_page; ?> of <span class="total-pages"><?php echo $total_pages; ?></span></span>
                    </span>
                    <?php if ($current_page < $total_pages) : ?>
                        <a class="next-page button" href="<?php echo add_query_arg('paged', $current_page + 1); ?>"><span class="screen-reader-text"><?php esc_html_e('Next page', 'creative-furniture'); ?></span><span aria-hidden="true">›</span></a>
                    <?php endif; ?>
                </span>
            <?php endif; ?>
        </div>
    </div>

    <table class="wp-list-table widefat fixed striped">
        <thead>
            <tr>
                <th scope="col" class="manage-column column-primary"><?php esc_html_e('Full Name', 'creative-furniture'); ?></th>
                <th scope="col" class="manage-column"><?php esc_html_e('Email', 'creative-furniture'); ?></th>
                <th scope="col" class="manage-column"><?php esc_html_e('Phone', 'creative-furniture'); ?></th>
                <th scope="col" class="manage-column"><?php esc_html_e('Date', 'creative-furniture'); ?></th>
                <th scope="col" class="manage-column"><?php esc_html_e('Action', 'creative-furniture'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php if ($results) : ?>
                <?php foreach ($results as $row) : ?>
                    <tr>
                        <td class="column-primary"><strong><?php echo esc_html(join(' ', [$row->firstname, $row->lastname])); ?></strong></td>
                        <td><?php echo esc_html($row->email); ?></td>
                        <td><?php echo esc_html($row->phone); ?></td>
                        <td><?php echo esc_html(date_i18n(get_option('date_format') . ' ' . get_option('time_format'), strtotime($row->created_at))); ?></td>
                        <td>
                            <a href="?page=contact-us&id=<?php echo $row->id; ?>" class="button button-small"><?php esc_html_e('View Details', 'creative-furniture'); ?></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="6"><?php esc_html_e('No submissions found.', 'creative-furniture'); ?></td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="tablenav bottom">
        <div class="tablenav-pages">
            <?php if ($total_pages > 1) : ?>
                <span class="pagination-links">
                    <?php if ($current_page > 1) : ?>
                        <a class="prev-page button" href="<?php echo add_query_arg('paged', $current_page - 1); ?>">‹</a>
                    <?php endif; ?>
                    <span class="tablenav-paging-text"><?php echo $current_page; ?> of <?php echo $total_pages; ?></span>
                    <?php if ($current_page < $total_pages) : ?>
                        <a class="next-page button" href="<?php echo add_query_arg('paged', $current_page + 1); ?>">›</a>
                    <?php endif; ?>
                </span>
            <?php endif; ?>
        </div>
    </div>
</div>
