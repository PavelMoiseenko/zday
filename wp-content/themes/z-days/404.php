<?php
get_header(); ?>
<section class="visual">
	<?php
	$logo      = get_field( 'logo', 'options' );
	$logo_link = get_field( 'logo_link', 'options' );
	if ( $logo_link ): ?>
        <strong class="logo">
            <a href="<?php echo $logo_link; ?>" target="_blank">
                <img src="<?php echo $logo; ?>" alt="Z-day" width="250" height="261"/>
            </a>
        </strong>
	<?php endif; ?>
</section>
<main id="main" class="clearfix">
    <section class="content-row intro-holder">
        <div class="container small-width">
            <h2 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'zdays' ); ?></h2>
            <div class="intro">
                <p><?php _e( 'It looks like nothing was found at this location.', 'zdays' ); ?></p>
            </div>
        </div>
    </section>
</main>
<?php get_footer(); ?>
