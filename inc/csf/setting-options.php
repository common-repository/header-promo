<?php if ( ! defined( 'ABSPATH' ) ) { die; }

$prefix = 'bphp_promo';

// Create options
CSF::createOptions( $prefix, array(
	'menu_title'		=> 'Settings / Options',
	'menu_slug'			=> 'header-promo-options',
	'menu_type'			=> 'submenu',
	'menu_parent'		=> 'header-promo',
	'framework_title'	=> 'Header Promo Settings / Options',
	'footer_credit'		=> 'If you like <strong> Header Promo </strong> please leave us a <a href="https://wordpress.org/support/plugin/header-promo/reviews/?filter=5#new-post" target="_blank">&#9733;&#9733;&#9733;&#9733;&#9733;</a> rating. Your Review is very important to us as it helps us to grow more. <a href="https://bplugins.com/">bPlugins</a> ',
) );


// Basic Fields
CSF::createSection( $prefix, array(
	'id'		=> 'header_promo_settings',
	'title'		=> 'Header Promo Settings',
	'icon'		=> 'fa fa-cog',
	'fields'	=> array(
		array(
			'id'			=> 'promo_header_off_on',
			'type'			=> 'switcher',
			'title'			=> esc_html__('Show/Hide Bar', 'header-promo'),
			'desc'			=> esc_html__('Show or Hide Promotion Bar', 'header-promo'),
			'default'		=> true,
		),

		array(
			'id'			=> 'promoStopReappear',
			'type'			=> 'switcher',
			'title'			=> esc_html__('Stop Reappear', 'header-promo'),
			'desc'			=> esc_html__('Stop reappear after closed the promo', 'header-promo'),
			'dependency'	=> array( 'promo_header_off_on', '==', '1' )
		),

		array(
			'id'			=> 'promo_pages',
			'type'			=> 'textarea',
			'title'			=> esc_html__('Pages', 'header-promo'),
			'desc'			=> esc_html__('Leave empty to show on every page. Every page should be in a new line', 'header-promo'),
			'attributes'	=> [
				'style'		=> 'width:800px;'
			],
			'dependency'	=> array( 'promo_header_off_on', '==', '1' )
		),

		array(
			'id'			=> 'header_promo_style',
			'type'			=> 'button_set',
			'title'			=> esc_html__('Style', 'header-promo'),
			'desc'			=> esc_html__('Choose Promo Style from the list', 'header-promo'),
			'options'		=> array(
				'style_1'	=> 'Style 1',
				'style_2'	=> 'Style 2',
				'style_3'	=> 'Style 3',
			),
			'default'		=> 'style_1',
			'dependency'	=> array( 'promo_header_off_on', '==', '1' )
		),
		array(
			'id'			=> 'header_promo_pos',
			'type'			=> 'button_set',
			'title'			=> esc_html__('Positions', 'header-promo'),
			'desc'			=> esc_html__('Choose Position where you want to show', 'header-promo'),
			'options'		=> array(
				'wp_head'	=> 'Header Top',
				'wp_footer'	=> 'Footer Bottom',
			),
			'default'		=> 'wp_head',
			'dependency'	=> array( 'promo_header_off_on', '==', '1' ) 
		),
		array(
			'id'			=> 'header_promo_bg',
			'type'			=> 'color',
			'title'			=> esc_html__('Background','header-promo'),
			'desc'			=> esc_html__('Choose Background of the Promo Bar', 'header-promo'),
			'default'		=> '#8224e3',
			'dependency'	=> array( 'promo_header_off_on', '==', '1' ) 
		),

		// Message/Text ==========
		array(
			'id'			=> 'promo_message_header',
			'type'			=> 'subheading',
			'title'			=> esc_html__('Message/Text', 'header-promo'),
			'dependency'	=> array( 'promo_header_off_on', '==', '1' ) 
		),
		array(
			'id'			=> 'header_promo_text',
			'type'			=> 'text',
			'title'			=> esc_html__('Message/Text', 'header-promo'),
			'desc'			=> esc_html__('Enter Promo message/text', 'header-promo'),
			'default'		=> 'Get Scalify forever with a 60% off lifetime deal!',
			'dependency'	=> array( 'promo_header_off_on', '==', '1' ) 
		),
		array(
			'id'			=> 'promo_text_size',
			'type'			=> 'spinner',
			'title'			=> esc_html__('Message/Text Font Size', 'header-promo'),
			'desc'			=> esc_html__('Enter Font Size for Promo Message/Text', 'header-promo'),
			'unit'			=> 'px',
			'default'		=> '18',
			'dependency'	=> array( 'promo_header_off_on', '==', '1' ) 
		),
		array(
			'id'			=> 'promo_text_color',
			'type'			=> 'color',
			'title'			=> esc_html__('Message/Text Color', 'header-promo'),
			'desc'			=> esc_html__('Color for Promo Message/Text', 'header-promo'),
			'default'		=> '#f2f2f2',
			'dependency'	=> array( 'promo_header_off_on', '==', '1' ) 
		),
		array(
			'id'			=> 'promo_text_weight',
			'type'			=> 'button_set',
			'title'			=> esc_html__('Message/Text Font Weight', 'header-promo'),
			'desc'			=> esc_html__('Choose Font Weight for Message/Text from the list', 'header-promo'),
			'options'		=> array(
				'300'		=> '300',
				'400'		=> '400',
				'600'		=> '600',
				'700'		=> '700'
			),
			'default'		=> '400',
			'dependency'	=> array( 'promo_header_off_on', '==', '1' ) 
		),
		array(
			'id'			=> 'promo_text_style',
			'type'			=> 'button_set',
			'title'			=> esc_html__('Message/Text Style', 'header-promo'),
			'desc'			=> esc_html__('Choose Message/Text Style', 'header-promo'),
			'options'		=> array(
				'normal'	=> 'Normal',
				'italic'	=> 'Italic',
				'oblique'	=> 'Oblique'
			),
			'default'		=> 'normal',
			'dependency'	=> array( 'promo_header_off_on', '==', '1' ) 
		),

		// Button ==========
		array(
			'id'			=> 'promo_btn_header',
			'type'			=> 'subheading',
			'title'			=> esc_html__('Button Options', 'header-promo'),
			'dependency'	=> array( 'promo_header_off_on', '==', '1' ) 
		),
		array(
			'id'			=> 'promo_btn_text',
			'type'			=> 'text',
			'title'			=> esc_html__('Button Text', 'header-promo'),
			'desc'			=> esc_html__('Enter the text of the Promo Button', 'header-promo'),
			'default'		=> 'Get Lifetime Deal',
			'dependency'	=> array( 'promo_header_off_on', '==', '1' ) 
		),
		array(
			'id'			=> 'promo_btn_link',
			'type'			=> 'text',
			'title'			=> esc_html__('Button Link', 'header-promo'),
			'desc'			=> esc_html__('Enter the link of the Promo BUtton', 'header-promo'),
			'default'		=> 'https://example.com',
			'dependency'	=> array( 'promo_header_off_on', '==', '1' ) 
		),
		array(
			'id'			=> 'promo_btn_link_target',
			'type'			=> 'button_set',
			'title'			=> esc_html__('Open link in', 'header-promo'),
			'desc'			=> esc_html__('Choose where the promo button link will open', 'header-promo'),
			'options'		=> array(
				'_self'		=> 'Current Tab',
				'_blank'	=> 'New Tab'
			),
			'default'		=> '_blank',
			'dependency'	=> array( 'promo_header_off_on|promo_btn_link', '==|!=', '1|' )
		),
		array(
			'id'			=> 'promo_btn_text_size',
			'type'			=> 'spinner',
			'title'			=> esc_html__('Button Font Size', 'header-promo'),
			'desc'			=> esc_html__('Enter Font Size for Promo Button', 'header-promo'),
			'min'			=> 10,
			'unit'			=> 'px',
			'default'		=> 16,
			'dependency'	=> array( 'promo_header_off_on', '==', '1' ) 
		),
		array(
			'id'			=> 'promo_btn_text_color',
			'type'			=> 'color',
			'title'			=> esc_html__('Button Text color', 'header-promo'),
			'desc'			=> esc_html__('Text Color for Promo Button', 'header-promo'),
			'default'		=> '#fff',
			'dependency'	=> array( 'promo_header_off_on', '==', '1' ) 
		),

		array(
			'id'			=> 'promo_btn_color',
			'type'			=> 'color',
			'title'			=> esc_html__('Button Background Color', 'header-promo'),
			'desc'			=> esc_html__('Color for Promo Button Background', 'header-promo'),
			'default'		=> '#2998ff',
			'dependency'	=> array( 'promo_header_off_on', '==', '1' ) 
		),
		array(
			'id'			=> 'promo_btn_radius',
			'type'			=> 'slider',
			'title'			=> esc_html__('Button Border Radius', 'header-promo'),
			'desc'			=> esc_html__('Choose Border Radius for Promo Button', 'header-promo'),
			'min'			=> 0,
			'max'			=> 100,
			'step'			=> 1,
			'unit'			=> 'px',
			'default'		=> 25,
			'dependency'	=> array( 'promo_header_off_on', '==', '1' ) 
		),
		array(
			'id'			=> 'promo_btn_hover_color',
			'type'			=> 'color',
			'title'			=> esc_html__('Button Hover Color', 'header-promo'),
			'desc'			=> esc_html__('Choose Hover Color for Promo Button', 'header-promo'),
			'default'		=> '#fff',
			'dependency'	=> array( 'promo_header_off_on', '==', '1' ) 
		),
		array(
			'id'			=> 'promo_btn_hover',
			'type'			=> 'color',
			'title'			=> esc_html__('Button Hover Background Color', 'header-promo'),
			'desc'			=> esc_html__('Choose Hover Background Color for Promo Button', 'header-promo'),
			'default'		=> '#43a4ff',
			'dependency'	=> array( 'promo_header_off_on', '==', '1' ) 
		)
	)
) );

// Countdown Fields
CSF::createSection( $prefix, array(
	'id'		=> 'promo_countdown_settings',
	'title'		=> 'Promo Countdown Settings',
	'icon'		=> 'fa fa-clock',
	'fields'	=> array(
		array(
			'id'			=> 'promo_countdown_off_on',
			'type'			=> 'switcher',
			'title'			=> esc_html__('Show/Hide Countdown Timer', 'header-promo'),
			'desc'			=> esc_html__('Choose mode to Enable or Disable Promotion Countdown', 'header-promo'),
			'default'		=> true,
		),
		array(
			'id'			=> 'promo_count_date',
			'type'			=> 'date',
			'title'			=> esc_html__('Targeted Date', 'header-promo'),
			'desc'			=> esc_html__('Select Targeted Date for the Countdown Timer', 'header-promo'),
			'settings'		=> array(
				'dateFormat'		=> 'mm/dd/yy',
				'changeMonth'		=> true,
				'changeYear'		=> true,
				'showWeek'			=> true,
				'showButtonPanel'	=> true,
				'weekHeader'		=> 'Week',
				'monthNamesShort'	=> array( 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December' ),
				'dayNamesMin'		=> array( 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday' )
			),
			'default'		=> '11/24/2023',
			'dependency'	=> array( 'promo_countdown_off_on', '==', '1' )
		),
		array(
			'id'			=> 'promo_count_time',
			'type'			=> 'text',
			'title'			=> esc_html__('Targeted Time', 'header-promo'),
			'desc'			=> esc_html__('Enter Targeted Time for Countdown Timer, No Need to Input AM/PM: format "hh:mm:ss"', 'header-promo'),
			'subtitle'		=> esc_html__('Use time in 24 hours format', 'header-promo'),
			'default'		=> '12:00:00',
			'dependency'	=> array( 'promo_countdown_off_on', '==', '1' )
		),
		
		array(
			'id'			=> 'promo_count_text_color',
			'type'			=> 'color',
			'title'			=> esc_html__('Text Color', 'header-promo'),
			'desc'			=> esc_html__('Choose Text Color of Countdown Timer', 'header-promo'),
			'default'		=> '#f2f2f2',
			'dependency'	=> array( 'promo_countdown_off_on', '==', '1' )
		),
		array(
			'id'			=> 'promo_count_bg',
			'type'			=> 'color',
			'title'			=> esc_html__('Background', 'header-promo'),
			'desc'			=> esc_html__('Choose Background color for Countdown Timer', 'header-promo'),
			'default'		=> 'transparent',
			'dependency'	=> array( 'promo_countdown_off_on', '==', '1' )
		),
		array(
			'id'			=> 'promo_time_bg',
			'type'			=> 'color',
			'title'			=> esc_html__('Digit Background', 'header-promo'),
			'desc'			=> esc_html__('Choose Background Color for Countdown Timer Digit', 'header-promo'),
			'default'		=> 'transparent',
			'dependency'	=> array( 'promo_countdown_off_on', '==', '1' )
		),
		array(
			'id'			=> 'promo_time_text_size',
			'type'			=> 'spinner',
			'title'			=> esc_html__('Digit Font Size', 'header-promo'),
			'desc'			=> esc_html__('Enter Font Size for Countdown Timer Digit', 'header-promo'),
			'unit'			=> 'px',
			'default'		=> 26,
			'dependency'	=> array( 'promo_countdown_off_on', '==', '1' )
		),
		array(
			'id'			=> 'promo_time_text_weight',
			'type'			=> 'button_set',
			'title'			=> esc_html__('Digit Font Weight', 'header-promo'),
			'desc'			=> esc_html__('Choose Font Weight for Countdown Timer Digit', 'header-promo'),
			'options'		=> array(
				'300'	=> '300',
				'400'	=> '400',
				'600'	=> '600',
				'700'	=> '700'
			),
			'default'		=> '400',
			'dependency'	=> array( 'promo_countdown_off_on', '==', '1' )
		),
		array(
			'id'			=> 'promo_time_border_width',
			'type'			=> 'spinner',
			'title'			=> esc_html__('Digit Border', 'header-promo'),
			'subtitle'		=> esc_html__('To hide border, Set it to "0"', 'header-promo'),
			'desc'			=> esc_html__('Enter Border Size for Countdown Timer Digit', 'header-promo'),
			'unit'			=> 'px',
			'default'		=> 1,
			'dependency'	=> array( 'promo_countdown_off_on', '==', '1' )
		),
		array(
			'id'			=> 'promo_time_border_clr',
			'type'			=> 'color',
			'title'			=> esc_html__('Digit Border Color', 'header-promo'),
			'desc'			=> esc_html__('Choose Border Color for Countdown Timer Digit', 'header-promo'),
			'default'		=> '#f2f2f2',
			'dependency'	=> array( 'promo_countdown_off_on', '==', '1' )
		),
		array(
			'id'			=> 'promo_time_border_radius',
			'type'			=> 'spinner',
			'title'			=> esc_html__('Digit Border Radius', 'header-promo'),
			'desc'			=> esc_html__('Input Size for Border Radius', 'header-promo'),
			'unit'			=> 'px',
			'default'		=> 5,
			'dependency'	=> array( 'promo_countdown_off_on', '==', '1' )
		)
	)
) );


// Field: backup
CSF::createSection( $prefix, array(
	'title'			=> 'Backup',
	'icon'			=> 'fas fa-shield-alt',
	'description'	=> 'Visit documentation for more details on this field: <a href="http://codestarframework.com/documentation/#/fields?id=backup" target="_blank">Field: backup</a>',
	'fields'		=> array(
		array(
			'type'	=> 'backup',
		)
	)
) );