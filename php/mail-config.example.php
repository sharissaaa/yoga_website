<?php
/**
 * Copy this file to mail-config.php (same folder) and fill in your real
 * Mailtrap values. mail-config.php is gitignored — never commit real
 * credentials.
 *
 * Testing (sandbox) inbox — emails show up inside Mailtrap's dashboard,
 * NOT in a real inbox. Get these from Email Testing > your inbox >
 * Integration/SMTP Settings tab in mailtrap.io.
 *   MAILTRAP_API_URL: 'https://sandbox.api.mailtrap.io/api/send/<inbox_id>'
 *
 * Live sending (after verifying a domain in Mailtrap) — actually
 * delivers to real inboxes.
 *   MAILTRAP_API_URL: 'https://send.api.mailtrap.io/api/send'
 */

define('MAILTRAP_API_URL', 'https://sandbox.api.mailtrap.io/api/send/<inbox_id>');
define('MAILTRAP_TOKEN', 'paste-your-mailtrap-api-token-here');

// Must be an address on a domain Mailtrap has verified for you once you
// move to live sending. For the Testing sandbox this can be anything.
define('MAIL_FROM_EMAIL', 'reservations@bhumimantra.com');
define('MAIL_FROM_NAME', 'Bhumi Mantra Reservations');

// Where reservation emails should land.
define('MAIL_TO_EMAIL', 'workbi623@gmail.com');
