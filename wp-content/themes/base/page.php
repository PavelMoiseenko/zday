<?php get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<?php
            // Start the loop.
            while ( have_posts() ) : the_post();
                    get_template_part( 'inc/content/page' );
            // End the loop.
            endwhile;
		?>
		</main><!-- .site-main -->
	</div><!-- .content-area -->
<?php get_footer(); ?>
