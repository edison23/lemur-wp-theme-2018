<?php get_header(); ?>

<?php
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

	<main role="main">
		<!-- section -->
		<section>

			<h2 class="font-sans text-center search-title"><?php single_cat_title('Články z kategorie „'); echo get_search_query(); echo '“'; ?></h2>

			<?php // get_template_part('loop'); ?>

			<?php if (have_posts()): while (have_posts()) : the_post(); ?>

				<!-- article -->
				<div class="clearfix archive-post border-bottom">
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<!-- post thumbnail -->
						<?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
							<div class="post-thumb float-left">
								<?php the_post_thumbnail('medium', array('class' => 'rounded')); // Declare pixel size you need inside the array ?>
							</div>
						<?php endif; ?>
						<!-- /post thumbnail -->

						<!-- post title -->
						<h3 class="title">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h3>
						<!-- /post title -->

						<!-- post details -->
						<div class="credits small-txt-75 font-sans">
							<span class="date"><?php the_time('j. n. Y'); ?> v <?php the_time('G:i'); ?></span>
							 | <span class="author"><?php the_author_posts_link(); ?></span>
						</div>
						<!-- /post details -->
						<div class="small-txt-75 excerpt">
							<?php html5wp_excerpt('html5wp_index'); // Build your custom callback length in functions.php ?>
						</div>

						<?php edit_post_link(); ?>

					</article>
				</div>
				<!-- /article -->

			<?php endwhile; ?>

			<?php else: ?>

				<!-- article -->
				<article>
					<h2 class="text-center">V této kategorii nemáme žádné články, omlouváme se.</h2>
				</article>
				<!-- /article -->

			<?php endif; ?>

			<?php get_template_part('pagination'); ?>

		</section>
		<!-- /section -->
	</main>

	<div class="row">
		<div class="category-sidebar font-sans small-txt-90 text-center mx-auto col-md-6 col-l-4 col-12">
			<?php get_sidebar(); ?>
		</div>
	</div>

<?php get_footer(); ?>

