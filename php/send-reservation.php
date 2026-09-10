<?php
/**
 * Receives the Reserve Your Spot form (reserve.js posts JSON here) and
 * sends a reservation email via Mailtrap's API to MAIL_TO_EMAIL, showing
 * which destination the reservation was made for.
 */

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['ok' => false, 'error' => 'Method not allowed']);
    exit;
}

$configPath = __DIR__ . '/mail-config.php';
if (!file_exists($configPath)) {
    http_response_code(500);
    echo json_encode(['ok' => false, 'error' => 'Mail is not configured yet.']);
    exit;
}
require $configPath;

$input = json_decode(file_get_contents('php://input'), true);
if (!is_array($input)) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => 'Invalid request body.']);
    exit;
}

function field($input, $key) {
    return isset($input[$key]) ? trim((string) $input[$key]) : '';
}

$name = field($input, 'name');
$email = field($input, 'email');
$phone = field($input, 'phone');
$nationality = field($input, 'nationality');
$destination = field($input, 'destination');
$dates = field($input, 'dates');
$travelers = field($input, 'travelers');
$notes = field($input, 'notes');

if ($name === '' || $email === '' || $nationality === '' || $destination === '') {
    http_response_code(422);
    echo json_encode(['ok' => false, 'error' => 'Missing required fields.']);
    exit;
}

$subject = 'Reservation Request - ' . $destination;

$bodyLines = [
    'A reservation has been made for: ' . $destination,
    '',
    'Name: ' . $name,
    'Email: ' . $email,
    'Phone: ' . ($phone !== '' ? $phone : '-'),
    'Nationality: ' . $nationality,
    'Destination / Retreat: ' . $destination,
    'Preferred Dates: ' . ($dates !== '' ? $dates : '-'),
    'Travelers: ' . ($travelers !== '' ? $travelers : '-'),
    'Additional Notes: ' . ($notes !== '' ? $notes : '-'),
];
$bodyText = implode("\n", $bodyLines);

$payload = [
    'from' => ['email' => MAIL_FROM_EMAIL, 'name' => MAIL_FROM_NAME],
    'to' => [['email' => MAIL_TO_EMAIL]],
    'subject' => $subject,
    'text' => $bodyText,
    'reply_to' => ['email' => $email, 'name' => $name],
];

$ch = curl_init(MAILTRAP_API_URL);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_HTTPHEADER => [
        'Authorization: Bearer ' . MAILTRAP_TOKEN,
        'Content-Type: application/json',
    ],
    CURLOPT_POSTFIELDS => json_encode($payload),
    CURLOPT_TIMEOUT => 15,
]);
$response = curl_exec($ch);
$curlError = curl_error($ch);
$statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($curlError || $statusCode < 200 || $statusCode >= 300) {
    http_response_code(502);
    echo json_encode([
        'ok' => false,
        'error' => 'Could not send the reservation email.',
        'detail' => $curlError ?: $response,
    ]);
    exit;
}

echo json_encode(['ok' => true]);
