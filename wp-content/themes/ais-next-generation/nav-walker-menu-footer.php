<?php
class Bootstrap_Navwalker_Footer_Custom extends Walker_Nav_Menu {

    // Start Level
    function start_lvl(&$output, $depth = 0, $args = null) {
        $output .= '<ul class="list-unstyled">';
    }

    // Start Element
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {

        $classes = empty($item->classes) ? [] : (array) $item->classes;
        //$has_children = in_array('menu-item-has-children', $classes);

        // if ($has_children) {
        //     $classes[] = 'dropdown';
        // }

        $class_names = join(' ', $classes);

        $output .= '<li class="' . esc_attr($class_names) . '">';

        $atts  = ' href="' . esc_url($item->url) . '"';

        $output .= '<a'.$atts.'>';

        $output .= '<span>' . esc_html($item->title) . '</span>';

        // if ($has_children) {
        //     $output .= ' <i class="bi bi-chevron-down toggle-dropdown"></i>';
        // }

        $output .= '</a>';
    }

    // End Element
    function end_el(&$output, $item, $depth = 0, $args = null) {
        $output .= '</li>';
    }
}