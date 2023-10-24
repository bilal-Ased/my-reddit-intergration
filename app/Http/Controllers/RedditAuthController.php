<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use GuzzleHttp\Client;
use App\User;


class RedditAuthController extends Controller
{
    public function redirectToReddit()
    {
        $redditAuthUrl = 'https://www.reddit.com/api/v1/authorize';
        $queryParams = [
            'client_id' => config('services.reddit.client_id'),
            'response_type' => 'code',
            'state' => bin2hex(random_bytes(16)),
            'redirect_uri' => config('services.reddit.redirect'),
            'scope' => 'read identity', // Add necessary scopes here

        ];

        return redirect("$redditAuthUrl?" . http_build_query($queryParams));
    }

    public function handleRedditCallback(Request $request)
    {
        $code = $request->input('code');
        $state = $request->input('state');

        // Exchange the code for an access token
        $client = new Client();
        $response = $client->post('https://www.reddit.com/api/v1/access_token', [
            'form_params' => [
                'grant_type' => 'authorization_code',
                'code' => $code,
                'redirect_uri' => config('services.reddit.redirect'),
            ],
            'auth' => [
                config('services.reddit.client_id'),
                config('services.reddit.client_secret'),
            ],
        ]);

        $accessToken = json_decode($response->getBody()->getContents(), true)['access_token'];

        // Fetch posts from a specific subreddit
        $response = $client->get('https://oauth.reddit.com/r/programming.json', [
            'headers' => [
                'Authorization' => "Bearer $accessToken",
            ],
        ]);

        $posts = json_decode($response->getBody()->getContents(), true);

        return view('reddit-posts', ['posts' => $posts]);
    }



}