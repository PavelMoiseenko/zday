<!DOCTYPE HTML>
<!--[if IE 9 ]>
<html class="ie ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html <?php language_attributes(); ?>><!--<![endif]-->
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
    <title><?php bloginfo('name'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="robots" content="noindex, nofollow"><!--  Replace with content="index, follow"> when site goes live -->
    <link rel="shortcut icon" href="favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i|Play:700" rel="stylesheet">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<svg style="display:none;">
    <symbol id="ico-facebook" viewBox="0 0 96.124 96.123">
        <path d="M72.089,0.02L59.624,0C45.62,0,36.57,9.285,36.57,23.656v10.907H24.037c-1.083,0-1.96,0.878-1.96,1.961v15.803
			c0,1.083,0.878,1.96,1.96,1.96h12.533v39.876c0,1.083,0.877,1.96,1.96,1.96h16.352c1.083,0,1.96-0.878,1.96-1.96V54.287h14.654
			c1.083,0,1.96-0.877,1.96-1.96l0.006-15.803c0-0.52-0.207-1.018-0.574-1.386c-0.367-0.368-0.867-0.575-1.387-0.575H56.842v-9.246
			c0-4.444,1.059-6.7,6.848-6.7l8.397-0.003c1.082,0,1.959-0.878,1.959-1.96V1.98C74.046,0.899,73.17,0.022,72.089,0.02z"/>
    </symbol>
    <symbol id="ico-twitter" viewBox="0 0 612 612">
        <path d="M612,116.258c-22.525,9.981-46.694,16.75-72.088,19.772c25.929-15.527,45.777-40.155,55.184-69.411
			c-24.322,14.379-51.169,24.82-79.775,30.48c-22.907-24.437-55.49-39.658-91.63-39.658c-69.334,0-125.551,56.217-125.551,125.513
			c0,9.828,1.109,19.427,3.251,28.606C197.065,206.32,104.556,156.337,42.641,80.386c-10.823,18.51-16.98,40.078-16.98,63.101
			c0,43.559,22.181,81.993,55.835,104.479c-20.575-0.688-39.926-6.348-56.867-15.756v1.568c0,60.806,43.291,111.554,100.693,123.104
			c-10.517,2.83-21.607,4.398-33.08,4.398c-8.107,0-15.947-0.803-23.634-2.333c15.985,49.907,62.336,86.199,117.253,87.194
			c-42.947,33.654-97.099,53.655-155.916,53.655c-10.134,0-20.116-0.612-29.944-1.721c55.567,35.681,121.536,56.485,192.438,56.485
			c230.948,0,357.188-191.291,357.188-357.188l-0.421-16.253C573.872,163.526,595.211,141.422,612,116.258z"/>
    </symbol>
    <symbol id="ico-instagram" viewBox="0 0 97.395 97.395">
        <path d="M12.501,0h72.393c6.875,0,12.5,5.09,12.5,12.5v72.395c0,7.41-5.625,12.5-12.5,12.5H12.501C5.624,97.395,0,92.305,0,84.895
			V12.5C0,5.09,5.624,0,12.501,0L12.501,0z M70.948,10.821c-2.412,0-4.383,1.972-4.383,4.385v10.495c0,2.412,1.971,4.385,4.383,4.385
			h11.008c2.412,0,4.385-1.973,4.385-4.385V15.206c0-2.413-1.973-4.385-4.385-4.385H70.948L70.948,10.821z M86.387,41.188h-8.572
			c0.811,2.648,1.25,5.453,1.25,8.355c0,16.2-13.556,29.332-30.275,29.332c-16.718,0-30.272-13.132-30.272-29.332
			c0-2.904,0.438-5.708,1.25-8.355h-8.945v41.141c0,2.129,1.742,3.872,3.872,3.872h67.822c2.13,0,3.872-1.742,3.872-3.872V41.188
			H86.387z M48.789,29.533c-10.802,0-19.56,8.485-19.56,18.953c0,10.468,8.758,18.953,19.56,18.953
			c10.803,0,19.562-8.485,19.562-18.953C68.351,38.018,59.593,29.533,48.789,29.533z"/>
    </symbol>
    <symbol id="ico-linkedin" viewBox="0 0 310 310">
        <path d="M72.16,99.73H9.927c-2.762,0-5,2.239-5,5v199.928c0,2.762,2.238,5,5,5H72.16c2.762,0,5-2.238,5-5V104.73
			C77.16,101.969,74.922,99.73,72.16,99.73z"/>
        <path d="M41.066,0.341C18.422,0.341,0,18.743,0,41.362C0,63.991,18.422,82.4,41.066,82.4
			c22.626,0,41.033-18.41,41.033-41.038C82.1,18.743,63.692,0.341,41.066,0.341z"/>
        <path d="M230.454,94.761c-24.995,0-43.472,10.745-54.679,22.954V104.73c0-2.761-2.238-5-5-5h-59.599
			c-2.762,0-5,2.239-5,5v199.928c0,2.762,2.238,5,5,5h62.097c2.762,0,5-2.238,5-5v-98.918c0-33.333,9.054-46.319,32.29-46.319
			c25.306,0,27.317,20.818,27.317,48.034v97.204c0,2.762,2.238,5,5,5H305c2.762,0,5-2.238,5-5V194.995
			C310,145.43,300.549,94.761,230.454,94.761z"/>
    </symbol>
</svg>
<div id="wrapper">
    <section class="visual">
        <div class="img-triangles">
            <img src=<?php echo get_template_directory_uri() . "/assets/images/img-decor1.png"; ?> alt="image
                    description">
        </div>
        <div class="container">
            <?php
            $logo = get_field('logo', 'options');
            $logo_link = get_field('logo_link', 'options');
            if ($logo_link): ?>
                <strong class="logo">
                    <a href="<?php echo $logo_link; ?>">
                        <img src="<?php echo $logo; ?>" alt="Z-day" width="250" height="261"/>
                    </a>
                </strong>
            <?php endif; ?>

            <?php
            $slogan = get_field('slogan', 'options');
            if ($slogan) : ?>
                <h1><?php echo $slogan; ?></h1>
            <?php endif; ?>


            <?php if (have_rows('topics', 'options')): ?>
                <div class="container small-width">
                    <ul class="list-visual">
                        <?php while (have_rows('topics', 'options')): the_row();
                            $topic_image = get_sub_field('topic_image');
                            $topic_title = get_sub_field('topic_title');
                            $topic_description = get_sub_field('topic_description');
                            ?>
                            <li class="topic">
                                <h2><?php echo $topic_title; ?></h2>
                                <p><?php echo $topic_description; ?></p>
                                <!--                            <img src="--><?php //echo $topic_image; ?><!--"/>-->
                            </li>
                        <?php endwhile; ?>
                    </ul>
                    <?php $header_cta_link = get_field('header_cta_link', 'options');
                    if ($header_cta_link) :
                        $header_cta_text = get_field('header_cta_text', 'options'); ?>
                        <div class="btn-holder">
                            <a class="button" href="<?php echo $header_cta_link; ?>"><?php echo $header_cta_text; ?></a>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
        <ul class="social-networks">
            <li>
                <a href="#">
                    <svg class="icon ico-facebook">
                        <use xlink:href="#ico-facebook"></use>
                    </svg>
                </a>
            </li>
            <li>
                <a href="#">
                    <svg class="icon ico-twitter">
                        <use xlink:href="#ico-twitter"></use>
                    </svg>
                </a>
            </li>
            <li>
                <a href="#">
                    <svg class="icon ico-instagram">
                        <use xlink:href="#ico-instagram"></use>
                    </svg>
                </a>
            </li>
            <li>
                <a href="#">
                    <svg class="icon ico-linkedin">
                        <use xlink:href="#ico-linkedin"></use>
                    </svg>
                </a>
            </li>
        </ul>
    </section>
