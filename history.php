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

<?php get_sidebar(); ?>
<?php get_footer(); ?>