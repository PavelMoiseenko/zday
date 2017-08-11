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
            ////// Prints the names and majors of students in a sample spreadsheet:
            ////// https://docs.google.com/spreadsheets/d/1BxiMVs0XRA5nFMdKvBdBZjgmUUqptlbs74OgvE2upms/edit
            //Get the API client and construct the service object.


            // Get the API client and construct the service object.
            $client = getClient();
            $service = new Google_Service_Sheets($client);

            //// Prints the names and majors of students in a sample spreadsheet:
            //// https://docs.google.com/spreadsheets/d/1BxiMVs0XRA5nFMdKvBdBZjgmUUqptlbs74OgvE2upms/edit
            $spreadsheetId = /*'1BxiMVs0XRA5nFMdKvBdBZjgmUUqptlbs74OgvE2upms'*/'135RS03FkjkQsyJHV7AxWX6j1of2tcCO9036Vyp093rU';
            $range = 'A2:B2';
                        $response = $service->spreadsheets_values->get($spreadsheetId, $range);
                        $values = $response->getValues();

                        if (count($values) == 0) {
                            print "No data found.\n";
                        } else {
                            var_dump($values);
                            /*foreach ($values as $row) {
                                // Print columns A and E, which correspond to indices 0 and 4.
                                printf("%s, %s\n", $row[0], $row[4]);
                            }*/
                        }


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