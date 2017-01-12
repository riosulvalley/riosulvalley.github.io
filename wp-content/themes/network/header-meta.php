<section id="header-meta" class="clearfix">

	<?php if ( is_archive() ) : ?>
	
		<h1>
		<?php
			if ( is_category() ) {
				printf( __( 'Category: %s', 'mighty' ), single_cat_title( '', false ) );
			} elseif ( is_tag() ) {
			    printf( __( 'Tagged: %s', 'mighty' ), single_tag_title( '', false ) );
			} elseif ( is_author() ) {
				$curauth = get_queried_object();
				echo get_avatar( get_the_author_meta('email'), '90', get_the_author() );
				echo $curauth->display_name;
			} elseif ( is_day() ) {
			    printf( __( 'Day: %s', 'mighty' ), get_the_date() );
			} elseif ( is_month() ) {
			    printf( __( 'Month: %s', 'mighty' ), get_the_date( 'F Y' ) );
			} elseif ( is_year() ) {
			    printf( __( 'Year: %s', 'mighty' ), get_the_date( 'Y' ) );
			} else {
			    _e( 'Archives', 'mighty' );
			}
		?>
		</h1>


		<?php if ( is_category() ) : ?>

			<h2><?php echo category_description(); ?></h2>


		<?php elseif ( is_author( $author ) ) : ?>

			<h2><?php the_author_meta( 'description' ); ?></h2>

		<?php endif; ?>
	
	<?php elseif ( is_search() ) : ?>
					
		<h1><?php _e( 'Search results for', 'mighty' ) ?>: '<?php the_search_query(); ?>'</h1>

	<?php elseif ( is_404() ) : ?>

		<h1><?php _e( 'Page Not Found', 'mighty' ) ?></h1>
			 
	<?php else : ?>
	
		<h1><?php single_post_title(); ?></h1>
	
		<?php if ( !is_archive() && !is_search() && !is_404() ) : ?>
		
			<?php $page_id = get_queried_object_id(); ?>
			<h2><?php echo get_post_field( 'post_excerpt', $page_id, 'display' ); ?></h2>

				<div class="all-btn-header">
				<a href="https://riosulvalley.typeform.com/to/jOlHRm" class="btn button-header" target="_blank">Faça parte</a>
				<!-- <a href="https://riosulvalley.typeform.com/to/jOlHRm" class="btn button-header outline" target="_blank">Entenda a proposta</a> -->
				</div>

				<div class="share-button-header">
				<div style="float:left; margin-right:15px"><a href="https://twitter.com/share" class="twitter-share-button" data-hashtags="gentequemuda">Tweet</a>
					<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></div>
					<div style="float:left"><div class="fb-like" style="position:absolute; margin-top:-4px" data-layout="standard" data-action="like" data-show-faces="false" data-share="true"></div></div>
				</div>

										
			
				



		
		<?php endif;?>


	<?php endif; ?>

	<?php if ( is_front_page() ) : ?>




							

		<?php if ( of_get_option( 'header-btn-link' ) ) : ?>
			<a href="<?php echo of_get_option( 'header-btn-link' ); ?>" title="<?php echo of_get_option( 'header-btn-text' ); ?>" class="btn"><?php echo of_get_option( 'header-btn-text' ); ?></a>
		<?php endif; ?>
						
	<?php endif; ?>


</section>