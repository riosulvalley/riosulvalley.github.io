<?php /* Template Name: Homepage */ ?>

<?php get_header(); ?>

	<!--Hero-->
	<section id="hero">
		<div class="wrap">

			<?php
				$loop = new WP_Query( array( 'post_type' => 'portfolio', 'posts_per_page' => 3 ) );
			?>

			<?php if ( $loop->have_posts() ) : ?>

			<div class="flexslider">
				<img class="browser" src="<?php echo get_template_directory_uri(); ?>/images/browser-bar.svg" alt="<?php _e( 'Browser Bar', 'mighty' ); ?>" />
				<ul class="slides">

				<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

					<li class="slide">
					<?php if ( has_post_thumbnail() ) : ?>
						<a href="<?php the_permalink(); ?>" rel="bookmark">
							<?php the_post_thumbnail( 'l' ); ?>
							<span><?php _e( 'View project', 'mighty' ); ?></span>
							<div class="overlay"></div>
						</a>
					<?php endif; ?>
					</li>

				<?php endwhile; ?>

			</div>

			<?php wp_reset_postdata(); ?>

			<?php endif; ?>
		
		</div>
	</section>


	<!--Columns-->
	<section id="columns">
		<div class="wrap">

		<?php if ( of_get_option( 'text-left-heading' ) || of_get_option( 'text-left-content' ) ) : ?>

			<div class="column">
			<?php if ( of_get_option( 'text-left-icon' ) ) : ?>
				<img src="<?php echo of_get_option( 'text-left-icon' ); ?>" alt="<?php _e( 'Icon', 'mighty' ); ?>" />
			<?php endif; ?>
			<?php if ( of_get_option( 'text-left-heading' ) ) : ?>
				<h2><?php echo of_get_option( 'text-left-heading' ); ?></h2>
			<?php endif; ?>
				<?php echo of_get_option( 'text-left-content' ); ?>
			</div>

		<?php endif; ?>

		<?php if ( of_get_option( 'text-center-heading' ) || of_get_option( 'text-center-content' ) ) : ?>

			<div class="column">
			<?php if ( of_get_option( 'text-center-icon' ) ) : ?>
				<img src="<?php echo of_get_option( 'text-center-icon' ); ?>" alt="<?php _e( 'Icon', 'mighty' ); ?>" />
			<?php endif; ?>
			<?php if ( of_get_option( 'text-center-heading' ) ) : ?>
				<h2><?php echo of_get_option( 'text-center-heading' ); ?></h2>
			<?php endif; ?>
				<?php echo of_get_option( 'text-center-content' ); ?>
			</div>

		<?php endif; ?>

		<?php if ( of_get_option( 'text-right-heading' ) || of_get_option( 'text-right-content' ) ) : ?>

			<div class="column last">
			<?php if ( of_get_option( 'text-right-icon' ) ) : ?>
				<img src="<?php echo of_get_option( 'text-right-icon' ); ?>" alt="<?php _e( 'Icon', 'mighty' ); ?>" />
			<?php endif; ?>
			<?php if ( of_get_option( 'text-right-heading' ) ) : ?>
				<h2><?php echo of_get_option( 'text-right-heading' ); ?></h2>
			<?php endif; ?>
				<?php echo of_get_option( 'text-right-content' ); ?>
			</div>

		<?php endif; ?>

		</div>
	</section>


	<!--Blog-->
	<section id="blog">
		<div class="wrap clearfix">
			
			<?php
				$args = array(
					'post_type' => 'post',
					'posts_per_page' => 3
				);

				$loop = new WP_Query( $args );
				$count = 1;
			?>

			<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

				<!-- Article -->
				<article class="post<?php if ( $count %3 == 0 ) { echo ' last'; }; $count ++; ?>" itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">

					<?php if ( has_post_thumbnail() ) : ?>
						<a href="<?php the_permalink(); ?>" rel="bookmark" class="entry-image">
							<?php the_post_thumbnail( 's' ); ?>
						</a>
					<?php endif; ?>

					<div class="entry-meta">
						<time class="entry-time" itemprop="datePublished" datetime="<?php echo get_the_time( 'c' ); ?>"><?php echo get_the_date(); ?></time>
						<?php _e( ' with ', 'mighty' ); ?>
						<span class="entry-comments"><?php comments_popup_link( __( '0 Comments', 'mighty' ), __( '1 Comment', 'mighty' ), __( '% Comments', 'mighty' ) ); ?></span>
					</div>
					
					<h2 class="entry-title" itemprop="headline">
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a>
					</h2>

					<?php the_excerpt(); ?>
				
				</article>

			<?php endwhile; ?>

			<?php wp_reset_postdata(); ?>

		</div>
	</section>


<?php get_footer(); ?>