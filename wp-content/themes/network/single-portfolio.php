<?php get_header(); ?>

<div class="container">

	<div class="wrap clearfix">

		<main id="content" class="full-width" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<!-- Article -->
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> itemscope="itemscope" itemtype="http://schema.org/BlogPosting" itemprop="blogPost">

					<div class="entry-image clearfix">

						<?php
							// First check if slideshow gallery is checked
							if ( get_post_meta( get_the_ID(), '_mighty_slideshow-gallery', true ) ) :
						?>

							<div class="flexslider">
							    <ul class="slides">
							        <?php mighty_gallery( $post->ID ); ?>
							    </ul>
							</div>

						<?php 
							// Check for self-hosted video, if found display it
							elseif ( get_post_meta( get_the_ID(), '_mighty_video-url', true ) ) :
						?>
							
							<?php if ( has_post_thumbnail() ) : ?>

								<?php
									$poster = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'l' );
									$url = $poster['0'];
								?>

								<?php echo do_shortcode( '[video src="' . get_post_meta( get_the_ID(), '_mighty_video-url', true ) . '" poster="' . $url . '" width="980"]' ); ?>

							<?php else : ?>

								<?php echo do_shortcode( '[video src="' . get_post_meta( get_the_ID(), '_mighty_video-url', true ) . '" width="980"]' ); ?>
								
							<?php endif; ?>

						<?php
							// Check for third-party embedded video, if found display it
							elseif ( get_post_meta( get_the_ID(), '_mighty_video-embed', true ) ) :
						?>

							<?php
								$wp_embed = new WP_Embed();
								$post_embed = $wp_embed->run_shortcode( '[embed width="980"]' . get_post_meta( get_the_ID(), '_mighty_video-embed', true ) . '[/embed]' );
							?>

							<?php echo $post_embed; ?>

						<?php
							// Check if audio file has been assigned, if so, display it.
							elseif ( get_post_meta( get_the_ID(), '_mighty_audio-file', true ) ) :
						?>

							<?php if ( has_post_thumbnail() ) : ?>
								<?php the_post_thumbnail( 'l' ); ?>
							<?php endif; ?>
							<?php echo do_shortcode( '[audio src="' . get_post_meta( get_the_ID(), '_mighty_audio-file', true ) . '" width="980"]' ); ?>

						<?php
							// Lastly, just display the single featured thumbnail.
							else :
						?>

							<?php if ( has_post_thumbnail() ) : ?>
								<?php the_post_thumbnail( 'l' ); ?>
							<?php endif; ?>

						<?php endif; ?>

					</div>

					<div class="whiteboard clearfix">

					<div class="logo-projeto-box">
					<p class="project-logo"><img src='<?php $values = get_post_custom_values(thumb); echo $values[0]; ?>' alt="<?php the_title(); ?>"  /><p/>
					<div class="description-content-project">
					<h1><?php single_post_title(); ?></h1>
					<p><span><?php $values = get_post_custom_values(description); echo $values[0]; ?></span></p>						
					</div>
					</div>

						<aside class="portfolio-meta">
						<h3 style="color:#21c391">Informações:</h3>

						<p>Responsável: <br><span><?php $values = get_post_custom_values(name); echo $values[0]; ?></span></p>
						<p>Área de Atuação: <br><span><?php $values = get_post_custom_values(focus); echo $values[0]; ?></span></p>
						<p>Público Atendido: <br><span><?php $values = get_post_custom_values(target); echo $values[0]; ?></span></p>
						<p>Endereço: <br><span><?php $values = get_post_custom_values(address); echo $values[0]; ?></span></p>
						<p>Contatos: <br><span><?php $values = get_post_custom_values(email); echo $values[0]; ?></span></p>
						<p class="sm-icon">Redes Sociais: <br><span><?php $values = get_post_custom_values(socialmedia); echo $values[0]; ?></span></p>
<!-- 					<p><a class="btn" href="<?php $values = get_post_custom_values(email); echo $values[0]; ?>">Quero ajudar esse projeto!</a></p>
 -->




	

						</aside>

						<div class="entry-content" itemprop="text">
							<?php the_content(); ?>
						</div>

					</div>

				</article>
					</a>

					<script language="javascript">
   					function fbshareCurrentPage()
    				{window.open("https://www.facebook.com/sharer/sharer.php?u="+escape(window.location.href)+"&t="+document.title, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false; }
					</script>

					<!-- <button class="compartilhar-footer"><a href="javascript:fbshareCurrentPage()" target="_blank" alt="Share on Facebook">Gostou desse projeto? Compartilhe com seus amigos!</a></button>
 					-->
 					<h3>Conhece esse projeto? Compartilhe com a gente sua experiência!</h3>
				<!-- Comments -->
				<?php comments_template(); ?>

				<?php get_template_part( 'loop', 'portfolio' ); ?>

			<?php endwhile; endif; ?>
		
		</main>

	</div>

</div>
			
<?php get_footer(); ?>
