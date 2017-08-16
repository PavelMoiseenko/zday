<?php /* Template Name: Home Template */ ?>

<?php get_header(); ?>
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <!--EVENT SECTION TITLE -->
        <?php
        $event_section_title = get_field('event_section_title');
        if ($event_section_title) :?>
            <h2><?php echo $event_section_title; ?></h2>
        <?php endif; ?>

        <!--EVENT SECTION DESCRIPTION -->
        <?php
        $event_section_description = get_field('event_section_description');
        if ($event_section_description) :?>
            <p><?php echo $event_section_description; ?></p>
        <?php endif; ?>

        <!--EVENT SECTION CAPTION -->
        <?php
        $event_caption = get_field('event_caption');
        if ($event_caption) :?>
            <h2><?php echo $event_caption; ?></h2>
        <?php endif; ?>

        <!--Favorite Event or Newest-->
        <?php
        $date_now = date('Y-m-d H:i:s');
        $posts = get_field('favorite_event');
        if ($posts): ?>
            <ul>
                <?php foreach ($posts as $post): // variable must be called $post (IMPORTANT) ?>
                    <?php setup_postdata($post);
                    $event_id = $post->ID;
                    $post_registration_opening = get_field('registration_opening', $event_id);?>
                    <li>
                        <div>Дата проведения: <?php the_field('start_date'); ?></div>
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        <?php the_post_thumbnail('medium')?>
                        <div><?php the_content();?></div>
                    </li>
                <?php endforeach; ?>
            </ul>
            <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
        <?php else : ?>
            <h1>THE NEAREST EVENT</h1>
            <?php
            $posts = get_posts(array(
            'posts_per_page'	=> 1,
            'post_type'			=> 'event',
            'meta_query' 		=> array(
                'relation' 			=> 'AND',
                array(
                    'key'			=> 'start_date',
                    'compare'		=> '>',
                    'value'			=> $date_now,
                    'type'			=> 'DATETIME'
                ),
                array(
                    'key'			=> 'finish_date',
                    'compare'		=> '>',
                    'value'			=> $date_now,
                    'type'			=> 'DATETIME'
                )
            ),
            'order'				=> 'ASC',
            'orderby'			=> 'meta_value',
            'meta_key'			=> 'start_date',
            'meta_type'			=> 'DATETIME'
            ));

            if( $posts ): ?>
            <h2>Event</h2>
            <ul id="events">
                <?php foreach( $posts as $p ):
                    $event_id = $p->ID;
                    $date_event = get_field('start_date', $event_id);
                    var_dump($date_event);
                    var_dump($date_now);
                    var_dump($date_event>$date_now);
                    $post_registration_opening = get_field('registration_opening', $event_id);?>
                    <li>
                        <strong><?php echo $p->post_title; ?></strong>: <?php echo the_field('start_date', $p->ID); ?> -  <?php the_field('finish_date', $p->ID); ?>
                        <?php
                        echo get_the_post_thumbnail($p->ID,'medium');
                        echo $p->post_content;
                        ?>
                    </li>
                <?php endforeach; ?>
            </ul>
            <?php endif;?>

        <?php endif; ?>

<!--            --><?php //$args = array(
//                'numberposts' => 1,
//                'orderby' => 'date',
//                'order' => 'DESC',
//                'post_type' => 'event',
//                'suppress_filters' => true
//            );
//
//            $posts = get_posts($args);
//            foreach ($posts as $post) {
//                setup_postdata($post);?>
<!---->
<!--                <a href="--><?php //the_permalink();?><!--">--><?php //the_title();?><!--</a>-->
<!--                --><?php //$event_id = $post->ID;
//                $post_registration_opening = get_field('registration_opening', $event_id);
//            }
//
//            wp_reset_postdata();
//        endif; ?>

        <?php $registration_cta_text = get_field('registration_cta_text'); ?>
        <a href="#"><?php echo $registration_cta_text; ?></a>


        <!--Speakers-->
        <?php $speaker_section_title = get_field('speaker_section_title'); ?>
        <h2><?php echo $speaker_section_title; ?></h2>
        <?php
        $speakers = get_field('speaker', $event_id);

        if ($speakers): ?>
            <ul>
                <?php foreach ($speakers as $post): // variable must be called $post (IMPORTANT) ?>
                    <?php setup_postdata($post); ?>
                    <li>
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        <?php the_post_thumbnail('thumbnail');?>
                        <div>Speaker position: <?php echo get_field('speaker_position', $post->ID); ?></div>
                        <div><?php the_content();?></div>
                    </li>
                <?php endforeach; ?>
            </ul>
            <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
        <?php endif; ?>

        <!--Registration form-->
        <?php $registration_title = get_field('registration_title');
        if ($registration_title) :?>
            <h2><?php echo $registration_title; ?></h2>
        <?php endif; ?>
        <?php $is_registration_on = get_field('is_registration_on');
        if ($is_registration_on['value'] === '1'  && $post_registration_opening) :?>
            <div class="registration">
                <h2>Registration</h2>
                <input class="name" type="text" name="name" placeholder="Name *"/>
                <span class="name-err"></span><br>
                <input class="surname" type="text" name="surname" placeholder="Surname *"/>
                <span class="surname-err"></span><br>
                <input class="email" type="email" name="email" placeholder="Email *">
                <span class="email-err"></span><br>
                <input class="specialization" type="text" name="specialization" placeholder="Specialization *">
                <span class="specialization-err"></span><br>
                <input class="telephone" type="tel" name="telephone" placeholder="Telephone">
                <span class="telephone-err"></span><br>
                <input class="event_id" type="hidden" name="event_id" value="<?php echo $event_id; ?>">
                <?php $registration_cta_text = get_field('registration_cta_text');?>
                <input class="register" type="button" value="<?php echo $registration_cta_text;?>" name="register"><br>
            </div>
            <div class="message"></div>
        <?php else : ?>
            <h2>REGISTRATION CLOSED</h2>
        <?php endif; ?>


        <!--Recent events-->

        <?php

        $args = array(
            'posts_per_page'	=> 3,
            'post_type'			=> 'event',
            'meta_query' 		=> array(
                'relation' 			=> 'AND',
                array(
                    'key'			=> 'start_date',
                    'compare'		=> '<',
                    'value'			=> $date_now,
                    'type'			=> 'DATETIME'
                ),
                array(
                    'key'			=> 'finish_date',
                    'compare'		=> '<',
                    'value'			=> $date_now,
                    'type'			=> 'DATETIME'
                )
            ),
            'order'				=> 'ASC',
            'orderby'			=> 'meta_value',
            'meta_key'			=> 'start_date',
            'meta_type'			=> 'DATETIME'
        );
        $posts = get_posts($args);

        if( $posts ): ?>
            <h2>Recent events</h2>
            <ul id="events">
                <?php foreach( $posts as $p ):
                    $event_id = $p->ID;
                    $date_event = get_field('start_date', $event_id);?>
                    <li>
                        <strong><?php echo $p->post_title; ?></strong>: <?php echo the_field('start_date', $p->ID); ?> -  <?php the_field('finish_date', $p->ID); ?>
                        <?php
                        echo get_the_post_thumbnail($p->ID,'medium');
                        echo $p->post_content;
                        ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif;?>

        <?php
        $recent_events_cta_text = get_field('recent_events_cta_text', 'options');
        if ($recent_events_cta_text) :?>
            <a href="#" ?>echo $recent_events_cta_text;</a>
        <?php endif; ?>

        <!--    // Start the loop.-->
        <!--    // --><?php //while (have_posts()) : the_post();
        //    //                get_template_part( 'inc/content/page' );
        //    //                // End the loop.
        //    //            endwhile;
        //    //            ?>
        <!--    --><?php
        ////// Prints the names and majors of students in a sample spreadsheet:
        ////// https://docs.google.com/spreadsheets/d/1BxiMVs0XRA5nFMdKvBdBZjgmUUqptlbs74OgvE2upms/edit
        //Get the API client and construct the service object.


        // Get the API client and construct the service object.
//                    $client = getClient();
//                    $service = new Google_Service_Sheets($client);
//
//                    $spreadsheetId = /*'1BxiMVs0XRA5nFMdKvBdBZjgmUUqptlbs74OgvE2upms'*/'135RS03FkjkQsyJHV7AxWX6j1of2tcCO9036Vyp093rU';
//                    $range = 'A3:B3';
//                    $optParams['dateTimeRenderOption'] = '';
//                    $optParams['valueInputOption'] = 'ROWS';

                  /*READING*/
//                    $response = $service->spreadsheets_values->get($spreadsheetId, $range);
//                    $values = $response->getValues();
//
//                    if (count($values) == 0) {
//                        print "No data found.\n";
//                    } else {
//                        var_dump($values);
//                        /*foreach ($values as $row) {
//                            // Print columns A and E, which correspond to indices 0 and 4.
//                            printf("%s, %s\n", $row[0], $row[1]);
//                        }*/
//                    }


        /*WRITING*/
//      $requestBody = new Google_Service_Sheets_ValueRange();
//
//        //$requestBody->setMajorDimension("ROWS");
//        $requestBody->setRange("A3:B3");
//        $requestBody->setValues(array(
//               "HELLO", "HELLO"
//        ));
//
//        $response = $service->spreadsheets_values->update($spreadsheetId, $range, $requestBody);

//        var_dump($requestBody);
//         die(0;)
        /*
         *  "majorDimension": "ROWS",
          "range": "A3:B3",
          "values": [
            [
              "HELLO",
              "WORLD"
            ]
          ]
        }*/










        /*Output all events*/
//        $args = array(
//            'post_type' => 'event',
//            'posts_per_page' => -1
//        );
//        $events = get_posts($args);
//        foreach ($events as $post) {
//            setup_postdata($post);
//            get_template_part('inc/content/event');
//        }
//        wp_reset_postdata();?>


    </main><!-- .site-main -->
</div><!-- .content-area -->
<?php get_footer();?>