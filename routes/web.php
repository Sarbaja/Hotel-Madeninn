<?php

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

//Route::get('/', function () {
//    return view('welcome');
//});


Route::get('/', 'WelcomeController@index')->name('welcome');
Route::get('/index', 'WelcomeController@index')->name('welcome');
Route::get('/contact', 'ContactController@index')->name('contact');

Route::get('/blogs', 'BlogController@index');
Route::get('/blog/{slug}', 'BlogController@showSingleBlog');

Route::get('/breakfast', 'BreakfastController@index');
Route::get('/rooms/{slug}', 'RoomController@index');
Route::get('/amneties/{slug}', 'LocationController@index');
//Route::get('/rooms', 'RoomController@index');
//Route::get('/policy', 'PolicyController@index');
Route::get('/about/{slug}', 'PolicyController@index');

Route::get('/meeting/{slug}', 'MeetingController@index');
Route::get('/location', 'LocationController@index');
Route::get('/attract', 'AttractionController@index');
Route::get('/event/{slug}', 'EventController@index');
Route::get('/offers', 'OffersControllers@index');
Route::get('/gallery', 'GalleryController@index');
Route::get('/feature', 'FeatureController@index');

Route::get('/request', function(){
    return view('request');
});

// Routes for Booking
Route::post('/book', 'BookingController@book');
Route::match(['get', 'post'], '/booking', 'BookingController@directBook');
//Route::match(['get', 'post'], '/book', 'BookingController@book');
Route::post('/infobook', 'BookingController@bookinginfo');
//Route::get('/infobook', 'BookingController@bookinginfoDirect');
Route::post('/confirmBooking', 'BookingController@confirmBook');
//Route::match(['get', 'post'], '/confirmBooking', 'BookingController@confirmBook');
Route::post('/finalizeBooking', 'BookingController@finalizeBook');

Route::get('/thankyou', 'BookingController@thanks');

// Routes for Get In Touch Message
Route::post('/message', 'GetInTouchController@message');

// Routes for General Informaiton Request
Route::post('/generalInfoReq', 'GeneralInfoController@generalInfo');

// Routes for Meeting Room Request
Route::post('/meetingRoomReq', 'MeetingRoomReqController@meetingRoomReq');


Auth::routes();
//routes For Normal users
Route::middleware(['auth','is_active'])->group(function () {
    
});


//controll login dashboard
Route::get('/admin/login', 'admin\LoginController@index')
    ->name('admin.login');
Route::get('/admin', 'admin\LoginController@index');

//routes For Admin users
Route::middleware(['auth','is_admin','is_active'])->group(function () {
//Dashboard
    Route::get('/admin/index', 'admin\DashboardController@index')
        ->name('admin.index');

    //controll setting
    Route::get('/admin/setting', 'admin\SettingController@index')
        ->name('admin.setting');
    Route::post('/admin/setting', 'admin\SettingController@update');

    //control Admin Users
    Route::get('/admin/users', 'admin\UserController@index')
        ->name('admin.users');
    Route::get('/admin/adduser', 'admin\UserController@adduser')
        ->name('admin.adduser');
    Route::post('/admin/adduser', 'admin\UserController@createuser');
    Route::get('/admin/updateuser/{id}', 'admin\UserController@update');
    Route::post('/admin/updateuser', 'admin\UserController@updateuser')
        ->name('admin.updateuser');
    Route::get('/admin/users/delete/{id}', 'admin\UserController@delete');

    //control Slider
    Route::get('/admin/slider', 'admin\SliderController@index')
        ->name('admin.slider');
    Route::get('/admin/slider/addslide', 'admin\SliderController@addslide')
        ->name('admin.addslide');
    Route::post('/admin/slider/createslide', 'admin\SliderController@createslide')
        ->name('admin.createslide');
    Route::get('/admin/slider/editslide/{id}', 'admin\SliderController@editslide')
        ->name('admin.editslide');
    Route::post('/admin/slider/updateslide', 'admin\SliderController@updateslide')
        ->name('admin.updateslide');
    Route::get('/admin/slider/delete/{id}', 'admin\SliderController@delete');

    //control testimonials
    Route::resource('/admin/testimonials','admin\TestimonialController');
    Route::post('/admin/orderTestimonials','admin\TestimonialController@setOrder');

    //control breakfast
    Route::resource('/admin/breakfast','admin\BreakfastController');
    Route::get('/admin/breakfast/images/{id}', 'admin\BreakfastController@showImages');
    Route::post('/admin/breakfast/add-images', 'admin\BreakfastController@addImages');
    Route::delete('/admin/breakfast/images/deleteImage/{id}', 'admin\BreakfastController@deleteImage');

    //control rooms

    Route::resource('/admin/rooms','admin\RoomController');
    Route::get('/admin/rooms/images/{id}', 'admin\RoomController@showImages');
    Route::post('/admin/rooms/add-images', 'admin\RoomController@addImages');
    Route::delete('/admin/rooms/images/deleteImage/{id}', 'admin\RoomController@deleteImage');


    Route::prefix('admin/photo-gallery')->group(function () {
        Route::get('/{albumName}', 'admin\PhotoGalleryController@index')->name('photo_gallery');
        Route::get('/{albumName}/{photoName}', 'admin\PhotoGalleryController@delete_image')->name('delete.photo_gallery');
        Route::post('/add-images', 'admin\PhotoGalleryController@add_images')->name('photo_gallery.add_images');
    });

    //control Pages
    Route::get('/admin/pages', 'admin\PagesController@index')
        ->name('admin.pages');
    Route::get('/admin/pages/addpage', 'admin\PagesController@addpage')
        ->name('admin.addpage');
    Route::post('/admin/pages/createpage', 'admin\PagesController@createpage')
        ->name('admin.createpage');
    Route::get('/admin/pages/editpage/{id}', 'admin\PagesController@editpages')
        ->name('admin.editpage');
    Route::post('/admin/pages/updatepage', 'admin\PagesController@updatepage')
        ->name('admin.updatepage');
    Route::get('/admin/pages/delete/{id}', 'admin\PagesController@delete');

    //control blogs
    Route::resource('/admin/blogs','admin\BlogController');
    Route::post('/admin/orderBlog','admin\BlogController@setOrder');

    //control policy
    Route::resource('/admin/policy','admin\PolicyController');
    Route::post('/admin/orderPolicy','admin\PolicyController@setOrder');

    //control meetings
    Route::resource('/admin/meetings','admin\MeetingController');
    Route::post('/admin/orderMeetings','admin\MeetingController@setOrder');

    //control events
    Route::resource('/admin/events','admin\EventController');
    Route::post('/admin/orderEvent','admin\EventController@setOrder');

    //control attractions
    Route::resource('/admin/attractions','admin\AttractionController');
    Route::post('/admin/orderAttraction','admin\AttractionController@setOrder');

    //control locations
    Route::resource('/admin/locations','admin\LocationController');
    Route::post('/admin/orderLocation','admin\LocationController@setOrder');

    //control locations
    Route::resource('/admin/retails','admin\RetailController');
    Route::post('/admin/orderRetail','admin\RetailController@setOrder');


    //common Gallery
    Route::get('admin/commongallery','admin\CommonGalleryController@index');
    Route::get('admin/commongallery/{slug}','admin\CommonGalleryController@album');

    /*========================== Gallery ===================================*/
    Route::get('/admin/gallery/{id}', 'admin\GalleryController@albumGallery');
    Route::resource('/admin/gallery', 'admin\GalleryController');
    /*========================== End of Gallery ===================================*/


    /*========================== Album ===================================*/
    Route::resource('/admin/albums', 'admin\AlbumController');
    /*========================== End of Album ===================================*/



    Route::prefix('admin/photo-gallery')->group(function () {
        Route::get('/{albumName}', 'admin\PhotoGalleryController@index')->name('photo_gallery');
        Route::get('/{albumName}/{photoName}', 'admin\PhotoGalleryController@delete_image')->name('delete.photo_gallery');
        Route::post('/add-images', 'admin\PhotoGalleryController@add_images')->name('photo_gallery.add_images');
    });

    Route::get('/admin/bookmails', 'admin\BookController@index');
    Route::get('/admin/viewbookmail/{id}','admin\BookController@viewbook');
    Route::post('/admin/changestatus','admin\BookController@changestatus');

});

Route::get('/home', 'HomeController@index')->name('home');
