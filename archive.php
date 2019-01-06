<?php get_header(); ?>

	<main role="main">
		<!-- section -->
		<section>

			<h2 class="font-sans text-center search-title">Archiv článků pro období:<br><span class="lower-case"><?php echo $GLOBALS['wp_locale']->get_month($monthnum) . ' ' . get_query_var('year');; ?></span></h2>

			<?php // get_template_part('loop'); ?>

			<?php if (have_posts()):
				get_template_part('loop');
			else: ?>

				<!-- article -->
				<article>
					<h2 class="text-center">Pro toto období nemáme žádné články.</h2>
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
