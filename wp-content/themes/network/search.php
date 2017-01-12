<?php get_header(); ?>

<div class="container">

	<div class="wrap clearfix">

		<main id="content" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">

			<h2 class="archive-title">
				<?php _e('Search results for', 'mighty') ?>: '<?php the_search_query(); ?>'
			</h2>

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<!-- Article -->
				<article <?php post_class(); ?> itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">

					<?php 
						$format = get_post_format(); 
						get_template_part( 'content', $format );
					?>

				</article>

			<?php endwhile; ?>

				<?php if ( $wp_query->max_num_pages > 1 ) : ?>

					<!--Pagination-->
					<div class="pagination">

						<?php if( function_exists( 'wp_pagenavi' ) ) : ?>

							<?php wp_pagenavi(); ?>

						<?php else : ?>

							<?php next_posts_link( '<span>&larr;</span> '.__( 'Older Posts', 'mighty' ).'' ); ?>
							<?php previous_posts_link( __( 'Newer Posts', 'mighty' ).' <span>&rarr;</span>' ); ?>

						<?php endif; ?>

					</div>

				<?php else : ?>

					<?php _e( 'Your search did not match any entries', 'mighty' ) ?>

				<?php endif; ?>

			<?php endif; ?>
		
		</main>

		<!--Sidebar-->
		<?php get_sidebar(); ?>
	
	</div>

</div>
			
<?php get_footer(); ?>

