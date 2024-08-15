<?php
	add_action( 'wp_enqueue_scripts', function() {
		wp_enqueue_style( 'qlic-acary-theme-css', get_template_directory_uri() . '/style.css', array(), '1.0.0', 'all' );
		wp_add_inline_style( 'qlic-acary-theme-css', qlic_acary_custom_colors() );
	});

	add_action( 'customize_register', function($wp_customize) {
		$wp_customize->add_section('qlic_acary_colors', array(
			'title'    => __('Couleurs du thème', 'qlic-acary'),
			'priority' => 30,
		));
		$wp_customize->add_setting('qlic_acary_main_color', array(
			'default'   => '#0073aa',
			'transport' => 'refresh',
		));
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'qlic_acary_main_color', array(
			'label'    => __('Couleur principale', 'qlic-acary'),
			'section'  => 'qlic_acary_colors',
			'settings' => 'qlic_acary_main_color',
		)));
	});

	function qlic_acary_custom_colors() {
		$main_color = get_theme_mod('qlic_acary_main_color', '#0073aa');
		$custom_css = "
			::selection {
				background-color: $main_color;
				color: #ffffff;
			}
			::-moz-selection {
				background-color: $main_color;
				color: #ffffff;
			}
			a {
				color: $main_color;
			}
			a:hover, a:focus {
				color: darken($main_color, 10%);
			}
		";
		return $custom_css;
	}

	add_action( 'init', function() {
		register_nav_menus(array());
	});

	add_theme_support( 'post-thumbnails' );

	add_filter('upload_mimes', function($file_types){
		$new_filetypes = array();
		$new_filetypes['svg'] = 'image/svg+xml';
		$file_types = array_merge($file_types, $new_filetypes );
		return $file_types;
	});
?>
