<?php
/**
 * @package Punte
 */
global $punte_options;
$footer_column = isset( $punte_options[ 'footer-column' ] ) ? $punte_options[ 'footer-column' ] : 'col-3';
$custom_footer = isset( $punte_options[ 'enable-custom-footer' ] ) ? $punte_options[ 'enable-custom-footer' ] : false;

if ( $custom_footer && isset( $punte_options[ 'custom-footer-page' ] ) && !empty( $punte_options[ 'custom-footer-page' ] ) ) {
    $custom_footer_page_id = $punte_options[ 'custom-footer-page' ];
    echo '<footer class="punte-container clearfix punte-custom-footer">';
    echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display($custom_footer_page_id); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    echo '</footer>';
} else {
    switch ( $footer_column ) {
        case 'col-1':
            $col_count = 1;
            break;

        case 'col-2':
            $col_count = 2;
            break;

        case 'col-3':
            $col_count = 3;
            break;

        case 'col-4':
            $col_count = 4;
            break;

        case 'col-1-2':
            $col_count = 2;
            break;

        case 'col-2-1':
            $col_count = 2;
            break;

        case 'col-1-1-2':
            $col_count = 3;
            break;

        case 'col-2-1-1':
            $col_count = 3;
            break;

        case 'col-1-3':
            $col_count = 2;
            break;

        case 'col-3-1':
            $col_count = 2;
            break;

        case 'col-1-2-1':
            $col_count = 3;
            break;

        default:
            $col_count = 4;
            break;
    }
    ?>
    <footer id="colophon" class="site-footer">
        <div id="top-footer">
            <div class="punte-container">
                <div class="top-footer-wrap clearfix <?php echo esc_attr( 'column-' . $footer_column ) ?>">
                    <?php
                    for ( $i = 1; $i <= $col_count; $i++ ) {
                        ?>
                        <div class="footer-column footer-column-<?php echo esc_attr( $i ); ?>">
                            <?php
                            if ( is_active_sidebar( 'punte-footer-' . $i ) ):
                                dynamic_sidebar( 'punte-footer-' . $i );
                            endif;
                            ?>	
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

        
            <div id="bottom-footer" class="footer-text">
                <div class="punte-container-wrapper">
                    <?php if ( isset( $punte_options[ 'copyright-text' ] ) && !empty( $punte_options[ 'copyright-text' ] ) ) { ?>
                        <?php echo wp_kses_post( $punte_options[ 'copyright-text' ] ); ?>
                    <?php } ?>

                    <?php do_action('punte_footer_copyright'); ?>
                    
                </div>
            </div>
    </footer><!-- #colophon -->
    <?php
}