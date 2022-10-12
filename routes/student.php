<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'studentauth'], function () {
    Route::get('/', 'DashboardController@index')->name('student-dashboard');
    Route::get('logout', 'AuthController@logout')->name('student-logout');

    Route::controller('AccountController')->group(function () {
        Route::get('/account', 'index')->name('student-account-setting');
        Route::post('/account/addaction', 'addAction')->name('student-account-addaction');
        Route::post('/account/imagedelete', 'imageDelete')->name('student-account-imagedelete');
        Route::post('/account/password', 'password')->name('student-account-password');

    });

    Route::controller('CourseController')->group(function () {
        Route::get('/course', 'index')->name('student-course');
        Route::get('/course/{id}', 'detail')->name('student-course-detail');
        Route::post('/course/{id}/reviews', 'reviews')->name('student-instructor-reviews');
    });

    Route::controller('LessonController')->group(function () {
        Route::get('/{course_slug}/lesson/{id}', 'index')->name('student-lesson');
        Route::post('/{course_slug}/lesson/{id}/reviews', 'reviews')->name('student-course-reviews');
        Route::post('/{course_slug}/lesson/{id}/assessment', 'assessment')->name('student-lesson-assessment');
        Route::get('/lesson/download/{id}', 'download')->name('student-file-download');
        // Route::post('/lesson/status', 'status')->name('student-lesson-status');
        // Route::get('/lesson/add', 'addEdit')->name('student-lesson-add');
        // Route::post('/lesson/addaction', 'addAction')->name('student-lesson-addaction');
        // Route::post('/lesson/filedelete', 'fileDelete')->name('student-lesson-filedelete');
        // Route::post('/lesson/delete', 'delete')->name('student-lesson-delete');
    });

});
