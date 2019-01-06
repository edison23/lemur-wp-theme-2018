<!doctype html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?> – <?php bloginfo( 'description' ); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
        <!-- <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed"> -->

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
								<img id="site-logo" src="<?php echo get_template_directory_uri(); ?>/img/logo-lemur-sign-with-drawing.svg" alt="site logo">
								<!-- <img scr="<?php echo get_template_directory_uri(); ?>/img/logo-lemur-sign-with-drawing.svg)" alt="Logo" class="logo-img"> -->
								<!-- <img scr="http://lemur.kmurtinger.cz/subdom/lemur/wp-content/themes/wp-theme-lemur-2018/img/logo-lemur-sign-with-drawing.svg" alt="Logo" class="logo-img"> -->
								<h1 id="site-name"><?php echo $site_title; ?></h1>

								<h2 class="site-description"><?php echo $site_description; ?></h2>
							</a>
						</div>
						<!-- /logo -->

						<!-- nav -->
						<nav class="nav bg-colorful small-txt-90 rounded" role="navigation">
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
	function exclude_post_categories($excl='', $spacer=' ') {
	  $categories = get_the_category($post->ID);
	  if (!empty($categories)) {
	    $exclude = $excl;
	    $exclude = explode(",", $exclude);
	    $thecount = count(get_the_category()) - count($exclude);
	    foreach ($categories as $cat) {
	      $html = '';
	      if (!in_array($cat->cat_ID, $exclude)) {
	        $html .= '<a href="' . get_category_link($cat->cat_ID) . '" ';
	        $html .= 'title="' . $cat->cat_name . '">' . $cat->cat_name . '</a>';
	        if ($thecount > 0) {
	          $html .= $spacer;
	        }
	        $thecount--;
	        echo $html;
	      }
	    }
	  }
	};

	//function to create HTML elements from a list of category IDs
	// expects $el (string, e.g. "div"), $classes (string, e.g. "cat blue") and $cats (array with integer IDs of categories)
	// excludes category named "Slider" (ID 1657) and long term relevant (ID 1967) (as that's something we never want to list to a user)
	function list_categories($el='', $classes='', $cats='0', $delim=', ') {
		$out = '';
		$i = 0;
		while ($cats[$i]):
			$cat_name = get_the_category_by_ID($cats[$i]);
			$cat_link = get_category_link($cats[$i]);
			if (($cats[$i] != 1657) && ($cats[$i] != 1967)){
				// determine whether the element is a link so we need to generate href attribute
				if ($el == 'a') {
					$cat_href_attr = ' href="' . $cat_link . '" ';
				}
				else {
					$cat_href_attr = '';
				}
				// when the current category is the last one, replace the delimiter by an empty string so we don't place it after the last category
				if (!$cats[$i+1]) {
					$delim = '';
				}
				$cat_element = '<' . $el . $cat_href_attr . ' class="' . $classes . '">' . $cat_name . '</' . $el . '>';
				$out = $out . $cat_element . $delim;
			}
			$i += 1;
		endwhile;
		return $out;
	};

	function excerpt_str_by_words($string, $chars) {
		if (strlen($string) < $chars) {
		     return $string;
		} else {
		   $short = wordwrap($string, $chars);
		   $short = explode("\n", $short);
		   $short = $short[0] . '…';
		   return $short;
		};
	};
?>