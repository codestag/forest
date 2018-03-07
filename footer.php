	</main>
	
	<?php stag_footer_before(); ?>

	<?php if ( is_active_sidebar( 'sidebar-footer' ) ) : ?>

	<footer id="colophon" class="site-footer" role="contentinfo">

		<div class="inside">
			<?php stag_footer_start(); ?>
			
			<div class="grids">
				<?php dynamic_sidebar( 'sidebar-footer' ); ?>
			</div>

			<?php stag_footer_end(); ?>
		</div>

	</footer><!-- .site-footer -->

	<?php endif; ?>

	<footer class="secondary-footer">
		<div class="inside">
			<div class="grids">
				<div class="site-info grid-6">
					<?php echo stripslashes( forest_get_thememod_value( 'forest_site_footer' ) ); ?>
					<?php if ( true !== forest_get_thememod_value( 'forest_theme_credit' ) ) : ?>
						<p>Forest theme <em>by</em> <a href="https://codestag.com">Codestag</a></p>
					<?php endif; ?>
				</div><!-- .site-info -->

				<div class="grid-6">
					<?php echo do_shortcode( stripcslashes( forest_get_thememod_value( 'forest_footer_social_links' ) ) ); ?>
				</div>
			</div>
		</div>
	</footer><!-- /.secondary-footer -->

	<?php stag_footer_after(); ?>

	<?php stag_body_end(); ?>

	<?php wp_footer(); ?>
</body>
</html>
