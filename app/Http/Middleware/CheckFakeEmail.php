<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class CheckFakeEmail
{
    public function handle(Request $request, Closure $next)
    {
        $email = $request->input('email');

        if (!$email) {
            return redirect()->back()->withErrors(['email' => 'Email is required']);
        }

        $client = new Client();
        $apiKey = env('HUNTER_API_KEY');

        try {
            $response = $client->request('GET', 'https://api.hunter.io/v2/email-verifier', [
                'query' => [
                    'email' => $email,
                    'api_key' => $apiKey
                ]
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            if ($data['data']['result'] == 'undeliverable') {
                return redirect()->back()->withErrors(['email' => 'Email is invalid. Please check the email address']);
            }



            if ($data['data']['result'] == 'unknown') {
                return redirect()->back()->withErrors(['email' => 'Unable to verify email address. Please try again later']);
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['email' => 'An error occurred while verifying the email address. Please try again later']);
        }

        return $next($request);
    }
}
