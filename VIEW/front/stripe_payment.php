<?php
require 'vendor/autoload.php';

\Stripe\Stripe::setApiKey('sk_test_51QUjka06VBtuLe4ozEfHRbdoK4UgHkhWQ9ujgjKwXEVkelryFbEjhSEuP5b096PfcBM6JhjbwpFqoqlqgH7gbg6b00lNDxJIuZ');

header('Content-Type: application/json');

try {
    $session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'tnd', // Remplacez par votre devise
                'product_data' => [
                    'name' => 'Achat Panier',
                ],
                'unit_amount' => 1000 * 100, // Prix total en centimes (ex : 1000 TND)
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => 'success.html',
        'cancel_url' => 'http://votre_site/cancel.html',
    ]);

    echo json_encode(['id' => $session->id]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
