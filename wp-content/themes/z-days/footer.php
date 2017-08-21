<footer id="footer" class="clearfix">
    <div class="footer-holder">
        <div class="container">
			<?php
			$company_logo = get_field( 'company_logo', 'options' );
			$company_link = get_field( 'company_link', 'options' );
			if ( $company_link ) :?>
                <div class="logo-holder">
                    <strong class="zfort-logo">
                        <a href="<?php echo $company_link; ?>">
                            <img src="<?php echo $company_logo; ?>" alt="Friendly Technologies ZFORT GROUP" width="230"
                                 height="35">
                        </a>
                    </strong>
                </div>
			<?php endif; ?>

            <?php if ( have_rows( 'footer_social_icons', 'options' ) ): ?>
                <ul class="social-networks">
                    <?php while ( have_rows( 'footer_social_icons', 'options' ) ) : the_row(); ?>
                        <li>
                            <a href="<?php the_sub_field( 'footer_social_link' ); ?>">
                                <svg class="icon <?php the_sub_field( 'footer_social_image' ); ?>">
                                    <use xlink:href="#<?php the_sub_field( 'footer_social_image' ); ?>"></use>
                                </svg>
                            </a>
                        </li>
                    <?php endwhile;?>
                </ul>
            <?php endif; ?>
			<?php
			$project_logo = get_field( 'project_logo', 'options' );
			$project_link = get_field( 'project_link', 'options' );
			if ( $project_link ) :?>
                <div class="logo-holder">
                    <strong class="zday-logo">
                        <a href="<?php echo $project_link; ?>" target="_blank">
                            <img src=<?php echo $project_logo; ?> alt="Z-day" width="250" height="261">
                        </a>
                    </strong>
                </div>
			<?php endif; ?>
        </div>
    </div>

	<?php $copyright = get_field( 'copyright', 'options' );
	$year            = date( 'Y' );
	if ( $copyright ) :?>
        <div class="container">
            <p><?php echo( $copyright . " " . $year ); ?></p>
        </div>
	<?php endif; ?>
</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>


