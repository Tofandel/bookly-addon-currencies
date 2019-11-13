<?php

namespace BooklyCurrencies\Lib;

/**
 * Class Installer
 *
 * @package BooklyCurrencies\Lib
 */
class Installer extends Base\Installer {
	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->options = [
			'bookly_currencies_enabled' => 1,
			'bookly_currencies' => [],
		];
	}
}