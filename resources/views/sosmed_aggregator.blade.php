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
    @foreach($data as $row)
      <div class="col-xs-6 col-md-3">
        <a href="#" class="thumbnail">
          <img src="{{ $row->thumbnail_src }}" alt="{{ $row->thumbnail_src }}">
        </a>
      </div>
    @endforeach
  </div>

  <div class="row">
    <div class="container">
      @foreach($tweets as $items)
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title">{!! "Tweeted by: ". $items['user']['name']."<br />"!!}</h3>
          </div>
          <div class="panel-body">
            {!! "Time and Date of Tweet: ".$items['created_at']."<br />" !!}
            {!! "Tweet: ". $items['text']."<br />"!!}
            {!! "Screen name: ". $items['user']['screen_name']."<br />"!!}
          </div>
        </div>
      @endforeach
    </div>
  </div>

  @stop
