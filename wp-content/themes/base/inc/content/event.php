<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php the_post_thumbnail(); ?>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' );?>
	</header><!-- .entry-header -->
    <div><?php echo (get_field('speaker')[0]->post_title);?></div>
    <?php the_field("start_date");?>-
    <?php the_field("finish_date");?>
	<div class="entry-content">
		<?php the_content( );?>
	</div><!-- .entry-content -->
    <?php

    $event_plan = get_field('event_plan');

    if( $event_plan ): ?>

        <a href="<?php echo $event_plan['url']; ?>" target="_blank"><?php echo $event_plan['filename']; ?></a>

    <?php endif; ?>

    <?php
    $registration_opening = get_field('registration_opening');
    if ($registration_opening) :?>
        <div class="registration">
            <h2>Registration</h2>
            <input class="surname" type="text" name="surname" placeholder="Surname"><br>
            <input class="name" type="text" name="name" placeholder="Name"><br>
            <input class="email" type="email" name="email" placeholder="Email"><br>
            <input class="event_id" type="hidden" name="event_id" value="<?php the_ID();?>">
            <input class="register" type="button" value="Register" name="register"><br>
        </div>
        <div class="message"></div>
    <?php endif;?>

	<footer class="entry-footer">
		<?php edit_post_link( __( 'Edit', 'base' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
