
<!--Portfolio-->

<section id="portfolio">

	<?php
		$current = $post->ID;
		$loop = new WP_Query( array( 'post_type' => 'portfolio', 'posts_per_page' => 3, 'orderby' => 'rand', 'post__not_in' => array( $current ) ) );
		$count = 1;
	?>

	<?php if ( $loop->have_posts() ) : ?>

		<div class="clearfix">

		<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>

			<!-- Article -->
			<!-- <article class="post<?php if( $count %3 == 0 ) { echo ' last'; }; $count ++; ?>" itemscope="itemscope" itemtype="http://schema.org/CreativeWork" itemprop="associatedArticle">

			<?php if ( has_post_thumbnail() ) : ?>
				<div class="item">
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
						<?php the_post_thumbnail( 's' ); ?>
						<?php the_title(); ?>
						<div class="overlay"></div>
						<span class="view"><?php _e( '+ Saiba Mais', 'mighty' ); ?></span>
					</a>
				</div>
			<?php endif; ?>

			</article> -->

		<?php endwhile; ?>

		</div>

		<?php wp_reset_postdata(); ?>

	<?php endif; ?>

</section>