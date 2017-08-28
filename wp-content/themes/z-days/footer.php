<footer id="footer" class="clearfix">
    <div class="footer-holder">
        <div class="container wow fadeIn" data-wow-duration="1.3s">
			<?php
			$company_logo = get_field( 'company_logo', 'options' );
			$company_link = get_field( 'company_link', 'options' );
			if ( $company_link ) :?>
                <div class="logo-holder">
                    <strong class="zfort-logo">
                        <a href="<?php echo $company_link; ?>" target="_blank">
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
                            <a href="<?php the_sub_field( 'footer_social_link' ); ?>" target="_blank">
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
<div class="popup-holder">
    <div class="popup" id="popup1">
        <a class="link-close" href="#"><svg class="icon ico-close"><use xlink:href="#ico-close"></use></svg></a>
        <div class="popup-content clearfix">
            <div class="popup-visual">
                <div class="image">
                    <img src="" alt="image-description" width="750" height="600">
                </div>
            </div>
            <div class="popup-desc">
                <div class="heading">
                    <h2>ElasticSearch – больше чем поиск / Jenkins CI</h2>
                    <p id="speakers-string">Спикеры: Максим Шаев (Software PHP Developer, Tech Lead), Роман Шопин (Software PHP Developer, Tech Lead)</p>
                </div>
                <p class="popup-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.</p>
            </div>
        </div>
    </div>
</div>
<?php wp_footer(); ?>
</body>
</html>


