<?php

namespace Bookly\Lib\Utils;

/**
 * Class Price
 *
 * @package Bookly\Lib\Utils
 */
abstract class Price {
	/** @var array */
	private static $currencies = [
		'AED' => [ 'symbol' => 'AED', 'format' => '{price|2} {symbol}' ],
		'AMD' => [ 'symbol' => 'դր.', 'format' => '{price|2} {symbol}' ],
		'AOA' => [ 'symbol' => 'Kz', 'format' => '{symbol} {price|2}' ],
		'ARS' => [ 'symbol' => '$', 'format' => '{symbol}{price|2}' ],
		'AUD' => [ 'symbol' => 'A$', 'format' => '{symbol}{price|2}' ],
		'BAM' => [ 'symbol' => 'KM', 'format' => '{price|2} {symbol}' ],
		'BDT' => [ 'symbol' => '৳', 'format' => '{symbol}{price|2}' ],
		'BGN' => [ 'symbol' => 'лв.', 'format' => '{price|2} {symbol}' ],
		'BHD' => [ 'symbol' => 'BHD', 'format' => '{symbol} {price|2}' ],
		'BRL' => [ 'symbol' => 'R$', 'format' => '{symbol} {price|2}' ],
		'BWP' => [ 'symbol' => 'P', 'format' => '{symbol}{price|2}' ],
		'CAD' => [ 'symbol' => 'C$', 'format' => '{symbol}{price|2}' ],
		'CHF' => [ 'symbol' => 'CHF', 'format' => '{price|2} {symbol}' ],
		'CLP' => [ 'symbol' => '$', 'format' => '{symbol}{price|2}' ],
		'COP' => [ 'symbol' => '$', 'format' => '{symbol}{price|0}' ],
		'CRC' => [ 'symbol' => '₡', 'format' => '{symbol}{price|2}' ],
		'CUC' => [ 'symbol' => 'CUC$', 'format' => '{price|2} {symbol}' ],
		'CZK' => [ 'symbol' => 'Kč', 'format' => '{price|2} {symbol}' ],
		'DKK' => [ 'symbol' => 'kr', 'format' => '{price|2} {symbol}' ],
		'DOP' => [ 'symbol' => 'RD$', 'format' => '{symbol}{price|2}' ],
		'DZD' => [ 'symbol' => 'DA', 'format' => '{price|2} {symbol}' ],
		'EGP' => [ 'symbol' => 'EGP', 'format' => '{symbol} {price|2}' ],
		'EUR' => [ 'symbol' => '€', 'format' => '{symbol}{price|2}' ],
		'FJD' => [ 'symbol' => 'F$', 'format' => '{symbol}{price|2}' ],
		'GBP' => [ 'symbol' => '£', 'format' => '{symbol}{price|2}' ],
		'GEL' => [ 'symbol' => '₾', 'format' => '{price|2} {symbol}' ],
		'GHS' => [ 'symbol' => 'GH¢', 'format' => '{symbol} {price|2}' ],
		'GTQ' => [ 'symbol' => 'Q', 'format' => '{symbol}{price|2}' ],
		'HKD' => [ 'symbol' => 'HK$', 'format' => '{symbol}{price|2}' ],
		'HRK' => [ 'symbol' => 'kn', 'format' => '{price|2} {symbol}' ],
		'HUF' => [ 'symbol' => 'Ft', 'format' => '{price|2} {symbol}' ],
		'IDR' => [ 'symbol' => 'Rp', 'format' => '{price|2} {symbol}' ],
		'ILS' => [ 'symbol' => '₪', 'format' => '{price|2} {symbol}' ],
		'INR' => [ 'symbol' => '₹', 'format' => '{price|2} {symbol}' ],
		'IRR' => [ 'symbol' => '﷼', 'format' => '{price} {symbol}' ],
		'ISK' => [ 'symbol' => 'kr', 'format' => '{price|0} {symbol}' ],
		'JOD' => [ 'symbol' => 'JD', 'format' => '{symbol}{price|2}' ],
		'JPY' => [ 'symbol' => '¥', 'format' => '{symbol}{price|3}' ],
		'KES' => [ 'symbol' => 'KSh', 'format' => '{symbol} {price|2}' ],
		'KRW' => [ 'symbol' => '₩', 'format' => '{price|2} {symbol}' ],
		'KWD' => [ 'symbol' => 'KD', 'format' => '{price|2} {symbol}' ],
		'KZT' => [ 'symbol' => 'тг.', 'format' => '{price|2} {symbol}' ],
		'LAK' => [ 'symbol' => '₭', 'format' => '{price|0} {symbol}' ],
		'LBP' => [ 'symbol' => 'ل.ل.', 'format' => '{symbol} {price}' ],
		'LKR' => [ 'symbol' => 'Rs.', 'format' => '{symbol} {price|2}' ],
		'MUR' => [ 'symbol' => 'Rs', 'format' => '{symbol}{price|2}' ],
		'MXN' => [ 'symbol' => '$', 'format' => '{symbol}{price|2}' ],
		'MYR' => [ 'symbol' => 'RM', 'format' => '{price|2} {symbol}' ],
		'MZN' => [ 'symbol' => 'MT', 'format' => '{price|2} {symbol}' ],
		'NAD' => [ 'symbol' => 'N$', 'format' => '{symbol}{price|2}' ],
		'NGN' => [ 'symbol' => '₦', 'format' => '{symbol}{price|2}' ],
		'NOK' => [ 'symbol' => 'Kr', 'format' => '{symbol} {price|2}' ],
		'NZD' => [ 'symbol' => '$', 'format' => '{symbol}{price|2}' ],
		'OMR' => [ 'symbol' => 'OMR', 'format' => '{price|3} {symbol}' ],
		'PEN' => [ 'symbol' => 'S/.', 'format' => '{symbol}{price|2}' ],
		'PHP' => [ 'symbol' => '₱', 'format' => '{price|2} {symbol}' ],
		'PKR' => [ 'symbol' => 'Rs.', 'format' => '{symbol} {price|0}' ],
		'PLN' => [ 'symbol' => 'zł', 'format' => '{price|2} {symbol}' ],
		'PYG' => [ 'symbol' => '₲', 'format' => '{symbol}{price|2}' ],
		'QAR' => [ 'symbol' => 'QAR', 'format' => '{price|2} {symbol}' ],
		'CNY' => [ 'symbol' => '¥', 'format' => '{price|2} {symbol}' ],
		'RON' => [ 'symbol' => 'lei', 'format' => '{price|2} {symbol}' ],
		'RSD' => [ 'symbol' => 'din.', 'format' => '{symbol}{price|0}' ],
		'RUB' => [ 'symbol' => 'руб.', 'format' => '{price|2} {symbol}' ],
		'SAR' => [ 'symbol' => 'SAR', 'format' => '{price|2} {symbol}' ],
		'SCR' => [ 'symbol' => '₨', 'format' => '{symbol} {price|2}' ],
		'SEK' => [ 'symbol' => 'kr', 'format' => '{price|2} {symbol}' ],
		'SGD' => [ 'symbol' => '$', 'format' => '{symbol}{price|2}' ],
		'THB' => [ 'symbol' => '฿', 'format' => '{price|2} {symbol}' ],
		'TRY' => [ 'symbol' => 'TL', 'format' => '{price|2} {symbol}' ],
		'TWD' => [ 'symbol' => 'NT$', 'format' => '{price|2} {symbol}' ],
		'UAH' => [ 'symbol' => '₴', 'format' => '{price|2} {symbol}' ],
		'UGX' => [ 'symbol' => 'UGX', 'format' => '{symbol} {price|0}' ],
		'USD' => [ 'symbol' => '$', 'format' => '{symbol}{price|2}' ],
		'VND' => [ 'symbol' => 'VNĐ', 'format' => '{price|0} {symbol}' ],
		'XAF' => [ 'symbol' => 'FCFA', 'format' => '{price|0} {symbol}' ],
		'XOF' => [ 'symbol' => 'CFA', 'format' => '{symbol} {price|2}' ],
		'XPF' => [ 'symbol' => 'FCFP', 'format' => '{price|0} {symbol}' ],
		'ZAR' => [ 'symbol' => 'R', 'format' => '{symbol} {price|2}' ],
		'ZMW' => [ 'symbol' => 'K', 'format' => '{symbol}{price|2}' ],
	];

	/** @var array */
	private static $formats = [
		'{sign}{symbol}{price|2}',
		'{symbol}{sign}{price|2}',
		'{sign}{symbol}{price|1}',
		'{symbol}{sign}{price|1}',
		'{sign}{symbol}{price|0}',
		'{symbol}{sign}{price|0}',
		'{sign}{symbol} {price|2}',
		'{symbol} {sign}{price|2}',
		'{sign}{symbol} {price|1}',
		'{symbol} {sign}{price|1}',
		'{sign}{symbol} {price|0}',
		'{symbol} {sign}{price|0}',
		'{sign}{symbol}{price|3}',
		'{symbol}{sign}{price|3}',
		'{sign}{symbol} {price|3}',
		'{symbol} {sign}{price|3}',
		'{sign}{price|2}{symbol}',
		'{sign}{price|1}{symbol}',
		'{sign}{price|0}{symbol}',
		'{sign}{price|3} {symbol}',
		'{sign}{price|2} {symbol}',
		'{sign}{price|1} {symbol}',
		'{sign}{price|0} {symbol}',
	];

	/**
	 * Format price.
	 *
	 * @param float $price
	 *
	 * @return string
	 */
	public static function format( $price ) {
		$price = (float)$price;
		$info = self::getCurrencyInfo();
		$format = $info['format'];
		$rate = $info['rate'];
		$symbol = self::$currencies[$info['currency']]['symbol'];

		if ( empty( $rate ) ) {
			$rate = self::getRate( $info['currency'] );
		}

		$price *= $rate;

		if ( preg_match( '/{price\|(\d)}/', $format, $match ) ) {
			return strtr( $format, [
				'{sign}' => $price < 0 ? '-' : '',
				'{symbol}' => $symbol,
				"{price|{$match[1]}}" => number_format_i18n( abs( $price ), $match[1] ),
			] );
		}

		return number_format_i18n( $price, 2 );
	}

	public static function defaultCurrency($content) {
		$currency = get_option( 'bookly_pmt_currency' );
		$format = get_option( 'bookly_pmt_price_format' );
		$symbol = self::$currencies[$currency]['symbol'];

		if ( preg_match( '/{price\|(\d)}/', $format, $match ) ) {
			return strtr( $format, [
				'{sign}' => '',
				'{symbol}' => '<span class="currency">'.$symbol.'</span>',
				"{price|{$match[1]}}" => $content,
			] );
		}
	}

	public static function getDefaultCurrencyInfo() {
		return self::$currencies[get_option( 'bookly_pmt_currency' )];
	}

	public static function getCurrencyInfo() {
		$lang = apply_filters( 'wpml_current_language', null );

		$currencies = get_option( 'bookly_currencies' );

		if ( isset( $currencies[$lang] ) ) {
			return $currencies[$lang];
		} else {
			return [ 'currency' => get_option( 'bookly_pmt_currency' ), 'format' => get_option( 'bookly_pmt_price_format' ), 'rate' => 1 ];
		}
	}

	public static function getRates() {
		$base = get_option( 'bookly_pmt_currency' );
		$rates = get_transient( 'currency_rates_' . $base );
		if ( $rates !== false ) {
			return $rates;
		} elseif ( ! empty( get_option( 'bookly_currencies_api_key' ) ) ) {
			$url = add_query_arg(
				[ 'access_key' => get_option( 'bookly_currencies_api_key' ), 'base' => $base ],
				'http://data.fixer.io/api/latest' );

			$ch = curl_init();

			curl_setopt( $ch, CURLOPT_URL, $url );
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

			if ( ( $data = curl_exec( $ch ) ) === false ) {
				return [];
			}
			curl_close( $ch );

			$data = json_decode( $data, true );

			if ( ! empty( $data['success'] ) && ! empty( $data['rates'] ) ) {
				set_transient( 'currency_rates_' . $base, $data['rates'], DAY_IN_SECONDS );
				return $data['rates'];
			}
		}
		return [];
	}

	public static function getRate( $currency ) {
		return self::getRates()[$currency] ?? null;
	}


	/**
	 * Get supported currencies.
	 *
	 * @return array[]
	 */
	public static function getCurrencies() {
		return self::$currencies;
	}

	/**
	 * Get supported price formats.
	 *
	 * @return array
	 */
	public static function getFormats() {
		return self::$formats;
	}

	/**
	 * @param double $price
	 * @param double $discount
	 * @param double $deduction
	 *
	 * @return float|int
	 */
	public static function correction( $price, $discount, $deduction ) {
		$price = (float)$price;
		$discount = (float)$discount;
		$deduction = (float)$deduction;
		$amount = round( $price * ( 100 - $discount ) / 100 - $deduction, 2 );

		return $amount > 0 ? $amount : 0;
	}
}
