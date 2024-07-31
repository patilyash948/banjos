<?php
header('Content-Type: application/json');

// Replace these with your actual merchant ID and salt key
$merchantId = "M22FYAZX3D3WS";
$saltKey = "ed909460-f05b-459a-b22c-4f96c6d5eabf";

// Get the POST data
$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    echo json_encode(['error' => 'Invalid input']);
    exit;
}

$orderId = $data['orderId'];
$transactionAmount = $data['transactionAmount'];

// Generate the checksum
$rawString = $merchantId . '|' . $orderId . '|' . $transactionAmount . '|' . $saltKey;
$checksum = hash('sha256', $rawString);

// Payment parameters
$paymentParams = [
    'merchantId' => $merchantId,
    'orderId' => $orderId,
    'transactionAmount' => $transactionAmount,
    'checksumHash' => $checksum,
    'phonePeUrl' => 'https://banjoscafe.in/submit_payment.php' // Replace with actual endpoint
];

// Return the payment parameters as JSON
echo json_encode($paymentParams);
?>
