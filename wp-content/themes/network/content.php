<?php /* Post Format: Standard */ ?>

	<header class="entry-header full-width" itemscope="itemscope" itemtype="http://schema.org/WPHeader">

		<?php if ( has_post_thumbnail() ) : ?>

			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="entry-image">
				<?php the_post_thumbnail( 'm' ); ?>
			</a>

		<?php endif; ?>

		<?php if ( !is_single() ) : ?>

			<h2 class="entry-title" itemprop="headline">
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h2>

		<?php endif; ?>

		<p class="entry-meta full-width">
			<time class="entry-time" itemprop="datePublished" datetime="<?php echo get_the_time('c'); ?>"><?php echo get_the_date(); ?></time>
			<?php _e( ' by ', 'mighty' ); ?>
			<span class="entry-author vcard" itemprop="author" itemscope="itemscope" itemtype="http://schema.org/Person"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" itemprop="url" rel="author"><?php echo get_the_author(); ?></a></span>
			<?php _e( ' with ', 'mighty' ); ?>
			<span class="entry-comments"><?php comments_popup_link( __( '0 Comments', 'mighty' ), __( '1 Comment', 'mighty' ), __( '% Comments', 'mighty' ) ); ?></span>
		</p>
		
	</header>

	<div class="entry-content full-width center" itemprop="text">
		<?php the_content(); ?>
	</div>

	<?php if ( is_single() ) : ?>

	<?php wp_link_pages( 'before=<div class="entry-links">&after=</div>' ); ?>
	
	<footer class="entry-footer full-width">
		<p class="entry-meta">
			<span><?php _e( 'Posted in', 'mighty' ); ?>: <?php the_category( ', ' ); ?></span>
			<?php if( has_tag() ) : ?>
				<br>
				<span><?php _e( 'Tagged with', 'mighty' ); ?>: <?php the_tags( '', ', ', '' ); ?></span>
			<?php endif; ?>
		</p>
	</footer>

	<?php endif; ?>
