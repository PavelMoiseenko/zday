<?php
get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php if ( is_home() && ! is_front_page() ) : ?>
                <header>
                    <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                </header>
			<?php endif; ?>

			<?php
			// Start the loop.
			while ( have_posts() ) : the_post();
				get_template_part( 'inc/content/post-list' );
				// End the loop.
			endwhile;

			// Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'zdays' ),
				'next_text'          => __( 'Next page', 'zdays' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'zdays' ) . ' </span>',
			) );

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'inc/content/none' );

		endif;
		?>

    </main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>