<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="wrapper">

    <header id="masthead" class="site-header" role="banner">
        <div class="site-branding">
            <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"
                                      rel="home"><?php bloginfo('name'); ?></a></h1>

            <!--LOGO-->
            <?php
            $logo = get_field('logo', 'options');
            if ($logo): ?>
                <img src="<?php echo $logo; ?>"/>
            <?php endif; ?>

            <!--SLOGAN-->
            <?php
            $slogan = get_field('slogan', 'options');
            if ($slogan) : ?>
                <h1><?php echo $slogan; ?></h1>
            <?php endif; ?>

            <!--TOPICS-->
            <?php if (have_rows('topics', 'options')): ?>
                <ul class="topics">
                    <?php while (have_rows('topics', 'options')): the_row();
                        $topic_image = get_sub_field('topic_image');
                        $topic_title = get_sub_field('topic_title');
                        $topic_description = get_sub_field('topic_description');
                        ?>

                        <li class="topic">
                            <?php echo $topic_image; ?>
                            <?php echo $topic_title; ?>
                            <?php echo $topic_description; ?>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php endif; ?>

            <!--Social icons-->
            <?php if (have_rows('header_social_icons', 'options')): ?>
                <ul class="icons">
                    <?php while (have_rows('header_social_icons', 'options')): the_row();
                        $header_social_image = get_sub_field('header_social_image');
                        $header_social_link = get_sub_field('header_social_link'); ?>

                        <li class="icon">
                            <?php if ($header_social_link): ?>
                                <a href="<?php echo $header_social_link; ?>">
                                    <img src="<?php echo $header_social_image; ?>"/>
                                </a>
                            <?php endif; ?>
                        </li>

                    <?php endwhile; ?>
                </ul>

            <?php endif; ?>

            <!--CTA-->
            <?php $header_cta_link = get_field('$header_cta_link', 'options');
            if ($header_cta_link) :
                $header_cta_text = get_field('$header_cta_text', 'options');?>
                <a href="<?php echo $header_cta_link;?>"><?php echo $header_cta_text;?></a>
            <?php endif; ?>

        </div>
    </header>
    <?php
    $args = array(
        'theme_location' => 'primary',
        'menu' => '',
        'container' => 'nav',
        'container_class' => '',
        'container_id' => '',
        'menu_class' => 'main-menu',
        'menu_id' => 'main-menu',
        'echo' => true,
        'fallback_cb' => 'wp_page_menu',
        'before' => '',
        'after' => '',
        'link_before' => '',
        'link_after' => '',
        'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
        'depth' => 0,
        'walker' => new CustomWalkerNavMenu
    );
    if (has_nav_menu('primary')) {
        wp_nav_menu($args);
    }
    ?>

    <div id="content" class="site-content">
