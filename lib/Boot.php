<?php
namespace BooklyCurrencies\Lib;

/**
 * Class Boot
 *
 * @package BooklyMultiplyAppointments\Lib
 */
class Boot
{
    public static $plugin_title     = 'Bookly Currencies (Add-on)';
    public static $req_plugin_class = 'BooklyPro\Lib\Plugin';
    public static $req_version      = '1.6';

	/**
	 * Boot up.
	 */
	public static function up()
	{
		$main_file = self::mainFile();
		$plugin    = self::pluginClass();

		// Register activation/deactivation hooks.
		if ( self::embedded() ) {
			add_action( 'deactivate_bookly-addon-pro/main.php', array( $plugin, 'deactivate' ), 99, 1 );
		} else {
			register_activation_hook( $main_file, function ( $network_wide ) use ( $plugin ) {
				if ( Boot::checkEnv() ) {
					$plugin::activate( $network_wide );
				}
			} );
			register_deactivation_hook( $main_file, function ( $network_wide ) use ( $plugin ) {
				if ( Boot::checkEnv() ) {
					$plugin::deactivate( $network_wide );
				}
			} );
			register_uninstall_hook( $main_file, array( __CLASS__, 'uninstall' ) );
		}

		// Run plugin.
		add_action( 'plugins_loaded', function () use ( $plugin, $main_file ) {
			if ( Boot::checkEnv() ) {
				$plugin::run();
			} else {
				// Deactivate plugin.
				add_action( 'init', function () use ( $main_file ) {
					if ( current_user_can( 'activate_plugins' ) ) {
						add_action( 'admin_init', function () use ( $main_file ) {
							deactivate_plugins( $main_file, false, is_network_admin() );
						} );
						add_action( is_network_admin() ? 'network_admin_notices' : 'admin_notices', function () {
							printf( '<div class="updated"><h3>%s</h3><p>The plugin has been <strong>deactivated</strong>.</p><p><strong>Bookly Pro v%s</strong> is required.</p></div>',
								Boot::$plugin_title,
								Boot::$req_version
							);
						} );
						unset ( $_GET['activate'], $_GET['activate-multi'] );
					}
				} );
			}
		} );
	}

	/**
	 * Check environment.
	 *
	 * @return bool
	 */
	public static function checkEnv()
	{
		return class_exists( 'Bookly\Lib\Base\Plugin' ) &&
			class_exists( self::$req_plugin_class ) &&
			version_compare( call_user_func( array( self::$req_plugin_class, 'getVersion' ) ), self::$req_version, '>=' );
	}

	/**
	 * Uninstall plugin.
	 *
	 * @param $network_wide
	 */
	public static function uninstall( $network_wide )
	{
		if ( $network_wide !== false && has_action( 'bookly_plugin_uninstall' ) ) {
			$slug = basename( dirname( __DIR__ ) );
			do_action( 'bookly_plugin_uninstall', $slug );
		} else {
			/** @var Base\Installer $installer */
			$installer_class = strtok( __NAMESPACE__, '\\' ) . '\Lib\Installer';
			$installer = new $installer_class();
			$installer->uninstall();
		}
	}

	/**
	 * Get path to plugin main file.
	 *
	 * @return string
	 */
	public static function mainFile()
	{
		return dirname( __DIR__ ) . '/main.php';
	}

	/**
	 * Get plugin class.
	 *
	 * @return \Bookly\Lib\Base\Plugin
	 */
	public static function pluginClass()
	{
		return strtok( __NAMESPACE__, '\\' ) . '\Lib\Plugin';
	}

	/**
	 * Check whether add-on is embedded or not.
	 *
	 * @return bool
	 */
	public static function embedded()
	{
		return strpos( self::mainFile(), DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'addons' . DIRECTORY_SEPARATOR ) > 0;
	}
}