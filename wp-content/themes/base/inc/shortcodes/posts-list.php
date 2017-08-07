<?php
if ( ! function_exists( 'posts_list_shortcode' ) ) {

	function posts_list_shortcode( $atts, $content = null, $shortcodename = '' ) {
		extract(shortcode_atts(array(
			'type'         => 'post',
			'thumbs'       => '',
			'thumb_width'  => '',
			'thumb_height' => '',
			'post_content' => '',
			'numb'         => '5',
			'order_by'     => '',
			'order'        => '',
			'link'         => '',
			'link_text'    => __('Read more', 'base'),
			'tag'          => '',
			'tags'         => '',
			'custom_class' => ''
		), $atts));

		// check what order by method user selected
		switch ( $order_by ) {
			case 'date':
				$order_by = 'post_date';
				break;
			case 'title':
				$order_by = 'title';
				break;
			case 'popular':
				$order_by = 'comment_count';
				break;
			case 'random':
				$order_by = 'rand';
				break;
		}

		// check what order method user selected (DESC or ASC)
		switch ( $order ) {
			case 'DESC':
				$order = 'DESC';
				break;
			case 'ASC':
				$order = 'ASC';
				break;
		}

		global $post;
		global $_wp_additional_image_sizes;

		// WPML filter
		$suppress_filters = get_option( 'suppress_filters' );

		$args = array(
			'post_type'        => $type,
			'tag'              => $tag,
			'numberposts'      => $numb,
			'orderby'          => $order_by,
			'order'            => $order,
			'suppress_filters' => $suppress_filters
		);

		$posts = get_posts( $args );
		$i = 0;

		// thumbnail size
		$thumb_x = 0;
		$thumb_y = 0;
		if ( $thumbs == 'large' ) {
			$thumb_x = 620;
			$thumb_y = 300;
		} else {
			$thumb_x = $_wp_additional_image_sizes['post-thumbnail']['width'];
			$thumb_y = $_wp_additional_image_sizes['post-thumbnail']['height'];
		}

		// thumbnail class
		$thumbs_class = '';
		if ( $thumbs == 'large' ){
			$thumbs_class = 'large';
		}

		$output = '<div class="posts-list ' . esc_attr( $custom_class ) . '">';

		foreach ( $posts as $key => $post ) {
			// Unset not translated posts
			if ( function_exists( 'wpml_get_language_information' ) ) {
				global $sitepress;

				$check              = wpml_get_language_information( $post->ID );
				$language_code      = substr( $check['locale'], 0, 2 );
				if ( $language_code != $sitepress->get_current_language() ) unset( $posts[$key] );

				// Post ID is different in a second language Solution
				if ( function_exists( 'icl_object_id' ) ) $post = get_post( icl_object_id( $post->ID, $type, true ) );
			}
			setup_postdata( $post );
			$excerpt        = get_the_excerpt();
			$attachment_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
			$url            = $attachment_url['0'];
			if ( ($thumb_width != '' ) && ( $thumb_height != '' ) )
				$image = base_image_resize( $url, $thumb_width, $thumb_height, true );
			else
				$image = base_image_resize( $url, $thumb_x, $thumb_y, true );

			$format = get_post_format();

			$output .= '<div class="list-item list-item-' . $i . '">';
			$output .= '<article class="post-holder">';

			//post thumbnail
			if ( has_post_thumbnail( $post->ID ) && $format == 'image' ) {

				$output .= '<div class="featured-thumbnail thumbnail ' . sanitize_html_class( $thumbs_class ) . '">';
				$output .= '<a href="' . get_permalink( $post->ID ) . '" title="' . get_the_title( $post->ID ) . '">';
				$output .= '<img src="' . esc_url( $image ) . '" alt="' . get_the_title( $post->ID ) . '" />';
				$output .= '</a></div>';

			} else {

				$thumbid = 0;
				$thumbid = get_post_thumbnail_id( $post->ID );
				$images = get_children( array(
					'orderby'        => 'menu_order',
					'order'          => 'ASC',
					'post_type'      => 'attachment',
					'post_parent'    => $post->ID,
					'post_mime_type' => 'image',
					'post_status'    => null,
					'numberposts'    => -1
				) );

				if ( $images ) {

					$k = 0;
					//looping through the images
					foreach ( $images as $attachment_id => $attachment ) {

						$image_attributes_t = wp_get_attachment_image_src( $attachment_id); // returns an array (thumbnail size)
						$image_attributes = wp_get_attachment_image_src( $attachment_id, 'full' ); // returns an array (full size)
						if ( ($thumb_width != '') && ($thumb_height != '') ) {
							$img = base_image_resize( $image_attributes[0], $thumb_width, $thumb_height, true );  //resize & crop img
						} else {
							$img = base_image_resize( $url, $thumb_x, $thumb_y, true );
						}

						$alt = get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true );
						$image_title = $attachment->post_title;

						if ( $k == 0 ) {
							$output .= '<div class="featured-thumbnail thumbnail ' . sanitize_html_class( $thumbs_class ) . '">';
							$output .= '<a href="' . get_permalink( $post->ID ) . '" title="' . get_the_title( $post->ID ) . '">';
							$output .= '<img  src="'.$img.'" alt="' . esc_attr( get_the_title( $post->ID ) ) . '" />';
						}
						$output .= '</a></div>';
						break;
					}
				}
			}
			
			//post header
			$output .= '<header class="post-header">';
				$output .= '<h2 class="post-title"><a href="' . get_permalink( $post->ID ) . '" title="' . get_the_title( $post->ID ) . '">';
					$output .= get_the_title( $post->ID );
				$output .= '</a></h2>';

				// post meta
				$output .= '<div class="post_meta">';

					// post category
					$output .= '<span class="post_category">';
					if ( $type != '' && $type != 'post' ) {
						$terms = get_the_terms( $post->ID, $type.'_category');
						if ( $terms && ! is_wp_error( $terms ) ) {
							$out = array();
							$output .= __( 'Posted in', 'base' ).' ';
							foreach ( $terms as $term )
								$out[] = '<a href="' .get_term_link( $term->slug, $type . '_category' ) .'">' . $term->name . '</a>';
								$output .= join( ', ', $out );
						}
					} else {
						$categories = get_the_category();
						if($categories){
							$out = array();
							$output .= __( 'Posted in', 'base' ).' ';
							foreach($categories as $category)
								$out[] = '<a href="'.get_category_link( $category->term_id ).'" title="' . $category->name . '">' . $category->cat_name . '</a> ';
								$output .= join( ', ', $out );
						}
					}
					$output .= '</span>';

				// post date
				$output .= '<span class="post_date">';
				$output .= '<time datetime="' . get_the_time( 'Y-m-d\TH:i:s', $post->ID ) . '">' . get_the_date() . '</time>';
				$output .= '</span>';

				// post author
				$output .= '<span class="post_author">';
				$output .= __( 'by ', 'base' ) . ' ';
				$output .= '<a href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '">' . get_the_author_meta( 'display_name' ) . '</a>';
				$output .= '</span>';

				// post comment count
				$num = 0;
				$post_id = $post->ID;
				$queried_post = get_post( $post_id );
				$cc = $queried_post->comment_count;
				if( $cc == $num || $cc > 1 ){
					$cc = $cc . ' ' . __( 'Comments', 'base' );
				}
				$permalink = get_permalink( $post_id );
				$output .= '<span class="post_comment">';
				$output .= '<a href="' . $permalink . '" class="comments_link">' . $cc . '</a>';
				$output .= '</span>';

				$output .= '</div>';
			$output .= '</header>';

			// post content
			if ( $post_content != 'none' || $link == 'yes' ) {
				$output .= '<div class="post_content">';

				switch ( $post_content ){
					case 'excerpt':
						$output .= '<p class="excerpt">';
							$output .= wp_trim_words( get_the_excerpt(), 50 );
						$output .= '</p>';
						break;
					case 'content':
						$output .= '<div class="full-post-content">';
							$output .= get_the_content();
						$output .= '</div>';
						break;
					case 'none':
						break;

				}
				if($link == 'yes'){
					$output .= '<a href="' . get_permalink( $post->ID ) . '" class="btn btn-primary" title="' . esc_attr( get_the_title( $post->ID ) ) . '">';
					$output .= $link_text;
					$output .= '</a>';
				}
				$output .= '</div>';
			}

			//post footer
			if ( $tags == 'yes' ) {
				$posttags = get_the_tags();
				if ( $posttags ) {
					$output .= '<footer class="post_footer">' . __( 'Tags', 'base' ) . ": ";
						foreach ( $posttags as $tag ) {
						  $output .= '<a href="' . get_tag_link( $tag->term_id ) . '" rel="tag">' . $tag->name . '</a> ';
						}
					$output .= '</footer>';
				}
			}

			$output .= '</article>';
			$output .= '</div><!-- .row-fluid (end) -->';

			$i++;

		} // end foreach
		wp_reset_postdata(); // restore the global $post variable
		$output .= '</div><!-- .posts-list (end) -->';

		$output = apply_filters( 'theme_shortcode_output', $output, $atts, $shortcodename );

		return $output;
	}
	add_shortcode('posts_list', 'posts_list_shortcode');

}