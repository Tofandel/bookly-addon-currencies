<?php if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly
use Bookly\Backend\Components\Controls\Buttons;
use Bookly\Backend\Components\Controls\Inputs as ControlInputs;
use Bookly\Backend\Components\Settings\Inputs;
use Bookly\Backend\Components\Settings\Selects;
use Bookly\Lib\Utils\Price;

?>
<div class="tab-pane" id="bookly_settings_currencies">
    <form method="post" action="<?php echo esc_url( add_query_arg( 'tab', 'currencies' ) ) ?>">
        <p class="help-block"><?php _e( 'Leave the rate empty to retrieve it automatically once per day', 'bookly' ) ?></p>
		<?php Selects::renderSingle( 'bookly_currencies_enabled', __( 'Currencies', 'bookly' ), __( 'If currencies add-on is enabled then your clients will be able to see different prices depending on their language', 'bookly' ) ) ?>
		<?php Inputs::renderText( 'bookly_currencies_api_key', __( 'Fixer.io API Key', 'bookly' ), __( 'Go to <a href=https://fixer.io rel="noopener noreferer">fixer.io</a> and register to get an api key to fetch currency rates automatically' ) ) ?>
        <h3><?php _e( 'Languages', 'bookly' ) ?></h3>
		<?php
		$currencies = Price::getCurrencies();
		$opts = array_map( function ( $currency, $key ) {
			return [ 0 => $key, 1 => $key . ' (' . $currency['format'] . ')' ];
		}, $currencies, array_keys( $currencies ) );

		$options = get_option( 'bookly_currencies' );

		$default_lang = apply_filters( 'wpml_default_language', null );

		$languages = apply_filters( 'wpml_active_languages', null );
		foreach ( $languages as $lang ) {
			$readonly = false;
			if ( $lang['language_code'] == $default_lang ) {
				$readonly = true;
			}

			if ( $readonly || empty( $options[$lang['language_code']] ) ) {
				$val = [ 'currency' => get_option( 'bookly_pmt_currency' ), 'format' => get_option( 'bookly_pmt_price_format' ), 'rate' => 1 ];
			} else {
				$val = $options[$lang['language_code']];
			}
			?>
            <div class="row">
                <div class="col-lg-2">
					<?php echo '<img src="' . $lang['country_flag_url'] . '" height="12" alt="' . $lang['language_code'] . '" width="18" /> ' . $lang['translated_name']; ?>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label for="bookly_currencies_<?php echo esc_attr( $lang['language_code'] ) ?>_currency"><?php _e( 'Currency', 'bookly' ) ?></label>
                        <select id="bookly_currencies_<?php echo esc_attr( $lang['language_code'] ) ?>_currency" class="form-control"
                                name="bookly_currencies[<?php echo esc_attr( $lang['language_code'] ) ?>][currency]" <?php readonly( $readonly ) ?>>
							<?php foreach ( $currencies as $code => $currency ) : ?>
                                <option value="<?php echo esc_attr( $code ) ?>"
                                        data-symbol="<?php esc_attr_e( $currency['symbol'] ) ?>" <?php selected( $val['currency'], $code ) ?> ><?php echo $code ?>
                                    (<?php esc_html_e( $currency['symbol'] ) ?>)
                                </option>
							<?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="bookly_currencies_<?php echo esc_attr( $lang['language_code'] ) ?>_format"><?php _e( 'Price format', 'bookly' ) ?></label>
                        <select id="bookly_currencies_<?php echo esc_attr( $lang['language_code'] ) ?>_format" class="form-control"
                                name="bookly_currencies[<?php echo esc_attr( $lang['language_code'] ) ?>][format]" <?php readonly( $readonly ) ?>>
							<?php foreach ( Price::getFormats() as $format ) : ?>
                                <option value="<?php echo esc_attr( $format ) ?>" <?php selected( $val['format'], $format ) ?>><?php esc_html_e( $format ) ?></option>
							<?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <label for="bookly_currencies_<?php echo esc_attr( $lang['language_code'] ) ?>_rate" <?php readonly( $readonly ) ?>><?php _e( 'Exchange Rate', 'bookly' ) ?></label>
                    <input id="bookly_currencies_<?php echo esc_attr( $lang['language_code'] ) ?>_rate" <?php readonly( $readonly ) ?> type="number" step="any"
                           min="0" max="99999999" value="<?php esc_attr( $val['rate'] ) ?>"
                           placeholder="<?php echo esc_attr( Price::getRate( $val['currency'] ) ) ?>">
                </div>
            </div>
			<?php
		}
		?>
        <div class="panel-footer">
			<?php ControlInputs::renderCsrf() ?>
			<?php Buttons::renderSubmit() ?>
			<?php Buttons::renderReset() ?>
        </div>
    </form>
</div>