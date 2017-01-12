<aside id="sidebar" role="complementary" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">

	<?php if ( is_blog() ) : ?>

		<?php dynamic_sidebar( 'sidebar-blog' ); ?>
		
	<?php else : ?>

		<?php dynamic_sidebar( 'sidebar-page' ); ?>

	<?php endif; ?>

</aside>