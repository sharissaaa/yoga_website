<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

/**
 * Receives Strapi's webhook notifications (entry.publish, entry.update,
 * entry.unpublish, entry.delete, etc.) and clears that page's cached content
 * so the very next request gets fresh data instead of waiting out the cache
 * TTL.
 */
class StrapiWebhookController extends Controller
{
    public function __invoke(Request $request)
    {
        $expected = config('services.strapi.webhook_secret');

        if (! $expected || $request->header('X-Webhook-Secret') !== $expected) {
            Log::warning('Strapi webhook received with missing or invalid secret.');

            abort(401);
        }

        $model = $request->input('model');

        if (! $model && $uid = $request->input('uid')) {
            // Fall back to deriving the model name from a UID like
            // "api::home-page.home-page".
            $model = str($uid)->afterLast('.')->toString();
        }

        if (! $model) {
            Log::warning('Strapi webhook received without a recognizable model name.', [
                'payload' => $request->all(),
            ]);

            return response()->json(['cleared' => false], 200);
        }

        Cache::forget("strapi.{$model}");

        Log::info("Strapi webhook cleared cache for [{$model}].", [
            'event' => $request->input('event'),
        ]);

        return response()->json(['cleared' => true, 'model' => $model]);
    }
}
