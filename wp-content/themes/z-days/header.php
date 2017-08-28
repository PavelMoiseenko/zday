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
<symbol id="ico-prev" viewBox="0 0 32.635 32.635">
    <path d="M32.135,16.817H0.5c-0.276,0-0.5-0.224-0.5-0.5s0.224-0.5,0.5-0.5h31.635c0.276,0,0.5,0.224,0.5,0.5
			S32.411,16.817,32.135,16.817z"/>
    <path d="M13.037,29.353c-0.128,0-0.256-0.049-0.354-0.146L0.146,16.669C0.053,16.575,0,16.448,0,16.315s0.053-0.26,0.146-0.354
			L12.684,3.429c0.195-0.195,0.512-0.195,0.707,0s0.195,0.512,0,0.707L1.207,16.315l12.184,12.184c0.195,0.195,0.195,0.512,0,0.707
			C13.293,29.304,13.165,29.353,13.037,29.353z"/>
</symbol>
<symbol id="ico-next" viewBox="0 0 32.635 32.635">
    <path d="M32.135,16.817H0.5c-0.276,0-0.5-0.224-0.5-0.5s0.224-0.5,0.5-0.5h31.635c0.276,0,0.5,0.224,0.5,0.5
			S32.411,16.817,32.135,16.817z"/>
    <path d="M19.598,29.353c-0.128,0-0.256-0.049-0.354-0.146c-0.195-0.195-0.195-0.512,0-0.707l12.184-12.184L19.244,4.136
			c-0.195-0.195-0.195-0.512,0-0.707s0.512-0.195,0.707,0l12.537,12.533c0.094,0.094,0.146,0.221,0.146,0.354
			s-0.053,0.26-0.146,0.354L19.951,29.206C19.854,29.304,19.726,29.353,19.598,29.353z"/>
</symbol>
<symbol id="ico-close" viewBox="0 0 94.926 94.926">
    <path d="M55.931,47.463L94.306,9.09c0.826-0.827,0.826-2.167,0-2.994L88.833,0.62C88.436,0.224,87.896,0,87.335,0
			c-0.562,0-1.101,0.224-1.498,0.62L47.463,38.994L9.089,0.62c-0.795-0.795-2.202-0.794-2.995,0L0.622,6.096
			c-0.827,0.827-0.827,2.167,0,2.994l38.374,38.373L0.622,85.836c-0.827,0.827-0.827,2.167,0,2.994l5.473,5.476
			c0.397,0.396,0.936,0.62,1.498,0.62s1.1-0.224,1.497-0.62l38.374-38.374l38.374,38.374c0.397,0.396,0.937,0.62,1.498,0.62
			s1.101-0.224,1.498-0.62l5.473-5.476c0.826-0.827,0.826-2.167,0-2.994L55.931,47.463z"/>
</symbol>

<div id="wrapper">
    <section class="visual">
        <div class="img-triangles">
            <div class="layer" data-rellax-speed="50">
                <img class="wow fadeInDown" data-wow-duration="1.5s" src=<?php echo get_template_directory_uri() . "/assets/images/img-decor1-1.png";?> alt="image description">
            </div>
            <div class="layer" data-rellax-speed="4">
                <img class="wow fadeInDown" data-wow-duration="1.5s" src=<?php echo get_template_directory_uri() . "/assets/images/img-decor1-2.png";?> alt="image description">
            </div>
        </div>
        <div class="container fadeIn wow" data-wow-duration="2s" data-wow-delay="0.5s">
			<?php
			$logo      = get_field( 'logo', 'options' );
			$logo_link = get_field( 'logo_link', 'options' );
			if ( $logo_link ): ?>
                <strong class="logo">
                    <a href="<?php echo $logo_link; ?>" target="_blank">
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
            <ul class="social-networks wow fadeIn" data-wow-duration="1.5s" data-wow-delay="0.5s">
            <?php while ( have_rows( 'header_social_icons', 'options' ) ) : the_row(); ?>
                <li>
                    <a href="<?php the_sub_field( 'header_social_link' ); ?>" target="_blank">
                        <svg class="icon <?php the_sub_field( 'header_social_image' ); ?>">
                            <use xlink:href="#<?php the_sub_field( 'header_social_image' ); ?>"></use>
                        </svg>
                    </a>
                </li>
		<?php endwhile;?>
            </ul>
		<?php endif; ?>
    </section>
