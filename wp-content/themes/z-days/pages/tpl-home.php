<?php /* Template Name: Home Template */ ?>

<?php get_header(); ?>
<main id="main" class="clearfix">
    <section class="content-row intro-holder">
        <div class="img-triangles">
            <img src=<?php echo get_template_directory_uri() . "/assets/images/img-decor2.png"; ?> alt="image
                 description">
        </div>
        <div class="container small-width">

			<?php
			$event_section_title       = get_field( 'event_section_title' );
			$event_section_description = get_field( 'event_section_description' );
			if ( $event_section_title ) :?>
                <div class="intro">
                    <h2><?php echo $event_section_title; ?></h2>
					<?php if ( $event_section_description ) : ?>
                        <p><?php echo $event_section_description; ?></p>
					<?php endif; ?>
                </div>
			<?php endif; ?>

			<?php
			$event_caption = get_field( 'event_caption' );
			if ( $event_caption ) :?>
                <h2><?php echo $event_caption; ?></h2>
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
                        <header class="heading">
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
                            <div class="image">
                                <img src=<?php echo get_template_directory_uri() . "/assets/images/git-cat.png"; ?> alt="git"
                                     width="390" height="520">
                            </div>
                            <div class="description">
								<?php the_content(); ?>
                            </div>
                        </div>
						<?php
						if ( $registration_cta_text ) :?>
                            <div class="btn-holder">
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
            <img src=<?php echo get_template_directory_uri() . "/assets/images/img-decor3.png"; ?> alt="image
                 description">
        </div>
        <div class="container small-width">
			<?php
			$speaker_section_title = get_field( 'speaker_section_title' );
			if ( $speaker_section_title ) :?>
                <h2><?php echo $speaker_section_title; ?></h2>
			<?php endif; ?>

			<?php $speakers = get_field( 'speaker', $event_id );
			if ( $speakers ): ?>
                <ul class="thumb-list">
					<?php foreach ( $speakers as $post ): ?>
						<?php setup_postdata( $post ); ?>
                        <li>
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
            <img src=<?php echo get_template_directory_uri() . "/assets/images/img-decor4.png"; ?> alt="image
                 description">
        </div>
        <div class="img-decor">
            <img src=<?php echo get_template_directory_uri() . "/assets/images/git-cat.png"; ?> alt="git" width="390"
                 height="520">
        </div>
        <div class="container">
            <div class="form-holder">
				<?php $registration_title = get_field( 'registration_title' );
				if ( $registration_title ) :?>
                    <h2><?php echo $registration_title; ?></h2>
				<?php endif; ?>
                <div class="box with-logo form-box">
					<?php $is_registration_on = get_field( 'is_registration_on' );
					if ( $is_registration_on['value'] === '1' && $post_registration_opening ) :?>
                        <form class="form" action="#" novalidate>
                            <div class="form-row">
                                <div class="form-field">
                                    <label for="name-field">Имя *</label>
                                    <input class="name" type="text" id="name-field" name="nameField" required>
                                    <!--                                        <span class="name-err"></span>-->
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-field">
                                    <label for="surname-field">Фамилия *</label>
                                    <input class="surname" type="text" id="surname-field" name="surnameField" required>
                                    <!--                                        <span class="surname-err"></span>-->
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-field">
                                    <label for="email-field">Email *</label>
                                    <input class="email" type="email" id="email-field" name="emailField" required>
                                    <!--                                        <span class="email-err"></span>-->
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-field">
                                    <label for="specialization-field">Специализация *</label>
                                    <input class="specialization" type="text" id="specialization-field"
                                           name="specializationField" required>
                                    <!--                                        <span class="specialization-err"></span>-->
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-field">
                                    <label for="tel-field">Телефон</label>
                                    <input class="telephone" type="tel" id="tel-field" name="telField" required>
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
							<?php endif; ?>
                        </form>
                        <div class="message-holder success-message">
                            <h2>Ваша регистрация прошла успешно!</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua.</p>
							<?php $event_plan = get_field( "event_plan", $event_id );
							if ( $event_plan ) :?>
                                <div class="btn-holder">
                                    <a class="button" target="_blank" href="<?php echo $event_plan['url']; ?>">Скачать
                                        план мероприятия</a>
                                </div>
							<?php endif; ?>
                        </div>git
					<?php else: ?>
                        <div class="message-holder info-message">
                            <h2>Регистрация закрыта</h2>
                            <p>Следите за нашими обновлениями</p>
                        </div>
					<?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</main>
<?php get_footer(); ?>

