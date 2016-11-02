<?php

function lasso_editor_component_sidebar() {
    ob_start();

    if ( !lasso_user_can() )
    return;

    // let users add custom css classes
    $custom_classes = apply_filters( 'lasso_sidebar_classes', '' );
    $html  = '<div id="lasso--sidebar" class="' . sanitize_html_class( $custom_classes ) . ' test" >';
        $html .= '<div class="lasso--sidebar__inner">';
            $html .= '<div id="lasso--component__settings"></div>';
        $html .= '</div>';
    $html .= '</div>';

    return apply_filters('lasso_sidebar_html', $html);
}

/**
 * Draw the main toolbar used to edit the text
 *
 * @since 1.0
 */
function lasso_editor_text_toolbar() {

    ob_start();

    if ( !lasso_user_can() )
        return;

    $is_mobile = wp_is_mobile();

    // check for lasso story engine and add a class doniting this
    $ase_status = class_exists( 'Aesop_Core' ) || defined( 'LASSO_CUSTOM' ) ? 'ase-active' : 'ase-not-active';

    // let users add custom css classes
    $custom_classes = apply_filters( 'lasso_toolbar_classes', '' );

    // are toolbar headings enabled
    $toolbar_headings      = lasso_editor_get_option( 'toolbar_headings', 'lasso_editor' );
    $toolbar_class  = $toolbar_headings ? 'toolbar-extended' : false;

    // mobile styles
    $mobile_class = $is_mobile ? 'lasso-mobile' : false;
    $mobile_style =$is_mobile ? 'style="top:40px;"' : null;

    // let's add the most basic ones
    $toolbar_items = [
        "lasso-toolbar--bold" => '<li id="lasso-toolbar--bold" title="' . esc_attr_e( "Bold", "lasso" ) . '"></li>',
        "lasso-toolbar--underline" => '<li id="lasso-toolbar--underline" title="' . esc_attr_e( "Underline", "lasso" ) . '"></li>',
        "lasso-toolbar--italic" => '<li id="lasso-toolbar--italic" title="' . esc_attr_e( "Italic", "lasso" ) . '"></li>',
        "lasso-toolbar--strike" => '<li id="lasso-toolbar--strike" title="' . esc_attr_e( "Strike", "lasso" ) . '"></li>',
    ];

    // now glue it all together
    $html  = '<div class="lasso--toolbar_wrap lasso-editor-controls--wrap' . $toolbar_class . ' ' . $mobile_class . ' ' . $ase_status . ' ' . sanitize_html_class( $custom_classes ) . '" ' . $mobile_style . '>';
    $html .= '	<ul class="lasso--toolbar__inner lasso-editor-controls">';
    $html .= do_action( 'lasso_toolbar_components_before' );


    $html .= implode("", apply_filters("lasso_toolbar_components_items", $toolbar_items));
    $html .= do_action( 'lasso_toolbar_components_after' );
    $html .= '</ul></div>';

    return $html;
}