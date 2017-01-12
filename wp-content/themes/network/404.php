<?php get_header(); ?>

<div class="container">

	<div class="wrap clearfix">

		<main id="content" class="full-width" role="main" itemprop="mainContentOfPage">

				<!-- Article -->
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> itemscope="itemscope" itemtype="http://schema.org/CreativeWork">

					<header class="entry-header">
						<h1 class="entry-title" itemprop="headline"><span class="big">WPLOCKER.COM - 404</span> <?php _e( 'Page Not Found', 'mighty' ); ?></h1>
					</header>

					<div class="entry-content" itemprop="text">
						<p><?php _e( 'Well, this is embarrassing. We can\'t seem to locate the page you\'re looking for. <br>Bad link? Mistyped address? We\'re not exactly sure. <br><br>You can always search for the page below.', 'mighty' ); ?></p>
						<?php get_search_form(); ?>
					</div>

				</article>
		
		</main>

	</div>

</div>
			
<?php get_footer(); ?>
