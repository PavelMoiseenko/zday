<?php get_header(); ?>
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">

            <!--EVENT SECTION TITLE -->
            <?php
            $event_section_title = get_field('event_section_title', 'options');
            if ($event_section_title) :?>
                <h2><?php echo $event_section_title; ?></h2>
            <?php endif; ?>

            <!--EVENT SECTION DESCRIPTION -->
            <?php
            $event_section_description = get_field('event_section_description', 'options');
            if ($event_section_description) :?>
                <p><?php echo $event_section_description; ?></p>
            <?php endif; ?>

            <!--EVENT SECTION CAPTION -->
            <?php
            $event_caption = get_field('event_caption', 'options');
            if ($event_caption) :?>
                <h2><?php echo $event_caption; ?></h2>
            <?php endif; ?>

            <!--Favorite Event or Newest-->
            <?php
            $posts = get_field('favorite_event', 'options');
            var_dump($posts);
            if ($posts): ?>
                <ul>
                    <?php foreach ($posts as $post): // variable must be called $post (IMPORTANT) ?>
                        <?php setup_postdata($post); ?>
                        <li>
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            <span>Custom field from $post: <?php the_field('start_date'); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
            <?php else : ?>
                <h1>THE NEWEST POST</h1>
                <?php $args = array(
                    'numberposts' => 1,
                    'orderby' => 'date',
                    'order' => 'DESC',
                    'post_type' => 'event',
                    'suppress_filters' => true
                );

                $posts = get_posts($args);
                foreach ($posts as $post) {
                    setup_postdata($post);
                    the_title();
                }

                wp_reset_postdata();
            endif; ?>

            <!--Registration turn on-->
            <?php
                $is_registration_on = get_field('is_registration_on', 'options');
                if($is_registration_on['value'] === '1') : ?>
                    <h2>Registration ON</h2>
                <?php else :?>
                    <h2>Registration OFF</h2>
            <?php endif;?>

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
            //            $client = getClient();
            //            $service = new Google_Service_Sheets($client);
            //
            //            //// Prints the names and majors of students in a sample spreadsheet:
            //            //// https://docs.google.com/spreadsheets/d/1BxiMVs0XRA5nFMdKvBdBZjgmUUqptlbs74OgvE2upms/edit
            //            $spreadsheetId = /*'1BxiMVs0XRA5nFMdKvBdBZjgmUUqptlbs74OgvE2upms'*/'135RS03FkjkQsyJHV7AxWX6j1of2tcCO9036Vyp093rU';
            //            $range = 'A2:B2';
            //                        $response = $service->spreadsheets_values->get($spreadsheetId, $range);
            //                        $values = $response->getValues();
            //
            //                        if (count($values) == 0) {
            //                            print "No data found.\n";
            //                        } else {
            //                            var_dump($values);
            //                            /*foreach ($values as $row) {
            //                                // Print columns A and E, which correspond to indices 0 and 4.
            //                                printf("%s, %s\n", $row[0], $row[4]);
            //                            }*/
            //                        }
            //

            //            $optParams = [];
            //            $optParams['valueInputOption'] = 'ROWS';

            //            $optParams = array(
            //                'valueInputOption' => "ROWS"
            //            );
            //            // TODO: Assign values to desired properties of `requestBody`. All existing
            //            // properties will be replaced:
            //            $requestBody = new Google_Service_Sheets_ValueRange();
            //

            /*$requestBody->setMajorDimension("ROWS");
            $requestBody->setRange("A3:B3");
            $requestBody->setValues(array(
                   "HELLO", "HELLO"           ));*/
            //var_dump($requestBody);

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


            // $response = $service->spreadsheets_values->update($spreadsheetId, $range, $requestBody, $optParams);


            $args = array(
                'post_type' => 'event',
                'posts_per_page' => -1
            );
            $events = get_posts($args);
            foreach ($events as $post) {
                setup_postdata($post);
                get_template_part('inc/content/event');
            }
            wp_reset_postdata(); ?>


        </main><!-- .site-main -->
    </div><!-- .content-area -->
<?php get_footer(); ?>