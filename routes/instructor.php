<?php

use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'instructorauth'], function () {
    Route::get('/', 'DashboardController@index')->name('instructor-dashboard');
	Route::get('logout', 'AuthController@logout')->name('instructor-logout');
	Route::controller('CourseController')->group(function () {
        Route::get('/course', 'index')->name('instructor-course');
        Route::post('/course/status', 'status')->name('instructor-course-status');
        Route::get('/course/add', 'addEdit')->name('instructor-course-add');
        Route::post('/course/addaction', 'addAction')->name('instructor-course-addaction');
        Route::post('/course/imagedelete', 'imageDelete')->name('instructor-course-imagedelete');
        Route::post('/course/delete', 'delete')->name('instructor-course-delete');
    });

    Route::controller('LessonController')->group(function () {
        Route::get('/lesson', 'index')->name('instructor-lesson');
        Route::post('/lesson/status', 'status')->name('instructor-lesson-status');
        Route::get('/lesson/add', 'addEdit')->name('instructor-lesson-add');
        Route::post('/lesson/addaction', 'addAction')->name('instructor-lesson-addaction');
        Route::post('/lesson/filedelete', 'fileDelete')->name('instructor-lesson-filedelete');
        Route::post('/lesson/delete', 'delete')->name('instructor-lesson-delete');
    }); 

    Route::controller('AccountController')->group(function () {
        Route::get('/account', 'index')->name('instructor-account-setting');
        Route::post('/account/addaction', 'addAction')->name('instructor-account-addaction');
        Route::post('/account/imagedelete', 'imageDelete')->name('instructor-account-imagedelete');
        Route::post('/account/password', 'password')->name('instructor-account-password');
    });
	
	
	 Route::controller('SaleController')->group(function () {
        Route::get('/sale', 'index')->name('instructor-sale');
    });

    Route::controller('ReviewController')->group(function () {
        Route::get('/review', 'index')->name('instructor-review');
        Route::get('/review/reply', 'addEdit')->name('instructor-review-reply');
        Route::post('/review/addaction', 'addAction')->name('instructor-review-addaction');
        Route::post('/review/delete', 'delete')->name('instructor-review-delete');
    });


    Route::controller('AssessmentController')->group(function () {
        Route::get('/assessment', 'index')->name('instructor-assessment');
        Route::post('/assessment/status', 'status')->name('instructor-assessment-status');
    });


    Route::controller('StripeController')->group(function () {
        Route::get('/stripe', 'index')->name('instructor-stripe-connect');
        Route::any('/stripe/redirect', 'redirect')->name('instructor-stripe-redirect');
    });



   // Route::get('/',         [PaymentController::class, 'index']);
//Route::get('/redirect', [PaymentController::class, 'redirect']);


	
	
	
	
   

    
});
