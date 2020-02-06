<?php

namespace BooklyCurrencies\Lib;

use Bookly\Lib;
use BooklyCurrencies\Backend\Modules\Settings\ProxyProviders\Shared as Settings;
use BooklyCurrencies\Backend\Modules\Staff\Proxy\Shared;

/**
 * Class Plugin
 *
 * @package BooklyCurrencies\Lib
 */
abstract class Plugin extends Lib\Base\Plugin {
	protected static $prefix;
	protected static $title;
	protected static $version;
	protected static $slug;
	protected static $directory;
	protected static $main_file;
	protected static $basename;
	protected static $text_domain;
	protected static $root_namespace;
	protected static $embedded;

	/**
	 * Register hooks.
	 */
	public static function registerHooks() {
		//parent::registerHooks(); Plugin is not an official plugin so no purchase code and update

		if ( is_admin() ) {
			Settings::init();
		}
		Shared::init();

		if ( get_option( 'bookly_currencies_enabled' ) ) {
			if ( ! class_exists( Lib\Utils\Price::class, false ) ) {
				require_once 'utils/Price.php';
			}
		}
	}
}
