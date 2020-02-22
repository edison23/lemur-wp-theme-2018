<?php
/*
Template Name: Historie Lemura 
*/
get_header(); ?>

<div id="container">
	<div id="content" role="main">

		<?php the_post(); ?>
		<h1 class="entry-title"><?php the_title(); ?></h1>
		
		<ul id="archives-list">
			<?php wp_get_archives('type=monthly'); ?>
		</ul>

	</div><!-- #content -->
</div><!-- #container -->

<div class="row">
	<div class="category-sidebar font-sans small-txt-90 text-center mx-auto col-md-6 col-l-4 col-12">
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>
