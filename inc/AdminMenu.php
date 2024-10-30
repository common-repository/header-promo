<?php
if ( !defined( 'ABSPATH' ) ) { exit; }

if ( !class_exists( 'BPHPAdminMenu' ) ){
	class BPHPAdminMenu{
		function __construct(){
			add_action( 'admin_enqueue_scripts', [$this, 'adminEnqueueScripts'] );
			add_action( 'admin_menu', [$this, 'adminMenu'] );
			add_filter( 'custom_menu_order', [$this, 'orderSubMenu'] );
		}

		function adminEnqueueScripts( $hook ){
			if( 'header-promo_page_header-promo-help' === $hook ){
				wp_enqueue_style( 'bphp-promo-admin-style', BPHP_DIR_URL . 'dist/admin.css', false, BPHP_VERSION );
				wp_enqueue_script( 'bphp-promo-admin-script', BPHP_DIR_URL . 'dist/admin.js', [ 'react', 'react-dom', 'wp-i18n' ], BPHP_VERSION );
			}
		}

		function adminMenu(){
			add_menu_page(
				__( 'Header Promo', 'header-promo' ),
				__( 'Header Promo', 'header-promo' ),
				'manage_options',
				'header-promo',
				'',
				'dashicons-megaphone',
				20
			);
			add_submenu_page(
				'header-promo',
				__( 'Help', 'header-promo' ),
				__( 'Help', 'header-promo' ),
				'manage_options',
				'header-promo-help',
				[$this, 'bphpHelpPage']
			);
		}

		function bphpHelpPage(){ ?>
			<div class='bphpAdminHelpPage'></div>
		<?php }

		function orderSubMenu( $menu_ord ){
			global $submenu;
		
			$arr = array();
			$arr[] = $submenu['header-promo'][2]; // Options
			$arr[] = $submenu['header-promo'][1]; // Help
			$submenu['header-promo'] = $arr;
		
			return $menu_ord;
		}
	}
	new BPHPAdminMenu;
}