<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SNSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $settings = array(
          'oauth_access_token' => "754919673603301376-KCWgF1JvK0Ps5yiHMNGYAOOjAlEpzpb",
          'oauth_access_token_secret' => "iGoRyibUNloUlyFV01vDFYDAIHObvIjGIDQr7uUqUYZjI",
          'consumer_key' => "jjdHBWtrLuARgXJeBRnKzrEIu",
          'consumer_secret' => "dfKiFTYb2F2Pn2zjQaQP4DOaH7v3VbWY27U0Kkn2ooDSZYKu3q"
        );

        $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
        $getfield = '?screen_name=gistaputri&count=20';
        $requestMethod = 'GET';

        $twitter = new TwitterAPIExchange($settings);

        $tweets = json_decode($twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
             ->performRequest(),$assoc = TRUE);

        if($request->has('hashtag'))
          $data = \Bolandish\Instagram::getMediaByHashtag($request->get('hashtag'), 10);
        else
          $data = collect([]);//\Bolandish\Instagram::getMediaByHashtag("chalkboard", 10);
        return view('sosmed_aggregator', compact('data','tweets'));
        
        //$clientId = '8de9d9b46e294b0ea8c43efa05c90f31';
        //$clientSecret = 'f5bac935921a452295594f05ab9025ea';
        //$accessToken = '3556328137.8de9d9b.848ed39457b546d480f28a0b22699a2a';
        //$redirectUrl = 'http://heribertslab.dev';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
