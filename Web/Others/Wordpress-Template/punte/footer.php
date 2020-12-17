<?php
/**
 * @package Punte
 */
?>
</div><!-- #content -->

<?php
do_action( 'punte_footer' );
?>
</div><!-- #page -->

<?php
/**
 * punte_after_footer hook.
 *
 * @hooked punte_back_to_top
 */
do_action( 'punte_after_footer' );

wp_footer();
?>
</body>
</html>