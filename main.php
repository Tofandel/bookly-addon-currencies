<?php
/*
Plugin Name: Bookly Currencies (Add-on)
Plugin URI: http://booking-wp-plugin.com
Description: Bookly Currencies add-on allows you to set multiple currencies depending on the language.
Version: 1.0
Author: Tofandel
Author URI: http://booking-wp-plugin.com
Text Domain: bookly-cart
Domain Path: /languages
License: GPLv3
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use BooklyCurrencies\Lib\Boot;

if ( ! function_exists( 'bookly_currencies_loader' ) ) {
    include_once __DIR__ . '/autoload.php';

    Boot::up();
}