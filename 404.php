<?php
/**
 * The template for displaying 404 pages (Not Found)
 */

get_header(); ?>

<section class="error-page">
    <div class="container">
        <h1 class="error-title">404</h1>
        <h2 class="error-subtitle">Page Not Found</h2>
        <p class="error-text">
            The page you are looking for doesn’t exist or has been moved.
        </p>

        <a href="<?php echo esc_url(home_url('/')); ?>" class="error-btn">
            Back to Home
        </a>
    </div>
</section>

<?php get_footer(); ?>
