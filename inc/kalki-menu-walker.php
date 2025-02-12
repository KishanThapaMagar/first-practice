<?php
class Kalki_Menu_Walker extends Walker_Nav_Menu {
    public function start_el( &$output, $data_object, $depth = 0, $args = null, $current_object_id = 0 ) {
        // Ensure $args is an object
        $args = is_object($args) ? $args : (object) $args;
        
        // Restores the more descriptive, specific name for use within this method.
        $menu_item = $data_object;

        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

        $classes   = empty( $menu_item->classes ) ? array() : (array) $menu_item->classes;
        $classes[] = 'menu-item-' . $menu_item->ID;
        $classes[] = 'nav-item';

        $args = apply_filters( 'nav_menu_item_args', $args, $menu_item, $depth );

        $class_names = implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $menu_item, $args, $depth ) );

        $id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $menu_item->ID, $menu_item, $args, $depth );

        $li_atts          = array();
        $li_atts['id']    = ! empty( $id ) ? $id : '';
        $li_atts['class'] = ! empty( $class_names ) ? $class_names : '';

        $li_atts       = apply_filters( 'nav_menu_item_attributes', $li_atts, $menu_item, $args, $depth );
        $li_attributes = $this->build_atts( $li_atts );

        $output .= $indent . '<li' . $li_attributes . '>';

        $title = apply_filters( 'the_title', $menu_item->title, $menu_item->ID );

        $the_title_filtered = $title;

        $title = apply_filters( 'nav_menu_item_title', $title, $menu_item, $args, $depth );

        $atts           = array();
        $atts['target'] = ! empty( $menu_item->target ) ? $menu_item->target : '';
        $atts['rel']    = ! empty( $menu_item->xfn ) ? $menu_item->xfn : '';

        if ( ! empty( $menu_item->url ) ) {
            if ( get_privacy_policy_url() === $menu_item->url ) {
                $atts['rel'] = empty( $atts['rel'] ) ? 'privacy-policy' : $atts['rel'] . ' privacy-policy';
            }

            $atts['href'] = $menu_item->url;
        } else {
            $atts['href'] = '';
        }

        $atts['aria-current'] = $menu_item->current ? 'page' : '';

        if ( ! empty( $menu_item->attr_title )
            && trim( strtolower( $menu_item->attr_title ) ) !== trim( strtolower( $menu_item->title ) )
            && trim( strtolower( $menu_item->attr_title ) ) !== trim( strtolower( $the_title_filtered ) )
            && trim( strtolower( $menu_item->attr_title ) ) !== trim( strtolower( $title ) )
        ) {
            $atts['title'] = $menu_item->attr_title;
        } else {
            $atts['title'] = '';
        }

        $atts['class'] = 'nav-link';

        $atts       = apply_filters( 'nav_menu_link_attributes', $atts, $menu_item, $args, $depth );
        $attributes = $this->build_atts( $atts );

        // Ensure safe access to $args->link_before and $args->link_after
        $item_output  = isset($args->link_before) ? $args->link_before : '';
        $item_output .= '<a' . $attributes . '>';
        $item_output .= (isset($args->link_before) ? $args->link_before : '') . $title . (isset($args->link_after) ? $args->link_after : '');
        $item_output .= '</a>';
        $item_output .= isset($args->link_after) ? $args->link_after : '';

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $menu_item, $depth, $args );
    }
}
