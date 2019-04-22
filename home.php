<?php
/**
 * The template for displaying an overview of posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Winslow
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

		<div class="posts-grid">

			<?php while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'archive' );

			endwhile; ?>

		</div>

			<?php
			winslow_pagination();

		endif; ?>

		</main>
	</div>

<?php
get_footer();
