<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Madd_Magazine
 */

?>

			</div><!-- #content -->
		</div>

		<footer id="colophon" class="footer" itemscope itemtype="<?php echo esc_url('http://schema.org/WPFooter'); ?>">
			<div class="footer-top">
				<div class="container">
					<div class="row">
						<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('footer-widget')) ?>
					</div>
				</div>
			</div>
			<div class="footer-bot">
				<div class="container">
					<div class="row">
						<div class="col-sm-6">
							<div class="footer-copyright"><?php echo esc_html(get_theme_mod('footer_copyright')); ?></div>
						</div>
						<div class="col-sm-6">
							<div class="author-credits">
								<?php esc_html_e('Powered by', 'madd-magazine'); ?> <a href="<?php echo esc_url('https://dessign.net/20-best-free-magazine-wordpress-themes/'); ?>"><?php esc_html_e('WordPress', 'madd-magazine'); ?></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
