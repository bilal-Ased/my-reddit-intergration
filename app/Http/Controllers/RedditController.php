<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class RedditController extends Controller
{
    public function index()
{
    $response = Http::get('https://www.reddit.com/r/subreddit_name.json');
    $posts = $response->json()['data']['children'];

    return view('reddit-posts', ['posts' => $posts]);
}
}
