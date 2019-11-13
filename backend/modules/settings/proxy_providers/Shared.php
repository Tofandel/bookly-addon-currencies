<?php

namespace BooklyCurrencies\Backend\Modules\Settings\ProxyProviders;

use Bookly\Backend\Modules\Settings\Proxy;
use Bookly\Backend\Components\Settings\Menu;
use Bookly\Lib\Utils\Price;

/**
 * Class Shared
 *
 * @package BooklyCoupons\Backend\Modules\Settings\ProxyProviders
 */
class Shared extends Proxy\Shared {
	public static function enqueueAssets() {
		self::enqueueScripts( [
			'module' => [
				'currency-settings.js' => [ 'jquery' ],
			],
		] );

		wp_localize_script( 'bookly-currency-settings', 'BooklyCurrencies', [
			'languages' => array_values( wp_list_pluck( apply_filters( 'wpml_active_languages', null ), 'language_code' ) ),
			'rates' => Price::getRates(),
		] );
	}

	/**
	 * @inheritdoc
	 */
	public static function renderMenuItem() {
		Menu::renderItem( esc_html__( 'Currencies', 'bookly' ), 'currencies' );
	}

	/**
	 * @inheritdoc
	 */
	public static function renderTab() {
		self::renderTemplate( 'settings_tab' );
	}

	/**
	 * @inheritdoc
	 */
	public static function saveSettings( array $alert, $tab, array $params ) {
		if ( $tab == 'currencies' ) {

			if ( isset( $params['bookly_currencies'] ) ) {
				$languages = apply_filters( 'wpml_active_languages', null );
				$default_lang = apply_filters( 'wpml_default_language', null );
				$currencies = get_option( 'bookly_currencies', [] );

				foreach ( $languages as $lang ) {
					if ( $lang['language_code'] == $default_lang ) {
						continue;
					}
					if ( isset( $params['bookly_currencies'][$lang['code']] ) ) {
						$val = $params['bookly_currencies'][$lang['code']];
						$currencies[$lang['code']] = [ 'currency' => (string)$val['currency'], 'format' => (string)$val['format'], 'rate' => $val['rate'] ?? null ];
					}
				}
				update_option( 'bookly_currencies', $currencies );
			}
			$options = array( 'bookly_currencies_enabled', 'bookly_currencies_api_key' );
			foreach ( $options as $option_name ) {
				if ( array_key_exists( $option_name, $params ) ) {
					update_option( $option_name, $params[ $option_name ] );
				}
			}

			$alert['success'][] = __( 'Settings saved.', 'bookly' );
		}

		return $alert;
	}
}