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
function lasso_editor_text_toolbar()
{

    ob_start();

    if (!lasso_user_can())
        return;

    $is_mobile = wp_is_mobile();

    // check for lasso story engine and add a class doniting this
    $ase_status = class_exists('Aesop_Core') || defined('LASSO_CUSTOM') ? 'ase-active' : 'ase-not-active';

    // let users add custom css classes
    $custom_classes = apply_filters('lasso_toolbar_classes', '');

    // are toolbar headings enabled
    $toolbar_headings = lasso_editor_get_option('toolbar_headings', 'lasso_editor');

    $toolbar_class = $toolbar_headings ? 'toolbar-extended' : false;

    // mobile styles
    $mobile_class = $is_mobile ? 'lasso-mobile' : false;
    $mobile_style = $is_mobile ? 'style="top:40px;"' : null;

    //show color
    $show_color = lasso_editor_get_option('toolbar_show_color', 'lasso_editor');

    //show alignment
    $show_align = lasso_editor_get_option('toolbar_show_alignment', 'lasso_editor');


    ?>
    <div class="lasso--toolbar_wrap lasso-editor-controls--wrap <?php echo $toolbar_class . ' ' . $mobile_class . ' ' . $ase_status . ' ' . sanitize_html_class($custom_classes); ?>" <?php echo $mobile_style ?>>
        <ul class="lasso--toolbar__inner lasso-editor-controls">
            <?php do_action('lasso_toolbar_components_before'); ?>
            <li id="lasso-toolbar--bold" title="<?php esc_attr_e('Bold', 'lasso'); ?>"></li>
            <li id="lasso-toolbar--underline" title="<?php esc_attr_e('Underline', 'lasso'); ?>"></li>
            <li id="lasso-toolbar--italic" title="<?php esc_attr_e('Italicize', 'lasso'); ?>"></li>
            <li id="lasso-toolbar--strike" title="<?php esc_attr_e('Strikethrough', 'lasso'); ?>"></li>
            <?php if ($toolbar_headings): ?>
                <li id="lasso-toolbar--h2" title="<?php esc_attr_e('H2 Heading', 'lasso'); ?>"></li>
                <li id="lasso-toolbar--h3" title="<?php esc_attr_e('H3 Heading', 'lasso'); ?>"></li>
            <?php endif; ?>

            <?php if ($show_color): ?>
                <li id="lasso-toolbar--color-set" title="<?php esc_attr_e('Set Text Color', 'lasso'); ?>"></li>
                <li id="lasso-toolbar--color-pick" title="<?php esc_attr_e('Choose Color', 'lasso'); ?>"></li>
            <?php endif; ?>


            <li id="lasso-toolbar--components" title="<?php esc_attr_e('Insert Component', 'lasso'); ?>">
                <ul id="lasso-toolbar--components__list" style="display:none;">
                    <?php if ('ase-active' == $ase_status): ?>
                        <li data-type="image" title="<?php esc_attr_e('Image', 'lasso'); ?>"
                            class="lasso-toolbar--component__image"></li>
                        <li data-type="character" title="<?php esc_attr_e('Character', 'lasso'); ?>"
                            class="lasso-toolbar--component__character"></li>
                        <li data-type="quote" title="<?php esc_attr_e('Quote', 'lasso'); ?>"
                            class="lasso-toolbar--component__quote"></li>
                        <li data-type="content" title="<?php esc_attr_e('Content', 'lasso'); ?>"
                            class="lasso-toolbar--component__content"></li>
                        <li data-type="chapter" title="<?php esc_attr_e('Chapter', 'lasso'); ?>"
                            class="lasso-toolbar--component__chapter"></li>
                        <li data-type="parallax" title="<?php esc_attr_e('Parallax', 'lasso'); ?>"
                            class="lasso-toolbar--component__parallax"></li>
                        <li data-type="audio" title="<?php esc_attr_e('Audio', 'lasso'); ?>"
                            class="lasso-toolbar--component__audio"></li>
                        <li data-type="video" title="<?php esc_attr_e('Video', 'lasso'); ?>"
                            class="lasso-toolbar--component__video"></li>
                        <li data-type="map" title="<?php esc_attr_e('Map', 'lasso'); ?>"
                            class="lasso-toolbar--component__map"></li>
                        <li data-type="timeline_stop" title="<?php esc_attr_e('Timeline', 'lasso'); ?>"
                            class="lasso-toolbar--component__timeline"></li>
                        <li data-type="document" title="<?php esc_attr_e('Document', 'lasso'); ?>"
                            class="lasso-toolbar--component__document"></li>
                        <li data-type="collection" title="<?php esc_attr_e('Collection', 'lasso'); ?>"
                            class="lasso-toolbar--component__collection"></li>
                        <li data-type="gallery" title="<?php esc_attr_e('Gallery', 'lasso'); ?>"
                            class="lasso-toolbar--component__gallery"></li>
                        <?php if (class_exists('Aesop_GalleryPop')) { ?>
                            <li data-type="gallery" title="<?php esc_attr_e('Gallery Pop', 'lasso'); ?>"
                                class="lasso-toolbar--component__gallerypop"></li>
                        <?php } ?>
                    <?php else: ?>
                        <li data-type="wpimg" title="<?php esc_attr_e('WordPress Image', 'lasso'); ?>"
                            class="image lasso-toolbar--component__image"></li>
                        <li data-type="wpquote" title="<?php esc_attr_e('WordPress Quote', 'lasso'); ?>"
                            class="quote lasso-toolbar--component__quote"></li>
                        <!--li data-type="wpvideo" title="<?php esc_attr_e('WordPress Video', 'lasso'); ?>" class="video lasso-toolbar--component__video"></li-->
                    <?php endif; ?>
                    <?php do_action('lasso_toolbar_components'); ?>
                </ul>
            </li>
            <li id="lasso-toolbar--link" title="<?php esc_attr_e('Anchor Link', 'lasso'); ?>">
                <div id="lasso-toolbar--link__wrap" <?php echo $mobile_style ?> >
                    <div id="lasso-toolbar--link__inner" contenteditable="true"
                         placeholder="<?php esc_attr_e('http://url.com', 'lasso'); ?>"></div>
                    <a href="#" title="<?php esc_attr_e('Create Link', 'lasso'); ?>"
                       class="lasso-toolbar--link__control" id="lasso-toolbar--link__create"></a>
                    <input class="styled-checkbox" type="checkbox" id="aesop-toolbar--link_newtab" checked/>
                    <label for="aesop-toolbar--link_newtab">Open in Another Tab</label>
                </div>
            </li>
            <?php do_action('lasso_toolbar_components_after'); ?>
            <li id="lasso-toolbar--html" title="<?php esc_attr_e('Insert HTML', 'lasso'); ?>">
                <div id="lasso-toolbar--html__wrap" <?php echo $mobile_style ?>>
                    <div id="lasso-toolbar--html__inner" contenteditable="true"
                         placeholder="<?php esc_attr_e('Enter HTML to insert', 'lasso'); ?>"></div>
                    <div id="lasso-toolbar--html__footer">
                        <ul class="lasso-toolbar--html-snips">
                            <?php if (!$toolbar_headings): ?>
                            <li id="lasso-html--h2" title="<?php esc_attr_e('H2 Heading', 'lasso'); ?>">
                            <li id="lasso-html--h3" title="<?php esc_attr_e('H3 Heading', 'lasso'); ?>">
                                <?php endif; ?>
                            <li id="lasso-html--ul" title="<?php esc_attr_e('Unordered List', 'lasso'); ?>">
                            <li id="lasso-html--ol" title="<?php esc_attr_e('Ordered List', 'lasso'); ?>">
                        </ul>
                        <a class="lasso-toolbar--html__control lasso-toolbar--html__cancel"
                           href="#"><?php _e('Cancel', 'lasso'); ?></a>
                        <a href="#" title="<?php esc_attr_e('Insert HTML', 'lasso'); ?>"
                           class="lasso-toolbar--html__control"
                           id="lasso-toolbar--html__insert"><?php _e('Insert', 'lasso'); ?></a>
                    </div>
                </div>
            </li>
            <?php if ($show_align): ?>
                <li id="lasso-toolbar--left-align" title="<?php esc_attr_e('Text Left Align', 'lasso'); ?>"></li>
                <li id="lasso-toolbar--center-align"
                    title="<?php esc_attr_e('Text Center Align', 'lasso'); ?>"></li>
                <li id="lasso-toolbar--right-align" title="<?php esc_attr_e('Text Right Align', 'lasso'); ?>"></li>
            <?php endif; ?>
        </ul>
    </div>

    <?php return ob_get_clean();
}