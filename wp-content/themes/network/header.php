<!DOCTYPE html>

<html <?php language_attributes(); ?>>

	<!-- A Mighty WordPress Theme (http://meetmighty.com) -->

	<head>

		<!-- Meta -->
		<meta http-equiv="content-type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		
		<!-- Title -->
		<title><?php if ( is_front_page() ) { ?><?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?><?php } else { ?><?php wp_title( '-', true, 'right' ); ?><?php bloginfo( 'name' ); ?><?php } ?></title>
						
		<meta property="og:locale" content="pt_BR">
		<meta property="og:url" content="<?php the_permalink() ?>">
		<meta property="og:title" content="<?php single_post_title(''); ?> - <?php bloginfo( 'name' ); ?>">
		<meta property="og:site_name" content="Rio Sul Valley - Comunidade de Inovação do Sul Fluminense">
		<meta property="og:description" content="Rio Sul Valley é uma rede para conectar pessoas, startups, empresas privadas, instituições do terceiro setor e iniciativas que estão mudando a realidade das cidades do Sul Fluminense.">
		<meta property="og:image" content="http://riosulvalley.com.br/wp-content/uploads/2016/07/fundo-1.jpg">
		<meta property="og:image:type" content="image/jpeg"> 
		<meta property="og:type" content="website">

		<!-- RSS & Pingbacks -->
		<?php if ( of_get_option( 'feedburner-url' ) ) : ?>
			<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> <?php _e( 'RSS Feed', 'mighty' ); ?>" href="http://feeds.feedburner.com/<?php echo of_get_option( 'feedburner-url' ); ?>" />
		<?php else : ?>
			<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> <?php _e( 'RSS Feed', 'mighty' ); ?>" href="<?php bloginfo( 'rss2_url' ); ?>" />
		<?php endif; ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		
		<!-- Favicon -->
		<?php if ( of_get_option( 'custom-favicon' ) ) : ?>
			<link rel="shortcut icon" href="<?php echo of_get_option( 'custom-favicon' ); ?>" />
		<?php else : ?>
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/fav.ico" />
		<?php endif; ?>
		
		<!-- Hooks -->
		<?php wp_head(); ?>
		    
	</head>


	<body <?php body_class( 'fadeDown' ); ?> itemscope="itemscope" itemtype="http://schema.org/WebPage">

			<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&appId=1517923908462657&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>



	    <header id="header" role="banner" itemscope="itemscope" itemtype="http://schema.org/WPHeader">

		    <div class="wrap clearfix">
			        
			    <!-- Logo -->
				<div class="logo" itemprop="headline">
				<?php if ( of_get_option( 'logo-plain' ) == 1 ) : ?>
					<a href="<?php echo home_url( '/' ) ?>" title="<?php bloginfo( 'name' ); ?>"><?php bloginfo( 'name' ); ?></a>
				<?php elseif ( of_get_option( 'logo-custom' ) ) : ?>
					<a href="<?php echo home_url( '/' ) ?>" title="<?php bloginfo( 'name' ); ?>" class="custom"><img src="<?php echo of_get_option( 'logo-custom' ); ?>" title="<?php bloginfo( 'name' ); ?>" alt="<?php bloginfo( 'name' ); ?>" /></a>
				<?php else : ?>
					<a href="<?php echo home_url( '/' ) ?>" title="<?php bloginfo( 'name' ); ?>"><?php bloginfo( 'name' ); ?></a>
				<?php endif; ?>
				</div>

			    <!-- Navigation -->
			    <nav role="navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
					<?php if( has_nav_menu( 'header-menu' ) ) : ?>
					
					    <?php
						    wp_nav_menu(
							    array(
								    'theme_location' => 'header-menu',
								    'container'      => false,
								    'menu_id'        => 'nav',
								    'menu_class'     => 'header-menu',
								    'depth'          => '4'
							    )
						    );
					    ?>
					
					<?php else : ?>
					
					<ul id="nav">
						<?php wp_list_pages( 'title_li=&depth=1' ); ?>
					</ul>
					
					<?php endif; ?>
				</nav>

				<div class="clearfix"></div>

				<?php get_template_part( 'header', 'meta' ); ?>
	
		</header>
