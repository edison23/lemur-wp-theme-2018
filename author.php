<?php get_header(); ?>

	<main role="main">
		<!-- section -->
		<section>

		<?php if (have_posts()): the_post(); ?>

			<h2 class="font-sans text-center search-title">Články autora <?php echo get_the_author(); ?></h2>

		<?php if ( get_the_author_meta('description')) : ?>

		<?php echo get_avatar(get_the_author_meta('user_email')); ?>

			<h2><?php echo ('O autorovi: ' . get_the_author()) ; ?></h2>

			<?php echo wpautop( get_the_author_meta('description') );

			endif; 
			
			rewind_posts(); 
			get_template_part('loop');
			
			else: ?>

			<!-- article -->
			<article>
				<h2 class="text-center">Od tohoto autora nemáme žádné články.</h2>
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
