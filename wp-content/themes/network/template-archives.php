<?php /* Template Name: Archive */ ?>

<?php get_header(); ?>

<div class="container">

	<div class="wrap clearfix">

		<?php if ( has_post_thumbnail() ) : ?>

			<?php $content_width = 980; ?>

			<div class="entry-image">
				<?php the_post_thumbnail( 'l' ); ?>
			</div>

		<?php endif; ?>

		<main id="content" role="main" itemprop="mainContentOfPage">

			<?php while ( have_posts() ) : the_post(); ?>

				<!-- Article -->
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> itemscope="itemscope" itemtype="http://schema.org/CreativeWork">

					<div class="entry-content" itemprop="text">
						<?php the_content(); ?>
					</div>

					<!-- Archive List -->
					<div class="archive-list">

						<h4><?php _e( 'Last 30 Posts:', 'mighty' ) ?></h4>
						<ul>
						<?php $archive = get_posts( 'numberposts=30' ); ?>
						<?php foreach( $archive as $post ) : ?>
							<li><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>
						<?php endforeach; ?>
						</ul>
						
						<h4><?php _e( 'Archives by Month:', 'mighty' ) ?></h4>
						<ul>
							<?php wp_get_archives( 'type=monthly' ); ?>
						</ul>
			
						<h4><?php _e( 'Archives by Subject:', 'mighty' ) ?></h4>
						<ul>
					 		<?php wp_list_categories( 'title_li=' ); ?>
						</ul>

					</div>

				</article>

			<?php endwhile; ?>
		
		</main>

		<!--Sidebar-->
		<?php get_sidebar(); ?>

	</div>

</div>
			
<?php get_footer(); ?>

