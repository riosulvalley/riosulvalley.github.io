<?php /* Post Format: Quote */ ?>

	<header class="entry-header" itemscope="itemscope" itemtype="http://schema.org/WPHeader">

		<?php if ( !is_single() ) : ?>

			<?php if ( has_post_thumbnail() ) : ?>

				<div class="entry-image">

					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
						<?php the_post_thumbnail( 'm' ); ?>
					</a>

				</div>

			<?php endif; ?>

			<p class="entry-meta">
				<time class="entry-time" itemprop="datePublished" datetime="<?php echo get_the_time( 'c' ); ?>"><?php echo get_the_date(); ?></time>
				<?php _e( ' by ', 'mighty' ); ?>
				<span class="entry-author vcard" itemprop="author" itemscope="itemscope" itemtype="http://schema.org/Person"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" itemprop="url" rel="author"><?php echo get_the_author(); ?></a></span>
				<?php _e( ' with ', 'mighty' ); ?>
				<span class="entry-comments"><?php comments_popup_link( __( '0 Comments', 'mighty' ), __( '1 Comment', 'mighty' ), __( '% Comments', 'mighty' ) ); ?></span>
			</p>

			<h2 class="entry-title" itemprop="headline">
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">

				<?php if ( get_post_meta( get_the_ID(), '_mighty_quote-text', true ) ) : ?>

					<blockquote>
						<p><?php echo get_post_meta( get_the_ID(), '_mighty_quote-text', true ); ?></p>
						<p><cite><?php echo get_post_meta( get_the_ID(), '_mighty_quote-attr', true ); ?></cite></p>
					</blockquote>

				<?php else : ?>

					<?php the_title(); ?>
					
				<?php endif; ?>

				</a>
			</h2>

		<?php else : ?>

			<?php if ( has_post_thumbnail() ) : ?>

				<div class="entry-image">
					<?php the_post_thumbnail( 'm' ); ?>
				</div>

			<?php endif; ?>

			<h2 class="entry-title" itemprop="headline">

			<?php if ( get_post_meta( get_the_ID(), '_mighty_quote-text', true ) ) : ?>

				<blockquote>
					<p><?php echo get_post_meta( get_the_ID(), '_mighty_quote-text', true ); ?></p>
					<p><cite><?php echo get_post_meta( get_the_ID(), '_mighty_quote-attr', true ); ?></cite></p>
				</blockquote>
		
			<?php endif; ?>

			</h2>

			<hr>

			<p class="entry-meta">
				<time class="entry-time" itemprop="datePublished" datetime="<?php echo get_the_time('c'); ?>"><?php echo get_the_date(); ?></time>
				<?php _e( ' by ', 'mighty' ); ?>
				<span class="entry-author vcard" itemprop="author" itemscope="itemscope" itemtype="http://schema.org/Person"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" itemprop="url" rel="author"><?php echo get_the_author(); ?></a></span>
				<?php _e( ' with ', 'mighty' ); ?>
				<span class="entry-comments"><?php comments_popup_link( __( '0 Comments', 'mighty' ), __( '1 Comment', 'mighty' ), __( '% Comments', 'mighty' ) ); ?></span>
			</p>

		<?php endif; ?>
		
	</header>

	<?php if( is_single() ) : ?>

	<div class="entry-content" itemprop="text">
		<?php the_content(); ?>
	</div>

	<?php wp_link_pages( 'before=<div class="entry-links">&after=</div>' ); ?>
	
	<footer class="entry-footer">
		<p class="entry-meta">
			<span><?php _e( 'Posted in', 'mighty' ); ?>: <?php the_category( ', ', '<br>' ); ?></span>
			<?php if( has_tag() ) : ?>
				<span><?php _e( 'Tagged with', 'mighty' ); ?>: <?php the_tags( ', ' ); ?></span>
			<?php endif; ?>
		</p>
	</footer>

	<?php endif; ?>

