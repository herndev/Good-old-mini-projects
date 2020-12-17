<?php
/**
 * @package Punte
 */
if ( !function_exists( 'punte_main_dynamic_styles' ) ) {

    function punte_main_dynamic_styles() {
        ob_start();
        global $punte_options;

        $default = array(
            'navbar-height' => 90,
            'logo-padding' => array(
                'padding-top' => '10px',
                'padding-right' => '10px',
                'padding-bottom' => '10px',
                'padding-left' => '0px'
            ),
            'top-header-padding' => array(
                'padding-top' => '10px',
                'padding-bottom' => '10px',
            ),
            'top-header-text-color' => '#FFF',
            'menu-typography' => array(
                'font-style' => '',
                'font-weight' => 400,
                'subsets' => 'latin',
                'font-family' => 'Roboto',
                'google' => true,
                'font-size' => '16px',
                'text-transform' => 'uppercase',
                'letter-spacing' => 0
            ),
            'skin-color' => '#25bcea',
            'responsive-width' => 768,
            'body-background' => array(
                'background-color' => '#FFFFFF',
                'background-image' => '',
                'background-repeat' => '',
                'background-position' => '',
                'background-size' => '',
                'background-attachment' => ''
            ),
            'website-layout' => 'full-width',
            'container-width' => 1170,
            'top-header' => false,
            'header-style' => 'header-1',
            'content-sidebar-ratio' => 70,
            'footer-background-color' => '#333333',
            'footer-text-color' => '#EEEEEE',
            'footer-link-color' => array(
                'regular' => '#CCCCCC',
                'hover' => '#AAAAAA',
            ),
            'footer-header-color' => '#FFFFFF',
            'menu-link-color' => array(
                'regular' => '#333333',
                'hover' => '#25bcea',
            ),
            'submenu-background' => array(
                'color' => '#25bcea',
                'alpha' => '.8',
                'rgba' => 'rgba(37,188,234,0.8)'
            ),
            'submenu-link-color' => array(
                'regular' => '#000',
                'hover' => '#25bcea',
            ),
            'header-background' => array(
                'color' => '#FFFFFF',
                'alpha' => '1',
                'rgba' => 'rgba(255,255,255,1)'
            ),
            'top-header-background' => array(
                'color' => '#25bcea',
                'alpha' => '1',
                'rgba' => 'rgba(37,188,234,1)'
            ),
            'top-header-link-color' => array(
                'regular' => '#FAFAFA',
                'hover' => '#EEEEEE',
            ),
            'footer-font-size' => 14,
            'mb-woo-header-bg' => array(
                'background-color' => '#EEEEEE',
            ),
            'mb-woo-header-text-color' => '#333333',
            'mb-woo-header-overlay-color' => array(
                'color' => '#000000',
                'alpha' => 0.3
            ),
            'mb-woo-breadcrumb-color' => '#333333',
            'mb-woo-header-padding' => array(
                'padding-top' => '30px',
                'padding-bottom' => '30px',
            ),
            'custom-css' => ''
        );

        $punte_options = wp_parse_args( $punte_options, $default );

        $navbar_height          = $punte_options[ 'navbar-height' ];
        $logo_padding           = $punte_options[ 'logo-padding' ];
        $top_header_padding     = $punte_options[ 'top-header-padding' ];
        $top_header_text_color  = $punte_options[ 'top-header-text-color' ];
        $menu_typography        = $punte_options[ 'menu-typography' ];
        $skin_color             = $punte_options[ 'skin-color' ];
        $responsive_width       = $punte_options[ 'responsive-width' ];
        $body_background        = $punte_options[ 'body-background' ];
        $darker_skin_color      = punte_darken_color( $skin_color, -0.10 );
        $more_darker_skin_color = punte_darken_color( $skin_color, -0.15 );
        $ligther_skin_color     = punte_darken_color( $skin_color, 0.10 );

        if( get_header_image() ){
        ?>
            header.page-header{
                background: url(<?php echo esc_url(get_header_image())?>);
            }
        <?php 
        }
        ?>
        body{
        <?php if ( !empty( $body_background[ 'background-color' ] ) ) { ?>
            background-color: <?php echo punte_escape_colors($body_background[ 'background-color' ]) ?>;
            <?php
        }
        if ( !empty( $body_background[ 'background-image' ] ) ) {
            ?>
            background-image: url(<?php echo esc_url($body_background[ 'background-image' ]) ?>);
            <?php
        }
        if ( !empty( $body_background[ 'background-repeat' ] ) ) {
            ?>
            background-repeat: <?php echo esc_html($body_background[ 'background-repeat' ]) ?>;
            <?php
        }
        if ( !empty( $body_background[ 'background-position' ] ) ) {
            ?>
            background-position: <?php echo esc_html($body_background[ 'background-position' ]) ?>;
            <?php
        }
        if ( !empty( $body_background[ 'background-size' ] ) ) {
            ?>
            background-size: <?php echo esc_html($body_background[ 'background-size' ]) ?>;
            <?php
        }
        if ( !empty( $body_background[ 'background-attachment' ] ) ) {
            ?>
            background-attachment: <?php echo esc_html($body_background[ 'background-attachment' ]) ?>;
        <?php } ?>
        }

        <?php
        if ( $punte_options[ 'website-layout' ] == 'boxed' ) {
            ?>
            #page{
            width:<?php echo absint($punte_options[ 'container-width' ]); ?>px;
            margin:0 auto;
            background: #FFF;
            }

            .punte-container{
            padding-left: 30px;
            padding-right: 30px;
            }

            .both-sidebar .site-content > .punte-container{
            padding: 0 320px;
            }

            .both-right-sidebar .site-content > .punte-container{
            padding-right: 610px;
            }

            .both-left-sidebar .site-content > .punte-container{
            padding-left: 610px;
            }
            <?php
        }
        ?>

        .punte-container{
        width: <?php echo absint($punte_options[ 'container-width' ]); ?>px;
        }

        .header-layout1 .site-branding img,
        .header-layout5 .site-branding img,
        .header-layout6 .site-branding img{
        max-height: <?php echo absint($navbar_height) - absint( $logo_padding[ 'padding-top' ] ) - absint( $logo_padding[ 'padding-bottom' ] ); ?>px;
        }

        .header-layout6 .is-sticky .site-branding img{
        max-height: <?php echo absint($navbar_height) - absint( $logo_padding[ 'padding-top' ] ) - absint( $logo_padding[ 'padding-bottom' ] ) - 20; ?>px;
        }

        /*==BACKGROUND COLOR==*/
        .header-layout1 .top-header,
        .header-layout3 .top-header,
        .header-layout5 .main-header,
        ul.punte-main-menu ul,
        .video-controls,
        .bttn-style1 a,
        .bttn-style3 a,
        .bttn-style5 a, 
        .style3.punte-pricing-table,
        .style4.punte-pricing-table .ppt-header,
        .style4.punte-pricing-table .ppt-header:before,
        .style4.punte-pricing-table .ppt-header:after,
        .style5.punte-pricing-table .ppt-header,
        .style5.punte-pricing-table .ppt-icon,
        .style5.punte-pricing-table .ppt-footer a,
        .style6.punte-pricing-table .ppt-footer a,
        .style6.punte-pricing-table .ppt-price,
        .style1.punte-team .pt-social-icons a,
        .style2.punte-team .pt-social-icons a,
        .style3.punte-team .pt-social-icons a,
        .style4.punte-team .pt-social-icons a,
        .style3.punte-testimonial .ptl-header,
        .pagination .page-numbers,
        .blog-style3 .entry-readmore a:hover,
        #pune-back-top,
        .sidebar-style3 .widget-title span:after,
        button,
        input[type="button"],
        input[type="reset"],
        input[type="submit"],
        .pws1-catname-wrapper a,
        .pws1-catname-wrapper a:before,
        .pnt-list .owl-theme .owl-nav [class*=owl-]:hover,
        .punte-portfolio-labels li.is-checked:after,
        .pnt-title,
        .style6.punte-pricing-table .ppt-heading:after,
        .pbp-pagination .page-numbers.current,
        .pbp-pagination a.page-numbers:hover,
        .punte-blog-post.style3 .punte-blog-list-inner,
        .punte-blog-post.style3 .punte-blog-list.pbp-even .punte-blog-list-inner:before,
        .punte-blog-post.style3 .punte-blog-list.pbp-odd .punte-blog-list-inner:before,
        .punte-blog-post.style3 .pbp-line,
        .pbs-slide-caption .pbs-category a,
        .pbs-slider-wrap .owl-dots .owl-dot.active span, 
        .pbs-slider-wrap .owl-dots .owl-dot:hover span,
        .punte-pricing-table.style2 .ppt-heading,
        .punte-pricing-table.style2:hover .ppt-icon,
        .style3.punte-pricing-table.punte-pricing-table,
        .style4.punte-pricing-table .ppt-button,
        .style5.punte-pricing-table .ppt-heading,
        .style5.punte-pricing-table .ppt-heading::before,
        .style5.punte-pricing-table .ppt-heading::after,
        .style1.punte-pricing-table .ppt-button,
        .punte-counter.style3 .pc-icon,
        .pbg-category a,
        .pbs-slide-caption .pbs-category a,
        .pwtb-catname-wrapper a.pwtb-active,
        .pwtb-catname-wrapper a:hover,
        .menu-item-punte-cart .mCSB_scrollTools .mCSB_dragger .mCSB_dragger_bar,
        .blog-style1 .entry-readmore a,
        blockquote:before{
        background-color: <?php echo punte_escape_colors($skin_color); ?>
        }
        ul.punte-main-menu>li>a:hover svg{
            fill: <?php echo punte_escape_colors($skin_color); ?>
        }


        /*==LIGHT BACKGROUD COLOR==*/
        .style1.punte-pricing-table .ppt-header{
        background-color: <?php echo punte_escape_colors($ligther_skin_color); ?>
        }

        /*==DARK BACKGROUD COLOR==*/
        .style1.punte-pricing-table .ppt-button,
        .style4.punte-pricing-table .ppt-button,
        .style5.punte-pricing-table .ppt-heading,
        .style5.punte-pricing-table .ppt-heading:before,
        .style5.punte-pricing-table .ppt-heading:after,
        .style6.punte-pricing-table .ppt-heading:after,
        #pune-back-top:hover,
        button:hover,
        input[type="button"]:hover,
        input[type="reset"]:hover,
        input[type="submit"]:hover,
        .pws1-catname-wrapper a.p-active,
        .pws1-catname-wrapper a.p-active:before,
        .pws1-catname-wrapper a:hover,
        .pws1-catname-wrapper a:hover:before,
        .bttn-style1 a:hover{
        background-color: <?php echo punte_escape_colors($darker_skin_color); ?>
        }

        /*==COLOR==*/
        a,
        .bttn-style2 a,
        .bttn-style6 a,
        .style3.punte-pricing-table .ppt-icon,
        .style6.punte-pricing-table .ppt-icon,
        .punte-blog-post .cat-links a:hover,
        .blog-style1 .entry-share a:hover,
        .blog-style3 .entry-share a:hover,
        .blog-style4 .entry-share a:hover,
        .punte-blog-post .entry-header a:hover,
        .comment-list a:hover,
        .post-navigation a:hover,
        .punte-related-post-wrap h4 a:hover,
        .punte-news-ticker h4 a:hover,
        .punte-blog-block h4 a:hover,
        .pbp-pagination .page-numbers,
        .punte-pricing-table.style2 .ppt-button:hover,
        .punte-counter.style3 .pc-value,
        .blog-style1 .entry-readmore a:hover, 
        .blog-style1 .entry-readmore a:focus
        {
        color: <?php echo punte_escape_colors($skin_color); ?>
        }

        a:hover,
        .woocommerce .product_meta a:hover{
        color: <?php echo punte_escape_colors($darker_skin_color); ?>
        }

        /*==BORDER COLOR==*/
        .bttn-style2.punte-pricing-table a,
        .bttn-style6.punte-pricing-table a,
        .style6.punte-pricing-table,
        .blog-style1 .entry-readmore a:hover,
        .blog-style3 .entry-readmore a:hover,
        .sidebar-style2 .widget-title,
        .sidebar-style5 .widget,
        .sidebar-style4 .widget-title,
        .punte-blog-header,
        .pbp-pagination .page-numbers,
        .style1.punte-blockquote,
        .style2.punte-blockquote,
        .punte-pricing-table.style2:hover .ppt-header,
        .punte-pricing-table.style2 .ppt-button:hover,
        .punte-counter.style3,
        .pbg-category a,
        .pbs-slide-caption .pbs-category a,
        .pwtb-catname-wrapper a,
        .blog-style1 .entry-readmore a{
        border-color: <?php echo punte_escape_colors($skin_color); ?>
        }

        .style1.punte-pricing-table .ppt-header:after{
        border-color: <?php echo punte_escape_colors($skin_color) . " " . punte_escape_colors($skin_color); ?> transparent transparent
        }

        .style1.punte-pricing-table .ppt-header:before{
        border-color: transparent transparent <?php echo punte_escape_colors($skin_color) . " " . punte_escape_colors($skin_color); ?>
        }

        .style2 .ppt-header:before{
        border-color: transparent <?php echo punte_escape_colors($skin_color) . " " . punte_escape_colors($skin_color); ?> transparent;
        }

        .style3 .pnt-title span,
        .punte-blog-post.style3 .punte-blog-list.pbp-even .punte-blog-list-inner:after,
        .blog-style1.sticky{
        border-left-color: <?php echo punte_escape_colors($skin_color); ?> ;
        }

        .punte-blog-post.style3 .punte-blog-list.pbp-odd .punte-blog-list-inner:after{
        border-right-color: <?php echo punte_escape_colors($skin_color); ?> ;
        }


        /*==BOX SHADOW==*/
        .style6.punte-pricing-table .ppt-price{
        box-shadow: 0 0 0 5px #FFF, 0 0 0 7px <?php echo punte_escape_colors($skin_color); ?>;
        }


        .punte-blog-post.style3 .punte-blog-list.pbp-odd .punte-blog-list-inner:before,
        .punte-blog-post.style3 .punte-blog-list.pbp-even .punte-blog-list-inner:before{
        box-shadow: 0 0px 0px 3px <?php echo punte_escape_colors($ligther_skin_color); ?>;
        }

        .header-layout1 .main-header,
        .header-layout1 .site-branding,
        .header-layout5 .main-header,
        .header-layout5 .site-branding,
        .header-layout6 .main-header,
        .header-layout6 .site-branding{
        height: <?php echo absint($navbar_height); ?>px;
        }

        .header-layout6 .is-sticky .main-header,
        .header-layout6 .is-sticky .site-branding{
        height: <?php echo absint($navbar_height) - 20; ?>px;
        }

        .header-layout1 ul.punte-main-menu > li > a,
        .header-layout1 ul.punte-main-menu > li.header-search i,
        .header-layout5 ul.punte-main-menu > li > a,
        .header-layout5 ul.punte-main-menu > li.header-search i,
        .header-layout6 ul.punte-main-menu > li > a,
        .header-layout6 ul.punte-main-menu > li.header-search i{
        line-height: <?php echo absint($navbar_height); ?>px;
        }

        .header-layout6 .is-sticky ul.punte-main-menu > li > a,
        .header-layout6 .is-sticky ul.punte-main-menu > li.header-search i{
        line-height: <?php echo absint($navbar_height) - 20; ?>px;
        }


        .header-layout5 .top-header{
        padding-bottom: <?php echo 10 + absint($navbar_height) / 2; ?>px !important;
        }

        .header-layout5 .top-header + .main-header-wrap,
        .header-layout5 .top-header + .main-header-wrap + .punte-mobile-header{
        margin-top: -<?php echo absint($navbar_height) / 2 ?>px
        }

        .header-layout5 + #content{
        transform: translateY(-<?php echo absint($navbar_height) / 2 ?>px);
        -webkit-transform: translateY(-<?php echo absint($navbar_height) / 2 ?>px);
        -ms-transform: translateY(-<?php echo absint($navbar_height) / 2 ?>px);
        margin-bottom: -<?php echo absint($navbar_height) / 2 ?>px
        }

        .header-layout5 + #content .page-header .page-title-wrap{
        margin-top: <?php echo absint($navbar_height) / 2 ?>px;
        }

        .header-layout5 + .site-content > .punte-container:first-child{
        margin-top: <?php echo absint($navbar_height) / 2 + 40 ?>px;
        }

        <?php
        if ( !$punte_options[ 'top-header' ] && $punte_options[ 'header-style' ] == "header-5" ) {
            echo '.header-layout5 + #content{margin-top: -' . absint($navbar_height) . 'px}';
            echo '.header-layout5 + #content .page-header .page-title-wrap{	margin-top: ' . absint($navbar_height) . 'px}';
        }
        ?>

        .site-header .site-branding{
        padding-top: <?php echo esc_html($logo_padding[ 'padding-top' ]) ?>;
        padding-right: <?php echo esc_html($logo_padding[ 'padding-right' ]) ?>;
        padding-bottom: <?php echo esc_html($logo_padding[ 'padding-bottom' ]) ?>;
        padding-left: <?php echo esc_html($logo_padding[ 'padding-left' ]) ?>;
        }

        /*==TYPOGRAPHY==*/
        <?php
        $menu_typography_style  = !empty( $menu_typography[ 'font-style' ] ) ? $menu_typography[ 'font-style' ] : 'normal';
        ?>
        .punte-main-menu{
        font-family: '<?php echo esc_html($menu_typography[ 'font-family' ]) ?>';
        font-size: <?php echo esc_html($menu_typography[ 'font-size' ]) ?>;
        font-weight: <?php echo esc_html($menu_typography[ 'font-weight' ]) ?>;
        font-style: <?php echo esc_html($menu_typography_style) ?>;
        text-transform: <?php echo esc_html($menu_typography[ 'text-transform' ]) ?>;
        letter-spacing: <?php echo esc_html($menu_typography[ 'letter-spacing' ]) ?>;
        }

        .punte-main-menu a{
        color: <?php echo punte_escape_colors($punte_options[ 'menu-link-color' ][ 'regular' ]); ?>;
        font-weight: <?php echo esc_html($menu_typography[ 'font-weight' ]) ?>;
        font-style: <?php echo esc_html($menu_typography_style) ?>;
        }



        #primary{
        width: <?php echo absint($punte_options[ 'content-sidebar-ratio' ]) ?>%;
        }

        .sidebar{
        width: <?php echo intval( 97 - $punte_options[ 'content-sidebar-ratio' ] ) ?>%;
        }

        #colophon{
        background-color: <?php echo punte_escape_colors($punte_options[ 'footer-background-color' ]); ?>;
        color: <?php echo punte_escape_colors($punte_options[ 'footer-text-color' ]); ?>;
        font-size: <?php echo esc_html($punte_options[ 'footer-font-size' ]); ?>px;
        }

        .site-footer a{
        color: <?php echo punte_escape_colors($punte_options[ 'footer-link-color' ][ 'regular' ]); ?>
        }

        .site-footer a:hover{
        color: <?php echo punte_escape_colors($punte_options[ 'footer-link-color' ][ 'hover' ]); ?>
        }

        #bottom-footer .punte-container{
        background: <?php echo punte_escape_colors(punte_darken_color( $punte_options[ 'footer-background-color' ], -0.10 )); ?>
        }

        ul.punte-main-menu > li > a,
        .header-layout4 .header-search-wrapper .search-field,
        .header-layout4 .header-search-wrapper .search-field,
        .header-layout4 .header-search-wrapper .search-field,
        .header-layout4 .header-search-wrapper .search-field{
        color: <?php echo esc_html($punte_options[ 'menu-link-color' ][ 'regular' ]); ?>;
        }

        .header-layout4 .header-search-wrapper .search-field::-webkit-input-placeholder,
        .header-layout4 .header-search-wrapper .search-field::-moz-placeholder,
        .header-layout4 .header-search-wrapper .search-field:-ms-input-placeholder,
        .header-layout4 .header-search-wrapper .search-field:-moz-placeholder{
        color: <?php echo esc_html($punte_options[ 'menu-link-color' ][ 'regular' ]); ?>;
        opacity: 1;
        }

        ul.punte-main-menu > li > a:hover,
        .home .punte-transparent-header ul.punte-main-menu > li > a:hover{
        color: <?php echo punte_escape_colors($punte_options[ 'menu-link-color' ][ 'hover' ]); ?>
        }

        nav.main-navigation ul.punte-main-menu > li.menu-item-has-children > a:hover:after,
        .home .punte-transparent-header ul.punte-main-menu > li.menu-item-has-children > a:hover:after{
            border-color: <?php echo punte_escape_colors($punte_options[ 'menu-link-color' ][ 'hover' ]); ?>
        }

        <?php if ( !empty( $punte_options[ 'submenu-background' ][ 'color' ] ) ) { ?>
            ul.punte-main-menu ul{
            background: <?php echo esc_html($punte_options[ 'submenu-background' ][ 'rgba' ]); ?>
            }
        <?php } ?>

        ul.punte-main-menu ul li a{
        color: <?php echo punte_escape_colors($punte_options[ 'submenu-link-color' ][ 'regular' ]); ?>
        }

        ul.punte-main-menu ul li a:hover{
        color: <?php echo punte_escape_colors($punte_options[ 'submenu-link-color' ][ 'hover' ]); ?>
        }

        <?php
        if ( !empty( $punte_options[ 'header-background' ][ 'color' ] ) ) {
            $header_background = $punte_options[ 'header-background' ][ 'rgba' ];
            $header_dark_background = punte_darken_color( $header_background, -0.10 );
            ?>
            .main-header,
            .header-layout5 .main-header,
            .punte-mobile-header{
            background: <?php echo esc_html($header_background); ?>
            }
            .header-layout1 .site-branding,
            .header-layout1 .main-header,
            .header-layout2 .main-header,
            .header-layout3 .main-header,
            .header-layout1 .menu-item-search,
            .header-layout2 .site-branding,
            .header-layout2 .top-header,
            .header-layout3 .main-navigation,
            .header-layout2,
            .punte-mobile-header{
            border-color: <?php echo esc_html($header_dark_background); ?>
            }
        <?php } ?>

        .site-header .top-header{
        padding-top: <?php echo esc_html($top_header_padding[ 'padding-top' ]) ?>;
        padding-bottom: <?php echo esc_html($top_header_padding[ 'padding-bottom' ]) ?>;
        color: <?php echo punte_escape_colors($top_header_text_color) ?>;
        }

        <?php if ( !empty( $punte_options[ 'top-header-background' ][ 'color' ] ) ) { ?>
            .site-header .top-header,
            .top-menu ul{
            background: <?php echo esc_html($punte_options[ 'top-header-background' ][ 'rgba' ]); ?>
            }
        <?php } ?>

        .site-header .top-header a{
        color: <?php echo esc_html($punte_options[ 'top-header-link-color' ][ 'regular' ]); ?>
        }

        .site-header .top-header a:hover{
        color: <?php echo esc_html($punte_options[ 'top-header-link-color' ][ 'hover' ]); ?>
        }

        <?php if ( punte_is_woocommerce_activated() ) { ?>

            .woocommerce ul.products li.product .price,
            .woocommerce div.product p.price, 
            .woocommerce div.product span.price,
            .woocommerce-error:before, 
            .woocommerce-info:before, 
            .woocommerce-message:before{
            color: <?php echo punte_escape_colors($skin_color) ?>;
            }

            .woocommerce #respond input#submit, 
            .woocommerce a.button, 
            .woocommerce button.button, 
            .woocommerce input.button,
            .woocommerce #respond input#submit.alt, 
            .woocommerce a.button.alt, 
            .woocommerce button.button.alt, 
            .woocommerce input.button.alt,
            .woocommerce nav.woocommerce-pagination ul li a, 
            .woocommerce nav.woocommerce-pagination ul li span,
            .woocommerce span.onsale,
            .woocommerce div.product .woocommerce-tabs ul.tabs li,
            .woocommerce #respond input#submit.disabled, 
            .woocommerce #respond input#submit:disabled, 
            .woocommerce #respond input#submit:disabled[disabled], 
            .woocommerce a.button.disabled, .woocommerce a.button:disabled, 
            .woocommerce a.button:disabled[disabled], 
            .woocommerce button.button.disabled, 
            .woocommerce button.button:disabled, 
            .woocommerce button.button:disabled[disabled], 
            .woocommerce input.button.disabled, 
            .woocommerce input.button:disabled, 
            .woocommerce input.button:disabled[disabled],
            .woocommerce #respond input#submit.alt.disabled, 
            .woocommerce #respond input#submit.alt.disabled:hover, 
            .woocommerce #respond input#submit.alt:disabled, 
            .woocommerce #respond input#submit.alt:disabled:hover, 
            .woocommerce #respond input#submit.alt:disabled[disabled], 
            .woocommerce #respond input#submit.alt:disabled[disabled]:hover, 
            .woocommerce a.button.alt.disabled, 
            .woocommerce a.button.alt.disabled:hover, 
            .woocommerce a.button.alt:disabled, 
            .woocommerce a.button.alt:disabled:hover, 
            .woocommerce a.button.alt:disabled[disabled], 
            .woocommerce a.button.alt:disabled[disabled]:hover, 
            .woocommerce button.button.alt.disabled, 
            .woocommerce button.button.alt.disabled:hover, 
            .woocommerce button.button.alt:disabled, 
            .woocommerce button.button.alt:disabled:hover, 
            .woocommerce button.button.alt:disabled[disabled], 
            .woocommerce button.button.alt:disabled[disabled]:hover, 
            .woocommerce input.button.alt.disabled, 
            .woocommerce input.button.alt.disabled:hover, 
            .woocommerce input.button.alt:disabled, 
            .woocommerce input.button.alt:disabled:hover, 
            .woocommerce input.button.alt:disabled[disabled], 
            .woocommerce input.button.alt:disabled[disabled]:hover,
            .woocommerce .widget_price_filter .ui-slider .ui-slider-range,
            .woocommerce-MyAccount-navigation-link a,.cart-contents .cart-count{
            background-color: <?php echo punte_escape_colors($skin_color) ?>;
            }

            .woocommerce #respond input#submit, 
            .woocommerce a.button, 
            .woocommerce button.button, 
            .woocommerce input.button,
            .woocommerce #respond input#submit.alt, 
            .woocommerce a.button.alt, 
            .woocommerce button.button.alt, 
            .woocommerce input.button.alt,
            .woocommerce #respond input#submit.alt.disabled, 
            .woocommerce #respond input#submit.alt.disabled:hover, 
            .woocommerce #respond input#submit.alt:disabled, 
            .woocommerce #respond input#submit.alt:disabled:hover, 
            .woocommerce #respond input#submit.alt:disabled[disabled], 
            .woocommerce #respond input#submit.alt:disabled[disabled]:hover, 
            .woocommerce a.button.alt.disabled, 
            .woocommerce a.button.alt.disabled:hover, 
            .woocommerce a.button.alt:disabled, 
            .woocommerce a.button.alt:disabled:hover, 
            .woocommerce a.button.alt:disabled[disabled], 
            .woocommerce a.button.alt:disabled[disabled]:hover, 
            .woocommerce button.button.alt.disabled, 
            .woocommerce button.button.alt.disabled:hover, 
            .woocommerce button.button.alt:disabled, 
            .woocommerce button.button.alt:disabled:hover, 
            .woocommerce button.button.alt:disabled[disabled], 
            .woocommerce button.button.alt:disabled[disabled]:hover, 
            .woocommerce input.button.alt.disabled, 
            .woocommerce input.button.alt.disabled:hover, 
            .woocommerce input.button.alt:disabled, 
            .woocommerce input.button.alt:disabled:hover, 
            .woocommerce input.button.alt:disabled[disabled], 
            .woocommerce input.button.alt:disabled[disabled]:hover,
            .woocommerce .widget_price_filter .ui-slider .ui-slider-handle{
            border-color: <?php echo punte_escape_colors($skin_color) ?>;
            }

            .woocommerce span.onsale:after{
            border-color: transparent <?php echo punte_escape_colors($skin_color) ?> <?php echo punte_escape_colors($skin_color) ?> transparent;
            }

            .woocommerce ul.products li.product .onsale:after{
            border-color: transparent transparent <?php echo punte_escape_colors($skin_color) ?> <?php echo punte_escape_colors($skin_color) ?>;
            }

            .woocommerce-error, 
            .woocommerce-info, 
            .woocommerce-message{
            border-top-color: <?php echo punte_escape_colors($skin_color) ?>
            }

            .woocommerce #respond input#submit:hover, 
            .woocommerce a.button:hover, 
            .woocommerce button.button:hover, 
            .woocommerce input.button:hover,
            .woocommerce #respond input#submit.alt:hover, 
            .woocommerce a.button.alt:hover, 
            .woocommerce button.button.alt:hover, 
            .woocommerce input.button.alt:hover,
            .woocommerce nav.woocommerce-pagination ul li a:focus, 
            .woocommerce nav.woocommerce-pagination ul li a:hover, 
            .woocommerce nav.woocommerce-pagination ul li span.current,
            .woocommerce div.product .woocommerce-tabs ul.tabs li.active,
            .woocommerce #respond input#submit.disabled:hover, 
            .woocommerce #respond input#submit:disabled:hover, 
            .woocommerce #respond input#submit:disabled[disabled]:hover, 
            .woocommerce a.button.disabled:hover, 
            .woocommerce a.button:disabled:hover, 
            .woocommerce a.button:disabled[disabled]:hover, 
            .woocommerce button.button.disabled:hover, 
            .woocommerce button.button:disabled:hover, 
            .woocommerce button.button:disabled[disabled]:hover, 
            .woocommerce input.button.disabled:hover, 
            .woocommerce input.button:disabled:hover, 
            .woocommerce input.button:disabled[disabled]:hover,
            .woocommerce-MyAccount-navigation-link.is-active a,
            .woocommerce-MyAccount-navigation-link a:hover{
            background: <?php echo punte_escape_colors($darker_skin_color) ?>
            }

            .woocommerce #respond input#submit:hover, 
            .woocommerce a.button:hover, 
            .woocommerce button.button:hover, 
            .woocommerce input.button:hover,
            .woocommerce #respond input#submit.alt:hover, 
            .woocommerce a.button.alt:hover, 
            .woocommerce button.button.alt:hover, 
            .woocommerce input.button.alt:hover{
            border-color: <?php echo punte_escape_colors($darker_skin_color) ?>
            }

        <?php } ?>
       

        <?php
        /*if ( is_singular( array( 'post', 'page' ) ) ) {

            $style = '';
            $styles = array();

            if ( isset( $body_background[ 'background-color' ] ) && !empty( $body_background[ 'background-color' ] ) ) {
                $styles[] = 'background-color:' . punte_escape_colors($body_background[ 'background-color' ]);
            }

            if ( isset( $body_background[ 'background-image' ] ) && !empty( $body_background[ 'background-image' ] ) ) {
                $styles[] = 'background-image: url(' . esc_url($body_background[ 'background-image' ]) . ')';
            }

            if ( isset( $body_background[ 'background-repeat' ] ) && !empty( $body_background[ 'background-repeat' ] ) ) {
                $styles[] = 'background-repeat:' . esc_attr($body_background[ 'background-repeat' ]);
            }

            if ( isset( $body_background[ 'background-position' ] ) && !empty( $body_background[ 'background-position' ] ) ) {
                $styles[] = 'background-position:' . esc_attr($body_background[ 'background-position' ]);
            }

            if ( isset( $body_background[ 'background-size' ] ) && !empty( $body_background[ 'background-size' ] ) ) {
                $styles[] = 'background-size:' . esc_attr($body_background[ 'background-size' ]);
            }

            if ( isset( $body_background[ 'background-attachment' ] ) && !empty( $body_background[ 'background-attachment' ] ) ) {
                $styles[] = 'background-attachment:' . esc_attr($body_background[ 'background-attachment' ]);
            }

            $style = implode( ';', $styles );
            if ( $style ) {
                echo 'body{' . $style . '}'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            }
        }*/

        //breadcrumb styles
        if ( is_singular( array( 'post', 'page') ) || ( class_exists('woocommerce') && is_woocommerce() ) || is_archive() || is_search() || is_home() ) {

            if ( is_singular( 'page' ) ) {
                
                $text_color = isset( $punte_options[ 'page-header-text-color' ] ) ? $punte_options[ 'page-header-text-color' ] : '#333333';
                $header_overlay_color = isset( $punte_options[ 'page-header-overlay-color' ] ) ? $punte_options[ 'page-header-overlay-color' ] : array( 'color' => '#000000', 'alpha' => '0.3' );
                $padding = isset( $punte_options[ 'page-header-padding' ] ) ? $punte_options[ 'page-header-padding' ] : array( 'padding-top' => '20px', 'padding-bottom' => '20px' );
                $page_background = isset( $punte_options[ 'page-header-bg' ] ) ? $punte_options[ 'page-header-bg' ] : array( 'background-color' => '#f5f4f4' );
                
            } elseif ( is_singular( array( 'post' ) ) ) {
               
                $text_color = isset( $punte_options[ 'post-header-text-color' ] ) ? $punte_options[ 'post-header-text-color' ] : '#333333';
                $header_overlay_color = isset( $punte_options[ 'post-header-overlay-color' ] ) ? $punte_options[ 'post-header-overlay-color' ] : array( 'color' => '#000000', 'alpha' => '0.3' );
                $padding = isset( $punte_options[ 'post-header-padding' ] ) ? $punte_options[ 'post-header-padding' ] : array( 'padding-top' => '20px', 'padding-bottom' => '20px' );
                $page_background = isset( $punte_options[ 'post-header-bg' ] ) ? $punte_options[ 'post-header-bg' ] : array( 'background-color' => '#f5f4f4' );

            } elseif ( class_exists('woocommerce') && is_woocommerce() ) {
                $breadcrumb_color = isset( $punte_options[ 'woo-breadcrumb-color' ] ) ? $punte_options[ 'woo-breadcrumb-color' ] : '#333333';
                $text_color = isset( $punte_options[ 'woo-header-text-color' ] ) ? $punte_options[ 'woo-header-text-color' ] : '#333333';
                $header_overlay_color = isset( $punte_options[ 'woo-header-overlay-color' ] ) ? $punte_options[ 'woo-header-overlay-color' ] : array( 'color' => '#000000', 'alpha' => '0.3' );
                $padding = isset( $punte_options[ 'woo-header-padding' ] ) ? $punte_options[ 'woo-header-padding' ] : array( 'padding-top' => '20px', 'padding-bottom' => '20px' );
                $page_background = isset( $punte_options[ 'woo-header-bg' ] ) ? $punte_options[ 'woo-header-bg' ] : array( 'background-color' => '#f5f4f4' );
            } elseif ( is_home() || is_search() || (is_archive() && !is_post_type_archive()) ) {
                $breadcrumb_color = $text_color = isset( $punte_options[ 'archive-header-text-color' ] ) ? $punte_options[ 'archive-header-text-color' ] : '#333333';
                $header_overlay_color = isset( $punte_options[ 'archive-header-overlay-color' ] ) ? $punte_options[ 'archive-header-overlay-color' ] : array( 'color' => '#000000', 'alpha' => '0.3' );
                $padding = isset( $punte_options[ 'archive-header-padding' ] ) ? $punte_options[ 'archive-header-padding' ] : array( 'padding-top' => '20px', 'padding-bottom' => '20px' );
                $page_background = isset( $punte_options[ 'archive-header-bg' ] ) ? $punte_options[ 'archive-header-bg' ] : array( 'background-color' => '#f5f4f4' );
            }

            $styles = array();
            $style = '';

            if ( isset( $page_background[ 'background-color' ] ) && !empty( $page_background[ 'background-color' ] ) ) {
                $styles[] = 'background-color:' . $page_background[ 'background-color' ];
            }

            if ( isset( $page_background[ 'background-image' ] ) && !empty( $page_background[ 'background-image' ] ) ) {
                $styles[] = 'background-image: url(' . $page_background[ 'background-image' ] . ')';
            }

            if ( isset( $page_background[ 'background-repeat' ] ) && !empty( $page_background[ 'background-repeat' ] ) ) {
                $styles[] = 'background-repeat:' . $page_background[ 'background-repeat' ];
            }

            if ( isset( $page_background[ 'background-position' ] ) && !empty( $page_background[ 'background-position' ] ) ) {
                $styles[] = 'background-position:' . $page_background[ 'background-position' ];
            }

            if ( isset( $page_background[ 'background-size' ] ) && !empty( $page_background[ 'background-size' ] ) ) {
                $styles[] = 'background-size:' . $page_background[ 'background-size' ];
            }

            if ( isset( $page_background[ 'background-attachment' ] ) && !empty( $page_background[ 'background-attachment' ] ) ) {
                $styles[] = 'background-attachment:' . $page_background[ 'background-attachment' ];
            }

            if ( isset( $padding[ 'padding-top' ] ) && !empty( $padding[ 'padding-top' ] ) ) {
                $styles[] = 'padding-top:' . $padding[ 'padding-top' ];
            }

            if ( isset( $padding[ 'padding-bottom' ] ) && !empty( $padding[ 'padding-bottom' ] ) ) {
                $styles[] = 'padding-bottom:' . $padding[ 'padding-bottom' ];
            }

            $style = implode( ';', $styles );
            if ( $style ) {
                echo '.page-header{' . $style . '}';
            }

            if ( isset( $text_color ) && !empty( $text_color ) ) {
                echo '.page-header .page-title,.page-header .page-sub-title,.page-header nav ul.trail-items li span{ color:' . $text_color . '}';
                echo '.page-header nav ul.trail-items li span::after{ border-color:'.$text_color.'}';
                echo '.header-style3 .page-title:after{ background:' . $text_color . '}';
            }

            if ( isset( $header_overlay_color[ 'rgba' ] ) && !empty( $header_overlay_color[ 'rgba' ] ) ) {
                echo '.page-header-overlay{background-color:' . $header_overlay_color[ 'rgba' ] . '}';
            }

            if ( isset( $breadcrumb_color ) && !empty( $breadcrumb_color ) ) {
                echo '.breadcrumbs,.breadcrumbs a,.woocommerce .woocommerce-breadcrumb,.woocommerce .woocommerce-breadcrumb a{color:' . $breadcrumb_color . '}';
            }


        }//breadcrumb ending

      

        $custom_header = isset( $punte_options[ 'enable-custom-header' ] ) ? $punte_options[ 'enable-custom-header' ] : false;
        if ( $custom_header && isset( $punte_options[ 'custom-header-page' ] ) && !empty( $punte_options[ 'custom-header-page' ] ) ) {

            $custom_header_page_id          = $punte_options[ 'custom-header-page' ];
            $custom_header_font_color       = isset( $punte_options[ 'custom-header-font-color' ] ) ? $punte_options[ 'custom-header-font-color' ] : '#333333';
            $custom_header_link_color       = isset( $punte_options[ 'custom-header-link-color' ][ 'regular' ] ) ? $punte_options[ 'custom-header-link-color' ][ 'regular' ] : '#333333';
            $custom_header_link_color_hov   = isset( $punte_options[ 'custom-header-link-color' ][ 'hover' ] ) ? $punte_options[ 'custom-header-link-color' ][ 'hover' ] : '#25bcea';

            echo get_post_meta( $custom_header_page_id, '_wpb_shortcodes_custom_css', true );
            echo '.punte-custom-header{color:' . punte_escape_colors($custom_header_font_color) . ';}';
            echo '.punte-custom-header a{color:' . punte_escape_colors($custom_header_link_color) . ';}';
            echo '.punte-custom-header a:hover{color:' . punte_escape_colors($custom_header_link_color_hov) . ';}';
        }

        $custom_footer = isset( $punte_options[ 'enable-custom-footer' ] ) ? $punte_options[ 'enable-custom-footer' ] : false;
        if ( $custom_footer && isset( $punte_options[ 'custom-footer-page' ] ) && !empty( $punte_options[ 'custom-footer-page' ] ) ) {

            $custom_footer_page_id          = $punte_options[ 'custom-footer-page' ];
            $custom_footer_font_color       = isset( $punte_options[ 'custom-footer-font-color' ] ) ? $punte_options[ 'custom-footer-font-color' ] : '#333333';
            $custom_footer_link_color       = isset( $punte_options[ 'custom-footer-link-color' ][ 'regular' ] ) ? $punte_options[ 'custom-footer-link-color' ][ 'regular' ] : '#333333';
            $custom_footer_link_color_hov   = isset( $punte_options[ 'custom-footer-link-color' ][ 'hover' ] ) ? $punte_options[ 'custom-footer-link-color' ][ 'hover' ] : '#25bcea';

            echo get_post_meta( $custom_footer_page_id, '_wpb_shortcodes_custom_css', true );
            echo '.punte-custom-footer{color:' . punte_escape_colors($custom_footer_font_color) . ';}';
            echo '.punte-custom-footer a{color:' . punte_escape_colors($custom_footer_link_color) . ';}';
            echo '.punte-custom-footer a:hover{color:' . punte_escape_colors($custom_footer_link_color_hov) . ';}';
        }
        ?>

        @media screen and (max-width:<?php echo absint($responsive_width) ?>px){
        .main-header,
        .main-header-wrap,
        .menu-item-search{
        display: none !important;
        }

        .punte-mobile-header{
        display: block !important;
        }

        .header-layout4{
        position: relative;
        width: auto;
        max-width: none;
        box-shadow: none;
        }

        .header-layout4 + .site-content, 
        .header-layout4 + .site-content + footer{
        margin-left: 0;
        }
        }

        <?php
        if ( $punte_options[ 'header-style' ] == 'header-6' ) {
            ?>
            @media screen and (max-width:<?php echo absint($punte_options[ 'container-width' ]) + 340 ?>px){
            #page,
            .punte-container{
            width: 100%;
            }

            .punte-container{
            padding: 0 5%;
            }
            }
            <?php
        } else {
            ?>
            @media screen and (max-width:<?php echo absint($punte_options[ 'container-width' ]) + 40 ?>px){
            #page,
            .punte-container{
            width: 100%;
            }

            .punte-container{
            padding: 0 5%;
            }
            }
            <?php
        }
        ?>
        @media screen and (max-width:<?php echo absint($punte_options[ 'container-width' ]) + 40 ?>px){
        .both-sidebar .site-content > .punte-container,
        .both-left-sidebar .site-content > .punte-container,
        .both-right-sidebar .site-content > .punte-container{
        padding: 0 5%;
        }

        .both-sidebar #primary,
        .both-left-sidebar #primary,
        .both-right-sidebar #primary{
        float: none;
        }

        .both-sidebar .sidebar-left,
        .both-left-sidebar .sidebar-left,
        .both-right-sidebar .sidebar-left{
        width: 48%;
        margin: 0;
        float: left;
        }

        .both-sidebar .sidebar-right,
        .both-left-sidebar .sidebar-right,
        .both-right-sidebar .sidebar-right{
        width: 48%;
        margin: 0;
        right: 0;
        float: right;
        }
        }
        <?php
        
        $hook_css       = '';
        $dynamic_hook   = apply_filters('punte_dynamic_styles',$hook_css);


        $css = ob_get_clean();

        $css = punte_css_strip_whitespace( $css );

       

        wp_add_inline_style( 'punte-style', $css );
    }

}

add_action( 'wp_enqueue_scripts', 'punte_main_dynamic_styles', 100 );
