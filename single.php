<?php get_header(); ?>

	<main role="main">
	<!-- section -->
	<section>

	<?php if (have_posts()): while (have_posts()) : the_post(); ?>

		<!-- article -->
		<article class="single-post" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="row">
				<div class="col-xl-9 col-12 mx-auto">
					<!-- post title -->
					<h1>
						<?php the_title(); ?>
					</h1>
					<!-- /post title -->
					<!-- post excerpt -->
					<div id="excerpt">
						<p><strong><?php html5wp_excerpt(); ?></strong></p>
					</div>
					<!-- /post excerpt -->
					<!-- post thumbnail -->
					<?php if ( has_post_thumbnail()) : // Check if Thumbnail exists ?>
						<div class="post-thumb"><?php the_post_thumbnail('large'); // Fullsize image for the single post ?>
							<?php if (the_post_thumbnail_caption()): ?>
								<div class="thumb-caption font-sans small-txt-90">
									<?php the_post_thumbnail_caption(); ?>
								</div>
							<?php endif; ?>
						</div>
					<?php endif; ?>
					<!-- /post thumbnail -->
				</div>
			</div>
			<div class="row">
				<div class="col-xl-8 col-l-9 col-12">
					<?php the_content(); // Dynamic Content ?>
					<?php edit_post_link(); // Always handy to have Edit Post Links available ?>
					<?php $post_post = get_post($post, 'display'); ?>
				</div>
				<div class="post-sidebar col-xl-4 col-l-3 col-12 small-txt-90 font-sans">
					<!-- post details -->
					<div class="post-meta">
						<p class="post-author"><?php the_author_posts_link(); ?>, <?php the_time('j. n. Y'); ?> v <?php the_time('G:i'); ?></p>
						<p>Rubriky: 
							<?php 
								$post_cats = list_categories('a', '', apply_filters('the_category', $post_post->post_category), ', '); // Category links separated by commas 
								echo $post_cats; 
							?>
						</p>
						<p><?php the_tags( 'Štítky: ', ', ', ''); // Separated by commas with nothing at the end (last param) ?></p>
					</div>
					<?php
						// end of the get post while loop
						endwhile; 
						
						$tag_objects = get_the_tags(get_the_ID());
						if (get_the_tags()):
							$tag_slugs = array();
							foreach ($tag_objects as $tag) {
								$tag_slugs[] = $tag -> slug;
							}
							$params = array(
								'tag_slug__in' => $tag_slugs,
								'post__not_in' => array( get_the_ID() ),
								'orderby' => 'rand',
								'posts_per_page' => 6,
								'no_found_rows' => true
							);
							wp_reset_query();
							$query_related = new WP_Query( $params ); 
							if ($query_related->have_posts()) : 
							?>
								<div class="related-posts bg-colorful rounded">
									<h3 class="related">Související články</h3>
									<?php
										while ($query_related->have_posts()) : 
											$query_related->the_post(); 
											echo '<p><a href="' . get_permalink() .'" target="_self">' . get_the_title() . '</a></p>';
										endwhile;
									?>
								</div>
								<?php
							endif;
						endif; 
						?>
					<div class="sidebar-sidebar">
						<?php get_sidebar(); ?>
					</div>
				</div>
			</div>
		</article>
		<!-- /article -->

	<?php else: ?>

		<!-- article -->
		<article>

			<h2><?php echo('Článek se nepodařilo zobrazit, omlouváme se.'); ?></h2>

		</article>
		<!-- /article -->

	<?php endif; ?>

		

	</section>
	<!-- /section -->
	</main>



<?php get_footer(); ?>