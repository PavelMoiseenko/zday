<?php get_header(); ?>
	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'base' ), get_search_query() ); ?></h1>
			</header><!-- .page-header -->

			<?php
			// Start the loop.
			while ( have_posts() ) : the_post();
				get_template_part( 'inc/content/post-list');
			// End the loop.
			endwhile;
			// Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'base' ),
				'next_text'          => __( 'Next page', 'base' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'base' ) . ' </span>',
			) );

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'inc/content/none');

		endif;
		?>
		</main><!-- .site-main -->
	</section><!-- .content-area -->

<?php get_footer(); ?>
