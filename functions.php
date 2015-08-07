<?php

// Define the version as a constant so we can easily replace it throughout the theme
define( 'LESS_VERSION', '1.1.1' );

/*-----------------------------------------------------------------------------------*/
/* Load language
/*-----------------------------------------------------------------------------------*/
add_action('after_setup_theme', 'my_theme_setup');
function my_theme_setup(){
    load_theme_textdomain('less', get_template_directory() . '/lang');
}

/*-----------------------------------------------------------------------------------*/
/* Add Rss to Head
/*-----------------------------------------------------------------------------------*/
add_theme_support( 'automatic-feed-links' );


/*-----------------------------------------------------------------------------------*/
/* register main menu
/*-----------------------------------------------------------------------------------*/
register_nav_menus( 
	array(
		'primary'	=>	__( 'Primary Menu', 'less' ),
	)
);

/*-----------------------------------------------------------------------------------*/
/* Enque Styles and Scripts
/*-----------------------------------------------------------------------------------*/

function less_scripts()  { 

	// theme styles
	wp_enqueue_style( 'less-style', get_template_directory_uri() . '/style.css', '10000', 'all' );
			
	// add fitvid
	wp_enqueue_script( 'less-fitvid', get_template_directory_uri() . '/js/jquery.fitvids.js', array( 'jquery' ), LESS_VERSION, true );
	
	// add theme scripts
	wp_enqueue_script( 'less', get_template_directory_uri() . '/js/theme.min.js', array(), LESS_VERSION, true );
  
}
add_action( 'wp_enqueue_scripts', 'less_scripts' );


/*-----------------------------------------------------------------------------------*/
/* Theme customization
/*-----------------------------------------------------------------------------------*/
function less_customizer_general($wp_customize) {

    $wp_customize->add_section('less_general', array(
        'title'    => __('Less options', 'less'),
        'description' => '',
        'priority' => 120,
    ));

	// Alt text for gravatar
	$wp_customize->add_setting( 'less_gravatar_alt_text', array(
		'type'		    => 'theme_mod',
        'capability'    => 'edit_theme_options',
		'default'	    => ''
	) );

	$wp_customize->add_control( 'less_gravatar_alt_text', array(
		'label'		=> __('Gravatar alt text','less'),
		'section'	=> 'less_general',
		'settings'	=> 'less_gravatar_alt_text',
		'type'		=> 'text',
		'priority'	=> '1',
	) );
		
}

add_action( 'customize_register', 'less_customizer_general' );
