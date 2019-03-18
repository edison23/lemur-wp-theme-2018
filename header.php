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
        <!-- <link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon-v3.png" rel="shortcut icon"> -->
        <!-- <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed"> -->
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">
        <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="msapplication-TileColor" content="#2b5797">
        <meta name="theme-color" content="#ffffff">

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
								<img id="site-logo" src="<?php echo get_template_directory_uri(); ?>/img/logo-lemur-sign-with-drawing.png" alt="site logo">
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
							<div id="pages_nav" class="float-lg-right">
								<?php lemurpages_nav(); ?>
							</div>
						</nav>
						<!-- /nav -->

				</header>
				<!-- /header -->


<?php
	
?>