<?php get_header(); ?>

	<main role="main">
		<!-- section -->
		<section>

			<h2 class="font-sans text-center search-title"><?php echo sprintf('Výsledky hledání pro „', $wp_query->found_posts); echo get_search_query(); echo '“'; ?></h2>

			<?php // get_template_part('loop'); ?>

			<?php if (have_posts()):
				get_template_part('loop');
			else: ?>

				<!-- article -->
				<article>
					<h2 class="text-center">Hledaný výraz se nevyskytuje v žádném článku.</h2>
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
