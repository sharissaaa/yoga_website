<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ReservationController extends Controller
{
    /**
     * Receives the Reserve Your Spot form and sends a reservation email
     * via Mailtrap's HTTP Send API, showing which destination the
     * reservation was made for.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'string'],
            'nationality' => ['required', 'string'],
            'destination' => ['required', 'string'],
            'phone' => ['nullable', 'string'],
            'dates' => ['nullable', 'string'],
            'travelers' => ['nullable', 'string'],
            'notes' => ['nullable', 'string'],
        ]);

        $destination = $validated['destination'];

        $bodyLines = [
            'A reservation has been made for: '.$destination,
            '',
            'Name: '.$validated['name'],
            'Email: '.$validated['email'],
            'Phone: '.($validated['phone'] ?? '-'),
            'Nationality: '.$validated['nationality'],
            'Destination / Retreat: '.$destination,
            'Preferred Dates: '.($validated['dates'] ?? '-'),
            'Travelers: '.($validated['travelers'] ?? '-'),
            'Additional Notes: '.($validated['notes'] ?? '-'),
        ];

        $apiUrl = config('services.mailtrap.api_url');
        $token = config('services.mailtrap.token');
        $toEmail = config('services.mailtrap.reservation_to');

        if (! $apiUrl || ! $token || ! $toEmail) {
            return response()->json([
                'ok' => false,
                'error' => 'Mail is not configured yet.',
            ], 500);
        }

        $response = Http::withToken($token)
            ->timeout(15)
            ->post($apiUrl, [
                'from' => [
                    'email' => config('mail.from.address'),
                    'name' => config('mail.from.name'),
                ],
                'to' => [['email' => $toEmail]],
                'subject' => 'Reservation Request - '.$destination,
                'text' => implode("\n", $bodyLines),
                'reply_to' => [
                    'email' => $validated['email'],
                    'name' => $validated['name'],
                ],
            ]);

        if ($response->failed()) {
            Log::warning('Mailtrap reservation email failed', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return response()->json([
                'ok' => false,
                'error' => 'Could not send the reservation email.',
            ], 502);
        }

        return response()->json(['ok' => true]);
    }
}
