<?php
use Illuminate\Support\Facades\Route;

Route::get('login', 'AuthController@login')->name('admin-login');
Route::post('check/login', 'AuthController@checkLogin')->name('admin-checkLogin');
Route::get('forgot-password', 'AuthController@forgotPassword')->name('admin-forgot-password');

Route::group(['middleware' => 'adminauth'], function () {
    Route::get('/', 'DashboardController@index')->name('admin-dashboard');
	Route::get('logout', 'AuthController@logout')->name('admin-logout');
    Route::controller('BlogController')->group(function () {
        Route::get('/blog', 'index')->name('admin-blog');
        Route::post('/blog/status', 'status')->name('admin-blog-status');
        Route::get('/blog/add', 'addEdit')->name('admin-blog-add');
        Route::post('/blog/addaction', 'addAction')->name('admin-blog-addaction');
        Route::post('/blog/imagedelete', 'imageDelete')->name('admin-blog-imagedelete');
        Route::post('/blog/delete', 'delete')->name('admin-blog-delete');
    });
    Route::controller('CategoryController')->group(function () {
        Route::get('/category', 'index')->name('admin-category');
        Route::post('/category/status', 'status')->name('admin-category-status');
        Route::get('/category/add', 'addEdit')->name('admin-category-add');
        Route::post('/category/addaction', 'addAction')->name('admin-category-addaction');
        Route::post('/category/imagedelete', 'imageDelete')->name('admin-category-imagedelete');
        Route::post('/category/delete', 'delete')->name('admin-category-delete');
    });
    Route::controller('CommissionController')->group(function () {
        Route::get('/commission', 'index')->name('admin-commission');
        Route::post('/commission/status', 'status')->name('admin-commission-status');
        Route::get('/commission/add', 'addEdit')->name('admin-commission-add');
        Route::post('/commission/addaction', 'addAction')->name('admin-commission-addaction');
        Route::post('/commission/delete', 'delete')->name('admin-commission-delete');
    });
    Route::controller('InstructorController')->group(function () {
        Route::get('/instructor', 'index')->name('admin-instructor');
        Route::get('/instructor/detail', 'detail')->name('admin-instructor-detail');
        Route::get('/instructor/export', 'export')->name('admin-instructor-export');
        Route::get('/instructor/add', 'addEdit')->name('admin-instructor-add');
        Route::post('/instructor/addaction', 'addAction')->name('admin-instructor-addaction');
        Route::get('/instructor/courses', 'courses')->name('admin-instructor-courses');
        Route::get('/instructor/course/edit', 'courseEdit')->name('admin-instructor-course-edit');
        Route::post('/instructor/course/editaction', 'courseEditAction')->name('admin-instructor-course-editaction');
        Route::post('/instructor/course/imagedelete', 'courseImageDelete')->name('admin-instructor-course-imagedelete');
        Route::get('/instructor/courses/lessons', 'lessons')->name('admin-instructor-courses-lessons');
        Route::get('/instructor/course/lesson/edit', 'lessonEdit')->name('admin-instructor-course-lesson-edit');
        Route::post('/instructor/course/lesson/editaction', 'lessonEditAction')->name('admin-instructor-course-lesson-editaction');
        Route::post('/instructor/course/lesson/filedelete', 'lessonFileDelete')->name('admin-instructor-course-lesson-filedelete');
    });
    Route::controller('StudentController')->group(function () {
        Route::get('/student', 'index')->name('admin-student');
        Route::get('/student/export', 'export')->name('admin-student-export');
    });
    Route::controller('SearchController')->group(function () {
        Route::get('/search', 'index')->name('admin-search');
    });
    Route::controller('FaqController')->group(function () {
        Route::get('/faq', 'index')->name('admin-faq');
        Route::post('/faq/status', 'status')->name('admin-faq-status');
        Route::get('/faq/add', 'addEdit')->name('admin-faq-add');
        Route::post('/faq/addaction', 'addAction')->name('admin-faq-addaction');
        Route::post('/faq/delete', 'delete')->name('admin-faq-delete');
    });
    Route::controller('FaqController')->group(function () {
        Route::get('/faq', 'index')->name('admin-faq');
        Route::post('/faq/status', 'status')->name('admin-faq-status');
        Route::get('/faq/add', 'addEdit')->name('admin-faq-add');
        Route::post('/faq/addaction', 'addAction')->name('admin-faq-addaction');
        Route::post('/faq/delete', 'delete')->name('admin-faq-delete');
    });
    Route::controller('ReviewController')->group(function () {
        Route::get('/review', 'index')->name('admin-review');
        Route::post('/review/status', 'status')->name('admin-review-status');
        Route::get('/review/add', 'addEdit')->name('admin-review-add');
        Route::post('/review/addaction', 'addAction')->name('admin-review-addaction');
        Route::post('/review/imagedelete', 'imageDelete')->name('admin-review-imagedelete');
        Route::post('/review/delete', 'delete')->name('admin-review-delete');
    });
    Route::controller('BannerController')->group(function () {
        Route::get('/banner', 'index')->name('admin-banner');
        Route::post('/banner/status', 'status')->name('admin-banner-status');
        Route::get('/banner/add', 'addEdit')->name('admin-banner-add');
        Route::post('/banner/imagedelete', 'imageDelete')->name('admin-banner-imagedelete');
        Route::post('/banner/addaction', 'addAction')->name('admin-banner-addaction');
        Route::post('/banner/delete', 'delete')->name('admin-banner-delete');
    });
    Route::controller('PartnerController')->group(function () {
        Route::get('/partner', 'index')->name('admin-partner');
        Route::post('/partner/status', 'status')->name('admin-partner-status');
        Route::get('/partner/add', 'addEdit')->name('admin-partner-add');
        Route::post('/partner/imagedelete', 'imageDelete')->name('admin-partner-imagedelete');
        Route::post('/partner/addaction', 'addAction')->name('admin-partner-addaction');
        Route::post('/partner/delete', 'delete')->name('admin-partner-delete');
    });
    
    Route::controller('EmailController')->group(function () {
        Route::get('/email', 'index')->name('admin-email');
        Route::post('/email/delete', 'delete')->name('admin-email-delete');

    });
    
    Route::controller('PageController')->group(function () {
        Route::get('/page', 'index')->name('admin-page');
        Route::post('/page/status', 'status')->name('admin-page-status');
        Route::get('/page/add', 'addEdit')->name('admin-page-add');
        Route::post('/page/imagedelete', 'imageDelete')->name('admin-page-imagedelete');
        Route::post('/page/addaction', 'addAction')->name('admin-page-addaction');
        Route::post('/page/delete', 'delete')->name('admin-page-delete');
    });
    Route::controller('SkillController')->group(function () {
        Route::get('/skill', 'index')->name('admin-skill');
        Route::post('/skill/status', 'status')->name('admin-skill-status');
        Route::get('/skill/add', 'addEdit')->name('admin-skill-add');
        Route::post('/skill/addaction', 'addAction')->name('admin-skill-addaction');
        Route::post('/skill/delete', 'delete')->name('admin-skill-delete');
    });
    Route::controller('SocialiconController')->group(function () {
        Route::get('/socialicon', 'index')->name('admin-socialicon');
        Route::post('/socialicon/store', 'store')->name('admin-socialicon-store');
    });
    Route::controller('SettingController')->group(function () {
        Route::get('/setting', 'index')->name('admin-setting');
        Route::post('/setting/store', 'store')->name('admin-setting-store');
    });
    Route::controller('SeoController')->group(function () {
        Route::get('/seo', 'index')->name('admin-seo');
        Route::get('/seo/add', 'addEdit')->name('admin-seo-add');
        Route::post('/seo/addaction', 'addAction')->name('admin-seo-addaction');
        Route::post('/seo/delete', 'delete')->name('admin-seo-delete');

    });

    
});
