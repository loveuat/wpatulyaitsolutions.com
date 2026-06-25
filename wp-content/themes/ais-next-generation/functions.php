<?php
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);
/**
 * Theme functions and definitions
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'HELLO_ELEMENTOR_VERSION', '3.4.6' );
define( 'EHP_THEME_SLUG', 'hello-elementor' );

define( 'HELLO_THEME_PATH', get_template_directory() );
define( 'HELLO_THEME_URL', get_template_directory_uri() );
define( 'HELLO_THEME_ASSETS_PATH', HELLO_THEME_PATH . '/assets/' );
define( 'HELLO_THEME_ASSETS_URL', HELLO_THEME_URL . '/assets/' );
define( 'HELLO_THEME_SCRIPTS_PATH', HELLO_THEME_ASSETS_PATH . 'js/' );
define( 'HELLO_THEME_SCRIPTS_URL', HELLO_THEME_ASSETS_URL . 'js/' );
define( 'HELLO_THEME_STYLE_PATH', HELLO_THEME_ASSETS_PATH . 'css/' );
define( 'HELLO_THEME_STYLE_URL', HELLO_THEME_ASSETS_URL . 'css/' );
define( 'HELLO_THEME_IMAGES_PATH', HELLO_THEME_ASSETS_PATH . 'images/' );
define( 'HELLO_THEME_IMAGES_URL', HELLO_THEME_ASSETS_URL . 'images/' );
require_once get_template_directory() . '/nav-walker-menu.php';
require_once get_template_directory() . '/nav-walker-menu-footer.php';
// add_filter( 'use_block_editor_for_post_type', function( $enabled, $post_type ) {
//     return 'page' === $post_type ? false : $enabled;
// }, 10, 2 );
// function remove_pages_editor(){
//     remove_post_type_support( 'page', 'editor' );
// }
// add_action( 'init', 'remove_pages_editor' );
if ( ! isset( $content_width ) ) {
	$content_width = 800; // Pixels.
}

if ( ! function_exists( 'hello_elementor_setup' ) ) {
	/**
	 * Set up theme support.
	 *
	 * @return void
	 */
	function hello_elementor_setup() {
		if ( is_admin() ) {
			hello_maybe_update_theme_version_in_db();
		}

		if ( apply_filters( 'hello_elementor_register_menus', true ) ) {
			register_nav_menus( [ 'menu-1' => esc_html__( 'Header', 'hello-elementor' ) ] );
			register_nav_menus( [ 'menu-2' => esc_html__( 'Footer First', 'hello-elementor' ) ] );
			register_nav_menus( [ 'menu-3' => esc_html__( 'Footer Second', 'hello-elementor' ) ] );
			register_nav_menus( [ 'menu-4' => esc_html__( 'Footer Third', 'hello-elementor' ) ] );
		}

		if ( apply_filters( 'hello_elementor_post_type_support', true ) ) {
			add_post_type_support( 'page', 'excerpt' );
		}

		if ( apply_filters( 'hello_elementor_add_theme_support', true ) ) {
			add_theme_support( 'post-thumbnails' );
			add_theme_support( 'automatic-feed-links' );
			add_theme_support( 'title-tag' );
			add_theme_support(
				'html5',
				[
					'search-form',
					'comment-form',
					'comment-list',
					'gallery',
					'caption',
					'script',
					'style',
					'navigation-widgets',
				]
			);
			add_theme_support(
				'custom-logo',
				[
					'height'      => 100,
					'width'       => 350,
					'flex-height' => true,
					'flex-width'  => true,
				]
			);
			add_theme_support( 'align-wide' );
			add_theme_support( 'responsive-embeds' );

			/*
			 * Editor Styles
			 */
			add_theme_support( 'editor-styles' );
			add_editor_style( 'assets/css/editor-styles.css' );

			/*
			 * WooCommerce.
			 */
			if ( apply_filters( 'hello_elementor_add_woocommerce_support', true ) ) {
				// WooCommerce in general.
				add_theme_support( 'woocommerce' );
				// Enabling WooCommerce product gallery features (are off by default since WC 3.0.0).
				// zoom.
				add_theme_support( 'wc-product-gallery-zoom' );
				// lightbox.
				add_theme_support( 'wc-product-gallery-lightbox' );
				// swipe.
				add_theme_support( 'wc-product-gallery-slider' );
			}
		}
	}
}
add_action( 'after_setup_theme', 'hello_elementor_setup' );

function hello_maybe_update_theme_version_in_db() {
	$theme_version_option_name = 'hello_theme_version';
	// The theme version saved in the database.
	$hello_theme_db_version = get_option( $theme_version_option_name );

	// If the 'hello_theme_version' option does not exist in the DB, or the version needs to be updated, do the update.
	if ( ! $hello_theme_db_version || version_compare( $hello_theme_db_version, HELLO_ELEMENTOR_VERSION, '<' ) ) {
		update_option( $theme_version_option_name, HELLO_ELEMENTOR_VERSION );
	}
}

if ( ! function_exists( 'hello_elementor_display_header_footer' ) ) {
	/**
	 * Check whether to display header footer.
	 *
	 * @return bool
	 */
	function hello_elementor_display_header_footer() {
		$hello_elementor_header_footer = true;

		return apply_filters( 'hello_elementor_header_footer', $hello_elementor_header_footer );
	}
}

if ( ! function_exists( 'hello_elementor_scripts_styles' ) ) {
	/**
	 * Theme Scripts & Styles.
	 *
	 * @return void
	 */
	function hello_elementor_scripts_styles() {
		if ( apply_filters( 'hello_elementor_enqueue_style', true ) ) {
			wp_enqueue_style(
				'hello-elementor',
				HELLO_THEME_STYLE_URL . 'reset.css',
				[],
				HELLO_ELEMENTOR_VERSION
			);
		}

		if ( apply_filters( 'hello_elementor_enqueue_theme_style', true ) ) {
			wp_enqueue_style(
				'hello-elementor-theme-style',
				HELLO_THEME_STYLE_URL . 'theme.css',
				[],
				HELLO_ELEMENTOR_VERSION
			);
		}

		if ( hello_elementor_display_header_footer() ) {
			wp_enqueue_style(
				'hello-elementor-header-footer',
				HELLO_THEME_STYLE_URL . 'header-footer.css',
				[],
				HELLO_ELEMENTOR_VERSION
			);
		}

		wp_enqueue_style(
				'bootstrap-css',
				HELLO_THEME_STYLE_URL . 'bootstrap.min.css',
				[],
				HELLO_ELEMENTOR_VERSION
			);
		wp_enqueue_style(
				'bootstrap-icons-css',
				HELLO_THEME_STYLE_URL . 'bootstrap-icons.css',
				[],
				HELLO_ELEMENTOR_VERSION
			);
		wp_enqueue_style(
				'aos-css',
				HELLO_THEME_STYLE_URL . 'aos.css',
				[],
				HELLO_ELEMENTOR_VERSION
			);
		wp_enqueue_style(
				'glightbox-css',
				HELLO_THEME_STYLE_URL . 'glightbox.min.css',
				[],
				HELLO_ELEMENTOR_VERSION
			);
		wp_enqueue_style(
				'swiper-css',
				HELLO_THEME_STYLE_URL . 'swiper-bundle.min.css',
				[],
				HELLO_ELEMENTOR_VERSION
			);
		wp_enqueue_style(
				'main',
				HELLO_THEME_STYLE_URL . 'main.css',
				[],
				HELLO_ELEMENTOR_VERSION
			);
		$args = array( 
		    'in_footer' => true,
		    'strategy'  => 'defer',
		);
		wp_enqueue_script(
				'bootstrap-js',
				HELLO_THEME_SCRIPTS_URL . 'bootstrap.bundle.min.js',
				['jquery'],
				HELLO_ELEMENTOR_VERSION,
				$args
			);
		// wp_enqueue_script(
		// 		'validate-js',
		// 		HELLO_THEME_SCRIPTS_URL . 'validate.js',
		// 		['jquery'],
		// 		HELLO_ELEMENTOR_VERSION,
		// 		$args
		// 	);
		wp_enqueue_script(
				'aos-js',
				HELLO_THEME_SCRIPTS_URL . 'aos.js',
				['jquery'],
				HELLO_ELEMENTOR_VERSION,
				$args
			);
		wp_enqueue_script(
				'glightbox-js',
				HELLO_THEME_SCRIPTS_URL . 'glightbox.min.js',
				['jquery'],
				HELLO_ELEMENTOR_VERSION,
				$args
			);
		wp_enqueue_script(
				'imagesloaded-js',
				HELLO_THEME_SCRIPTS_URL . 'imagesloaded.pkgd.min.js',
				['jquery'],
				HELLO_ELEMENTOR_VERSION,
				$args
			);
		wp_enqueue_script(
				'isotope-js',
				HELLO_THEME_SCRIPTS_URL . 'isotope.pkgd.min.js',
				['jquery'],
				HELLO_ELEMENTOR_VERSION,
				$args
			);
		wp_enqueue_script(
				'purecounter_vanilla-js',
				HELLO_THEME_SCRIPTS_URL . 'purecounter_vanilla.js',
				['jquery'],
				HELLO_ELEMENTOR_VERSION,
				$args
			);
		wp_enqueue_script(
				'swiper-js',
				HELLO_THEME_SCRIPTS_URL . 'swiper-bundle.min.js',
				['jquery'],
				HELLO_ELEMENTOR_VERSION,
				$args
			);
		wp_enqueue_script(
        'digio-sdk',
        'https://app.digio.in/sdk/v11/digio.js',
        array(),
        HELLO_ELEMENTOR_VERSION,
        $args
    );
    wp_enqueue_script(
        'digio-init',
        get_template_directory_uri() . '/assets/js/digio-init.js',
        array('digio-sdk'),
        HELLO_ELEMENTOR_VERSION,
        $args
    );
		wp_enqueue_script(
				'main-js',
				HELLO_THEME_SCRIPTS_URL . 'main.js',
				['jquery','bootstrap-js'],
				HELLO_ELEMENTOR_VERSION,
				$args
			);
		 wp_localize_script(
        'main-js',
        'customScripts', // JS object name
        array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'base_url' => get_site_url(),
            'theme_url' => get_stylesheet_directory_uri(),
            'nonce'    => wp_create_nonce('digio_nonce'),
        )
    	);


	// 	if ( is_page_template( 'template-razorpay-payment.php' ) ) {
			
	// 		wp_enqueue_script(
	// 			'razorpay-js',
	// 			'https://checkout.razorpay.com/v1/checkout.js',
	// 			['jquery','bootstrap-js'],
	// 			HELLO_ELEMENTOR_VERSION,
	// 			$args
	// 		);
	// 	wp_enqueue_script(
	// 			'razorpay-custom-js',
	// 			HELLO_THEME_SCRIPTS_URL . 'razorpay.js',
	// 			['jquery','bootstrap-js'],
	// 			HELLO_ELEMENTOR_VERSION,
	// 			$args
	// 		);
	// 	 wp_localize_script(
    //     'razorpay-custom-js',
    //     'razorpayScripts', // JS object name
    //     array(
    //         'ajax_url' => admin_url('admin-ajax.php'),
    //         'base_url' => get_site_url(),
    //         'theme_url' => get_stylesheet_directory_uri(),
    //        // 'nonce'    => wp_create_nonce('digio_nonce'),
    //     )
    // 	);
	// }
	}
}
add_action( 'wp_print_footer_scripts', 'hello_elementor_scripts_styles' );

if ( ! function_exists( 'hello_elementor_register_elementor_locations' ) ) {
	/**
	 * Register Elementor Locations.
	 *
	 * @param ElementorPro\Modules\ThemeBuilder\Classes\Locations_Manager $elementor_theme_manager theme manager.
	 *
	 * @return void
	 */
	function hello_elementor_register_elementor_locations( $elementor_theme_manager ) {
		if ( apply_filters( 'hello_elementor_register_elementor_locations', true ) ) {
			$elementor_theme_manager->register_all_core_location();
		}
	}
}
add_action( 'elementor/theme/register_locations', 'hello_elementor_register_elementor_locations' );

if ( ! function_exists( 'hello_elementor_content_width' ) ) {
	/**
	 * Set default content width.
	 *
	 * @return void
	 */
	function hello_elementor_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'hello_elementor_content_width', 800 );
	}
}
add_action( 'after_setup_theme', 'hello_elementor_content_width', 0 );

if ( ! function_exists( 'hello_elementor_add_description_meta_tag' ) ) {
	/**
	 * Add description meta tag with excerpt text.
	 *
	 * @return void
	 */
	function hello_elementor_add_description_meta_tag() {
		if ( ! apply_filters( 'hello_elementor_description_meta_tag', true ) ) {
			return;
		}

		if ( ! is_singular() ) {
			return;
		}

		$post = get_queried_object();
		if ( empty( $post->post_excerpt ) ) {
			return;
		}

		echo '<meta name="description" content="' . esc_attr( wp_strip_all_tags( $post->post_excerpt ) ) . '">' . "\n";
	}
}
add_action( 'wp_head', 'hello_elementor_add_description_meta_tag' );

// Settings page
require get_template_directory() . '/includes/settings-functions.php';

// Header & footer styling option, inside Elementor
require get_template_directory() . '/includes/elementor-functions.php';

if ( ! function_exists( 'hello_elementor_customizer' ) ) {
	// Customizer controls
	function hello_elementor_customizer() {
		if ( ! is_customize_preview() ) {
			return;
		}

		if ( ! hello_elementor_display_header_footer() ) {
			return;
		}

		require get_template_directory() . '/includes/customizer-functions.php';
	}
}
add_action( 'init', 'hello_elementor_customizer' );

if ( ! function_exists( 'hello_elementor_check_hide_title' ) ) {
	/**
	 * Check whether to display the page title.
	 *
	 * @param bool $val default value.
	 *
	 * @return bool
	 */
	function hello_elementor_check_hide_title( $val ) {
		if ( defined( 'ELEMENTOR_VERSION' ) ) {
			$current_doc = Elementor\Plugin::instance()->documents->get( get_the_ID() );
			if ( $current_doc && 'yes' === $current_doc->get_settings( 'hide_title' ) ) {
				$val = false;
			}
		}
		return $val;
	}
}
add_filter( 'hello_elementor_page_title', 'hello_elementor_check_hide_title' );

/**
 * BC:
 * In v2.7.0 the theme removed the `hello_elementor_body_open()` from `header.php` replacing it with `wp_body_open()`.
 * The following code prevents fatal errors in child themes that still use this function.
 */
if ( ! function_exists( 'hello_elementor_body_open' ) ) {
	function hello_elementor_body_open() {
		wp_body_open();
	}
}

/**
 * Customize the custom logo HTML output
 */
// function my_custom_logo_modifier( $html ) {
//     // Add custom class or change HTML here
//     $html = str_replace( 'custom-logo-link', 'logo d-flex align-items-center me-auto me-xl-0', $html );
    

//     $html = str_replace('<img', '<img loading="lazy"', $html);

//      $html = preg_replace('/(width|height)="\d*"\s/', "", $html);

//     return $html;
// }
// add_filter( 'get_custom_logo', 'my_custom_logo_modifier' );

function my_theme_logo($location = 'header') {
    $logo = get_custom_logo();

    if ($location === 'footer') {
        $logo = apply_filters('my_footer_logo', $logo);
    } else {
        $logo = apply_filters('my_header_logo', $logo);
    }

    echo $logo;
}

add_filter('my_header_logo', function($html) {

    $html = str_replace(
        'custom-logo-link',
        'logo header-logo d-flex align-items-center me-auto me-xl-0',
        $html
    );

    $html = str_replace('<img', '<img loading="lazy"', $html);
    $html = preg_replace('/(width|height)="\d*"\s/', "", $html);

    return $html;
});
add_filter('my_footer_logo', function($html) {

    $html = str_replace(
        'custom-logo-link',
        'footer-logo logo d-flex align-items-center mb-3',
        $html
    );

    // Example: smaller logo or different styling
    $html = str_replace('<img', '<img loading="lazy"', $html);

    $html = preg_replace('/(width|height)="\d*"\s/', "", $html);

    return $html;
});
use Carbon_Fields\Carbon_Fields;
function convert_bootstrap_css_to_array($css) {
    preg_match_all('/\.bi-([a-z0-9\-]+)::before/', $css, $matches);

    $icons = array();

    foreach ($matches[1] as $icon) {
        $icons['bi-' . $icon] = 'bi-' . $icon; // label simple rakho
    }

    return $icons;
}
function get_all_icons() {

    // 🔹 Bootstrap CSS file path (local recommended)
    $css_file = get_template_directory() . '/assets/css/bootstrap-icons.css';
    //https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css
    $bootstrap_icons = array();

    if (file_exists($css_file)) {
        $css = file_get_contents($css_file);
        $bootstrap_icons = convert_bootstrap_css_to_array($css);
    }

    // 🔹 Custom Icons (manual add)
    $custom_icons = array(
        'custom-whatsapp' => 'custom-whatsapp',
        'custom-telegram' => 'custom-telegram',
        'custom-growth' => 'custom-growth',
    );

    // 🔹 Merge both
    return array_merge($bootstrap_icons, $custom_icons);
}

add_action('after_setup_theme', function () {
	$plugin_path = plugin_dir_path( Carbon_Fields_Plugin\PLUGIN_FILE );
require_once $plugin_path.'vendor/autoload.php';
    \Carbon_Fields\Carbon_Fields::boot();
    require_once get_template_directory() . '/fields/theme-options.php';
    require_once get_template_directory() . '/fields/blocks/hero/hero.php';
    require_once get_template_directory() . '/fields/blocks/hero/hero-carousel/hero-carousel.php';
    require_once get_template_directory() . '/fields/blocks/hero/hero-second/hero-second.php';
    require_once get_template_directory() . '/fields/blocks/who-we-are/who-we-are.php';
    require_once get_template_directory() . '/fields/blocks/about/about-one/about-one.php';
    require_once get_template_directory() . '/fields/blocks/contact/contact-first/contact-first.php';
    require_once get_template_directory() . '/fields/blocks/testimonials/testimonial-first/testimonial-first.php';
    require_once get_template_directory() . '/fields/blocks/teams/team-first/team-first.php';
    require_once get_template_directory() . '/fields/blocks/pricing/pricing-first/pricing-first.php';
    require_once get_template_directory() . '/fields/blocks/faqs/faq-first/faq-first.php';
    require_once get_template_directory() . '/fields/blocks/services/services-second/services-second.php';
    require_once get_template_directory() . '/fields/blocks/hero/hero-four/hero-four.php';
    require_once get_template_directory() . '/fields/blocks/hero/hero-five/hero-five.php';
    require_once get_template_directory() . '/fields/blocks/what-we-do/what-we-do-first/what-we-do-first.php';
    require_once get_template_directory() . '/fields/blocks/what-we-do/what-we-do-second/what-we-do-second.php';
    require_once get_template_directory() . '/fields/blocks/image-with-text/image-with-text-left.php';
    require_once get_template_directory() . '/fields/blocks/text-blocks/large-heading/large-heading.php';
    require_once get_template_directory() . '/fields/blocks/content-box/content-box.php';
    require_once get_template_directory() . '/fields/blocks/content-box/step-card.php';
    require_once get_template_directory() . '/fields/blocks/content-box/decorated-list-items.php';
    require_once get_template_directory() . '/fields/blocks/content-box/feature-list.php';
    require_once get_template_directory() . '/fields/blocks/content-box/content-table.php';
 require_once get_template_directory() . '/fields/blocks/testimonials/testimonial-with-border/testimonial-with-border.php';
});
//use Carbon_Fields\Carbon_Fields;
add_filter('carbon_fields_compact_input', '__return_true');
add_filter('forminator_field_markup','custom_field_markup',10,3); 
function custom_field_markup($html, $field, $form_id) {
	// echo "<pre>";
	// print_r($field);
	// echo "</pre>";
		$uid = Forminator_CForm_Front::$uid;
    // TEXT FIELD (Name)
   if ($field['type'] === 'name') {

    $required = $field['required'];
    $required_sign = $required ? '<span class="forminator-required">*</span>' : '';

    $id = $field['element_id'];

    // ✅ plain text placeholder
    $placeholder = $field['field_label'] . ($required ? ' *' : '');

    return '
    <div class="form-floating mb-3 forminator-field">
    
        <input 
            type="text" 
            class="form-control forminator-'.$field['type'].'--field" 
            id="forminator-field-'.$id.'_'.$uid.'" 
            name="'.$id.'" 
            placeholder="'.$placeholder.'" 
            '.($required ? 'required' : '').'
        >
        
        <label for="forminator-field-'.$id.'_'.$uid.'">
            '.$field['field_label'].' '.$required_sign.'
        </label>
        
    </div>
    ';
}
 if ($field['type'] === 'text') {
 	$required = $field['required'];
    $required_sign = $required ? '<span class="forminator-required">*</span>' : '';

    $id = $field['element_id'];

    // ✅ plain text placeholder
    $placeholder = $field['field_label'] . ($required ? ' *' : '');
    $description = !empty($field['description'])
        ? '<small class="form-text text-muted d-block fs-xxs">' .
            esc_html($field['description']) .
          '</small>'
        : '';
    return '
    <div class="form-floating mb-3 forminator-field">
        <input 
            type="text" 
            class="form-control forminator-'.$field['type'].'--field" 
            id="forminator-field-'.$id.'_'.$uid.'" 
            name="'.$id.'" 
            placeholder="'.$placeholder.'" 
            '.$required_attr.'
        >
        <label for="forminator-field-'.$id.'_'.$uid.'">'.$field['field_label'].' '.$required_sign.'</label>
        '.$description.'
    </div>';
}
if ($field['type'] === 'number') {
	$prefilled_value = '';
$readonly = '';

if (!empty($field['prefill']) && !empty($_GET[$field['prefill']])) {

    $prefilled_value = sanitize_text_field($_GET[$field['prefill']]);

    $readonly = 'readonly';
}
$required = $field['required'];
    $required_sign = $required ? '<span class="forminator-required">*</span>' : '';

    $id = $field['element_id'];

    // ✅ plain text placeholder
    $placeholder = $field['field_label'] . ($required ? ' *' : '');

    return '
    <div class="form-floating mb-3 forminator-field">
        <input 
            type="number" 
            class="form-control forminator-'.$field['type'].'--field" 
            id="forminator-field-'.$id.'_'.$uid.'" 
            name="'.$id.'" 
            placeholder="'.$placeholder.'" 
            '.$required_attr.'
             value="'.esc_attr($prefilled_value).'"
        '.$readonly.'
        >
        <label for="forminator-field-'.$id.'_'.$uid.'">'.$field['field_label'].' '.$required_sign.'</label>
    </div>';
}
if ($field['type'] === 'address') {
$required = $field['required'];
    $required_sign = $required ? '<span class="forminator-required">*</span>' : '';

    $id = $field['element_id'];
    $field['street_address'] == true;
    if($field['street_address'] == true){
    	$id = $field['element_id'].'-street_address';
    }
    // ✅ plain text placeholder
    $placeholder = $field['field_label'] . ($required ? ' *' : '');

    return '
    <div class="form-floating mb-3 forminator-field">
        <input 
            type="text" 
            class="form-control forminator-'.$field['type'].'--field" 
            id="forminator-field-'.$id.'_'.$uid.'" 
            name="'.$id.'" 
            placeholder="'.$placeholder.'" 
            '.$required_attr.'
        >
        <label for="forminator-field-'.$id.'_'.$uid.'">'.$field['field_label'].' '.$required_sign.'</label>
    </div>';
}

if ($field['type'] === 'select') {
$selected_value = '';
$select_disabled = '';
if (!empty($field['prefill']) && !empty($_GET[$field['prefill']])) {
    $selected_value = sanitize_text_field($_GET[$field['prefill']]);
    $select_disabled = 'readonly';
}
$required = $field['required'];
    $required_sign = $required ? '<span class="forminator-required">*</span>' : '';

    $id = $field['element_id'];

    // ✅ plain text placeholder
    $placeholder = $field['field_label'] . ($required ? ' *' : '');

    $is_multi = (!empty($field['value_type']) && $field['value_type'] === 'multiselect');
    $multiple = $is_multi ? 'multiple' : '';
    $multiple_class = $is_multi ? 'forminator-select2 forminator-select2-multiple' : '';

    $html = '
    <div class="form-floating mb-3 forminator-field">
        <select '.$multiple.'  '.$select_disabled.'
            class="form-select forminator-'.$field['type'].'--field '.$multiple_class.'" 
            id="forminator-field-'.$id.'_'.$uid.'" 
            name="'.$id.'"
            '.$required_attr.'
        >
        <option value="">Select '.$field['field_label'].'</option>';

    foreach ($field['options'] as $option) {
         $selected = ($selected_value === $option['value'])
        ? ' selected="selected"'
        : '';

    $html .= '<option value="' . esc_attr($option['value']) . '"' . $selected . '>'
        . esc_html($option['label']) .
        '</option>';
    }

    $html .= '
        </select>
        <label for="forminator-field-'.$id.'_'.$uid.'">'.$field['field_label'].' '.$required_sign.'</label>
    </div>';

    return $html;
}
 if ($field['type'] === 'date') {

   $required = $field['required'];
    $required_sign = $required ? '<span class="forminator-required">*</span>' : '';

    $id = $field['element_id'];

    // ✅ plain text placeholder
    $placeholder = $field['field_label'] . ($required ? ' *' : '');

    

    return '
    <div class="form-floating mb-3 forminator-field">
   
        <input 
            type="text" 
            class="form-control  forminator-datepicker forminator-'.$field['type'].'--field" 
            id="forminator-field-'.$id.'_'.$uid.'" size="1"
            name="'.$id.'" 
            placeholder="'.$field['field_label'].'" 
				data-required="" data-format="mm/dd/yy" data-restrict-type="" data-restrict="" data-start-year="1926" data-end-year="2008" data-past-dates="enable" data-start-of-week="1" data-start-date="" data-end-date="'.date('Y-m-d').'" data-start-field="" data-end-field="" data-start-offset="'.$field['start-offset-value'].'" data-end-offset="" data-disable-date="" data-disable-range=""
        >
        <label for="forminator-field-'.$id.'_'.$uid.'">'.$field['field_label'].'</label>
    </div>
    ';
}

    // EMAIL FIELD
  if ($field['type'] === 'email') {
$required = $field['required'];
    $required_sign = $required ? '<span class="forminator-required">*</span>' : '';

    $id = $field['element_id'];

    // ✅ plain text placeholder
    $placeholder = $field['field_label'] . ($required ? ' *' : '');

    return '
    <div class="form-floating mb-3 forminator-field">
        <input 
            type="email" 
            class="form-control forminator-'.$field['type'].'--field" 
            id="forminator-field-'.$id.'_'.$uid.'"  
            name="'.$id.'" 
            placeholder="'.$placeholder.'" 
            '.$required_attr.'
        >
        <label for="forminator-field-'.$id.'_'.$uid.'">'.$field['field_label'].' '.$required_sign.'</label>
    </div>';
}

    // PHONE FIELD
   if ($field['type'] === 'phone') {
$required = $field['required'];
    $required_sign = $required ? '<span class="forminator-required">*</span>' : '';

    $id = $field['element_id'];

    // ✅ plain text placeholder
    $placeholder = $field['field_label'] . ($required ? ' *' : '');

    return '
    <div class="form-floating mb-3 forminator-iti-input iti">
    <div class="iti__country-container" style="right: 0px;"><div class="iti__selected-country" title="India: +91"><div class="iti__selected-country-primary"><div class="iti__flag iti__in"><span class="iti__a11y-text">India +91</span></div></div></div></div>
        <input 
            type="text" 
            class="form-control forminator-'.$field['type'].'--field iti__tel-input" 
            id="forminator-field-'.$id.'_'.$uid.'" 
data-national_mode="enabled" data-country="in" data-validation="standard" data-intl-tel-input-id="0"
            name="'.$id.'" 
            placeholder="'.$placeholder.'" 
            '.$required_attr.'
        >
        <label for="forminator-field-'.$id.'_'.$uid.'">'.$field['field_label'].' '.$required_sign.'</label>
    </div>';
}

    // TEXTAREA
  if ($field['type'] === 'textarea') {
$required = $field['required'];
    $required_sign = $required ? '<span class="forminator-required">*</span>' : '';

    $id = $field['element_id'];

    // ✅ plain text placeholder
    $placeholder = $field['field_label'] . ($required ? ' *' : '');

    return '
    <div class="form-floating mb-3">
        <textarea 
            class="form-control forminator-'.$field['type'].'--field" 
            id="forminator-field-'.$id.'_'.$uid.'" 
            name="'.$id.'" 
            placeholder="'.$placeholder.'" 
            style="height: 150px"
            '.$required_attr.'
        ></textarea>
        <label for="forminator-field-'.$id.'_'.$uid.'">'.$field['field_label'].' '.$required_sign.'</label>
    </div>';
}
if ($field['type'] === 'upload') {
$required = $field['required'];
    $required_sign = $required ? '<span class="forminator-required">*</span>' : '';

    $id = $field['element_id'];

    // ✅ plain text placeholder
    $placeholder = $field['field_label'] . ($required ? ' *' : '');

    return '
    <div class="mb-3 forminator-field">
        <label class="form-label">'.$field['field_label'].' '.$required_sign.'</label>
        <input 
            type="file" 
            class="form-control forminator-file--field" 
            id="forminator-field-'.$id.'_'.$uid.'" 
            name="'.$id.'"
            '.$required_attr.'
        >
    </div>';
}

     return $html;

};
add_filter('forminator_render_form_submit_markup','custom_submit_button_markup',10,5);
 function custom_submit_button_markup($html, $form_id, $post_id, $nonce, $settings) {
 	global $wpdb;
     $selected_form_id = function_exists('carbon_get_theme_option') 
        ? carbon_get_theme_option('selected_forminator_form') 
        : '';

    // 2. Validation checks
    if (empty($selected_form_id)) {
        return $html; // no form selected in theme options
    }

    // sanitize
    $selected_form_id = intval($selected_form_id);
    $form_id = intval($form_id);

    // 3. Match condition
    if ($form_id !== $selected_form_id) {
        if (strpos($html, 'forminator-button') !== false) {

	        $custom_button = '
	        <div class="d-grid custom-forminator-button ">
	            <button type="submit" class="btn-submit forminator-button forminator-button-submit">
	                '.$settings['submitData']['custom-submit-text'].' <i class="bi bi-send-fill ms-2"></i>
	            </button>
	        </div>';

	        // Replace entire button tag
	        $html = preg_replace('/<button.*?<\/button>/s', $custom_button, $html);
	    }
    }else{
    	 if (strpos($html, 'forminator-button') !== false) {

	        $custom_button = '
	        <div class="d-grid custom-forminator-button ">
	            <button type="submit" class="btn-submit forminator-button forminator-button-submit forminator-hidden">
	                '.$settings['submitData']['custom-submit-text'].' <i class="bi bi-send-fill ms-2"></i>
	            </button>
	        </div>';
	        $custom_button .= '<div id="digio-button-wrapper"></div>';
	        // Replace entire button tag
	        $html = preg_replace('/<button.*?<\/button>/s', $custom_button, $html);
	    }
    }
   

    return $html;
};
function my_custom_breadcrumb() {

    ob_start(); // buffer start
    ?>
    
    <div class="breadcrumbs">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">

          <!-- Home -->
          <li class="breadcrumb-item">
            <a href="<?php echo home_url(); ?>">
              <i class="bi bi-house"></i> Home
            </a>
          </li>

          <?php

          if (is_page()) {

              global $post;

              if ($post->post_parent) {
                  $parents = array_reverse(get_post_ancestors($post->ID));

                  foreach ($parents as $parent) {
                      echo '<li class="breadcrumb-item">
                              <a href="'.get_permalink($parent).'">'.get_the_title($parent).'</a>
                            </li>';
                  }
              }

              echo '<li class="breadcrumb-item active current">'.get_the_title().'</li>';
          }

          elseif (is_single()) {

              $categories = get_the_category();

              if (!empty($categories)) {
                  $cat = $categories[0];

                  echo '<li class="breadcrumb-item">
                          <a href="'.get_category_link($cat->term_id).'">'.$cat->name.'</a>
                        </li>';
              }

              echo '<li class="breadcrumb-item active current">'.get_the_title().'</li>';
          }

          elseif (is_category()) {

              echo '<li class="breadcrumb-item active current">'.single_cat_title('', false).'</li>';
          }

          elseif (is_archive()) {

              echo '<li class="breadcrumb-item active current">'.post_type_archive_title('', false).'</li>';
          }

          elseif (is_search()) {

              echo '<li class="breadcrumb-item active current">Search Results for: '.get_search_query().'</li>';
          }

          elseif (is_404()) {

              echo '<li class="breadcrumb-item active current">404 Not Found</li>';
          }

          ?>

        </ol>
      </nav>
    </div>

    <?php
    return ob_get_clean(); // return HTML
}
function get_padding_options() {
    return array(

        '' => 'Default',

        // All sides
        'p-0' => 'No Inner Space',
        'p-1' => 'Extra Small Inner Space',
        'p-2' => 'Small Inner Space',
        'p-3' => 'Medium Inner Space',
        'p-4' => 'Large Inner Space',
        'p-5' => 'Extra Large Inner Space',

        // Top
        'pt-0' => 'Top No Space',
        'pt-1' => 'Top Extra Small Space',
        'pt-2' => 'Top Small Space',
        'pt-3' => 'Top Medium Space',
        'pt-4' => 'Top Large Space',
        'pt-5' => 'Top Extra Large Space',

        // Bottom
        'pb-0' => 'Bottom No Space',
        'pb-1' => 'Bottom Extra Small Space',
        'pb-2' => 'Bottom Small Space',
        'pb-3' => 'Bottom Medium Space',
        'pb-4' => 'Bottom Large Space',
        'pb-5' => 'Bottom Extra Large Space',

        // Left (start)
        'ps-0' => 'Left No Space',
        'ps-1' => 'Left Extra Small Space',
        'ps-2' => 'Left Small Space',
        'ps-3' => 'Left Medium Space',
        'ps-4' => 'Left Large Space',
        'ps-5' => 'Left Extra Large Space',

        // Right (end)
        'pe-0' => 'Right No Space',
        'pe-1' => 'Right Extra Small Space',
        'pe-2' => 'Right Small Space',
        'pe-3' => 'Right Medium Space',
        'pe-4' => 'Right Large Space',
        'pe-5' => 'Right Extra Large Space',

        // Horizontal
        'px-0' => 'Left & Right No Space',
        'px-1' => 'Left & Right Extra Small Space',
        'px-2' => 'Left & Right Small Space',
        'px-3' => 'Left & Right Medium Space',
        'px-4' => 'Left & Right Large Space',
        'px-5' => 'Left & Right Extra Large Space',

        // Vertical
        'py-0' => 'Top & Bottom No Space',
        'py-1' => 'Top & Bottom Extra Small Space',
        'py-2' => 'Top & Bottom Small Space',
        'py-3' => 'Top & Bottom Medium Space',
        'py-4' => 'Top & Bottom Large Space',
        'py-5' => 'Top & Bottom Extra Large Space',
    );
}
function get_margin_options() {
    return array(

        '' => 'Default',

        // All sides
        'm-0' => 'No Outer Space',
        'm-1' => 'Extra Small Outer Space',
        'm-2' => 'Small Outer Space',
        'm-3' => 'Medium Outer Space',
        'm-4' => 'Large Outer Space',
        'm-5' => 'Extra Large Outer Space',
        'm-auto' => 'Auto Margin (Center)',

        // Top
        'mt-0' => 'Top No Space',
        'mt-1' => 'Top Extra Small Space',
        'mt-2' => 'Top Small Space',
        'mt-3' => 'Top Medium Space',
        'mt-4' => 'Top Large Space',
        'mt-5' => 'Top Extra Large Space',
        'mt-auto' => 'Top Auto',

        // Bottom
        'mb-0' => 'Bottom No Space',
        'mb-1' => 'Bottom Extra Small Space',
        'mb-2' => 'Bottom Small Space',
        'mb-3' => 'Bottom Medium Space',
        'mb-4' => 'Bottom Large Space',
        'mb-5' => 'Bottom Extra Large Space',
        'mb-auto' => 'Bottom Auto',

        // Left (start)
        'ms-0' => 'Left No Space',
        'ms-1' => 'Left Extra Small Space',
        'ms-2' => 'Left Small Space',
        'ms-3' => 'Left Medium Space',
        'ms-4' => 'Left Large Space',
        'ms-5' => 'Left Extra Large Space',
        'ms-auto' => 'Left Auto',

        // Right (end)
        'me-0' => 'Right No Space',
        'me-1' => 'Right Extra Small Space',
        'me-2' => 'Right Small Space',
        'me-3' => 'Right Medium Space',
        'me-4' => 'Right Large Space',
        'me-5' => 'Right Extra Large Space',
        'me-auto' => 'Right Auto',

        // Horizontal
        'mx-0' => 'Left & Right No Space',
        'mx-1' => 'Left & Right Extra Small Space',
        'mx-2' => 'Left & Right Small Space',
        'mx-3' => 'Left & Right Medium Space',
        'mx-4' => 'Left & Right Large Space',
        'mx-5' => 'Left & Right Extra Large Space',
        'mx-auto' => 'Center Horizontally',

        // Vertical
        'my-0' => 'Top & Bottom No Space',
        'my-1' => 'Top & Bottom Extra Small Space',
        'my-2' => 'Top & Bottom Small Space',
        'my-3' => 'Top & Bottom Medium Space',
        'my-4' => 'Top & Bottom Large Space',
        'my-5' => 'Top & Bottom Extra Large Space',
        'my-auto' => 'Auto Vertical',
    );
}
//add_filter('forminator_form_submit_response', 'my_generate_agreement_pdf', 20, 2);
//add_filter('forminator_form_ajax_submit_response', 'my_generate_agreement_pdf', 20, 2);

function my_generate_agreement_pdf( $response, $form_id ) {
    global $wpdb;
     $selected_form_id = function_exists('carbon_get_theme_option') 
        ? carbon_get_theme_option('selected_forminator_form') 
        : '';

    // 2. Validation checks
    if (empty($selected_form_id)) {
        return $response; // no form selected in theme options
    }

    // sanitize
    $selected_form_id = intval($selected_form_id);
    $form_id = intval($form_id);

    // 3. Match condition
    if ($form_id !== $selected_form_id) {
        return $response;
    }

    // 4. Extra safety: ensure Forminator exists
    // if (!class_exists('Forminator_API')) {
    //     return $response;
    // }

    // 5. (Optional) Verify form actually exists
    // $form = Forminator_API::get_form($form_id);
    // if (!$form) {
    //     return $response;
    // }
    
     $entry_id = $wpdb->get_var(
        $wpdb->prepare(
            "SELECT entry_id FROM {$wpdb->prefix}frmt_form_entry WHERE form_id = %d ORDER BY entry_id DESC LIMIT 1",
            $form_id
        )
    );
    if (!$entry_id) return $response;
    $form_data = forminator_get_latest_entry_by_form_id($form_id)->meta_data;
    // echo "<pre>";
    // print_r($form_data);
    // echo "</pre>";
    $name   = isset($form_data['name-1']['value']) ? $form_data['name-1']['value'] : '';
    $fathername   = isset($form_data['name-2']['value']) ? $form_data['name-2']['value'] : '';
    // Accessing values
    $address = $form_data['address-1']['value'];
    $day   = current_time('d'); // Day with leading zero (01-31)
        $month = current_time('M'); // Month with leading zero (01-12)
        $year  = current_time('Y');
    $street   = isset($address['street_address']) ? $address['street_address'] : '';
    $line     = isset($address['address_line']) ? $address['address_line'] : '';
    $city     = isset($address['city']) ? $address['city'] : '';
    $state    = isset($address['state']) ? $address['state'] : '';
    $zip      = isset($address['zip']) ? $address['zip'] : '';
    $country  = isset($address['country']) ? $address['country'] : '';
    $fee_amount  = isset($form_data['number-1']['value']) ? $form_data['number-1']['value'] : '';
    $service_name  = isset($form_data['select-1']['value']) ? $form_data['select-1']['value'] : '';
    $payment_terms  = isset($form_data['select-2']['value']) ? $form_data['select-2']['value'] : $form_data['text-2']['value'];
    $pan = isset($form_data['text-1']['value']) ? $form_data['text-1']['value'] : '';
     $ra_sign_name = carbon_get_theme_option('ra_sign_name');
        $jurisdiction_city = carbon_get_theme_option('jurisdiction_city');
        $ra_address = carbon_get_theme_option('ra_address');
        $ra_website = carbon_get_theme_option('ra_website');
        $ra_phone = carbon_get_theme_option('ra_phone');
        $ra_email = carbon_get_theme_option('ra_email');
        $ra_reg_date = carbon_get_theme_option('ra_reg_date');
        $ra_name = carbon_get_theme_option('ra_name');
        $ra_brand = carbon_get_theme_option('ra_brand');
        $ra_registration_number = carbon_get_theme_option('ra_registration_number');
        $ra_sign = carbon_get_theme_option('ra_sign');
        $ra_sign_id = carbon_get_theme_option('ra_sign');
$ra_sign_url = wp_get_attachment_image_url($ra_sign_id, 'full');
$currency = '&#8377;';
        $upload_dir = wp_upload_dir();
    // Setup Dompdf
   require_once get_template_directory() . '/tcpdf/tcpdf.php'; // adjust path if Dompdf is 
    class MYPDF extends TCPDF {
    // Page header
       
    // Page header
        public function Header() {
        // --- Row 1: Logo in center ---
        $pdf_logo = carbon_get_theme_option('pdf_logo');
        $pdf_logo_path = get_attached_file($pdf_logo);
        $logo = $pdf_logo_path;
        $this->Image($logo, '', 3, 40, '', '', '', '', false, 300, 'C', false, false, 0, false, false, false);
        $sebi_registration_number = carbon_get_theme_option('sebi_registration_number');
        $pdf_phone_number = carbon_get_theme_option('pdf_phone_number');
        // --- Row 2: Subheader text ---
        $htmlLeft  = '<span style="font-size:12px; font-weight:bold;">'.$sebi_registration_number.'</span>';
        $htmlRight = '<span style="font-size:12px; font-weight:bold;">'.$pdf_phone_number.'</span>';
        // Left heading (x=12, y=28)
        $this->writeHTMLCell(90, 5, 12, 14, $htmlLeft, 0, 0, 0, true, 'L', true);
        // Right heading (x=108, y=28)
        $this->writeHTMLCell(90, 5, 108, 14, $htmlRight, 0, 0, 0, true, 'R', true);
        $this->Line(5, 20, $this->getPageWidth() - 5,20);
         //$this->Line(15, 52, $this->getPageWidth()-15, 52);
        }


    // Page footer (optional)
        public function Footer() {
        $this->Line(15, $this->GetY(), $this->getPageWidth() - 15, $this->GetY());
        // Position 15 mm from bottom
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8);

        // Get current page number and total in group
        $pageNum = $this->getPageNumGroupAlias();
        $pageTot = $this->getPageGroupAlias();

        // Print: Page X of Y (group-wise)
        $this->Cell(0, 10, "Page $pageNum of $pageTot", 0, 0, 'R');
    }
    }
    $pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $docId = uniqid('pdf_', true); // generate unique ID
    $pdf->SetCreator($ra_name);
    $pdf->SetAuthor($ra_name);
    $pdf->SetTitle('Agreement Document');
    $pdf->SetSubject('Digital Agreement');
    $pdf->SetKeywords('agreement, esign, digio, tcpdf');
    $pdf->SetFooterMargin(15);
    // --------------- Global Mapping ----
    $map = [
           '{{agreement_date}}'   => $day,
           '{{agreement_month}}' => $month,
           '{{agreement_year}}'  => $year,
           '{{client_name}}'     => $name,
           '{{client_father}}'   => $fathername,
          '{{client_address}}'  => $street.''.$line.''.$city.''.$state.''.$country,
          '{{fee_amount}}'      => $fee_amount,
          '{{service_name}}'    => $service_name,
          '{{payment_terms}}'   => $payment_terms,
          '{{ra_name}}'         => $ra_name,
          '{{ra_brand}}'        => $ra_brand,
          '{{ra_registration}}' => $ra_registration_number,
          '{{ra_reg_date}}'     => $ra_reg_date,
          '{{ra_email}}'        => $ra_email,
          '{{ra_phone}}'        => $ra_phone,
          '{{ra_website}}'      => $ra_website,
          '{{ra_address}}'      => $ra_address,
          '{{jurisdiction_city}}'=> $jurisdiction_city,
          //'{{client_pan}}'      => $client_pan,
          '{{ra_sign_name}}'    => $ra_sign_name,
          '{{client_pan}}'    => $pan,
          '{{service_name}}'    => $service_name,
          '{{service_duration}}'    => $payment_terms,
          '{{currency}}'	=>'₹',
        ];
         /*
        |--------------------------------------------------------------------------
        | Agreement PDF
        |--------------------------------------------------------------------------
        */
        $agreement_sections = carbon_get_theme_option('pdf_agreement_content');
        $count_agreement = count($agreement_sections);
        if (!empty($agreement_sections)) {
        $pdf->startPageGroup();
            foreach ($agreement_sections as $index => $agreement_section) {
                $pdf->SetAutoPageBreak(TRUE, 10);
                $pdf->SetMargins(20, 25, 20);
                $pdf->AddPage();
                $agreement_title   = $agreement_section['agreement_title'] ?? '';
                $agreement_content = $agreement_section['agreement_content'] ?? '';
                $agreement_content = strtr($agreement_content, $map);
                $agreement_content = preg_replace('/<p([^>]*)>/', '<span$1>', $agreement_content);
                $agreement_content = str_replace('</p>', '</span><br>', $agreement_content);

                if (!empty($agreement_title)) {
                    $html = '
                        <h2 style="font-size:16px;font-weight:bold;">
                            ' . $agreement_title . '
                        </h2>
                    ';
                    $pdf->writeHTML($html, true, false, true, false, '');
                }
               $agreement_html_content = '
                        <div class="section" style="font-size:10px;" >
                            ' . $agreement_content . '
                        </div>
                    ';
                $pdf->writeHTML(
                    $agreement_html_content,
                    true,
                    false,
                    true,
                    false,
                    ''
                );

                }
//              $page_width  = round($pdf->getPageWidth() * 2.83465);
// 			$page_height = round($pdf->getPageHeight() * 2.83465);
//              $sign = $ra_sign_url;
//              $imageWidth = 40;
//         $imageHeight = 20;
//         // Place image ABOVE "Analyst Signature"
//         // $pdf->Image(
//         //     $sign,
//         //     $page_width - 60, // center inside box
//         //     $page_height - 40,  // above text
//         //     $imageWidth,
//         //     $imageHeight
//         // );
      
//       // $pdf->Text($x2, $y + $boxHeight + 2, 'Client Signature');
//          $agreement_last_index = $index;
// $right_margin  = 30;
// $bottom_margin = 40;
// $llx = $page_width - $right_margin;
// $lly = $bottom_margin; 
// $urx = $llx;
// $ury = $lly;
                $agreement_last_index = $index;
$page_width  = round($pdf->getPageWidth() * 2.83465);
$page_height = round($pdf->getPageHeight() * 2.83465);

$right_margin  = 30;

// Pehle 40 tha
$bottom_margin = 70; // box ko upar le jayega

$sign_width  = 100;

// Pehle 50 tha
$sign_height = 80; // image + digital sign dono ke liye space

$llx = $page_width - $right_margin - $sign_width;
$lly = $bottom_margin;

$urx = $llx + $sign_width;
$ury = $lly + $sign_height;
$imageWidth  = 35;
$imageHeight = 15;

// Digio box
$llx = $page_width - $right_margin - $sign_width;
$lly = $bottom_margin;

$urx = $llx + $sign_width;
$ury = $lly + $sign_height;

// TCPDF uses mm
$pt_to_mm = 0.352778;

// Image ko sign box ke LEFT me rakho
$imageX = (($llx - 110) * $pt_to_mm); // 110 = image + gap
$imageY = (($page_height - $ury) * $pt_to_mm) + 5;

$pdf->Image(
    $ra_sign_url,
    $imageX,
    $imageY,
    $imageWidth,
    $imageHeight
);
/*
|--------------------------------------------------------------------------
| RA Details Below Signature
|--------------------------------------------------------------------------
*/

$pdf->SetFont('helvetica', '', 6);

$textY = $imageY + $imageHeight + 2;

$sebi_no = 'SEBI Reg. No.: '.$ra_registration_number;
$sign_date = date('d/m/Y');

$pdf->writeHTMLCell(
    45,                 // width
    0,                  // height
    $imageX,            // x
    $textY,             // y
    '
    <span style="font-size:6px;">
     <b>Research Analyst</b><br>
        <b>'.$ra_sign_name.'</b><br>
        '.$sebi_no.'<br>
        Digitally Signed<br>
        Date: '.$sign_date.'
    </span>
    ',
    0,
    0,
    false,
    true,
    'L',
    true
);
        }
            /*
        |--------------------------------------------------------------------------
        | MITC PDF
        |--------------------------------------------------------------------------
        */
        $mitc_sections = carbon_get_theme_option('pdf_mitc_content');
       $count_mitc = count($mitc_sections);
       // $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
            if (!empty($mitc_sections)) {
            $pdf->startPageGroup();
                foreach ($mitc_sections as $index => $mitc_section) {
                    $pdf->SetAutoPageBreak(TRUE, 10);
                    $pdf->SetMargins(20, 25, 20);
                    $pdf->AddPage();
                    $mitc_title   = $mitc_section['mitc_title'] ?? '';
                    $mitc_content = $mitc_section['mitc_content'] ?? '';
                    $mitc_content = strtr($mitc_content, $map);
                    if (!empty($mitc_title)) {
                        $html = '
                            <h2 style="font-size:16px;font-weight:bold;">
                                ' . $mitc_title . '
                            </h2>
                            <br>
                        ';
                        $pdf->writeHTML($html, true, false, true, false, '');
                    }
                   $mitc_html_content = '
                            <div class="section" style="font-size:10px;" >
                                ' . $mitc_content . '
                            </div>
                        ';
                    $pdf->writeHTML(
                        $mitc_html_content,
                        true,
                        false,
                        true,
                        false,
                        ''
                    );

                    }
                   
 $mitc_section_last_index = $index;
 $page_width  = round($pdf->getPageWidth() * 2.83465);
$page_height = round($pdf->getPageHeight() * 2.83465);

$right_margin  = 30;

// Pehle 40 tha
$bottom_margin = 70; // box ko upar le jayega

$sign_width  = 100;

// Pehle 50 tha
$sign_height = 80; // image + digital sign dono ke liye space

$mmx = $page_width - $right_margin - $sign_width;
$mmy = $bottom_margin;

$urx = $mmx + $sign_width;
$ury = $mmy + $sign_height;
$imageWidth  = 35;
$imageHeight = 15;

// Digio box
$mmx = $page_width - $right_margin - $sign_width;
$mmy = $bottom_margin;

$mpx = $mmx + $sign_width;
$mpy = $mmy + $sign_height;

// TCPDF uses mm
$pt_to_mm = 0.352778;

// Image ko sign box ke LEFT me rakho
$imageX = (($mmx - 110) * $pt_to_mm); // 110 = image + gap
$imageY = (($page_height - $ury) * $pt_to_mm) + 5;

$pdf->Image(
    $ra_sign_url,
    $imageX,
    $imageY,
    $imageWidth,
    $imageHeight
);
/*
|--------------------------------------------------------------------------
| RA Details Below Signature
|--------------------------------------------------------------------------
*/
$pdf->SetFont('helvetica', '', 6);

$textY = $imageY + $imageHeight + 2;

$sebi_no = 'SEBI Reg. No.: '.$ra_registration_number;
$sign_date = date('d/m/Y');

$pdf->writeHTMLCell(
    45,                 // width
    0,                  // height
    $imageX,            // x
    $textY,             // y
    '
    <span style="font-size:6px;">
     <b>Research Analyst</b><br>
        <b>'.$ra_sign_name.'</b><br>
        '.$sebi_no.'<br>
        Digitally Signed<br>
        Date: '.$sign_date.'
    </span>
    ',
    0,
    0,
    false,
    true,
    'L',
    true
);
  		
            }
          /*
        |--------------------------------------------------------------------------
        | Consent PDF
        |--------------------------------------------------------------------------
        */
        $consent_sections = carbon_get_theme_option('pdf_consent_content');
        $count_consent = count($consent_sections);
       
       // $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
            if (!empty($consent_sections)) {
            $pdf->startPageGroup();
                foreach ($consent_sections as $index => $section) {
                    $pdf->SetAutoPageBreak(TRUE, 10);
                    $pdf->SetMargins(20, 25, 20);
                    $pdf->AddPage();
                    $consent_title   = $section['consent_title'] ?? '';
                    $consent_content = $section['consent_content'] ?? '';
                    $consent_content = strtr($consent_content, $map);
                    if (!empty($title)) {
                        $html = '
                            <h2 style="font-size:16px;font-weight:bold;">
                                ' . $consent_title . '
                            </h2>
                            <br>
                        ';
                        $pdf->writeHTML($html, true, false, true, false, '');
                    }
                   $consent_html_content = '
                            <div class="section" style="font-size:10px;" >
                                ' . $consent_content . '
                            </div>
                        ';
                    $pdf->writeHTML(
                        $consent_html_content,
                        true,
                        false,
                        true,
                        false,
                        ''
                    );

                    }
                   
 $consent_last_index = $index;
 $page_width  = round($pdf->getPageWidth() * 2.83465);
$page_height = round($pdf->getPageHeight() * 2.83465);

$right_margin  = 30;

// Pehle 40 tha
$bottom_margin = 70; // box ko upar le jayega

$sign_width  = 100;

// Pehle 50 tha
$sign_height = 80; // image + digital sign dono ke liye space

$ccx = $page_width - $right_margin - $sign_width;
$ccy = $bottom_margin;

$urx = $ccx + $sign_width;
$ury = $ccy + $sign_height;
$imageWidth  = 35;
$imageHeight = 15;

// Digio box
$ccx = $page_width - $right_margin - $sign_width;
$ccy = $bottom_margin;

$cdx = $ccx + $sign_width;
$cdy = $ccy + $sign_height;

// TCPDF uses mm
$pt_to_mm = 0.352778;

// Image ko sign box ke LEFT me rakho
$imageX = (($ccx - 110) * $pt_to_mm); // 110 = image + gap
$imageY = (($page_height - $ury) * $pt_to_mm) + 5;

$pdf->Image(
    $ra_sign_url,
    $imageX,
    $imageY,
    $imageWidth,
    $imageHeight
);
/*
|--------------------------------------------------------------------------
| RA Details Below Signature
|--------------------------------------------------------------------------
*/

$pdf->SetFont('helvetica', '', 6);

$textY = $imageY + $imageHeight + 2;

$sebi_no = 'SEBI Reg. No.: '.$ra_registration_number;
$sign_date = date('d/m/Y');

$pdf->writeHTMLCell(
    45,                 // width
    0,                  // height
    $imageX,            // x
    $textY,             // y
    '
    <span style="font-size:6px;">
     <b>Research Analyst</b><br>
        <b>'.$ra_sign_name.'</b><br>
        '.$sebi_no.'<br>
        Digitally Signed<br>
        Date: '.$sign_date.'
    </span>
    ',
    0,
    0,
    false,
    true,
    'L',
    true
);
 
            }
    
    // -------- 1) MITC PDF END--------
		$timestamp = time();
    $agreement_pdf_path   = $upload_dir['basedir'] . "/unsigned/agreement-" . sanitize_title($name).'-'. $timestamp . ".pdf";
    $agreement_pdf_url   = content_url('/uploads/unsigned/agreement-' ).sanitize_title($name) .'-'.$timestamp . ".pdf";
    $unsigned_dir = $upload_dir['basedir'] . '/unsigned';
    if ( ! file_exists($unsigned_dir) ) {
    wp_mkdir_p($unsigned_dir);
    }
    $pdf->Output($agreement_pdf_path, 'F'); // Save to server
    if (
        file_exists($agreement_pdf_path) &&
        filesize($agreement_pdf_path) > 0
    ) {
        $file_name   = basename($agreement_pdf_path);
        $pdf_content = file_get_contents($agreement_pdf_path);
        $base64_pdf  = base64_encode($pdf_content);
        $client_phone = $form_data['phone-1']['value'] ? $form_data['phone-1']['value'] : '';
        $clean_phone = preg_replace('/\D/', '', $client_phone);

        // Remove leading 0 or 91 if present
        if (strlen($clean_phone) > 10) {
            // Keep only last 10 digits
            $clean_phone = substr($clean_phone, -10);
        }

        // Optional: check if it's exactly 10 digits
        if (strlen($clean_phone) !== 10) {
            $clean_phone = ''; // Invalid number
        }
        /**
         * Payload as per Digio documentation
         */
        $first_index= ((int)($agreement_last_index ?? 0)) + 1;
         $mitc_sp= ((int)($mitc_section_last_index ?? 0)) + 1;
        $second_index = ((int)($mitc_sp + $first_index));
      $consent_sp= ((int)($consent_last_index ?? 0)) + 1;
      $last_index = ((int)($consent_sp + $second_index));
        $payload = [
            "file_name"        => $file_name,
            "file_data"        => $base64_pdf,
            "expire_in_days"   => 10,
            "display_on_page"  => "custom",
            "notify_signers"   => false,
            "send_sign_link"   => false,
            "reference_id"     => $entry_id,
            "callback"  => $entry_id,
            "signers" => [
                [
                    "identifier" => $clean_phone,
                    "name"       => $name,
                    "sign_type"  => "aadhaar",
                    "reason"     => "Service Agreement with".$ra_name
                ]
            ],

            "sign_coordinates" => [
                $clean_phone => [
                    $first_index => [
                        [
                           "llx" => round($llx),
    						"lly" => round($lly),
    						"urx" => round($urx),
    						"ury" => round($ury),
                        ]
                    ],
                    $second_index => [
                        [
                          "llx" => round($mmx),
    						"lly" => round($mmy),
    						"urx" => round($mpx),
    						"ury" => round($mpy),
                        ]
                    ],
                    $last_index => [
                        [
                           "llx" => round($ccx),
    						"lly" => round($ccy),
    						"urx" => round($cdx),
    						"ury" => round($cdy),
                        ]
                    ]
                ]
            ]
        ];

        $json_payload = json_encode($payload, JSON_UNESCAPED_SLASHES);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $response['success'] = false;
            $response['message'] = json_last_error_msg();
        }
        $env      = carbon_get_theme_option('digio_environment');
        $enabled  = carbon_get_theme_option('digio_enable');

        if ( ! $enabled ) {
            return;
        }

        if ( $env === 'sandbox' ) {
            $client_id = carbon_get_theme_option('sb_digio_client_id');

            $secret    = carbon_get_theme_option('sb_digio_client_secret');
            $base_url  = carbon_get_theme_option('sb_digio_callback_url');
        } else {
            $client_id = carbon_get_theme_option('pro_digio_client_id');
            $secret    = carbon_get_theme_option('pro_digio_client_secret');
            $base_url  = carbon_get_theme_option('pro_digio_callback_url');
        }
       // $client_id = 'ACK260507132501407O7RJM3LEXYYJPX';
       //      $secret    = 'OLD3GBHX5H9FFEKVI6ZZ3YS8AEZGELKL';
       //      $base_url = 'https://ext.digio.in:444'; 

        // Final API URL
        $endpoint = $base_url . '/v2/client/document/uploadpdf';

        // JSON payload
        $json_payload = json_encode( $payload, JSON_UNESCAPED_SLASHES );

        // Headers
        $headers = [
            'Authorization: Basic ' . base64_encode( $client_id . ':' . $secret ),
            'Content-Type: application/json',
            'Accept: application/json',
            'Content-Length: ' . strlen( $json_payload ),
        ];

        // CURL
        $curl = curl_init();

        curl_setopt_array( $curl, [
            CURLOPT_URL            => $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST  => 'POST',
            CURLOPT_HTTPHEADER     => $headers,
            CURLOPT_POSTFIELDS     => $json_payload,
            CURLOPT_TIMEOUT        => 60,
        ]);

        $curlresponse = curl_exec($curl);
        //print_r($curlresponse);
        if ($curlresponse === false) {
             $response['success'] = 0;
            $response['message'] = curl_error($curl);
        }

        curl_close($curl);

        $decode = json_decode($curlresponse, true);
        $response['success'] = 1;
        $response['message'] = "Agreement is generated successfully";
        $response['digio'] = array(
            'digio_document_id'=> $decode['id'] ?? $decode['message'],
        'identifier'  => $clean_phone,
        'logo'        => 'https://pavanprajapati.com/wp-content/uploads/2026/04/logo14final.png',
        'entry_id'=>$entry_id,
        'formId'=> $form_id
        );

    
       // echo '<pre>';
       // print_r($decode);
       // echo '</pre>';

     $wpdb->insert(
        $wpdb->prefix . 'frmt_form_entry_meta',
        [
            'entry_id'   => $entry_id,
            'meta_key'   => 'document_id',
            'meta_value' => $docId,
        ]
    );
     $wpdb->insert(
        $wpdb->prefix . 'frmt_form_entry_meta',
        [
            'entry_id'   => $entry_id,
            'meta_key'   => 'pdf_path',
            'meta_value' => $agreement_pdf_path,
        ]
    );
     $wpdb->insert(
        $wpdb->prefix . 'frmt_form_entry_meta',
        [
            'entry_id'   => $entry_id,
            'meta_key'   => 'pdf_url',
            'meta_value' => $agreement_pdf_url,
        ]
    );
    $wpdb->insert(
        $wpdb->prefix . 'frmt_form_entry_meta',
        [
            'entry_id'   => $entry_id,
            'meta_key'   => 'digio_doc_id',
            'meta_value' => $decode['id'],
        ]
    );
    $wpdb->insert(
        $wpdb->prefix . 'frmt_form_entry_meta',
        [
            'entry_id'   => $entry_id,
            'meta_key'   => 'is_agreement',
            'meta_value' => $decode['is_agreement'],
        ]
    );
    $wpdb->insert(
        $wpdb->prefix . 'frmt_form_entry_meta',
        [
            'entry_id'   => $entry_id,
            'meta_key'   => 'agreement_type',
            'meta_value' => $decode['agreement_type'],
        ]
    );
     $wpdb->insert(
        $wpdb->prefix . 'frmt_form_entry_meta',
        [
            'entry_id'   => $entry_id,
            'meta_key'   => 'agreement_status',
            'meta_value' => $decode['agreement_status'],
        ]
    );
     $wpdb->insert(
        $wpdb->prefix . 'frmt_form_entry_meta',
        [
            'entry_id'   => $entry_id,
            'meta_key'   => 'digio_created_at',
            'meta_value' => $decode['created_at'],
        ]
    );
    //$response['agreement_pdf_url'] = $agreement_pdf_url;
    $response['last_entry_id'] = $entry_id;
   // $response['form_id'] = $form_id;
   // $response['pdf_doc_id'] = $docId;
   // print_r($response);
   // die;
    return $response;
    } else {
       $response['success'] = 0;
        $response['message'] = 'PDF generation failed.';
        return $response;
    }
    //wp_die();
}
function get_forminator_forms_options() {

    $options = [];

    if (!class_exists('Forminator_API')) {
        return $options;
    }

    $forms = Forminator_API::get_forms();
// echo "<pre>";
// print_r($forms);
// echo "</pre>";
    if (!empty($forms)) {
        foreach ($forms as $form) {
            $options[$form->id] = $form->name; // value => label
        }
    }

    return $options;
}

// function load_digio_sdk() {
    
// }
// add_action('wp_enqueue_scripts', 'load_digio_sdk');


/**
 * Verify Digio Webhook Signature
 */
// function theme_digio_verify_signature( $raw_body, $headers ) {

//     // ✅ Webhook secret from Digio dashboard
//     //$webhook_secret = carbon_get_theme_option('digio_webhook_secret');
//     $webhook_secret = 'investaxresearchsandbox';

//     if ( empty( $webhook_secret ) ) {
//         error_log('[DIGIO] Webhook secret missing');
//         return false;
//     }

//     // ✅ Get Digio signature header
//     if ( empty( $headers['x-digio-signature'][0] ) ) {
//         error_log('[DIGIO] Signature header missing');
//         return false;
//     }

//     $received_signature = trim( $headers['x-digio-signature'][0] );

//     // ✅ Generate signature from RAW body
//     $generated_signature = base64_encode(
//         hash_hmac(
//             'sha256',
//             $raw_body,
//             $webhook_secret,
//             true // IMPORTANT: binary output
//         )
//     );

//     // 🔍 DEBUG LOGS (remove after testing)
//     error_log('--- DIGIO SIGNATURE DEBUG ---');
//     error_log('RAW BODY: ' . $raw_body);
//     error_log('RECEIVED: ' . $received_signature);
//     error_log('GENERATED: ' . $generated_signature);

//     // ✅ Secure compare
//     return hash_equals( $generated_signature, $received_signature );
// }
/**
 * Register Digio Webhook REST API
 */
add_action('rest_api_init', function () {
    register_rest_route('digio/v1', '/webhook', [
        'methods'  => 'POST',
        'callback' => 'theme_digio_webhook_handler',
        'permission_callback' => '__return_true',
    ]);
});

function theme_digio_webhook_handler(WP_REST_Request $request) {

    //  $allowed_ips = [
    //     '35.154.20.28',   // Sandbox
    //     '13.126.198.236', // Production
    //     '145.223.17.115'
    // ];

    // $remote_ip = $_SERVER['REMOTE_ADDR'] ?? '';

    // if (!in_array($remote_ip, $allowed_ips, true)) {
    //     error_log('Digio Webhook blocked IP: ' . $remote_ip);
    //     return new WP_REST_Response([
    //         'error' => 'Unauthorized IP'
    //     ], 403);
    // }

    /* -------------------------------
     * 2. CHECKSUM VALIDATION
     * ----------------------------- */
    $raw_payload = $request->get_body();
    $headers     = $request->get_headers();
    //error_log("rawpayload: " . print_r($raw_payload, true));
    //error_log("headers: " . print_r($headers, true));
    if (empty($headers['x_digio_checksum'][0])) {
        error_log('Digio Webhook missing checksum');
        return new WP_REST_Response([
            'error' => 'Checksum missing'
        ], 403);
    }

    $received_checksum = $headers['x_digio_checksum'][0];
     $secret_key    = carbon_get_theme_option('digio_webhook_secret');
     $calculated_checksum = hash_hmac('sha256', $raw_payload, $secret_key);
    //  $calculated_checksum = base64_encode(hash_hmac(
    //     'sha256',
    //     $raw_payload,
    //     $secret_key,
    //     true
    // ));

    if (!hash_equals($calculated_checksum, $received_checksum)) {
        error_log('Digio Webhook checksum mismatch');
        return new WP_REST_Response([
            'error' => 'Invalid signature'
        ], 403);
    }

    // ----- PARSE JSON -----
    $payload = json_decode($raw_payload, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        return new WP_REST_Response([
            'status'  => 'error',
            'message' => 'Invalid JSON'
        ], 400);
    }

    theme_digio_log($payload, 'digio-webhook-payload');

    // ----- PROCESS EVENTS -----
    $event = isset($payload['event']) ? strtolower($payload['event']) : '';

    switch ($event) {

        // Document signed event
        case 'doc.signed':
        case 'DOC.SIGNED':
            theme_digio_handle_signed($payload);
            break;

        // Document rejected
        case 'doc.sign.rejected':
        case 'DOC.SIGN.REJECTED':
            theme_digio_handle_rejected($payload);
            break;

        // Document failed
        case 'doc.sign.failed':
        case 'DOC.SIGN.FAILED':
            theme_digio_handle_failed($payload);
            break;

        default:
            theme_digio_log("Webhook event not handled: " . $event, 'digio-webhook-notice');
            break;
    }

    // Must return HTTP 200 if successful
    return new WP_REST_Response([
        'status' => 'success',
    ], 200);
}

/**
 * Handle successful document signing
 */
function theme_digio_handle_signed($payload) {
    global $wpdb;
    // Pull document meta
    $document = $payload['payload']['document'] ?? [];

    if (empty($document)) {
        theme_digio_log("DOC.SIGNED missing document payload", 'digio-webhook-error');
        return;
    }

     $did = sanitize_text_field($document['id'] ?? '');

    $entry_id = $wpdb->get_var($wpdb->prepare("SELECT entry_id FROM {$wpdb->prefix}frmt_form_entry_meta WHERE meta_key = %s AND meta_value = %s LIMIT 1",'digio_doc_id',$did));
    // Get sign status & parties
    $agreement_status = sanitize_text_field($document['agreement_status'] ?? '');

    // Example: save this status somewhere
    $status_update = $wpdb->update(
            $wpdb->prefix . 'frmt_form_entry_meta',
            [
                'meta_value' => $agreement_status,
            ],
            [
                'entry_id' => $entry_id,
                'meta_key' => 'agreement_status',
            ]
        );
    $wpdb->update(
            $wpdb->prefix . 'frmt_form_entry_meta',
            [
                'meta_value' => current_time('mysql'),
            ],
            [
                'entry_id' => $entry_id,
                'meta_key' => 'digio_updated_at',
            ]
        );
        if ($status_update === false) {
    theme_digio_log("DB error while updating status for $did : " . $wpdb->last_error, 'digio-webhook-error');
} else {
    // ✅ Update query executed (0 or more rows)
    theme_digio_log("Document $did status handled: $agreement_status", 'digio-webhook-success');
}
    
}

/**
 * Handle document reject
 */
function theme_digio_handle_rejected($payload) {
    global $wpdb;
    $document = $payload['payload']['document'] ?? [];

    if (empty($document)) {
        theme_digio_log("DOC.SIGNED missing document payload", 'digio-webhook-error');
        return;
    }

     $did  = sanitize_text_field($document['id'] ?? '');

     $entry_id = $wpdb->get_var($wpdb->prepare("SELECT entry_id FROM {$wpdb->prefix}frmt_form_entry_meta WHERE meta_key = %s AND meta_value = %s LIMIT 1",'digio_doc_id',$did));
     $rejected_status = $wpdb->update(
            $wpdb->prefix . 'frmt_form_entry_meta',
            [
                'meta_value' => 'rejected',
            ],
            [
                'entry_id' => $entry_id,
                'meta_key' => 'agreement_status',
            ]
        );
    $wpdb->update(
            $wpdb->prefix . 'frmt_form_entry_meta',
            [
                'meta_value' => current_time('mysql'),
            ],
            [
                'entry_id' => $entry_id,
                'meta_key' => 'digio_updated_at',
            ]
        );
    if ($rejected_status === false) {
    theme_digio_log("Document not rejected: $did", 'digio-webhook-info');
} else {
    // ✅ Update query executed (0 or more rows)
    theme_digio_log("Document rejected: $did", 'digio-webhook-info');
}
    // Log or update status in your DB
    
}

/**
 * Handle document failed
 */
function theme_digio_handle_failed($payload) {
    global $wpdb;
    $document = $payload['payload']['document'] ?? [];
    if (empty($document)) {
        theme_digio_log("DOC.SIGNED missing document payload", 'digio-webhook-error');
        return;
    }
    $did      = sanitize_text_field($document['id'] ?? '');
    $entry_id = $wpdb->get_var($wpdb->prepare("SELECT entry_id FROM {$wpdb->prefix}frmt_form_entry_meta WHERE meta_key = %s AND meta_value = %s LIMIT 1",'digio_doc_id',$did));
    $error    = sanitize_text_field($document['error_message'] ?? '');
    $failed_status = $wpdb->update(
            $wpdb->prefix . 'frmt_form_entry_meta',
            [
                'meta_value' => 'failed',
            ],
            [
                'entry_id' => $entry_id,
                'meta_key' => 'agreement_status',
            ]
        );
    $wpdb->update(
            $wpdb->prefix . 'frmt_form_entry_meta',
            [
                'meta_value' => current_time('mysql'),
            ],
            [
                'entry_id' => $entry_id,
                'meta_key' => 'digio_updated_at',
            ]
        );
    if ($rejected_status === false) {
    theme_digio_log("Document not failed: $did error: $error", 'digio-webhook-info');
} else {
    // ✅ Update query executed (0 or more rows)
    theme_digio_log("Document failed: $did error: $error", 'digio-webhook-info');
    $wpdb->insert(
        $wpdb->prefix . 'frmt_form_entry_meta',
        [
            'entry_id'   => $entry_id,
            'meta_key'   => 'failed_error_message',
            'meta_value' => $error,
        ]
    );
}
    
}

/**
 * Utility logger
 */
function theme_digio_log($message, $type = 'digio-webhook-log') {
    if (WP_DEBUG === true) {
        if (is_array($message) || is_object($message)) {
            error_log("$type: " . print_r($message, true));
        } else {
            error_log("$type: " . $message);
        }
    }
}
add_action('wp_ajax_digio_update_status', 'digio_update_status');
add_action('wp_ajax_nopriv_digio_update_status', 'digio_update_status');

function digio_update_status() {

    if ( empty($_POST['payload']) ) {
        wp_send_json_error('No payload received');
    }

    $data = json_decode(stripslashes($_POST['payload']), true);
    $document_id = sanitize_text_field($data['document_id']);
    $identifier  = sanitize_text_field($data['identifier']);
    $status      = sanitize_text_field($data['status']);
    $entry_id      = sanitize_text_field($data['entry_id']);
    $form_id      = sanitize_text_field($data['form_id']);

    global $wpdb;
    $wpdb->update(
            $wpdb->prefix . 'frmt_form_entry_meta',
            [
                'meta_value' => $status,
            ],
            [
                'entry_id' => $entry_id,
                'meta_key' => 'agreement_status',
            ]
        );
        $wpdb->insert(
        $wpdb->prefix . 'frmt_form_entry_meta',
        [
            'entry_id'   => $entry_id,
            'meta_key'   => 'digio_updated_at',
            'meta_value' => current_time('mysql'),
        ]
    );
    if ($status === 'completed') {
        $email = $wpdb->get_var(
        $wpdb->prepare(
            "SELECT meta_value 
             FROM {$wpdb->prefix}frmt_form_entry_meta 
             WHERE entry_id = %s AND meta_key = %s",
            $entry_id,
            'email-1'
        )
    );

    $env      = carbon_get_theme_option('digio_environment');
        $enabled  = carbon_get_theme_option('digio_enable');

        if ( ! $enabled ) {
            return;
        }

        if ( $env === 'sandbox' ) {
            $client_id = carbon_get_theme_option('sb_digio_client_id');

            $secret    = carbon_get_theme_option('sb_digio_client_secret');
            $base_url  = carbon_get_theme_option('sb_digio_callback_url');
        } else {
            $client_id = carbon_get_theme_option('pro_digio_client_id');
            $secret    = carbon_get_theme_option('pro_digio_client_secret');
            $base_url  = carbon_get_theme_option('pro_digio_callback_url');
        }

        // $client_id = 'ACK260507132501407O7RJM3LEXYYJPX';
        //     $secret    = 'OLD3GBHX5H9FFEKVI6ZZ3YS8AEZGELKL';
        //     $base_url = 'https://ext.digio.in:444'; 
    $endpoint = $base_url . "/v2/client/document/download?document_id={$document_id}";

    $upload_dir = WP_CONTENT_DIR . '/uploads/signed/';
        if (!file_exists($upload_dir)) {
            wp_mkdir_p($upload_dir);
        }

        $save_path = $upload_dir . 'signed-' . $document_id . '.pdf';

        $fp = fopen($save_path, 'w');

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL            => $endpoint,
            CURLOPT_RETURNTRANSFER => false,
            CURLOPT_FILE           => $fp,
            CURLOPT_HTTPAUTH       => CURLAUTH_BASIC,
            CURLOPT_USERPWD        => $client_id . ':' . $secret,
            CURLOPT_TIMEOUT        => 60,
        ]);

        curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);
        fclose($fp);
        if ($http_code === 200 && file_exists($save_path)) {
            $wpdb->insert(
        $wpdb->prefix . 'frmt_form_entry_meta',
        [
            'entry_id'   => $entry_id,
            'meta_key'   => 'signed_digio_doc',
            'meta_value' => $save_path,
        ]
    );
        }
    $to      = get_option('admin_email');
$subject = 'Digio Document Signed Successfully';
$message = "Hello,\n\nYour document has been signed successfully.\n\nDocument ID: {$document_id}";
$headers = ['Content-Type: text/plain; charset=UTF-8'];

$attachments = [];
if (file_exists($save_path)) {
    $attachments[] = $save_path;
}

    if ($status === 'completed') {
        wp_mail($to, $subject, $message, $headers, $attachments);
        wp_mail($email, $subject, $message, $headers, $attachments);
    }
    }
//     if (!class_exists('Razorpay\Api\Api')) {

//     require_once get_template_directory() . '/razorpay/Razorpay.php';
//      $api = new Razorpay\Api\Api(
//         'rzp_test_Ss7LbNUQr9iBtr',
//         'Xx7iSb0uunJ2Ab48cVcyqX1h'
//     );

//      $form_data = forminator_get_latest_entry_by_form_id($form_id)->meta_data;
//      $fee_amount  = isset($form_data['number-1']['value']) ? $form_data['number-1']['value'] : '';
//      $order = $api->order->create([

//         'receipt' => 'receipt_' . time(),

//         'amount' => $fee_amount*100,

//         'currency' => 'INR'

//     ]);
// }

   

    /*
    UNIQUE REF
    */

    $ref = wp_generate_uuid4();

    /*
    SAVE DB
    */

    // $wpdb->insert(
    //     $wpdb->prefix . 'frmt_form_entry_meta',
    //     [
    //         'entry_id'   => $entry_id,
    //         'meta_key'   => 'razorpay_order_id',
    //         'meta_value' => $order['id'],
    //     ]
    // );
    // $wpdb->insert(
    //     $wpdb->prefix . 'frmt_form_entry_meta',
    //     [
    //         'entry_id'   => $entry_id,
    //         'meta_key'   => 'ref',
    //         'meta_value' => $ref,
    //     ]
    // );
    $wpdb->insert(
        $wpdb->prefix . 'frmt_form_entry_meta',
        [
            'entry_id'   => $entry_id,
            'meta_key'   => 'payment_status',
            'meta_value' => 'pending',
        ]
    );
    $wpdb->insert(
        $wpdb->prefix . 'frmt_form_entry_meta',
        [
            'entry_id'   => $entry_id,
            'meta_key'   => 'order_created_at',
            'meta_value' => current_time('mysql'),
        ]
    );
    wp_send_json_success([
        'message' => 'Status updated successfully',
        //'ref'=>$ref
    ]);
}
add_action('admin_menu', function () {
    add_menu_page(
        'Digio Details',
        'Digio Details',
        'manage_options',
        'digio-details',
        'render_digio_details_page',
        'dashicons-media-document',
        26
    );
});
function render_digio_details_page() {

    echo '<div class="wrap">';
    echo '<h1 class="wp-heading-inline">Digio Agreement Transactions</h1>';
    echo '<hr class="wp-header-end">';

    require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
    require_once get_template_directory().'/class-digio-list-table.php';

    $table = new Digio_List_Table();
    $table->prepare_items();
    ?>

    <!-- IMPORTANT: form is required for search + pagination -->
    <form method="get">
        <!-- preserve current admin page -->
        <input type="hidden" name="page" value="<?php echo esc_attr($_REQUEST['page']); ?>" />

        <?php
        // 🔍 Search box
        $table->search_box( 'Search Entries', 'digio-search' );

        // 📋 Table
        $table->display();
        ?>
    </form>

    </div>

    <!-- Modal (for Details popup) -->
    <div id="digio-modal" style="display:none;">
       
    </div>
    <?php
}
add_action('wp_ajax_get_digio_details', function () {

    global $wpdb;

    if (empty($_POST['entry_id'])) {
        wp_send_json_error('Missing entry_id');
    }

    $entry_id = intval($_POST['entry_id']);

    /*
     * Get all Forminator meta
     */
    $results = $wpdb->get_results(
        $wpdb->prepare(
            "SELECT meta_key, meta_value
             FROM {$wpdb->prefix}frmt_form_entry_meta
             WHERE entry_id = %d",
            $entry_id
        )
    );

    if (empty($results)) {
        wp_send_json_error('No entry data found');
    }

    $form_data = [];

    foreach ($results as $row) {
        $form_data[$row->meta_key] = $row->meta_value;
    }

    /*
     * Get Digio Document ID
     */
    $doc_id = $form_data['digio_doc_id'] ?? '';

    if (empty($doc_id)) {
        wp_send_json_error('Digio document ID not found');
    }

    /*
     * Digio Configuration
     */
    $enabled = carbon_get_theme_option('digio_enable');
    $env     = carbon_get_theme_option('digio_environment');

    if (!$enabled) {
        wp_send_json_error('Digio disabled');
    }

    if ($env === 'sandbox') {

        $client_id = carbon_get_theme_option('sb_digio_client_id');
        $secret    = carbon_get_theme_option('sb_digio_client_secret');
        $base_url  = carbon_get_theme_option('sb_digio_callback_url');

    } else {

        $client_id = carbon_get_theme_option('pro_digio_client_id');
        $secret    = carbon_get_theme_option('pro_digio_client_secret');
        $base_url  = carbon_get_theme_option('pro_digio_callback_url');
    }

    /*
     * Digio API Request
     */
    $endpoint = trailingslashit($base_url) . 'v2/client/document/' . $doc_id;

    $ch = curl_init();

    curl_setopt_array($ch, [
        CURLOPT_URL            => $endpoint,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPAUTH       => CURLAUTH_BASIC,
        CURLOPT_USERPWD        => $client_id . ':' . $secret,
        CURLOPT_TIMEOUT        => 30,
    ]);

    $response  = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error     = curl_error($ch);

    curl_close($ch);

    if ($error) {
        wp_send_json_error($error);
    }

    $digio_data = json_decode($response, true);

    if ($http_code !== 200) {

        wp_send_json_error([
            'message'      => 'Digio API error',
            'http_code'    => $http_code,
            'entry_id'     => $entry_id,
            'doc_id'       => $doc_id,
            'form_data'    => $form_data,
            'api_response' => $response,
        ]);
    }

    /*
     * Combined Response
     */
    wp_send_json_success([
        'entry_id'  => $entry_id,
        'doc_id'    => $doc_id,
        'form_data' => $form_data,
        'digio_data'=> $digio_data,
    ]);
});add_action('wp_ajax_digio_download', 'digio_download_signed_pdf');

function digio_download_signed_pdf() {
    global $wpdb;

    // 🔐 Security
    if ( ! current_user_can('manage_options') ) {
        wp_die('Unauthorized');
    }

    if ( empty($_GET['entry_id']) ) {
        wp_die('Missing entry id');
    }

    $document_id = sanitize_text_field($_GET['entry_id']);

    // 📁 Upload path
    $upload_dir = WP_CONTENT_DIR . '/uploads/signed/';
    if ( ! file_exists($upload_dir) ) {
        wp_mkdir_p($upload_dir);
    }

    $save_path = $upload_dir . 'signed-' . $document_id . '.pdf';

    /**
     * =================================================
     * 1️⃣ If file already exists → DOWNLOAD DIRECTLY
     * =================================================
     */
    if ( file_exists($save_path) ) {
        digio_force_download($save_path);
        wp_die();
    }

    /**
     * =================================================
     * 2️⃣ Else → DOWNLOAD FROM DIGIO API
     * =================================================
     */
    $enabled = carbon_get_theme_option('digio_enable');
    if ( ! $enabled ) {
        wp_die('Digio disabled');
    }

    $env = carbon_get_theme_option('digio_environment');

    if ( $env === 'sandbox' ) {
        $client_id = carbon_get_theme_option('sb_digio_client_id');
        $secret    = carbon_get_theme_option('sb_digio_client_secret');
        $base_url  = carbon_get_theme_option('sb_digio_callback_url');
    } else {
        $client_id = carbon_get_theme_option('pro_digio_client_id');
        $secret    = carbon_get_theme_option('pro_digio_client_secret');
        $base_url  = carbon_get_theme_option('pro_digio_callback_url');
    }

    $endpoint = $base_url . "/v2/client/document/download?document_id={$document_id}";

    $fp = fopen($save_path, 'w');

    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL            => $endpoint,
        CURLOPT_FILE           => $fp,
        CURLOPT_HTTPAUTH       => CURLAUTH_BASIC,
        CURLOPT_USERPWD        => $client_id . ':' . $secret,
        CURLOPT_TIMEOUT        => 60,
        CURLOPT_FAILONERROR    => true,
    ]);

    curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curl_err  = curl_error($ch);

    curl_close($ch);
    fclose($fp);

    if ( $http_code !== 200 || ! file_exists($save_path) ) {
        @unlink($save_path);
        wp_die('Failed to download from Digio: ' . $curl_err);
    }

    /**
     * =================================================
     * 3️⃣ File saved → DOWNLOAD
     * =================================================
     */
    digio_force_download($save_path);
    wp_die();
}
function digio_force_download($file_path) {
    if ( ! file_exists($file_path) ) {
        wp_die('File not found');
    }

    header('Content-Description: File Transfer');
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
    header('Content-Length: ' . filesize($file_path));
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Expires: 0');

    readfile($file_path);
    exit;
}
add_action('admin_enqueue_scripts', function ($hook) {

    // OPTIONAL: load only on your Digio admin page
    // if ($hook !== 'toplevel_page_digio-details') return;

    wp_enqueue_script(
        'digio-admin',
        get_template_directory_uri() . '/assets/js/digio-admin.js',
        ['jquery'],
        '1.0',
        true
    );

    // Pass ajaxurl securely
    wp_localize_script('digio-admin', 'digioAdmin', [
        'ajaxurl' => admin_url('admin-ajax.php'),
    ]);
});
add_action('admin_head', function () {
    ?>
    <style>
       #digio-modal{
    position:fixed;
    inset:0;
    background:rgba(0,0,0,.6);
    z-index:999999;
    display:none;
    overflow:auto;
}

.digio-popup{
    width:900px;
    max-width:95%;
    margin:40px auto;
    background:#fff;
    border-radius:10px;
    padding:25px;
    box-sizing:border-box;
}

.digio-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}

.digio-header h2{
    margin:0;
}

.digio-status-row{
    display:flex;
    gap:10px;
    margin-bottom:20px;
}

.digio-badge{
    padding:8px 14px;
    border-radius:20px;
    font-weight:600;
}

.digio-success{
    background:#d4edda;
    color:#155724;
}

.digio-danger{
    background:#f8d7da;
    color:#721c24;
}

.digio-warning{
    background:#fff3cd;
    color:#856404;
}

.digio-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:20px;
}

.digio-card{
    border:1px solid #ddd;
    border-radius:8px;
    padding:15px;
}

.digio-card h3{
    margin-top:0;
    margin-bottom:15px;
}

.digio-row{
    display:flex;
    justify-content:space-between;
    padding:10px 0;
    border-bottom:1px solid #eee;
}

.digio-row:last-child{
    border-bottom:none;
}
    </style>
    <?php
});

//require_once get_template_directory() . '/fields/homepage.php';
//require_once get_template_directory() . '/fields/blocks/hero.php';
add_action(
    'wp_ajax_verify_razorpay_payment',
    'verify_razorpay_payment'
);

add_action(
    'wp_ajax_nopriv_verify_razorpay_payment',
    'verify_razorpay_payment'
);

function verify_razorpay_payment() {
    global $wpdb;
     $entry_id = intval($_POST['entry_id']);
if (!$entry_id) {
    wp_send_json_error([

            'message' => 'Entry Id not found'
        ]);
}

/*
|--------------------------------------------------------------------------
| FETCH ALL META
|--------------------------------------------------------------------------
*/

$results = $wpdb->get_results(

    $wpdb->prepare(

        "
        SELECT meta_key, meta_value
        FROM {$wpdb->prefix}frmt_form_entry_meta
        WHERE entry_id = %d
        ",

        $entry_id

    )

);

/*
|--------------------------------------------------------------------------
| CONVERT TO ARRAY
|--------------------------------------------------------------------------
*/

$payment_data = [];

foreach ($results as $row) {

    $payment_data[$row->meta_key] = $row->meta_value;

}

/*
|--------------------------------------------------------------------------
| VALUES
|--------------------------------------------------------------------------
*/

$razorpay_order_id = $payment_data['razorpay_order_id'] ?? '';

$amount = isset($payment_data['number-1'])
    ? (int) $payment_data['number-1']
    : 0;

$payment_status = $payment_data['payment_status'] ?? 'pending';

$razorpay_payment_id = $payment_data['razorpay_payment_id'] ?? '';

$order_created_at = $payment_data['order_created_at'] ?? '';

$name = $payment_data['name-1'] ?? '';

$email = $payment_data['email-1'] ?? '';

$mobile = $payment_data['phone-1'] ?? '';
$valid_till = date(
    'Y-m-d',
    strtotime('+2 months', strtotime($order_created_at))
);
require_once get_template_directory() . '/tcpdf/tcpdf.php';
class INVOICEPDF extends TCPDF {
    // Page header
       
    // Page header
        public function Header() {
        // --- Row 1: Logo in center ---
        $pdf_logo = carbon_get_theme_option('pdf_logo');
        $pdf_logo_path = get_attached_file($pdf_logo);
        $logo = $pdf_logo_path;
        $this->Image($logo, '', 3, 40, '', '', '', '', false, 300, 'C', false, false, 0, false, false, false);
        $sebi_registration_number = carbon_get_theme_option('sebi_registration_number');
        $pdf_phone_number = carbon_get_theme_option('pdf_phone_number');
        // --- Row 2: Subheader text ---
        $htmlLeft  = '<span style="font-size:12px; font-weight:bold;">'.$sebi_registration_number.'</span>';
        $htmlRight = '<span style="font-size:12px; font-weight:bold;">'.$pdf_phone_number.'</span>';
        // Left heading (x=12, y=28)
        $this->writeHTMLCell(90, 5, 12, 14, $htmlLeft, 0, 0, 0, true, 'L', true);
        // Right heading (x=108, y=28)
        $this->writeHTMLCell(90, 5, 108, 14, $htmlRight, 0, 0, 0, true, 'R', true);
        $this->Line(5, 20, $this->getPageWidth() - 5,20);
         //$this->Line(15, 52, $this->getPageWidth()-15, 52);
        }


    // Page footer (optional)
        public function Footer() {
        $this->Line(15, $this->GetY(), $this->getPageWidth() - 15, $this->GetY());
        // Position 15 mm from bottom
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8);

        // Get current page number and total in group
        $pageNum = $this->getPageNumGroupAlias();
        $pageTot = $this->getPageGroupAlias();

        // Print: Page X of Y (group-wise)
        $this->Cell(0, 10, "Page $pageNum of $pageTot", 0, 0, 'R');
    }
    }
    $pdf = new INVOICEPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->AddPage();
$html = '
<h2>Payment Invoice</h2>

<table border="1" cellpadding="8">
<tr>
    <td><strong>Name</strong></td>
    <td>'.$name.'</td>
</tr>

<tr>
    <td><strong>Email</strong></td>
    <td>'.$email.'</td>
</tr>

<tr>
    <td><strong>Amount</strong></td>
    <td>₹'.$amount.'</td>
</tr>

<tr>
    <td><strong>Status</strong></td>
    <td style="color:green;">'.esc_html($payment_status).'</td>
</tr>

<tr>
    <td><strong>Agreement Date</strong></td>
    <td>'. esc_html($order_created_at).'</td>
</tr>

<tr>
    <td><strong>Valid From</strong></td>
    <td>'.$agreement_date.'</td>
</tr>

<tr>
    <td><strong>Valid Till</strong></td>
    <td>'.$valid_till.'</td>
</tr>

</table>
';

$pdf->writeHTML($html);
$upload_dir = wp_upload_dir();
$timestamp = time();
$pdf_file = $upload_dir['basedir'] . "/invoices/invoice-" . sanitize_title($entry_id).'-'. $timestamp . ".pdf";
$invoices_dir = $upload_dir['basedir'] . '/invoices';
    if ( ! file_exists($invoices_dir) ) {
    wp_mkdir_p($invoices_dir);
    }
$pdf->Output($pdf_file, 'F');

    require_once get_template_directory() . '/razorpay/Razorpay.php';

    $api = new Razorpay\Api\Api(
        'rzp_test_Ss7LbNUQr9iBtr',
        'Xx7iSb0uunJ2Ab48cVcyqX1h'
    );

   

    $attributes = [

        'razorpay_order_id' =>
            $_POST['razorpay_order_id'],

        'razorpay_payment_id' =>
            $_POST['razorpay_payment_id'],

        'razorpay_signature' =>
            $_POST['razorpay_signature']

    ];

    try {

        /*
        |--------------------------------------------------------------------------
        | VERIFY SIGNATURE
        |--------------------------------------------------------------------------
        */

        $api->utility->verifyPaymentSignature($attributes);

        /*
        |--------------------------------------------------------------------------
        | UPDATE DB
        |--------------------------------------------------------------------------
        */

        $wpdb->update(

            $wpdb->prefix . 'frmt_form_entry_meta',

            [

                'meta_value' => 'paid'

            ],

            [

                'entry_id' => $entry_id,

                'meta_key' => 'payment_status'

            ]

        );

        /*
        |--------------------------------------------------------------------------
        | SAVE PAYMENT ID
        |--------------------------------------------------------------------------
        */

        $wpdb->insert(

            $wpdb->prefix . 'frmt_form_entry_meta',

            [

                'entry_id' => $entry_id,

                'meta_key' => 'razorpay_payment_id',

                'meta_value' =>
                    sanitize_text_field(
                        $_POST['razorpay_payment_id']
                    )

            ]

        );

        /*
        |--------------------------------------------------------------------------
        | GET USER EMAIL
        |--------------------------------------------------------------------------
        */

        $email = $wpdb->get_var(

            $wpdb->prepare(

                "
                SELECT meta_value
                FROM {$wpdb->prefix}frmt_form_entry_meta
                WHERE entry_id = %d
                AND meta_key = %s
                LIMIT 1
                ",

                $entry_id,
                'email-1'

            )

        );

        /*
        |--------------------------------------------------------------------------
        | SEND EMAIL
        |--------------------------------------------------------------------------
        */

      if ($email) {

    wp_mail(
        $email,
        'Payment Successful',
        'Your payment was completed successfully. Invoice attached.',
        [],
        [$pdf_file]
    );
}

        wp_send_json_success([

            'message' => 'Payment verified'

        ]);

    } catch (Exception $e) {

        wp_send_json_error([

            'message' => $e->getMessage()

        ]);

    }

}
add_action('init', function () {

    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Authorization');

    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        status_header(200);
        exit();
    }

});
add_action('rest_api_init', function () {

    register_rest_route('ais/v1', '/form/(?P<id>\d+)', [
        'methods'  => 'GET',
        'callback' => 'ais_get_form',
        'permission_callback' => '__return_true'
    ]);

});

function ais_get_form($request)
{
    $form_id = (int) $request['id'];

    $form = Forminator_API::get_form($form_id);

    return rest_ensure_response($form);
}
// Next to WP
add_action('rest_api_init', function () {

    register_rest_route(
        'ais/v1',
        '/lead',
        [
            'methods'  => 'POST',
            'callback' => 'ais_save_lead',
            'permission_callback' => '__return_true',
        ]
    );

});

function ais_save_lead($request)
{
    $data = $request->get_json_params();
    $captcha = $data['captcha'] ?? '';

$response = wp_remote_post(
    'https://challenges.cloudflare.com/turnstile/v0/siteverify',
    [
        'body' => [
            'secret' => TURNSTILE_SECRET,
            'response' => $captcha
        ]
    ]
);

$body = json_decode(
    wp_remote_retrieve_body($response),
    true
);

if (empty($body['success'])) {

    return new WP_Error(
        'captcha_failed',
        'Captcha verification failed',
        ['status' => 400]
    );
}
    if (empty($data['form_id'])) {
        return new WP_Error(
            'missing_form_id',
            'Form ID is required',
            ['status' => 400]
        );
    }

    if (empty($data['fields']) || !is_array($data['fields'])) {
        return new WP_Error(
            'missing_fields',
            'Fields are required',
            ['status' => 400]
        );
    }

    $form_id = (int) $data['form_id'];
    $fields = $data['fields'];

    /**
     * Form 1 Validation
     */
    if ($form_id === 9) {

        if (empty($fields['name-1'])) {
            return new WP_Error(
                'name_required',
                'Name is required',
                ['status' => 400]
            );
        }

        if (empty($fields['email-1'])) {
            return new WP_Error(
                'email_required',
                'Email is required',
                ['status' => 400]
            );
        }

        if (!is_email($fields['email-1'])) {
            return new WP_Error(
                'invalid_email',
                'Invalid email address',
                ['status' => 400]
            );
        }
    }

    /**
     * Form 2 Validation
     */
    if ($form_id === 7) {

        if (empty($fields['company-1'])) {
            return new WP_Error(
                'company_required',
                'Company name is required',
                ['status' => 400]
            );
        }

        if (
            !empty($fields['website-1']) &&
            !filter_var($fields['website-1'], FILTER_VALIDATE_URL)
        ) {
            return new WP_Error(
                'invalid_website',
                'Invalid website URL',
                ['status' => 400]
            );
        }

        if (empty($fields['message-1'])) {
            return new WP_Error(
                'message_required',
                'Message is required',
                ['status' => 400]
            );
        }
    }

    $entry_meta = [];

    foreach ($fields as $field_name => $field_value) {

        $entry_meta[] = [
            'name'  => sanitize_text_field($field_name),
            'value' => is_array($field_value)
                ? wp_json_encode($field_value)
                : sanitize_text_field($field_value)
        ];
    }

    $entry_id = Forminator_API::add_form_entry(
        $form_id,
        $entry_meta
    );

    return [
        'success' => true,
        'entry_id' => $entry_id
    ];
}
require HELLO_THEME_PATH . '/theme.php';
HelloTheme\Theme::instance();