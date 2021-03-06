<footer id="footer" class="clearfix">
    <div class="footer-holder">
        <div class="contact-info">
            <h2>Связаться с нами можно по адресу:</h2>
            <p><a href="mailto:&#122;&#100;&#097;&#121;&#064;&#122;&#102;&#111;&#114;&#116;&#046;&#099;&#111;&#109;">&#122;&#100;&#097;&#121;&#064;&#122;&#102;&#111;&#114;&#116;&#046;&#099;&#111;&#109;</a></p>
        </div>
        <div class="footer-area">
            <div class="container <?php is_front_page()? 'wow fadeIn': '';?>" data-wow-duration="1.3s">
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
    <svg class="icon ico-loader"><use xlink:href="#loader"></use></svg>
    <div class="popup" id="popup1">
        <span class="pop-close">X</span>
        <div class="popup-content clearfix">
            <div class="popup-visual slider-holder">
                <div class="gallery-top swiper-container">
                    <div class="swiper-wrapper top-picture">
                    </div>
                </div>
                <div class="thumb-holder">
                    <div class="swiper-container gallery-thumbs">
                        <div class="swiper-wrapper bottom-picture">
                        </div>
                        <div class="swiper-arrows">
                            <span class="swiper-prev"><svg class="ico-prev"><use xlink:href="#ico-prev"></use></svg></span>
                            <span class="swiper-next"><svg class="ico-next"><use xlink:href="#ico-next"></use></svg></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="popup-desc">
                <div class="heading">
                    <h2>ElasticSearch – больше чем поиск / Jenkins CI</h2>
                    <p id="speakers-string">Спикеры: Максим Шаев (Software PHP Developer, Tech Lead), Роман Шопин (Software PHP Developer, Tech Lead)</p>
                </div>
                <p class="popup-description"></p>
            </div>
        </div>
    </div>
</div>
<?php wp_footer(); ?>
</body>
</html>


