<?php
use GuzzleHttp\Client;

public function VerifyFakeEmail($email)
{
    $client = new Client();
    $apiKey = 'private_03e2a7ea39bbb870db31ca77b9c1cff4';

    try {

        $response = $client->get('https://api.neverbounce.com/v4/single/check', [
            'query' => [
                'key' => $apiKey,
                'email' => $email,
            ]
        ]);

         $data = json_decode($response->getBody()->getContents(), true);

         if ($data['result'] == 'valid') {
            return true;
        } else {
            return false;
        }

    } catch (\Exception $e) {
         return false;
    }
}
