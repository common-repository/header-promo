<?php
/**
 * Plugin Name:			Header Promo
 * Plugin URI:			https://wordpress.org/plugins/my-pricing-table
 * Description:			Make beautiful Promotion Bar with this plugin.
 * Version:				1.1.1
 * Requires at least:	5.2
 * Author:				bPlugins LLC
 * Author URI:			https://bplugins.com
 * License:				GPL v2 or later
 * License URI:			https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:			header-promo
 */

// ABS PATH
if ( !defined( 'ABSPATH' ) ) { exit; }

// Constant
define( 'BPHP_VERSION', isset( $_SERVER['HTTP_HOST'] ) && 'localhost' === $_SERVER['HTTP_HOST'] ? time() : '1.1.0' );
define( 'BPHP_DIR_URL', plugin_dir_url( __FILE__ ) );

if ( !class_exists( 'BPHPHeaderPromoPlugin' ) ){
	class BPHPHeaderPromoPlugin{
		function __construct(){
			$bphpOptions = get_option( 'bphp_promo' );

			register_activation_hook( __FILE__, [$this, 'onPluginActivate'] );
			add_action( 'admin_init', [$this, 'adminInit'] );
			add_action( 'wp_enqueue_scripts', [$this, 'enqueueScripts'] );
			add_action( 'init', [$this, 'onInit'] );
			add_action( $bphpOptions['header_promo_pos'], [$this, 'initHeaderPromo'] );
		}

		function onPluginActivate(){
			add_option( 'bphp_plugin_do_activation_redirect', true );
		}
		
		function adminInit() {
			if ( get_option( 'bphp_plugin_do_activation_redirect', false ) ) {
				delete_option( 'bphp_plugin_do_activation_redirect' );
				wp_redirect('admin.php?page=header-promo-options');
			}
		}

		function enqueueScripts(){
			$bphpOptions = get_option( 'bphp_promo' );
			extract( $bphpOptions );

			if( $promo_header_off_on ){
				wp_enqueue_style( 'bphp-promo-style', BPHP_DIR_URL . 'dist/style.css', [], BPHP_VERSION );
				wp_enqueue_script( 'bphp-promo-script', BPHP_DIR_URL . 'dist/script.js', [ 'wp-i18n' ], BPHP_VERSION );
			}
		}

		function onInit(){
			load_plugin_textdomain( 'header-promo', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
		}

		function initHeaderPromo(){
			$bphpOptions = get_option( 'bphp_promo' );
			extract( $bphpOptions );
			$show = false;

			$pages = preg_split('/\n/', $promo_pages ?? '');
			$actualLink = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

			foreach( $pages as $page ){
				if(trim($page, '/') === trim($actualLink, '/')){
					$show = true;
				}
			}

			if( count($pages) <= 1 && $pages[0] === '' ){
				$show = true;
			}

			if( $promo_header_off_on && $show ){
				echo $this->promoContent( $bphpOptions );
			}else{
				return;
			}
		}

		function promoContent( $bphpOptions ){
			extract( $bphpOptions );
			$btnLinkTarget = $promo_btn_link_target ?? '_blank';
			$isStopReappear = ($promoStopReappear ?? '0') === '1';

			$countdownHTML = $promo_countdown_off_on ? $this->countdownHTML() : '';

			$footerCSS = $header_promo_pos === 'wp_footer' ? '#promo-outer {
				position: fixed;
				bottom: 0;
				left: 0;
				z-index: 9999;
			}' : '';
			$style3CSS = 'style_3' === $header_promo_style ? '#promo-outer #close {
				font-size: 15px;
				line-height: 24px;
			}' : '';

			$promoToggleClass = $isStopReappear ? 'promoClosed': 'promoOpened';
			$promoDisplay = $isStopReappear ? 'none': 'block';

			$styles = "
				$footerCSS
				#promo-outer {
					display: $promoDisplay;
					background: $header_promo_bg;
				}
				#promo-inner span.promo_txt{
					font-size: ". $promo_text_size ."px;
					color: $promo_text_color;
					font-style: $promo_text_style;
					font-weight: $promo_text_weight;
				}
				#promo-inner .promo_btn {
					background: $promo_btn_color;
					color: $promo_btn_text_color;
					font-size: ". $promo_btn_text_size ."px;
					border-radius: ". $promo_btn_radius ."px;
				}
				#promo-inner a.promo_btn:hover {
					color: $promo_btn_hover_color;
					background: $promo_btn_hover;
				}
				ul.countdown {
					color: $promo_count_text_color;
					background: $promo_count_bg;
				}
				.days, .hours, .minutes, .seconds {
					background: $promo_time_bg;
					font-weight: $promo_time_text_weight;
					font-size: ". $promo_time_text_size ."px;
					border-style: solid;
					border-width: ". $promo_time_border_width ."px;
					border-color: $promo_time_border_clr;
					border-radius: ". $promo_time_border_radius ."px;
				}
				$style3CSS
			";
			
			ob_start(); ?>
			<div id='promo-outer' class='bphpPromo <?php echo esc_attr( $promoToggleClass ); ?>' data-options='<?php echo esc_attr( wp_json_encode( $bphpOptions ) ); ?>'>
				<style><?php echo esc_html( $styles ); ?></style>

				<div id='promo-inner' class='bphpPromoInner'>
					<?php echo $header_promo_style === 'style_2' ? wp_kses_post( $countdownHTML ) : '' ?>

					<span class='promo_txt'>
						<?php echo esc_html( $header_promo_text ); ?>
					</span>

					<?php echo $header_promo_style === 'style_1' ? wp_kses_post( $countdownHTML ) : '' ?>

					<a href='<?php echo esc_url( $promo_btn_link ); ?>' class='promo_btn' target='<?php echo esc_attr( $btnLinkTarget ); ?>'>
						<?php echo esc_html( $promo_btn_text ); ?>
					</a>
					<span id='close'>
						<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 384 512' fill='currentColor'>
							<path d='M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z'/>
						</svg>
					</span>
				</div>
			</div>

			<?php
			return ob_get_clean();
		}

		function countdownHTML(){
			ob_start(); ?>
			<div class='countdown'>
				<div>
					<span class='days'>00</span>
					<span class='days_ref'><?php echo __('days', 'header-promo'); ?></span>
				</div>

				<div>
					<span class='hours'>00</span>
					<span class='hours_ref'><?php echo __('hours', 'header-promo'); ?></span>
				</div>

				<div>
					<span class='minutes'>00</span>
					<span class='minutes_ref'><?php echo __('minutes', 'header-promo'); ?></span>
				</div>

				<div>
					<span class='seconds'>00</span>
					<span class='seconds_ref'><?php echo __('seconds', 'header-promo'); ?></span>
				</div>
			</div>
			<?php return ob_get_clean();
		}
	}
	new BPHPHeaderPromoPlugin();
}

require_once 'inc/csf/csf-config.php';
if( class_exists( 'CSF' )) {
	require_once 'inc/csf/setting-options.php';
}
require_once 'inc/AdminMenu.php';