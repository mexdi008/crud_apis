<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('csadmin')->group(function () {

#region Administrative Routes
// create data for administrativeStaff
Route::get('/administrative/create', function () {
    return view('administrative_staff/postData');
});
Route::post('/adminstrative/create',[ApiController::class,'addPost']);

// get all datas from adiminstrativeStaff
Route::get('/administrative/list/all',[ApiController::class,'getAllPost']);

// get data from administrativeStaff by id
Route::get('/administrative/list', function(){
    return view('administrative_staff/getDataByUniqId');
});
Route::post('/administrative/list/{id}',[ApiController::class, 'getPostByUniqId']);

//get data from administrativeStaff findOne
Route::get('/administrative/list/findone', function(){
    return view('administrative_staff/getDataFindOne');
});
Route::post('/administrative/list/findone/{id}',[ApiController::class, 'getPostFindOne']);

// update data from administrativeStaff by id
Route::get('/administrative/update', function(){
    return view('administrative_staff/updateData');
});
Route::post('/administrative/update/{id}',[ApiController::class, 'updatePost']);

// delete data from administrativeStaff by id
Route::get('/administrative/delete/{id}',[ApiController::class,'deletePost']);
#endregion

#region Brands Routes
// create data for Brands
Route::get('/brands/create', function () {
    return view('brands/brandsPostData');
});
Route::post('/brands/create',[ApiController::class,'brandsAddPost']);

// get all datas from Brands
Route::get('/brands/list/all',[ApiController::class,'brandsGetAllPost']);

// get data from Brands by id
Route::get('/brands/list', function(){
    return view('brands/brandsGetDataByUniqId');
});
Route::post('/brands/list/{id}',[ApiController::class, 'brandsGetPostByUniqId']);

//get data from Brands findOne
Route::get('/brands/list/findone', function(){
    return view('brands/brandsGetDataFindOne');
});
Route::post('/brands/list/findone/{id}',[ApiController::class, 'brandsGetPostFindOne']);

// update data from brands by id
Route::get('/brands/update', function(){
    return view('brands/brandsUpdateData');
});
Route::post('/brands/update/{id}',[ApiController::class, 'brandsUpdatePost']);

// delete data from brands by id
Route::get('/brands/delete/{id}',[ApiController::class,'brandsDeletePost']);
#endregion

#region hero_slider Routes
// create data for Brands
Route::get('/hero_slider/create', function () {
    return view('hero_slider/heroSliderPostData');
});
Route::post('/hero_slider/create',[ApiController::class,'heroSliderAddPost']);

// get all datas from hero_slider
Route::get('/hero_slider/list/all',[ApiController::class,'heroSliderGetAllPost']);

// get data from hero_slider by id
Route::get('/hero_slider/list', function(){
    return view('hero_slider/heroSliderGetDataByUniqId');
});
Route::post('/hero_slider/list/{id}',[ApiController::class, 'heroSliderGetPostByUniqId']);


//get data from hero_slider findOne
Route::get('/hero_slider/list/findone', function(){
    return view('hero_slider/heroSliderGetDataFindOne');
});
Route::post('/hero_slider/list/findone/{id}',[ApiController::class, 'heroSliderGetPostFindOne']);

// update data from hero_slider by id
Route::get('/hero_slider/update', function(){
    return view('hero_slider/heroSliderUpdateData');
});
Route::post('/hero_slider/update/{id}',[ApiController::class, 'heroSliderUpdatePost']);

// delete data from hero_slider by id

Route::get('/hero_slider/delete/{id}',[ApiController::class,'heroSliderDeletePost']);


#endregion

});






