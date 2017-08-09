<?php get_header(); ?>
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

            <?php
            // Start the loop.
//            while ( have_posts() ) : the_post();
//                get_template_part( 'inc/content/page' );
//                // End the loop.
//            endwhile;
//            ?>
            <?php
            $args = array(
                'post_type' => 'event',
                'posts_per_page' => -1
            );
            $events = get_posts( $args );
            foreach( $events as $post ){ setup_postdata($post);
                get_template_part( 'inc/content/event' );
            }
            wp_reset_postdata();?>




        </main><!-- .site-main -->
    </div><!-- .content-area -->
<?php get_footer(); ?>