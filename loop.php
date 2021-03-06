<?php

while (have_posts()) : the_post(); ?>

	<!-- article -->
	<div class="clearfix archive-post border-bottom">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<!-- post thumbnail -->
			<?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
				<div class="post-thumb float-left d-none d-md-block">
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
