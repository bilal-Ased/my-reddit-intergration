<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;


class RedditPostController extends Controller
{
    public function index()
    {
        return view ('reddit.post-create');
    }


    public function create(Request $request)
    {
        // Get the user's Reddit access token
        $accessToken = 'K7pq1Sav5BbD3XCxY6a37HoIaGHk2g'; // Replace with the actual token

        // Define the post data
        $postData = [
            'sr' => 'programming', // Replace with the target subreddit
            'title' => $request->input('title'),
            'text' => $request->input('content'),
            'kind' => 'self', // 'self' for text post, 'link' for link post
        ];

        // Make a POST request to Reddit's API
        $client = new Client();
        $response = $client->post('https://oauth.reddit.com/api/submit', [
            'form_params' => $postData,
            'headers' => [
                'Authorization' => "Bearer $accessToken",
                'User-Agent' => 'MyRedditApp/1.0', // Replace with your app's user agent
            ],
        ]);

        // Check the response and handle success or errors
        $responseData = json_decode($response->getBody()->getContents(), true);
        if (isset($responseData['json']['errors']) && count($responseData['json']['errors']) > 0) {
            return redirect()->back()->with('error', 'Failed to create the post. Please check your data and try again.');
        }

        return redirect()->back()->with('success', 'Post created successfully.');
    }

}
