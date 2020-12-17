<?php

/**
 * @package Punte
 */
global $punte_options;

$enable_custom_header = isset( $punte_options[ 'enable-custom-header' ] ) ? $punte_options[ 'enable-custom-header' ] : false;

if ( $enable_custom_header && isset( $punte_options[ 'custom-header-page' ] ) && !empty( $punte_options[ 'custom-header-page' ] ) ) {
    $custom_header_page_id = $punte_options[ 'custom-header-page' ];
    echo '<header class="punte-container clearfix punte-custom-header">';
    echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display($custom_header_page_id); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    echo '</header>';
} else {
    $header_layouts = isset( $punte_options[ 'header-style' ] ) ? $punte_options[ 'header-style' ] : 'header-1';

    switch ( $header_layouts ) {
        case 'header-1':
            get_template_part( 'includes/headers/header1' );
            break;

        case 'header-2':
            get_template_part( 'includes/headers/header2' );
            break;

        case 'header-3':
            get_template_part( 'includes/headers/header3' );
            break;

        case 'header-4':
            get_template_part( 'includes/headers/header4' );
            break;

        case 'header-5':
            get_template_part( 'includes/headers/header5' );
            break;

        case 'header-6':
            get_template_part( 'includes/headers/header6' );
            break;

        default:
            get_template_part( 'includes/headers/header1' );
            break;
    }
}