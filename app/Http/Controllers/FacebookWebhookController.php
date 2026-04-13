<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FacebookWebhookController extends Controller
{
    /**
     * Verify the Facebook Webhook
     */
    public function verify(Request $request)
    {
        // $accessToken = config('services.facebook.access_token');
        // $appId = config('services.facebook.app_id');
        // $appSecret = config('services.facebook.app_secret');
        // $verifyToken  = config('services.facebook.webhook_verify_token');
        // dd($appId, $appSecret, $accessToken, $verifyToken);
        $verifyToken = config('services.facebook.webhook_verify_token');

        if ($request->hub_verify_token === $verifyToken) {
            return response($request->hub_challenge, 200);
        }

        return response('Invalid verify token', 403);
    }

    /**
     * Handle incoming Facebook lead data
     */
    public function handle(Request $request)
    {
        $payload = $request->all();

        // Log raw payload (like your PHP file logger)
        Log::info("Raw FB Webhook Payload:", $payload);

        if (!isset($payload['entry']) || !is_array($payload['entry'])) {
            return response()->json(['success' => false, 'message' => 'Invalid data']);
        }

        foreach ($payload['entry'] as $entry) {
            if (!isset($entry['changes'])) continue;

            foreach ($entry['changes'] as $change) {
                $leadData = $change['value'] ?? null;

                if (!$leadData || !isset($leadData['leadgen_id'])) {
                    Log::warning("Missing leadgen_id in webhook payload", $change);
                    continue;
                }

                $leadId = $leadData['leadgen_id'];

                // ✅ Refresh Access Token if invalid (like your PHP example)
                $accessToken = $this->refreshAccessToken();

                // Fetch full lead details
                $fbLead = Http::get("https://graph.facebook.com/v17.0/{$leadId}", [
                    'access_token' => $accessToken,
                ])->json();

                if (!isset($fbLead['field_data'])) {
                    Log::warning("No field_data for lead ID {$leadId}", $fbLead);
                    continue;
                }

                // ✅ Dynamically map all fields from Facebook form
                $fields = [];
                foreach ($fbLead['field_data'] as $field) {
                    $fields[$field['name']] = $field['values'][0] ?? null;
                }

                // Log mapped fields
                Log::info("Lead ID {$leadId} fields:", $fields);

                try {
                    // Save to DB (adapt this to your leads table schema)
                    $newLead = Lead::create([
                        'first_name' => $fields['first_name'] ?? ($fields['full_name'] ?? ''),
                        'last_name'  => $fields['last_name'] ?? '',
                        'email'      => $fields['email'] ?? null,
                        'phone'      => $fields['phone_number'] ?? null,
                        'company'    => $fields['company_name'] ?? null,
                        'job_title'  => $fields['job_title'] ?? null,
                        'city'       => $fields['city'] ?? null,
                        'state'      => $fields['state'] ?? null,
                        'zip'        => $fields['zip_code'] ?? null,
                        'source_id'  => 1,
                        'stage_id'   => 1,
                        'created_by' => 1,
                    ]);

                    Log::info("✅ New lead saved from FB lead ID {$leadId}", ['db_id' => $newLead->id]);

                } catch (\Exception $e) {
                    Log::error("Failed to create lead from FB lead ID {$leadId}: " . $e->getMessage());
                }
            }
        }

        return response()->json(['success' => true]);
    }

    /**
     * Refresh Facebook Access Token if expired
     */
    private function refreshAccessToken()
    {
        $accessToken = config('services.facebook.access_token');
        $appId = config('services.facebook.app_id');
        $appSecret = config('services.facebook.app_secret');
        
        // Check validity
        $check = Http::get("https://graph.facebook.com/v17.0/debug_token", [
            'input_token' => $accessToken,
            'access_token' => "{$appId}|{$appSecret}",
        ])->json();

        if (isset($check['data']['is_valid']) && $check['data']['is_valid']) {
            return $accessToken;
        }

        // Refresh if expired
        $refresh = Http::get("https://graph.facebook.com/v17.0/oauth/access_token", [
            'grant_type' => 'fb_exchange_token',
            'client_id' => $appId,
            'client_secret' => $appSecret,
            'fb_exchange_token' => $accessToken,
        ])->json();
        Log::info("Attempting to refresh Facebook Access Token.", $refresh);
        if (isset($refresh['access_token'])) {
            $newToken = $refresh['access_token'];

            // Optional: Save new token into database or config storage
            Log::info("🔄 Facebook Access Token refreshed.");

            return $newToken;
        }

        Log::error("Failed to refresh Facebook access token.", $refresh);
        return $accessToken; // fallback
    }
}
