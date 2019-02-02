<?php
	function get_articles($params) {
		// $params[ 'category_name' ] = $cat_name;
		$query_result = new WP_Query( $params ); 
		return $query_result;
	};

	function print_articles_thumb_and_title($articles, $limit) {
		$limit -= 1; // substracting one to print only the number of files specified and not one more because the array indexing starts at 0 and humans count from 1
		$i = 0;
		while (($articles[$i]) && ($i <= $limit)):
			echo '<div class="clearfix main-pg-cat-post rounded">';
			$post = get_post($articles[$i]);
			echo '<img class="post-thumb rounded float-left" src="' . get_the_post_thumbnail_url($articles[$i], 'thumbnail') . '"><h3 class="small-txt-90"><a href="' . get_permalink($articles[$i]) . '" >' . apply_filters( 'the_title', $post->post_title ) . '</a></h3>';
			$i += 1;
			echo '</div>';
		endwhile;
	}

	function get_long_term_relevance_posts($ltr_cat, $limit) {
		$lemur_config = lemur_load_config();
		$query_params = array(
			'category_name' => $ltr_cat ,
			'posts_per_page' => $limit,
			'no_found_rows' => true
		);
		$posts = get_articles($query_params);
		return $posts;
	}
	
	// function to get metadata being displayed in the main page article lists
	function retrieve_post_meta($post, $thumb_size, $excrpt_len) {
		// get the post object by its ID we got from the DB by wp_query earlier
		$post_post = get_post($post, 'display');
		$post_author = get_user_by('id', apply_filters('the_author', $post_post->post_author))->display_name;

		$post_categories = list_categories('div', 'categories small-txt-75', apply_filters('the_category', $post_post->post_category), '');
		$post_date = get_the_date('', $post);
		$post_excerpt = excerpt_str_by_words(apply_filters('the_excerpt', $post_post->post_excerpt), $excrpt_len);
		$post_link = get_permalink($post);
		$post_thumb = get_the_post_thumbnail_url($post, $thumb_size);
		$post_title = apply_filters( 'the_title', $post_post->post_title );

		$out = array(
			author => $post_author, 
			categories => $post_categories, 
			date => $post_date, 
			excerpt => $post_excerpt, 
			link => $post_link, 
			thumb => $post_thumb, 
			title => $post_title
		);
		return $out;
	}

	// function to insert a post beneath the main "slider" post (currently two posts, each in a separate box)
	function insert_prominent_article($post) {
		$post_meta = retrieve_post_meta($post, 'large', 500);
		echo $post_meta[categories]; 
	?>
		<div class="thumb">
			<a href="<?php echo $post_meta[link]; ?>"><img class="rounded post-thumb mx-auto d-block" src="<?php echo $post_meta[thumb]; ?>"></a>
		</div>
		<div class="prominent-post-content">
			<h2 id="prominent-post-title"><a href="<?php echo $post_meta[link]; ?>"><?php echo $post_meta[title]; ?></a></h2>
			<div class="credits small-txt-75 font-sans">
				<span class="date"><?php echo $post_meta[date]; ?></span>
				 | <span class="author"><?php echo $post_meta[author]; ?></span>
			</div>
			<div id="excerpt">
				<p><?php echo $post_meta[excerpt]; ?></p>
			</div>
		</div>
	<?php
	}

	// ===================================================================== //
	// beginning of the WP loop that gets articles, sorts them by categories and prints them to the main page

	// loading configuration (from config.json)
	$lemur_config = lemur_load_config();

	// setting up wp_query parametrs for the main page
	$query_params = array(
		'posts_per_page' => 150,
		'no_found_rows' => true
	);

	// intialize arrays for storing posts from various categories displayed on main page
	$kratke = array();
	$prominent_posts = array();
	$slider = array();
	$student = array();
	$univerzita = array();

	// iterator for limiting number of articles in the prominent posts area below the hero area ("slider")
	$j = 0; 

	// get the newest posts from the DB according to the parameters from above
	$main_posts = get_articles($query_params);

	// sort out the posts by category
	while ($main_posts->have_posts()):
		$main_posts->the_post();

		// the 1st condition whether to put a post into the prominent category tests for following:
		// a post must NOT be in 'kratke_zpravy' AND (the slider (hero) must be already full OR the tested post is not supposed to be in the slider, thus would never got there even if we skipped it here and it would go straight to the category columns beneath the prominent area)
		if (((!in_category($lemur_config['category_slugs']['kratke'])) && (($slider[0] != NULL) || (!in_category($lemur_config['category_slugs']['slider'])))) && ($j < 2)):
			$prominent_posts[] = get_the_ID();
			$j += 1;
		elseif ((in_category($lemur_config['category_slugs']['slider'])) && (!in_category($lemur_config['category_slugs']['kratke'])) && ($slider[0] == NULL)):
			$slider[] = get_the_ID();
		elseif ((in_category($lemur_config['category_slugs']['univerzita'])) && (!in_category($lemur_config['category_slugs']['kratke']))):
			$univerzita[] = get_the_ID();
		elseif ((in_category($lemur_config['category_slugs']['studentsky'])) && (!in_category($lemur_config['category_slugs']['kratke']))):
			$student[] = get_the_ID();
		elseif (in_category($lemur_config['category_slugs']['kratke'])):
			$kratke[] = get_the_ID();
		endif;
	endwhile;

?>

<!-- featured article (legacy name: slider) -->
<?php
	
?>
<div id="main-pg-featured-post" class="row border-bottom">
	<?php $post_meta = retrieve_post_meta($slider[0], 'large', 500); ?>
	<div class="thumb col-md-5">
		<a href="<?php echo $post_meta[link]; ?>"><img class="rounded post-thumb" src="<?php echo $post_meta[thumb]; ?>"></a>
	</div>
	<div class="col-md-7">
		<div class="post-head col-12">
			<?php echo $post_meta[categories]; ?>
			<h2 id="featured-post-title" class="txt-lemur"><a href="<?php echo $post_meta[link]; ?>"><?php echo $post_meta[title]; ?></a></h2>
		</div>
		<div class="post-meta-n-excerpt d-none d-lg-block">
			<div class="credits small-txt-75 font-sans">
				<span class="date"><?php echo $post_meta[date]; ?></span>
				 <!-- | <span class="author"><?php // echo $post_meta[author]; ?></span> -->
				 | <span class="author"><?php echo $post_meta[author]; ?></span>
			</div>
			<div class="excerpt">
				<p><?php echo $post_meta[excerpt]; ?></p>
			</div>
		</div>
	</div>
	<div class="post-meta-n-excerpt d-block d-lg-none col-12">
		<div class="credits small-txt-75 font-sans">
			<span class="date"><?php echo $post_meta[date]; ?></span>
			 <!-- | <span class="author"><?php // echo $post_meta[author]; ?></span> -->
			 | <span class="author"><?php echo $post_meta[author]; ?></span>
		</div>
		<div class="excerpt">
			<p><?php echo $post_meta[excerpt]; ?></p>
		</div>
	</div>
</div>

<div id="main-pg-prominent-articles">
	<div class="row justify-content-md-center">
		<div class="col-md-5 post-card">
			<?php insert_prominent_article($prominent_posts[0]); ?>
		</div>
		<div class="col-md-5 post-card">
			<?php insert_prominent_article($prominent_posts[1]); ?>
		</div>
	</div>
</div>

<div id="main-pg-categories" class="border-top">
	<h2 class="font-sans text-center">Možná jste ještě nečetli</h2>

	<div class="row">
		<div class="col-md-4">
			<div class="main-pg-category">
				<h2 class="main-pg-category-title border-bottom font-sans small-txt-90">Univerzita</h2>
				<?php
					print_articles_thumb_and_title($univerzita, 5)
				?>
			</div>
		</div>
		<div class="col-md-4">
			<div class="main-pg-category">
				<h2 class="main-pg-category-title border-bottom font-sans small-txt-90">Studentský život</h2>
				<?php
					print_articles_thumb_and_title($student, 5)
				?>
			</div>
		</div>
		<div class="col-md-4">
			<div class="main-pg-category">
				<h2 class="main-pg-category-title border-bottom font-sans small-txt-90">Krátké zprávy</h2>
				<?php
					print_articles_thumb_and_title($kratke, 5)
				?>
			</div>
		</div>
	</div>
</div>

<div id="long-time-relevance-and-imprint">
	<?php
		$long_term_relevance_posts = get_long_term_relevance_posts($lemur_config['category_slugs']['dlouhodobe'], 7);
		$lemur_config = lemur_load_config();
	?>
	<div class="row">
		<div class="col-lg-8 col-md-7 border-top">
			<h2 class="font-sans">Mohlo by vás zajímat</h2>
			<div id="ltr-posts">
				<?php
					while ($long_term_relevance_posts->have_posts()):
						$long_term_relevance_posts->the_post(); ?>
						<h3 class="small-txt-90"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<?php endwhile; ?>
					<div id="ltr-posts-all-link" class="bg-gray text-center small-txt-90 border-top font-sans">
						<a href="category/<?php echo $lemur_config['category_slugs']['dlouhodobe']; ?>/">Všechny dlouhodobě zajímavé články</a>
					</div>
			</div>
		</div>
		<div class="col-lg-4 col-md-5 bg-gray font-sans small-txt-90">
			<?php get_sidebar(); ?>
		</div>
	</div>
</div>

	