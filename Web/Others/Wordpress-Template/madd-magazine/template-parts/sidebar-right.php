<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Madd_Magazine
 */
?>

<div class="col-md-3">
	<aside id="sidebar-right" class="sidebar-wrap">
		<div class="sidebar-widget">
			<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-widget2')) ?>
		</div>
	</aside>
</div><!-- #sidebar-right -->
