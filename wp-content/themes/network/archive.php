<?php get_header(); ?>

<div class="container">

	<div class="wrap clearfix">

		<main id="content" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">

			<h2 class="archive-title">

			<?php

				if ( is_category() ) {
					printf( __( 'Category: %s', 'mighty' ), single_cat_title( '', false ) );
				} elseif ( is_tag() ) {
				    printf( __( 'Tagged: %s', 'mighty' ), single_tag_title( '', false ) );
				} elseif ( is_author() ) {
					$user = get_user_by( 'email', get_the_author_meta( 'email' ) );
					printf( __( 'Author: %s', 'mighty' ), $user->display_name );
				} elseif ( is_day() ) {
				    printf( __( 'Day: %s', 'mighty' ), get_the_date() );
				} elseif ( is_month() ) {
				    printf( __( 'Month: %s', 'mighty' ), get_the_date( 'F Y' ) );
				} elseif ( is_year() ) {
				    printf( __( 'Year: %s', 'mighty' ), get_the_date( 'Y' ) );
				} else {
				    _e( 'Archives', 'mighty' );
				}

			?>
			
			</h2>

			<?php if ( is_author( $author ) ) : ?>

				<!-- Author -->
				<section class="author-bio clearfix" itemprop="author" itemscope="itemscope" itemtype="http://schema.org/Person">
					<?php echo get_avatar( get_the_author_meta( 'email' ), '75', get_the_author() ); ?>
					<h1 class="author-name" itemprop="name">
						<?php the_author_posts_link(); ?>
					</h1>
					<p class="author-description" itemprop="description">
						<?php the_author_meta( 'description' ); ?>
					</p>
				</section>

			<?php endif; ?>

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<!-- Article -->
				<article <?php post_class( 'clearfix' ); ?> itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">

					<?php 
						$format = get_post_format(); 
						get_template_part( 'content', $format );
					?>

				</article>

			<?php endwhile; ?>

				<?php if ( $wp_query->max_num_pages > 1 ) : ?>

					<!--Pagination-->
					<div class="pagination">

						<?php if ( function_exists( 'wp_pagenavi' ) ) : ?>

							<?php wp_pagenavi(); ?>

						<?php else : ?>

							<?php next_posts_link( '<span>&larr;</span> '.__( 'Older Posts', 'mighty' ).'' ); ?>
							<?php previous_posts_link( __( 'Newer Posts', 'mighty' ).' <span>&rarr;</span>' ); ?>

						<?php endif; ?>

					</div>

				<?php endif; ?>

			<?php endif; ?>
		
		</main>

		<!--Sidebar-->
		<?php get_sidebar(); ?>
	
	</div>
	
</div>
			
<?php get_footer(); ?>
