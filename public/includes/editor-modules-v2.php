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