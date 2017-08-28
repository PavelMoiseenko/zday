<?php /* Template Name: Home Template */ ?>

<?php get_header(); ?>
<main id="main" class="clearfix">
    <section class="content-row intro-holder">
        <div class="img-triangles">
            <div class="layer" data-rellax-speed="-4" data-rellax-percentage="0.5">
                <img class="wow fadeIn" data-wow-duration="1.5s"
                     src=<?php echo get_template_directory_uri() . "/assets/images/img-decor2-1.png"; ?> alt="image
                     description">
            </div>
            <div class="layer" data-rellax-speed="12" data-rellax-percentage="0.5">
                <img class="wow fadeIn" data-wow-duration="1.5s"
                     src=<?php echo get_template_directory_uri() . "/assets/images/img-decor2-2.png"; ?> alt="image
                     description">
            </div>
        </div>
        <div class="container small-width">

			<?php
			$event_section_title       = get_field( 'event_section_title' );
			$event_section_description = get_field( 'event_section_description' );
			if ( $event_section_title ) :?>
                <h2 class="" data-wow-duration="1.3s"><?php echo $event_section_title; ?></h2>
                <div class="intro " data-wow-duration="1.3s" data-wow-delay="0.15s">
					<?php if ( $event_section_description ) : ?>
                        <p><?php echo $event_section_description; ?></p>
					<?php endif; ?>
                </div>
			<?php endif; ?>

			<?php
			$event_caption = get_field( 'event_caption' );
			if ( $event_caption ) :?>
                <h2 class="" data-wow-duration="1.3s"><?php echo $event_caption; ?></h2>
			<?php endif; ?>

			<?php
			$date_now              = date( 'Y-m-d H:i:s' );
			$registration_cta_text = get_field( 'registration_cta_text' );
			$posts                 = get_field( 'favorite_event' );
			if ( $posts ) {
				$favorite_event_id    = $posts[0]->ID;
				$favorite_event_start = get_field( 'start_date', $favorite_event_id );
				if ( $favorite_event_start < $date_now ) {
					$posts = false;
				}
			}

			if ( ! $posts ):
				$posts = get_posts( array(
					'posts_per_page' => 1,
					'post_type'      => 'event',
					'meta_query'     => array(
						'relation' => 'AND',
						array(
							'key'     => 'start_date',
							'compare' => '>',
							'value'   => $date_now,
							'type'    => 'DATETIME'
						),
						array(
							'key'     => 'finish_date',
							'compare' => '>',
							'value'   => $date_now,
							'type'    => 'DATETIME'
						)
					),
					'order'          => 'ASC',
					'orderby'        => 'meta_value',
					'meta_key'       => 'start_date',
					'meta_type'      => 'DATETIME'
				) );
			endif;

			if ( $posts ): ?>
				<?php foreach ( $posts as $post ): ?>
					<?php setup_postdata( $post );
					$event_id                  = $post->ID;
					$post_registration_opening = get_field( 'registration_opening', $event_id ); ?>
                    <article class="box with-logo">
                        <header class="heading" data-wow-duration="1.3s" data-wow-delay="0.15s">
                            <div class="info">
								<?php
								$date = get_field( 'start_date', false, false );
								if ( $date ) :
									$date = new DateTime( $date ); ?>
                                    <time><?php echo $date->format( 'j.m.Y, G:i' ); ?></time>
								<?php endif; ?>
								<?php $address = get_field( 'address' );
								if ( $address ) :?>
                                    <address><?php echo $address; ?></address>
								<?php endif; ?>
                            </div>
                            <h1><?php the_title(); ?></h1>
                        </header>
                        <div class="desc-holder clearfix">
                            <div class="image wow fadeIn" data-wow-duration="1.3s" data-wow-delay="0.15s">
                                <img src=<?php echo get_template_directory_uri() . "/assets/images/git-cat.png"; ?> alt="git"
                                     width="390" height="520">
                            </div>
                            <div class="description" data-wow-duration="1.3s" data-wow-delay="0.15s">
								<?php the_content(); ?>
                            </div>
                        </div>
						<?php
						if ( $registration_cta_text ) :?>
                            <div class="btn-holder wow fadeIn" data-wow-duration="1.3s" data-wow-delay="0.15s">
                                <a class="button" href="#section_registration"><?php echo $registration_cta_text; ?></a>
                            </div>
						<?php endif; ?>
                    </article>
				<?php endforeach; ?>
				<?php wp_reset_postdata(); ?>
			<?php endif; ?>
        </div>
    </section>

    <section class="content-row bg-custom with-logo">
        <div class="img-triangles">
            <div class="layer" data-rellax-speed="12" data-rellax-percentage="0.5">
                <img class="wow fadeIn" data-wow-duration="1.5s"
                     src=<?php echo get_template_directory_uri() . "/assets/images/img-decor3-1.png"; ?> alt="image
                     description">
            </div>
            <div class="layer" data-rellax-speed="-4" data-rellax-percentage="0.5">
                <img class="wow fadeIn" data-wow-duration="1.5s"
                     src=<?php echo get_template_directory_uri() . "/assets/images/img-decor3-2.png"; ?> alt="image
                     description">
            </div>
        </div>
        <div class="container small-width">
			<?php
			$speaker_section_title = get_field( 'speaker_section_title' );
			if ( $speaker_section_title ) :?>
                <h2 class="" data-wow-duration="1.3s"><?php echo $speaker_section_title; ?></h2>
			<?php endif; ?>

			<?php $speakers = get_field( 'speaker', $event_id );
			if ( $speakers ): ?>
                <ul class="thumb-list">
					<?php foreach ( $speakers as $post ): ?>
						<?php setup_postdata( $post ); ?>
                        <li class="" data-wow-duration="1.3s" data-wow-delay="0.15s">
                            <div class="thumb">
								<?php the_post_thumbnail( array( 360, 350 ), array( 'alt' => 'image description' ) ); ?>
                            </div>
                            <div class="thumb-desc">
                                <div class="title">
									<?php if ( get_the_title() ) : ?>
                                        <h3><?php the_title(); ?></h3>
									<?php endif; ?>
									<?php $speaker_position = get_field( 'speaker_position', $post->ID );
									if ( $speaker_position ) :?>
                                        <span class="position"><?php echo $speaker_position; ?></span>
									<?php endif; ?>
                                </div>
								<?php if ( get_the_content() ) : ?>
                                    <p><?php the_content(); ?></p>
								<?php endif; ?>
                            </div>
                        </li>
					<?php endforeach; ?>
                </ul>
				<?php wp_reset_postdata(); ?>
			<?php endif; ?>
        </div>
    </section>

    <section class="content-row striped registration" id="section_registration">
        <div class="img-triangles">
            <div class="layer" data-rellax-speed="-4" data-rellax-percentage="0.5">
                <img class="wow fadeIn" data-wow-duration="1.5s"
                     src=<?php echo get_template_directory_uri() . "/assets/images/img-decor4-1.png"; ?> alt="image
                     description">
            </div>
            <div class="layer" data-rellax-speed="12" data-rellax-percentage="0.5">
                <img class="wow fadeIn" data-wow-duration="1.5s"
                     src=<?php echo get_template_directory_uri() . "/assets/images/img-decor4-2.png"; ?> alt="image
                     description">
            </div>
        </div>
        <div class="img-decor" data-wow-duration="1s" data-wow-delay="0.15s">
            <img src=<?php echo get_template_directory_uri() . "/assets/images/git-cat.png"; ?> alt="git" width="390"
                 height="520">
        </div>
        <div class="container">
            <div class="form-holder">
				<?php $registration_title = get_field( 'registration_title' );
				if ( $registration_title ) :?>
                    <h2 class="" data-wow-duration="1.3s"><?php echo $registration_title; ?></h2>
				<?php endif; ?>
                <div class="box with-logo form-box">
					<?php $is_registration_on = get_field( 'is_registration_on' );
					if ( $is_registration_on['value'] === '1' && $post_registration_opening ) :?>
                        <form class="wow fadeIn form" data-wow-duration="1.3s" data-wow-delay="0.15s" action="/"
                              method="post" novalidate>
                            <div class="form-row">
                                <div class="form-field">
                                    <label for="name-field"><?php _e( "Имя *", "zdays" ); ?></label>
                                    <input class="name" type="text" id="name-field" name="nameField" required>
                                    <!--                                        <span class="name-err"></span>-->
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-field">
                                    <label for="surname-field"><?php _e( "Фамилия *", "zdays" ); ?></label>
                                    <input class="surname" type="text" id="surname-field" name="surnameField" required>
                                    <!--                                        <span class="surname-err"></span>-->
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-field">
                                    <label for="email-field"><?php _e( "Email *", "zdays" ); ?></label>
                                    <input class="email" type="email" id="email-field" name="emailField" required>
                                    <!--                                        <span class="email-err"></span>-->
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-field">
                                    <label for="specialization-field"><?php _e( "Специализация *", "zdays" ); ?></label>
                                    <input class="specialization" type="text" id="specialization-field"
                                           name="specializationField" required>
                                    <!--                                        <span class="specialization-err"></span>-->
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-field">
                                    <label for="tel-field"><?php _e( "Телефон", "zdays" ); ?></label>
                                    <input class="telephone" type="tel" id="tel-field" name="telField">
                                    <!--                                        <span class="telephone-err"></span>-->
                                </div>
                            </div>
                            <input class="event_id" type="hidden" name="event_id" value="<?php echo $event_id; ?>">
							<?php $registration_cta_text = get_field( 'registration_cta_text' );
							if ( $registration_cta_text ) :?>
                                <div class="btn-holder register">
                                    <button class="button" type="submit"><?php echo $registration_cta_text; ?></button>
                                </div>
                                <div class="message"></div>
							<?php endif;
							$event_plan = get_field( "event_plan", $event_id ); ?>
                        </form>
                        <div class="message-holder success-message"></div>
					<?php else: ?>
                        <div class="message-holder info-message" class="wow fadeIn" data-wow-duration="1.3s"
                             data-wow-delay="0.15s">
                            <h2><?php _e( "Регистрация закрыта", "zdays" ); ?></h2>
                            <p><?php _e( "Следите за нашими обновлениями", "zdays" ); ?></p>
                        </div>
					<?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <?php $posts = get_posts( array(
	    'numberposts' => -1,
	    'post_type'      => 'event',
	    'meta_query'     => array(
		    'relation' => 'AND',
		    array(
			    'key'     => 'start_date',
			    'compare' => '<',
			    'value'   => $date_now,
			    'type'    => 'DATETIME'
		    ),
		    array(
			    'key'     => 'finish_date',
			    'compare' => '<',
			    'value'   => $date_now,
			    'type'    => 'DATETIME'
		    )
	    ),
	    'order'          => 'DESC',
	    'orderby'        => 'meta_value',
	    'meta_key'       => 'start_date',
	    'meta_type'      => 'DATETIME'
    ) ); ?>
    <?php if($posts) :?>
    <section class="content-row bg-custom">
        <div class="container">
            <?php $recent_events_title = get_field('recent_events_title');
            if($recent_events_title) :?>
                <h2 data-wow-duration="1.3s"><?php echo $recent_events_title;?></h2>
            <?php endif;?>
			<div class="slider-holder">
                <div class="slider swiper-container">
                    <section class="events swiper-wrapper">
						<?php foreach ( $posts as $post ): ?>
						<?php setup_postdata( $post );
						$event_id = $post->ID; ?>
                        <article class="event swiper-slide">
                            <div class="image">
                                <?php the_post_thumbnail(array(490, 300), array('alt'=>"image description"));?>
                                <div class="link-holder" data-id="<?php echo $event_id;?>" >
                                    <span class="link-more"><?php _e('Подробнее', 'zdays');?></span>
                                </div>
                            </div>
                            <h3><?php the_title();?></h3>
                            <?php $speakers = get_field('speaker', $event_id);
                            $number_speakers = count($speakers);
                            $i = 1;
                            if($speakers) : ?>
                            <p>Спикеры:
                                <?php foreach ($speakers as $speaker): ?>
                                    <?php
                                    $speaker_ID = $speaker->ID;
                                    $speaker_position = get_field('speaker_position', $speaker_ID);
                                    echo $speaker->post_title . " (" . $speaker_position . ")";
                                    if ($i !== $number_speakers) :
                                        echo ", ";
                                    endif;
                                    $i++;
                                endforeach;?>
                            </p>
                            <?php endif;?>
                        </article>
                        <?php endforeach; ?>
						<?php wp_reset_postdata(); ?>
                    </section>
                </div>
                <div class="swiper-arrows">
                    <span class="prev"><svg class="ico-prev"><use xlink:href="#ico-prev"></use></svg></span>
                    <span class="next"><svg class="ico-next"><use xlink:href="#ico-next"></use></svg></span>
                </div>
            </div>
            <?php
            $number_posts = count($posts);
            if ($number_posts > 6) :?>
                <!-- Show if events more than 6 -->
                <?php $recent_events_cta_text = get_field('recent_events_cta_text');
                if($recent_events_cta_text) :?>
<!--                <div class="btn-holder wow fadeIn" data-wow-duration="1.3s" data-wow-delay="0.15s">-->
<!--					<a class="button" href="#">--><?php //echo $recent_events_cta_text;?><!--</a>-->
<!--				</div>-->
                <?php endif;?>
	        <?php endif; ?>
        </div>
    </section>
    <?php endif;?>
</main>
<?php get_footer(); ?>

