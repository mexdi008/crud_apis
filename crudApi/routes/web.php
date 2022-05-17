<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\administrativeStaffController;
use App\Http\Controllers\brandsController;
use App\Http\Controllers\contactUsController;
use App\Http\Controllers\heroSliderController;
use App\Http\Controllers\sectorsController;
use App\Http\Controllers\subscriptionsController;
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
Route::post('/adminstrative/create',[administrativeStaffController::class,'administrativeStaffAddPost']);

// get all datas from adiminstrativeStaff
Route::get('/administrative/list/all',[administrativeStaffController::class,'administrativeStaffgetAll']);

// get data from administrativeStaff by id
Route::get('/administrative/list', function(){
    return view('administrative_staff/getDataByUniqId');
});
Route::post('/administrative/list/{id}',[administrativeStaffController::class, 'administrativeStaffgetByUniqId']);

//get data from administrativeStaff findOne
Route::get('/administrative/list/findone', function(){
    return view('administrative_staff/getDataFindOne');
});
Route::post('/administrative/list/findone/{id}',[administrativeStaffController::class, 'administrativeStaffgetFindOne']);

// update data from administrativeStaff by id
Route::get('/administrative/update', function(){
    return view('administrative_staff/updateData');
});
Route::post('/administrative/update/{id}',[administrativeStaffController::class, 'administrativeStaffupdate']);

// delete data from administrativeStaff by id
Route::delete('/administrative/delete/{id}',[administrativeStaffController::class,'administrativeStaffdelete']);
#endregion

#region Brands Routes
// create data for Brands
Route::get('/brands/create', function () {
    return view('brands/brandsPostData');
});
Route::post('/brands/create',[brandsController::class,'brandsAddPost']);

// get all datas from Brands
Route::get('/brands/list/all',[brandsController::class,'brandsGetAll']);

// get data from Brands by id
Route::get('/brands/list', function(){
    return view('brands/brandsGetDataByUniqId');
});
Route::post('/brands/list/{id}',[brandsController::class, 'brandsGetByUniqId']);

//get data from Brands findOne
Route::get('/brands/list/findone', function(){
    return view('brands/brandsGetDataFindOne');
});
Route::post('/brands/list/findone/{id}',[brandsController::class, 'brandsGetFindOne']);

// update data from brands by id
Route::get('/brands/update', function(){
    return view('brands/brandsUpdateData');
});
Route::post('/brands/update/{id}',[brandsController::class, 'brandsUpdate']);

// delete data from brands by id
Route::delete('/brands/delete/{id}',[brandsController::class,'brandsDelete']);
#endregion

#region hero_slider Routes
// create data for hero_slider
Route::get('/hero_slider/create', function () {
    return view('hero_slider/heroSliderPostData');
});
Route::post('/hero_slider/create',[heroSliderController::class,'heroSliderAddPost']);

// get all datas from hero_slider
Route::get('/hero_slider/list/all',[heroSliderController::class,'heroSliderGetAll']);

// get data from hero_slider by id
Route::get('/hero_slider/list', function(){
    return view('hero_slider/heroSliderGetDataByUniqId');
});
Route::post('/hero_slider/list/{id}',[heroSliderController::class, 'heroSliderGetByUniqId']);

//get data from hero_slider findOne
Route::get('/hero_slider/list/findone', function(){
    return view('hero_slider/heroSliderGetDataFindOne');
});
Route::post('/hero_slider/list/findone/{id}',[heroSliderController::class, 'heroSliderGetFindOne']);

// update data from hero_slider by id
Route::get('/hero_slider/update', function(){
    return view('hero_slider/heroSliderUpdateData');
});
Route::post('/hero_slider/update/{id}',[heroSliderController::class, 'heroSliderUpdate']);

// delete data from hero_slider by id

Route::delete('/hero_slider/delete/{id}',[heroSliderController::class,'heroSliderDelete']);
#endregion

#region Subscriptions Routes
// create data for subscriptions
Route::get('/subscriptions/create', function () {
    return view('subscriptions/subscriptionsPostData');
});
Route::post('/subscriptions/create',[subscriptionsController::class,'subscriptionsAddPost']);

// get all datas from subscriptions
Route::get('/subscriptions/list/all',[subscriptionsController::class,'subscriptionsGetAll']);

// get data from subscriptions by id
Route::get('/subscriptions/list', function(){
    return view('subscriptions/subscriptionsGetDataByUniqId');
});
Route::post('/subscriptions/list/{id}',[subscriptionsController::class, 'subscriptionsGetByUniqId']);

//get data from subscriptions findOne
Route::get('/subscriptions/list/findone', function(){
    return view('subscriptions/subscriptionsGetDataFindOne');
});
Route::post('/subscriptions/list/findone/{id}',[subscriptionsController::class, 'subscriptionsGetFindOne']);

// update data from subscriptions by id
Route::get('/subscriptions/update', function(){
    return view('subscriptions/subscriptionsUpdateData');
});
Route::post('/subscriptions/update/{id}',[subscriptionsController::class, 'subscriptionsUpdate']);

// delete data from subscriptions by id

Route::delete('/subscriptions/delete/{id}',[subscriptionsController::class,'subscriptionsDelete']);


#endregion

#region contact_us routes
// create data for contact_us
Route::get('/contact_us/create', function () {
    return view('contact_us/contactUsPostData');
});
Route::post('/contact_us/create',[contactUsController::class,'contactUsAddPost']);

// get all datas from contact_us
Route::get('/contact_us/list/all',[contactUsController::class,'contactUsGetAll']);

// get data from contact_us by id
Route::get('/contact_us/list', function(){
    return view('contact_us/contactUsGetDataByUniqId');
});
Route::post('/contact_us/list/{id}',[contactUsController::class, 'contactUsGetByUniqId']);

//get data from contact_us findOne
Route::get('/contact_us/list/findone', function(){
    return view('contact_us/contactUsGetDataFindOne');
});
Route::post('/contact_us/list/findone/{id}',[contactUsController::class, 'contactUsGetFindOne']);

// update data from contact_us by id
Route::get('/contact_us/update', function(){
    return view('contact_us/contactUsUpdateData');
});
Route::post('/contact_us/update/{id}',[contactUsController::class, 'contactUsUpdate']);

// delete data from contact_us by id

Route::delete('/contact_us/delete/{id}',[contactUsController::class,'contactUsDelete']);


#endregion

#region sectors
// create data for sectors
Route::get('/sectors/create', function () {
    return view('sectors/sectorsPostData');
});
Route::post('/sectors/create',[sectorsController::class,'sectorsAddPost']);

// get all datas from sectors
Route::get('/sectors/list/all',[sectorsController::class,'sectorsGetAll']);

// get data from sectors by id
Route::get('/sectors/list', function(){
    return view('sectors/sectorsGetDataByUniqId');
});
Route::post('/sectors/list/{id}',[sectorsController::class, 'sectorsGetByUniqId']);

//get data from sectors findOne
Route::get('/sectors/list/findone', function(){
    return view('sectors/sectorsGetDataFindOne');
});
Route::post('/sectors/list/findone/{id}',[sectorsController::class, 'sectorsGetFindOne']);

// update data from sectors by id
Route::get('/sectors/update', function(){
    return view('sectors/sectorsUpdateData');
});
Route::post('/sectors/update/{id}',[sectorsController::class, 'sectorsUpdate']);

// delete data from sectors by id

Route::delete('/sectors/delete/{id}',[sectorsController::class,'sectorsDelete']);

#endregion
});






