        </div><!-- .site-content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
            <!-- Logo in footer left-->
			<?php
            $company_logo = get_field('company_logo', 'options');
            if($company_logo) :?>
                <img src="<?php echo $company_logo;?>">
            <?php endif;?>


            <!--Footer social icons-->
            <?php if( have_rows('footer_social_icons') ): ?>
                <ul class="icons">
                    <?php while( have_rows('footer_social_icons') ): the_row();
                        $footer_social_image = get_sub_field('footer_social_image');
                        $footer_social_link = get_sub_field('footer_social_link');
                        ?>

                        <li class="icon">
                            <?php if( $link ): ?>
                            <a href="<?php echo $footer_social_link; ?>">
                                <?php endif; ?>
                                <img src="<?php echo $footer_social_image; ?>"/>
                                <?php if( $footer_social_link ): ?>
                            </a>
                        <?php endif; ?>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php endif; ?>
            
            
            <!-- Logo in footer right-->
            <?php
            $project_logo = get_field('project_logo', 'options');
            if($project_logo) :?>
                <img src="<?php echo $project_logo;?>">
            <?php endif;?>

            <a href="<?php echo esc_url(home_url('/')); ?>"><?php printf( __( 'Proudly powered by base', 'base' )); ?></a>
		</div><!-- .site-info -->
	</footer><!-- .site-footer -->

</div><!-- .wrapper -->

<?php wp_footer(); ?>

</body>
</html>
