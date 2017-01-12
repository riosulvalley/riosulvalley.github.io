		<footer id="footer" role="contentinfo" itemscope="itemscope" itemtype="http://schema.org/WPFooter">
			<div class="wrap clearfix">

			    <!-- Links -->

			    <nav role="navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
				    <?php if( has_nav_menu( 'footer-menu' ) ) : ?>

					    <?php
						    wp_nav_menu(
							    array(
								    'theme_location' => 'footer-menu',
								    'container'      => false,
								    'menu_id'        => 'links',
								    'menu_class'     => 'footer-menu',
								    'depth'          => '1'
							    )
						    );
					    ?>

				    <?php else : ?>

						<ul id="links">
							<?php wp_list_pages( 'title_li=&depth=1' ); ?>
						</ul>

			    	<?php endif; ?>
				</nav>



			    <!-- Copyright -->
				<p class="copyright">

				<?php if ( of_get_option( 'footer-text' ) ) : ?>
					<?php echo of_get_option( 'footer-text' ); ?>
				<?php else : ?>
					<a href="http://meetmighty.com/themes/relevant/" target="_blank"><?php _e( 'Relevant', 'mighty' ); ?></a> <?php _e( 'WordPress Theme by', 'mighty' ); ?> <a href="http://meetmighty.com/" target="_blank" title="Mighty WordPress Themes">Mighty Themes</a>
				<?php endif; ?>

				<span>
				<?php if ( of_get_option( 'copyright-text' ) ) : ?>
					<?php echo of_get_option( 'copyright-text' ); ?>
				<?php else : ?>
					<?php _e( 'Copyright', 'mighty' ); ?> &copy; <?php echo date( 'Y' ); ?> <?php _e( 'All rights reserved', 'mighty' ); ?>
				<?php endif; ?>
				</span>
				
				</p>

	
			</div>
					

   					




		</footer>

		<?php if ( of_get_option( 'footer-scripts' ) ) : ?>
			<script type="text/javascript">
				<?php echo of_get_option( 'footer-scripts' ); ?>
			</script>
		<?php endif; ?>

		<?php wp_footer(); ?>


		<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-56057534-1', 'auto');
  ga('send', 'pageview');

</script>

	</body>
</html>