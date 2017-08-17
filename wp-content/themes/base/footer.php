<footer id="footer" class="clearfix">
    <div class="footer-holder">
        <div class="container">
            <?php
            $company_logo = get_field('company_logo', 'options');
            $company_link = get_field('company_link', 'options');
            if ($company_link) :?>
                <div class="logo-holder">
                    <strong class="zfort-logo">
                        <a href="<?php echo $company_link; ?>">
                            <img src="<?php echo $company_logo; ?>" alt="Friendly Technologies ZFORT GROUP" width="230"
                                 height="35">
                        </a>
                    </strong>
                </div>
            <?php endif; ?>


            <ul class="social-networks">
                <li>
                    <a href="#">
                        <svg class="icon ico-facebook">
                            <use xlink:href="#ico-facebook"></use>
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <svg class="icon ico-twitter">
                            <use xlink:href="#ico-twitter"></use>
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <svg class="icon ico-instagram">
                            <use xlink:href="#ico-instagram"></use>
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <svg class="icon ico-linkedin">
                            <use xlink:href="#ico-linkedin"></use>
                        </svg>
                    </a>
                </li>
            </ul>
            <?php
            $project_logo = get_field('project_logo', 'options');
            $project_link = get_field('project_link', 'options');
            if ($project_link) :?>
                <div class="logo-holder">
                    <strong class="zday-logo">
                        <a href="<?php echo $project_link; ?>">
                            <img src=<?php echo $project_logo; ?> alt="Z-day" width="250" height="261">
                        </a>
                    </strong>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php $copyright = get_field('copyright', 'options');
    $year = date('Y');
    if ($copyright) :?>
        <div class="container">
            <p><?php echo($copyright . " " . $year); ?></p>
        </div>
    <?php endif; ?>
</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>

<!--            <!--Footer social icons-->
<!--            --><?php //if( have_rows('footer_social_icons') ): ?>
<!--                <ul class="icons">-->
<!--                    --><?php //while( have_rows('footer_social_icons') ): the_row();
//                        $footer_social_image = get_sub_field('footer_social_image');
//                        $footer_social_link = get_sub_field('footer_social_link');
//                        ?>
<!---->
<!--                        <li class="icon">-->
<!--                            --><?php //if( $link ): ?>
<!--                            <a href="--><?php //echo $footer_social_link; ?><!--">-->
<!--                                --><?php //endif; ?>
<!--                                <img src="--><?php //echo $footer_social_image; ?><!--"/>-->
<!--                                --><?php //if( $footer_social_link ): ?>
<!--                            </a>-->
<!--                        --><?php //endif; ?>
<!--                        </li>-->
<!--                    --><?php //endwhile; ?>
<!--                </ul>-->
<!--            --><?php //endif; ?>


