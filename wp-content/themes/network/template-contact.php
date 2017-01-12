<?php /* Template Name: Contact */ ?>

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

					<!-- Contact Form -->
					<section id="contact-form">

					<?php if ( isset ( $_GET['success'] ) ) : ?>

						<p class="success"><i class="fa fa-check"></i> <?php _e( 'You message has been sent', 'mighty' ); ?></p>

					<?php else : ?>

						<form action="" method="POST">

							<input type="hidden" name="form" value="contact-form">
							<input type="hidden" name="currenturl" value="<?php the_permalink(); ?>">
							<input type="hidden" name="redirect" value="<?php the_permalink(); ?>?success">

							<?php if ( isset( $_GET['check'] ) ) : ?>

								<p class="check"><i class="fa fa-times"></i> 
									<?php
										if ( $_GET['check'] == "empty" ) {
											echo _e( 'Please complete the form', 'mighty' );
										} elseif ( $_GET['check'] == "fields" ) {
											echo _e( 'There was a problem processing your request', 'mighty' );
										} elseif ( $_GET['check'] == "email" ) {
											echo _e( 'Please enter a valid email address', 'mighty' );
										}
									?>
								</p>

							<?php endif; ?>

							<ul>
								<li>
									<label for="name"><?php _e( 'Name', 'mighty' ); ?>:</label>
									<input type="text" name="name" />
								</li>
								<li>
									<label for="email"><?php _e( 'Email', 'mighty' ); ?>:</label>
									<input type="text" name="email" />
								</li>
								<li>
									<label for="message"><?php _e( 'Message', 'mighty' ); ?>:</label>
									<textarea rows="5" cols="45" name="message"></textarea>
								</li>
								<li>
									<input type="submit" class="btn" value="<?php _e( 'Submit', 'mighty' ); ?>" />
								</li>
							</ul>

						</form>

					<?php endif; ?>

					</section>

				</article>

			<?php endwhile; ?>
		
		</main>

		<!--Sidebar-->
		<aside id="sidebar" role="complementary" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
			<?php dynamic_sidebar( 'sidebar-contact' ); ?>
		</aside>

	</div>

</div>
			
<?php get_footer(); ?>
