<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php the_post_thumbnail(); ?>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' );?>
	</header><!-- .entry-header -->
	<div class="entry-content">
		<?php the_content( );?>
	</div><!-- .entry-content -->
	<footer class="entry-footer">
		<?php edit_post_link( __( 'Edit', 'base' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
