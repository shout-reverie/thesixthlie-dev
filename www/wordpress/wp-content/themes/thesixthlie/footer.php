			<footer class="footer" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">

        <?php get_template_part('followme'); ?>

				<div id="inner-footer" class="wrap cf">

					<nav role="navigation">
						<?php wp_nav_menu(array(
    					'container' => 'div',                           // enter '' to remove nav container (just make sure .footer-links in _base.scss isn't wrapping)
    					'container_class' => 'footer-links cf',         // class of container (should you choose to use it)
    					'menu' => __( 'Footer Links', 'bonestheme' ),   // nav name
    					'menu_class' => 'nav footer-nav cf',            // adding custom nav class
    					'theme_location' => 'footer-links',             // where it's located in the theme
    					'before' => '',                                 // before the menu
    					'after' => '',                                  // after the menu
    					'link_before' => '',                            // before each link
    					'link_after' => '',                             // after each link
    					'depth' => 0,                                   // limit the depth of the nav
    					'fallback_cb' => 'bones_footer_links_fallback'  // fallback function
						)); ?>
					</nav>

					<p class="source-org copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>.</p>

				</div>

			</footer>

		</div>

        <?php //for font awesome ?>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <script>
            var ajaxurl = '<?php echo get_stylesheet_directory_uri().'/more.php'; ?>';
        </script>

		<?php // all js scripts are loaded in library/bones.php ?>
		<?php wp_footer(); ?>
        <?php if(!is_mobile()) : ?>
            <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri().'/library/js/script-pc.js'; ?>"></script>
        <?php endif ?>
    <?php // google map ?>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>

	</body>

</html> <!-- end of site. what a ride! -->
