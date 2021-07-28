{{--<!doctype html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">--}}
{{--    <meta http-equiv="X-UA-Compatible" content="ie=edge">--}}
{{--    <title>Document</title>--}}
{{--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">--}}
{{--    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>--}}
{{--    <link rel="preconnect" href="https://fonts.googleapis.com">--}}
{{--    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>--}}
{{--    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">--}}
{{--    <style>--}}
{{--        body {--}}
{{--            font-family: 'Roboto', sans-serif;--}}
{{--        }--}}
{{--        @media only screen and (max-width: 980px) { #trad { display: none !important; } }--}}
{{--    </style>--}}
{{--</head>--}}
{{--<body>--}}

{{--<div class="container">--}}
{{--    <div class="table table-responsive">--}}
{{--        <table class="table table-borderless">--}}
{{--            <thead>--}}
{{--            <tr>--}}
{{--                <th></th>--}}
{{--                <th>Name</th>--}}
{{--                <th>Symbol</th>--}}
{{--                <th>Price</th>--}}
{{--                <th>Market Cap</th>--}}
{{--                <th>1H Change</th>--}}
{{--                <th>1D Change</th>--}}
{{--                <th>30D Change</th>--}}
{{--            </tr>--}}
{{--            </thead>--}}
{{--            <tbody id="cap">--}}
{{--            @foreach($data as $key => $market)--}}
{{--                <tr>--}}
{{--                    <th>{{ $key + 1 }}</th>--}}
{{--                    <td><img src="{{ $market['logo_url'] }}" alt="" height="20"> {{ $market['name'] }}</td>--}}
{{--                    <td>{{ $market['symbol'] }}</td>--}}
{{--                    <td>NGN {{ number_format($market['price'], 2) }}</></td>--}}
{{--                    <td>NGN {{ $market['market_cap'] }}</td>--}}
{{--                    <td class="{{ isset($market["1h"]) ? ($market["1h"]["price_change_pct"] < 0 ? 'text-danger' : 'text-success') : '' }}">{{ isset($market["1h"]) ? ($market["1h"]["price_change_pct"] * 100).'%' : '' }}</td>--}}
{{--                    <td class="{{ isset($market["1d"]) ? ($market["1d"]["price_change_pct"] < 0 ? 'text-danger' : 'text-success') : '' }}">{{ isset($market["1d"]) ? ($market['1d']['price_change_pct'] * 100).'%' : '' }}</td>--}}
{{--                    <td class="{{ isset($market["30d"]) ? ($market["30d"]["price_change_pct"] < 0 ? 'text-danger' : 'text-success') : '' }}">{{ isset($market["30d"]) ? ($market['30d']['price_change_pct'] * 100).'%' : '' }}</td>--}}
{{--                </tr>--}}
{{--            @endforeach--}}
{{--            </tbody>--}}
{{--        </table>--}}
{{--    </div>--}}
{{--</div>--}}

{{--<!-- TradingView Widget BEGIN -->--}}
{{--<div id="trad">--}}
{{--    <div class="tradingview-widget-container">--}}
{{--        <div id="tradingview_723ad"></div>--}}
{{--        <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/symbols/NASDAQ-AAPL/" rel="noopener" target="_blank"><span class="blue-text">AAPL Chart</span></a> by TradingView</div>--}}
{{--        <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>--}}
{{--        <script type="text/javascript">--}}
{{--            new TradingView.widget(--}}
{{--                {--}}
{{--                    "width": 980,--}}
{{--                    "height": 610,--}}
{{--                    "symbol": "NASDAQ:AAPL",--}}
{{--                    "interval": "D",--}}
{{--                    "timezone": "Etc/UTC",--}}
{{--                    "theme": "light",--}}
{{--                    "style": "1",--}}
{{--                    "locale": "en",--}}
{{--                    "toolbar_bg": "#f1f3f6",--}}
{{--                    "enable_publishing": true,--}}
{{--                    "withdateranges": true,--}}
{{--                    "hide_side_toolbar": false,--}}
{{--                    "allow_symbol_change": true,--}}
{{--                    "details": true,--}}
{{--                    "hotlist": true,--}}
{{--                    "calendar": true,--}}
{{--                    "container_id": "tradingview_723ad"--}}
{{--                }--}}
{{--            );--}}
{{--        </script>--}}
{{--    </div>--}}
{{--</div>--}}
{{--<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>--}}
{{--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>--}}
{{--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>--}}
{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>--}}

{{--<script>--}}
{{--    $(document).ready(function () {--}}
{{--        setInterval(function () {--}}
{{--            $.ajax({--}}
{{--                type: "GET",--}}
{{--                url: `https://api.nomics.com/v1/currencies/ticker?key=aba7d7994847e207e4e405132c98374a3c061c5e&interval=1h,1d,30d&convert=NGN&per-page=100&page=1`,--}}
{{--                headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},--}}
{{--                contentType: false,--}}
{{--                processData: false,--}}
{{--                success: function (data) {--}}
{{--                    if (data.length > 0) {--}}
{{--                        $('#cap').html(appendHTML(data))--}}
{{--                    }--}}
{{--                }--}}
{{--            });--}}
{{--        }, 10000)--}}
{{--    })--}}

{{--    function appendHTML(data) {--}}
{{--        let market = '';--}}
{{--        data.forEach((cur, i) => {--}}
{{--            market += appendRow(cur, i+1)--}}
{{--        })--}}
{{--        return market;--}}
{{--    }--}}

{{--    function appendRow(market, i) {--}}
{{--        return `--}}
{{--            <tr>--}}
{{--                <th>${i}</th>--}}
{{--                <td><img src="${market['logo_url']}" alt="" height="20"> ${market['name']}</td>--}}
{{--                <td>${market['symbol']}</td>--}}
{{--                <td>NGN ${parseFloat(market['price']).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')}</td>--}}
{{--                <td>NGN ${cap(market['market_cap'])}</td>--}}
{{--                <td class="${ typeof market["1h"] !== "undefined" ? (parseFloat(market["1h"]["price_change_pct"]) < 0 ? 'text-danger' : 'text-success') : '' }">${typeof market["1h"] !== "undefined" ? roundNumber(market["1h"]["price_change_pct"] * 100, 2)+'%' : '' }</td>--}}
{{--                <td class="${ typeof market["1d"] !== "undefined" ? (parseFloat(market["1d"]["price_change_pct"]) < 0 ? 'text-danger' : 'text-success') : '' }">${typeof market["1d"] !== "undefined" ? roundNumber(market["1d"]["price_change_pct"] * 100, 2)+'%' : '' }</td>--}}
{{--                <td class="${ typeof market["30d"] !== "undefined" ? (parseFloat(market["30d"]["price_change_pct"]) < 0 ? 'text-danger' : 'text-success') : '' }">${typeof market["30d"] !== "undefined" ? roundNumber(market["30d"]["price_change_pct"] * 100, 2)+'%' : '' }</td>--}}
{{--            </tr>--}}
{{--            `--}}
{{--    }--}}

{{--    function cap(str) {--}}
{{--        let string = str;--}}
{{--        if (str.length > 12) {--}}
{{--            string = roundNumber((str/1000000000000), 2)+"T";--}}
{{--        }--}}
{{--        else if (str.length > 9) {--}}
{{--            string = roundNumber((str/1000000000), 2)+"B";--}}
{{--        }--}}
{{--        else if (str.length  > 6) {--}}
{{--            string = roundNumber((str/1000000), 2)+"M";--}}
{{--        }--}}
{{--        else if (str.length  > 3) {--}}
{{--            string = roundNumber((str/1000), 2)+"K";--}}
{{--        }--}}

{{--        return string;--}}
{{--    }--}}

{{--    function roundNumber(num, scale) {--}}
{{--        if(!("" + num).includes("e")) {--}}
{{--            return +(Math.round(num + "e+" + scale)  + "e-" + scale);--}}
{{--        } else {--}}
{{--            var arr = ("" + num).split("e");--}}
{{--            var sig = ""--}}
{{--            if(+arr[1] + scale > 0) {--}}
{{--                sig = "+";--}}
{{--            }--}}
{{--            return +(Math.round(+arr[0] + "e" + sig + (+arr[1] + scale)) + "e-" + scale);--}}
{{--        }--}}
{{--    }--}}
{{--</script>--}}
{{--<!-- TradingView Widget END -->--}}

{{--</body>--}}
{{--</html>--}}


<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<div id="container"></div>
<script async src="https://pay.google.com/gp/p/js/pay.js" onload="onGooglePayLoaded()"></script>
<script>
    /**
    * Define the version of the Google Pay API referenced when creating your
    * configuration
    *
    * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#PaymentDataRequest|apiVersion in PaymentDataRequest}
    */
const baseRequest = {
     apiVersion: 2,
     apiVersionMinor: 0
};

/**
    * Card networks supported by your site and your gateway
    *
    * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#CardParameters|CardParameters}
    * @todo confirm card networks supported by your site and gateway
    */
const allowedCardNetworks = ["AMEX", "DISCOVER", "INTERAC", "JCB", "MASTERCARD", "VISA"];

/**
    * Card authentication methods supported by your site and your gateway
    *
    * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#CardParameters|CardParameters}
    * @todo confirm your processor supports Android device tokens for your
    * supported card networks
    */
const allowedCardAuthMethods = ["PAN_ONLY", "CRYPTOGRAM_3DS"];

/**
    * Identify your gateway and your site's gateway merchant identifier
    *
    * The Google Pay API response will return an encrypted payment method capable
    * of being charged by a supported gateway after payer authorization
    *
    * @todo check with your gateway on the parameters to pass
    * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#gateway|PaymentMethodTokenizationSpecification}
    */
const tokenizationSpecification = {
     type: 'PAYMENT_GATEWAY',
     parameters: {
         'gateway': 'example',
         'gatewayMerchantId': 'exampleGatewayMerchantId'
     }
};

/**
    * Describe your site's support for the CARD payment method and its required
    * fields
    *
    * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#CardParameters|CardParameters}
    */
const baseCardPaymentMethod = {
     type: 'CARD',
     parameters: {
         allowedAuthMethods: allowedCardAuthMethods,
         allowedCardNetworks: allowedCardNetworks,
         billingAddressRequired: true,
         billingAddressParameters: {
            format: 'FULL',
             phoneNumberRequired: true
         }
     }
};

/**
    * Describe your site's support for the CARD payment method including optional
    * fields
    *
    * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#CardParameters|CardParameters}
    */
const cardPaymentMethod = Object.assign(
     {},
     baseCardPaymentMethod,
     {
         tokenizationSpecification: tokenizationSpecification
     }
);

/**
    * An initialized google.payments.api.PaymentsClient object or null if not yet set
    *
    * @see {@link getGooglePaymentsClient}
    */
let paymentsClient = null;

/**
    * Configure your site's support for payment methods supported by the Google Pay
    * API.
    *
    * Each member of allowedPaymentMethods should contain only the required fields,
    * allowing reuse of this base request when determining a viewer's ability
    * to pay and later requesting a supported payment method
    *
    * @returns {object} Google Pay API version, payment methods supported by the site
    */
function getGoogleIsReadyToPayRequest() {
     return Object.assign(
             {},
             baseRequest,
             {
                 allowedPaymentMethods: [baseCardPaymentMethod]
             }
     );
}

/**
    * Configure support for the Google Pay API
    *
    * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#PaymentDataRequest|PaymentDataRequest}
    * @returns {object} PaymentDataRequest fields
    */
function getGooglePaymentDataRequest() {
     const paymentDataRequest = Object.assign({}, baseRequest);
     paymentDataRequest.allowedPaymentMethods = [cardPaymentMethod];
     paymentDataRequest.transactionInfo = getGoogleTransactionInfo();
     paymentDataRequest.merchantInfo = {
         // @todo a merchant ID is available for a production environment after approval by Google
         // See {@link https://developers.google.com/pay/api/web/guides/test-and-deploy/integration-checklist|Integration checklist}
         merchantId: 'BCR2DN6TZ7AM3CYV',
         merchantName: 'CRUD'
     };
     // paymentDataRequest.callbackIntents = ["PAYMENT_AUTHORIZATION"];
     return paymentDataRequest;
}

/**
    * Return an active PaymentsClient or initialize
    *
    * @see {@link https://developers.google.com/pay/api/web/reference/client#PaymentsClient|PaymentsClient constructor}
    * @returns {google.payments.api.PaymentsClient} Google Pay API client
    */
function getGooglePaymentsClient() {
     if ( paymentsClient === null ) {
         paymentsClient = new google.payments.api.PaymentsClient({environment: 'TEST'});
     }
     return paymentsClient;
}

/**
    * Initialize Google PaymentsClient after Google-hosted JavaScript has loaded
    *
    * Display a Google Pay payment button after confirmation of the viewer's
    * ability to pay.
    */
function onGooglePayLoaded() {
     const paymentsClient = getGooglePaymentsClient();
     paymentsClient.isReadyToPay(getGoogleIsReadyToPayRequest())
             .then(function(response) {
                 if (response.result) {
                     addGooglePayButton();
                     // @todo prefetch payment data to improve performance after confirming site functionality
                     // prefetchGooglePaymentData();
                 }
             })
             .catch(function(err) {
                 // show error in developer console for debugging
                 console.error(err);
             });
}

/**
    * Add a Google Pay purchase button alongside an existing checkout button
    *
    * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#ButtonOptions|Button options}
    * @see {@link https://developers.google.com/pay/api/web/guides/brand-guidelines|Google Pay brand guidelines}
    */
function addGooglePayButton() {
     const paymentsClient = getGooglePaymentsClient();
     const button =
             paymentsClient.createButton({onClick: onGooglePaymentButtonClicked});
     document.getElementById('container').appendChild(button);
}

/**
    * Provide Google Pay API with a payment amount, currency, and amount status
    *
    * @see {@link https://developers.google.com/pay/api/web/reference/request-objects#TransactionInfo|TransactionInfo}
    * @returns {object} transaction info, suitable for use as transactionInfo property of PaymentDataRequest
    */
function getGoogleTransactionInfo() {
     return {
         countryCode: 'US',
         currencyCode: 'USD',
         totalPriceStatus: 'FINAL',
         // set to cart total
         totalPrice: '100.00'
     };
}

function prefetchGooglePaymentData() {
     const paymentDataRequest = getGooglePaymentDataRequest();
     paymentDataRequest.transactionInfo = {
         totalPriceStatus: 'NOT_CURRENTLY_KNOWN',
         currencyCode: 'USD'
     };
     const paymentsClient = getGooglePaymentsClient();
     paymentsClient.prefetchPaymentData(paymentDataRequest);
}

function onGooglePaymentButtonClicked() {
     const paymentDataRequest = getGooglePaymentDataRequest();
     paymentDataRequest.transactionInfo = getGoogleTransactionInfo();

     const paymentsClient = getGooglePaymentsClient();
     paymentsClient.loadPaymentData(paymentDataRequest)
         .then(function(paymentData) {
             processPayment(paymentData);
         })
         .catch(function(err) {
             console.error(err);
         });
}

function processPayment(paymentData) {
     console.log(paymentData);
     paymentToken = paymentData.paymentMethodData.tokenizationData.token;
}
</script>
</body>
</html>
