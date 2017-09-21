<?php

$path = $_SERVER['DOCUMENT_ROOT'];

include_once $path . '/wp-config.php';
include_once $path . '/wp-load.php';
include_once $path . '/wp-includes/wp-db.php';
include_once $path . '/wp-includes/pluggable.php';
include_once $path . '/wp-admin/includes/plugin.php';
$path_to_plugin = plugins_url( '/wp-emails/index.php' );


$date_now      = date( 'Y-m-d H:i:s' );
$time_now      = strtotime( $date_now );
$time_next_day = strtotime( '+1 day', $time_now );
$date_next_day = date( 'Y-m-d H:i:s', $time_next_day );

$closest_event_array  = get_posts(
	array(
		'post_type'     => 'event',
		'meta_query'    => array(
			array(
				'key'     => 'start_date',
				'compare' => 'BETWEEN',
				'value'   => array( $date_now, $date_next_day ),
				'type'    => 'DATETIME'

			)
		),
		'post_per_page' => 1
	)
);
$closest_event_object = $closest_event_array[0];

$closest_event_id = $closest_event_object->ID;

$closest_event_title   = $closest_event_object->post_title;
$closest_event_content = $closest_event_object->post_content;
$closest_event_address = get_field( "address", $closest_event_id );

$closest_event_start_date = get_field( "start_date", $closest_event_id, false );
$closest_date_object      = new DateTime( $closest_event_start_date );
$closest_event_date       = $closest_date_object ->format( 'j.m' );
$closest_event_time       = $closest_date_object ->format( 'G:i' );

if ( have_rows( 'participants', $closest_event_id ) ):
	while ( have_rows( 'participants', $closest_event_id ) ) : the_row();
		$email = get_sub_field( 'participant_email' );

		send_email_template( 'reminder', $email, array(
				'title'      => $closest_event_title,
				'content'    => $closest_event_content,
				'address'    => $closest_event_address,
				'start_date' => $closest_event_date,
				'start_time' => $closest_event_time
			)
		);
	endwhile;
endif;
