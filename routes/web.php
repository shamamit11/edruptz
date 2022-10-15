<?php
use App\Models\Slug;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

Route::get('/', 'DashboardController@index')->name('/');
Route::get('about-edruptz', 'PageController@pageDetail')->name('about-edruptz');
Route::get('courses', 'CourseController@index')->name('courses');
Route::get('professionals', 'InstructorController@index')->name('professionals');
Route::get('blog', 'BlogController@index')->name('blog');
Route::get('contact', 'ContactController@index')->name('contact');
Route::post('newsletter', 'EmailController@index')->name('newsletter');
Route::post('contact/post', 'ContactController@post')->name('contact-post');
Route::get('register', 'AuthController@register')->name('register');
Route::post('register/student', 'AuthController@registerStudent')->name('register-student');
Route::post('register/instructor', 'AuthController@registerInstructor')->name('register-instructor');
Route::get('email/verification/student/{code}', 'AuthController@verificationStudent')->name('verification-student');
Route::get('email/verification/instructor/{code}', 'AuthController@verificationInstructor')->name('verification-instructor');
Route::get('facebook/student', 'AuthController@facebookStudent')->name('facebook-student');
Route::get('facebook/instructor', 'AuthController@facebookInstructor')->name('facebook-instructor');
Route::get('login', 'AuthController@login')->name('login');
Route::post('login/student', 'AuthController@loginStudent')->name('login-student');
Route::post('login/instructor', 'AuthController@loginInstructor')->name('login-instructor');

Route::get('forgot-password-instructor', 'AuthController@passwordInstructor')->name('forgot-password-instructor');
Route::post('forgot-password-instructor', 'AuthController@forgotPasswordInstructor')->name('forgot-password-instructor');
Route::get('reset-password-instructor/{token}', 'AuthController@resetPasswordInstructor')->name('reset-password-instructor');
Route::post('save-password-instructor', 'AuthController@savePasswordInstructor')->name('save-password-instructor');

Route::get('forgot-password-student', 'AuthController@passwordStudent')->name('forgot-password-student');
Route::post('forgot-password-student', 'AuthController@forgotPasswordStudent')->name('forgot-password-student');
Route::get('reset-password-student/{token}', 'AuthController@resetPasswordStudent')->name('reset-password-student');
Route::post('save-password-student', 'AuthController@savePasswordStudent')->name('save-password-student');

Route::get('cart', 'CartController@index')->name('cart');
Route::post('cart/add', 'CartController@cartAdd')->name('cart-add');
Route::get('cart/delete/{id}', 'CartController@delete')->name('cart-delete');
Route::get('cart/stripe', 'CartController@stripe')->name('cart-stripe');
Route::post('cart/stripe', 'CartController@stripePost')->name('cart-stripe-post');
Route::get('cart/success', 'CartController@success')->name('cart-success');
Route::get('faq', 'FaqController@index')->name('faq');



if (Schema::hasTable('slugs')) {
    $routes = Slug::get();
    if ($routes->count() > 0) {
        foreach ($routes as $route) {
            Route::get($route->slug, ucwords($route->controller_name) . 'Controller@' . $route->function_name)->name($route->slug);
        }
    }
}