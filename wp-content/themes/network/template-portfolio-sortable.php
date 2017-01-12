<?php /* Template Name: Portfolio (Sortable) */ ?>

<?php get_header(); ?>

<div class="container" style="background-color:#f7f7f7 !important">
	<div class="wrap clearfix">

		<main id="content"  class="full-width" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">

			<div class="clearfix">

				<?php
					$args = array(
						'post_type' => 'portfolio',
						'order' => 'DESC',
						'posts_per_page' => -1
					);

					$wp_query = new WP_Query( $args );
				?>

				<?php if ( $wp_query->have_posts() ) : ?>

					<?php $terms = get_terms( 'portfolio-type' ); ?>
					<?php if ( !empty( $terms ) ) : ?>

				
				<h2 class="home-h2">Conheça quem já faz parte da comunidade</h2>

					<!-- Filters -->
					<div class="portfolio-filter clearfix">
						<ul>
							<li><a href="<?php get_permalink( $portfolio ); ?>" class="active" data-filter="*"><?php _e( 'Todos', 'mighty' ); ?></a></li>
							<?php foreach( $terms as $term ) : ?>
							<li><a href="<?php get_term_link( $term ); ?>" data-filter=".<?php echo $term->slug; ?>"><?php echo $term->name; ?></a></li>
							<?php endforeach; ?>
						</ul>
					</div>
					
					<?php endif; ?>

					<div class="portfolio-container clearfix">

						<?php while ( $wp_query->have_posts() ) : $wp_query->the_post();
							$terms = get_the_terms( $post->ID, 'portfolio-type' );
							$term_list = '';
							if( !empty( $terms ) ) {
								foreach( $terms as $term ) {
									$term_list .= "$term->slug" . " ";
								}
								$term_list = trim( $term_list );
							}
						?>

						<!-- Article -->
						<article id="post-<?php the_ID(); ?>" <?php post_class( array( $term_list, 'post' ) ); ?> itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost" style="background-color:#fff; padding:12px; border-radius:5px">

							<header class="entry-header" itemscope="itemscope" itemtype="http://schema.org/WPHeader">

									<div class="item">
										<a href="<?php the_field('link');?>" target="_blank" title="<?php the_title(); ?>">
											<?php 
											$image = get_field('logo');
											if( !empty($image) ): ?>
												<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
											<?php endif; ?>
											<div class="overlay"></div>
											<span class="view"><?php _e( '+ Saiba Mais', 'mighty' ); ?></span>
										</a>
									</div>
								
							<span class="cidade-thumb"><?php the_field('cidade');?> - RJ</span>
								<h2 class="entry-title" itemprop="headline">
									<a href="<?php the_field('link');?>" target="_blank" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a>
								</h2>

							</header>

							<div class="entry-content" itemprop="text">
								<?php the_field('descricao'); ?>
							</div>

						</article>

				<?php endwhile; endif; ?>

				</div><!--/.portfolio-container-->

			</div><!--/.clearfix-->
		
		</main>

	</div>
</div>
			
<?php get_footer(); ?>
