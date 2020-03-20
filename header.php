<!doctype html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-133486467-1"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'UA-133486467-1');
		</script>

		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?> – <?php bloginfo( 'description' ); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
		<!-- <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed"> -->
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
		<link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_template_directory_uri(); ?>/img/icons/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_template_directory_uri(); ?>/img/icons/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/img/icons/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_template_directory_uri(); ?>/img/icons/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/img/icons/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_template_directory_uri(); ?>/img/icons/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/img/icons/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/img/icons/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/img/icons/apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo get_template_directory_uri(); ?>/img/icons/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon-16x16.png">
		<!-- <link rel="manifest" href="/img/icons/manifest.json"> -->
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
		<meta name="theme-color" content="#ffffff">

		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/style.css?version=6" />

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">

		<?php wp_head(); ?>
		<script>
        // conditionizr.com
        // configure environment tests
        conditionizr.config({
            assets: '<?php echo get_template_directory_uri(); ?>',
            tests: {}
        });
        </script>

	</head>
	<body <?php body_class(); ?>>

		<!-- wrapper -->
		<div class="wrapper">
			<div class="container">

				<!-- header -->
				<header class="header clear font-sans" role="banner">
					<?php
						$site_title = get_bloginfo( 'name' );
						$site_description = get_bloginfo( 'description' );
					?>


						<!-- logo -->
						<div class="logo">
							<a href="<?php echo home_url(); ?>">
								<!-- svg logo - toddmotto.com/mastering-svg-use-for-a-retina-web-fallbacks-with-png-script -->
								<img id="site-logo" src="<?php echo get_template_directory_uri(); ?>/img/lemur-logo-2020-02.plain.svg" alt="site logo">
								<!-- <img scr="<?php echo get_template_directory_uri(); ?>/img/logo-lemur-sign-with-drawing.svg)" alt="Logo" class="logo-img"> -->
								<!-- <img scr="http://lemur.kmurtinger.cz/subdom/lemur/wp-content/themes/wp-theme-lemur-2018/img/logo-lemur-sign-with-drawing.svg" alt="Logo" class="logo-img"> -->
								<h1 id="site-name"><?php echo $site_title; ?></h1>

								<h2 class="site-description donthyphenate"><?php echo $site_description; ?></h2>
							</a>
						</div>
						<!-- /logo -->

						<!-- nav -->
						<nav class="nav bg-colorful small-txt-90 rounded donthyphenate" role="navigation">
							<div id="categories_nav" class="float-lg-left">
								<?php lemurcategories_nav(); ?>
							</div>
							<!-- the right block items are stacking from the right so the right-most must be 1st (same goes for the contents of the block) -->
							<div id="sociaal-icons" class="float-lg-right">
								<!-- The icons are not named e.g. "facebook.svg" because uBlock Origin blocks them by default for some reason if there's a full soc. site name. -->
								<a target="_blank" href="https://twitter.com/lemur_mu"><img class="soc-icon" src="<?php echo get_template_directory_uri(); ?>/img/icons/logo-tw.svg"></a>
								<a target="_blank" href="https://www.instagram.com/lemur_mu"><img class="soc-icon" src="<?php echo get_template_directory_uri(); ?>/img/icons/logo-inst.svg"></a>
								<a target="_blank" href="https://www.facebook.com/LeMUr.mu"><img class="soc-icon" src="<?php echo get_template_directory_uri(); ?>/img/icons/logo-fb.svg"></a>
							</div>
							<div id="pages_nav" class="float-lg-right">
								<?php lemurpages_nav(); ?>
							</div>
						</nav>
						<!-- /nav -->

				</header>
				<!-- /header -->


<?php

?>