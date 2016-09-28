<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/vuejs1', function () {
    return view('vuejs1');
});

Route::get('/dependency', function () {
    return view('dependency');
});

Route::get('/api/categories', function () {
    $data = App\Category::get(['id','name']);
    return Response::json(['categories'=>$data]);
});

Route::get('/api/subcategories', function () {
    $data = App\SubCategory::get(['id','name', 'category_id']);
    return Response::json(['subcategories'=>$data]);
});

Route::get('/api/categories/{id}/subcategories', function ($id) {
    $data = App\SubCategory::where('category_id', $id)->get(['id','name', 'category_id']);
    //$data = App\SubCategory::get(['id','name', 'category_id']);
    return Response::json(['subcategories'=>$data]);
});

Route::post('/api/testpost', function (Illuminate\Http\Request $request) {
    $data = json_decode($request->get('rows'));
});
