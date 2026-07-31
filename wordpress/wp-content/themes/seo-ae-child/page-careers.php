<?php
/**
 * Child-theme Elementor wrapper.
 * Overrides the parent template of the same name so Elementor content renders
 * instead of the parent's hardcoded PHP layout.
 */
get_header();
?>
<main id="main-content" class="elementor-page-wrap">
<?php
if ( have_posts() ) :
    while ( have_posts() ) : the_post();
        the_content();
    endwhile;
endif;
?>
</main>
<?php
get_footer();
