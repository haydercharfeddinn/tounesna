

<?php

require __DIR__ . "/vendor/autoload.php";

$stripe_secret_key = "sk_test_51QUbRfJtir63S780PJgPYYdOb1HByaXvKAmTkEbLvDDgfbLEgt10PbjHeIvrEWKO3oMIOKxZDTOqajr1D9FlM4K000jAhS07yK";

\Stripe\Stripe::setApiKey($stripe_secret_key);

$checkout_session = \Stripe\Checkout\Session::create([
    "mode" => "payment",
    "success_url" => "http://localhost/mico-html1/VIEW/front/success.php",
    "line_items" => [
        [
            "quantity" => 1,
            "price_data" => [
                "currency" => "usd",
                "unit_amount" => 2000,
                "product_data" => [
                    "name" => "tiquet"
                ]
            ]
        ]
    ]
]);

http_response_code(303);
header("location: " . $checkout_session->url);
?>

