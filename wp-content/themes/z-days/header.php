<!DOCTYPE HTML>
<!--[if IE 9 ]>
<html class="ie ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html <?php language_attributes(); ?>><!--<![endif]-->
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <![endif]-->
    <title><?php bloginfo( 'name' ); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="robots" content="noindex, nofollow"><!--  Replace with content="index, follow"> when site goes live -->
    <link rel="shortcut icon" href="favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i|Play:700" rel="stylesheet">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php get_template_part( 'inc/global/svg-socials' ) ?>
<div id="wrapper">
    <section class="visual">
        <div class="img-triangles">
            <img src=<?php echo get_template_directory_uri() . "/assets/images/img-decor1.png"; ?> alt="image description">
        </div>
        <div class="container">
			<?php
			$logo      = get_field( 'logo', 'options' );
			$logo_link = get_field( 'logo_link', 'options' );
			if ( $logo_link ): ?>
                <strong class="logo">
                    <a href="<?php echo $logo_link; ?>">
                        <img src="<?php echo $logo; ?>" alt="Z-day" width="250" height="261"/>
                    </a>
                </strong>
			<?php endif; ?>
			<?php
			$slogan = get_field( 'slogan', 'options' );
			if ( $slogan ) : ?>
                <h1><?php echo $slogan; ?></h1>
			<?php endif; ?>
			<?php if ( have_rows( 'topics', 'options' ) ): ?>
                <div class="container small-width">
                    <ul class="list-visual">
						<?php while ( have_rows( 'topics', 'options' ) ): the_row();
							$topic_image       = get_sub_field( 'topic_image' );
							$topic_title       = get_sub_field( 'topic_title' );
							$topic_description = get_sub_field( 'topic_description' );
							?>
                            <li class="topic">
                                <h2><?php echo $topic_title; ?></h2>
                                <p><?php echo $topic_description; ?></p>
                            </li>
						<?php endwhile; ?>
                    </ul>
					<?php $header_cta_link = get_field( 'header_cta_link', 'options' );
					if ( $header_cta_link ) :
						$header_cta_text = get_field( 'header_cta_text', 'options' ); ?>
                        <div class="btn-holder">
                            <a class="button" href="#main"><?php echo $header_cta_text; ?></a>
                        </div>
					<?php endif; ?>
                </div>
			<?php endif; ?>
        </div>
		<?php if ( have_rows( 'header_social_icons', 'options' ) ): ?>
            <ul class="social-networks">
            <?php while ( have_rows( 'header_social_icons', 'options' ) ) : the_row(); ?>
                <li>
                    <a href="<?php the_sub_field( 'header_social_link' ); ?>">
                        <svg class="icon <?php the_sub_field( 'header_social_image' ); ?>">
                            <use xlink:href="#<?php the_sub_field( 'header_social_image' ); ?>"></use>
                        </svg>
                    </a>
                </li>
		<?php endwhile;?>
            </ul>
		<?php endif; ?>
    </section>
