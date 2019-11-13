jQuery(function ($) {
    BooklyCurrencies.languages.forEach(function (code) {
        var $currency           = $('#bookly_currencies_'+code+'_currency'),
            $format            = $('#bookly_currencies_'+code+'_format'),
            $rate = $('#bookly_currencies_'+code+'_rate');

        $currency.on('change', function () {
            var rate = BooklyCurrencies.rates[$currency.val()];
            $rate.prop('placeholder', rate || 'N/A');

            $format.find('option').each(function () {
                var decimals = this.value.match(/{price\|(\d)}/)[1],
                    price    = BooklyL10n.sample_price;

                if (decimals < 3) {
                    price = price.slice(0, -(decimals == 0 ? 4 : 3 - decimals));
                }
                var html = this.value
                    .replace('{sign}', '')
                    .replace('{symbol}', $currency.find('option:selected').data('symbol'))
                    .replace(/{price\|\d}/, price)
                ;
                html += ' (' + this.value
                    .replace('{sign}', '-')
                    .replace('{symbol}', $currency.find('option:selected').data('symbol'))
                    .replace(/{price\|\d}/, price) + ')'
                ;
                this.innerHTML = html;
            });
        }).trigger('change');
    });

});