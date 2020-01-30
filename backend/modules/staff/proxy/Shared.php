<?php

namespace BooklyCurrencies\Backend\Modules\Staff\Proxy;

use Bookly\Lib;

/**
 * Class Shared
 *
 * @package BooklyCurrencies\Backend\Modules\Staff\Proxy
 */
abstract class Shared extends Lib\Base\Proxy {
	/**
	 * @param int                  $staff_id
	 * @param Lib\Entities\Service $service
	 */
	public static function renderStaffService( $staff_id, Lib\Entities\Service $service ) {
		$info = Lib\Utils\Price::getCurrencyInfo();
		echo $info['currency'];
	}

}