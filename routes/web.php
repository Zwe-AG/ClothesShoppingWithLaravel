<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\User\UserController;
use App\Models\Contact;
use App\Models\Product;
use Illuminate\Support\Facades\Route;


Route::redirect('/','login/page');
Route::get('login/page',[AuthController::class,'login'])->name('login#page');
Route::get('register/page',[AuthController::class,'register'])->name('register#page');

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {

    //Dashboard
    Route::get('/dashboard',[AuthController::class,'dashboard'])->name('dashboard');

    // Admin
    Route::middleware(['admin_auth'])->group(function(){

        // Admin Home
        Route::get('admin/home',[AdminController::class,'adminHome'])->name('admin#home');

        // Profile
        Route::get('admin/profile',[AdminController::class,'adminProfile'])->name('admin#profile');

        // profile Edit
        Route::get('admin/profile/edit/{id}',[AdminController::class,'adminProfileEdit'])->name('admin#profileEdit');

        // Profile Update
        Route::post('admin/profile/update/{id}',[AdminController::class,'adminProfileUpdate'])->name('admin#profileupdate');

        // Change Password Page
        Route::get('admin/changePasswordPage',[AdminController::class,'adminChangePasswordPage'])->name('admin#changePasswordPage');
         // Change Password
        Route::post('admin/change/password',[AdminController::class,'adminChangePassword'])->name('admin#changePassword');

        // User List From Admin Dashboard
        Route::get('admin/userListPage',[AdminController::class,'userListPage'])->name('admin#userListPage');

        // For Category
        Route::prefix('category')->group(function(){

            //category List Page
            Route::get('listPage',[CategoryController::class,'categoryListPage'])->name('category#listpage');
            //category Create Page
            Route::get('createPage',[CategoryController::class,'categoryCreatePage'])->name('category#createpage');
             //category Create
            Route::post('create',[CategoryController::class,'categoryCreate'])->name('categoty#create');
             //category Delete
            Route::get('delete/{id}',[CategoryController::class,'categoryDelete'])->name('categoty#delete');
        });

        // For Product
        Route::prefix('product')->group(function(){

            // product list page
            Route::get('listPage',[ProductController::class,'productListPage'])->name('product#listpage');
            //product Create Page
            Route::get('createPage',[ProductController::class,'productCreatePage'])->name('product#createpage');
            // product create
            Route::post('create',[ProductController::class,'productCreate'])->name('product#create');
            // product delete
            Route::get('delete/{id}',[ProductController::class,'productDelete'])->name('product#delete');
            // product edit page
            Route::get('editPage/{id}',[ProductController::class,'productEditPage'])->name('product#editPage');
            // product update
            Route::post('update',[ProductController::class,'productUpdate'])->name('product#update');
        });

        Route::prefix('ajax')->group(function(){
            Route::get('change/role',[AdminController::class,'ajaxChangeRole'])->name('ajax#changerole');
            Route::get('admin/changeRole',[AdminController::class,'ajaxAdminChangeRole'])->name('ajax#adminchangerole');
        });

        // Feedback
        Route::get('feedback',[AdminController::class,'feedback'])->name('user#feedback');
        Route::get('feedback/detail/{id}',[AdminController::class,'feedbackDetail'])->name('user#feedbackdetail');

        //Billing 
        Route::get('orderList',[AdminController::class,'orderListBilling'])->name('user#orderList');

    });

     // User
     Route::group(['prefix'=>'user','middleware'=>'user_auth'],function(){

        // User Home
        Route::get('home',[UserController::class,'userHome'])->name('user#home');

        // User Profile
        Route::get('profile',[UserController::class,'userProfile'])->name('user#profile');
        Route::post('password/change',[UserController::class,'userPasswordChange'])->name('user#passwordchange');
        Route::get('edit/{id}',[UserController::class,'userProfileEdit'])->name('user#editprofile');
        Route::post('update/{id}',[UserController::class,'userProfileUpdate'])->name('user#updateprofile');

         // filter
         Route::get('filter/{id}',[UserController::class,'filterProduct'])->name('product#filter');

         // Cart List
         Route::get('product/detail/{id}',[UserController::class,'productdetail'])->name('product#detail');
         Route::get('cart/list',[UserController::class,'cartList'])->name('cart#list');

         // Contact
         Route::get('contact',[ContactController::class,'contact'])->name('user#contact');
         Route::post('contact/create',[ContactController::class,'contactCreate'])->name('user#contactcreate');


        // Ajax
        Route::prefix('ajax')->group(function(){
            // Asc & desc
            Route::get('orderby',[AjaxController::class,'orderDescAsc']);
            // Add Cart
            Route::get('cart',[AjaxController::class,'cart']);
            // Order
            Route::get('order',[AjaxController::class,'orderProduct']);
        });


    });

});

