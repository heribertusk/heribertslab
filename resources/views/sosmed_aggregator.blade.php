@extends('layouts.default')
@section('content')
  <div class="row">
  {!! Form::open(['method'=>'GET','url'=> URL::to('instagram'),'class'=>'navbar-form navbar-left','role'=>'search'])  !!}
  <div class="input-group custom-search-form">
    <input type="text" class="form-control" name="hashtag" placeholder="Hashtag tanpa #...">
    {!! Form::submit('Cari Konten') !!}
  </div>
  {!! Form::close() !!}
  </p>
  </div>

  <div class="row">
    <div class="container">
      @foreach($data as $row)
        <img src="{{ $row->thumbnail_src }}" alt="{{ $row->thumbnail_src }}" height="128" width="128">
      @endforeach
    </div>
  </div>

  <div class="row">
    <div class="container">
      @foreach($tweets as $items)
        {!! "Time and Date of Tweet: ".$items['created_at']."<br />" !!}
        {!! "Tweet: ". $items['text']."<br />"!!}
        {!! "Tweeted by: ". $items['user']['name']."<br />"!!}
        {!! "Screen name: ". $items['user']['screen_name']."<br />"!!}
        {!! "Followers: ". $items['user']['followers_count']."<br />"!!}
        {!! "Friends: ". $items['user']['friends_count']."<br />"!!}
        {!! "Listed: ". $items['user']['listed_count']."<br />"!!}
      @endforeach
    </div>
  </div>

  @stop
