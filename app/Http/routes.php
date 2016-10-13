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

Route::get('vuejs/cart', function () {
    return view('vuejs.cart');
});

Route::get('vuejs/dependency', function () {
    return view('vuejs.dependency');
});

Route::get('vuejs/pembukuan', function () {
    return view('vuejs.pembukuan');
});

Route::get('vuejs/datepicker', function () {
    return view('vuejs.datepicker');
});

Route::get('hashtag_feeder', 'SNSController@index');
Route::get('vuejs/paginator', 'EmployeeController@index');

Route::get('api/employees', 'EmployeeController@apiGetEmployee');

Route::get('api/categories', function () {
    $data = App\Category::get(['id','name']);
    return Response::json(['categories'=>$data]);
});

Route::get('api/subcategories', function () {
    $data = App\SubCategory::get(['id','name', 'category_id']);
    return Response::json(['subcategories'=>$data]);
});

Route::get('api/categories/{id}/subcategories', function ($id) {
    $data = App\SubCategory::where('category_id', $id)->get(['id','name', 'category_id']);
    //$data = App\SubCategory::get(['id','name', 'category_id']);
    return Response::json(['subcategories'=>$data]);
});

Route::get('api/activities', function () {
    $data = App\Activity::get(['id','project_id', 'name']);
    return Response::json(['activities'=>$data]);
});

Route::get('api/account_codes', function () {
    $data = App\AccountCode::get(['id','kode as text']);    
    return Response::json(['account_codes'=>$data]);
});

Route::get('api/projects', function () {
    $data = App\Project::get(['id', 'name']);
    return Response::json(['projects'=>$data]);
});

Route::post('api/testpost', function (Illuminate\Http\Request $request) {
    $data = json_decode($request->get('rows'));
});
