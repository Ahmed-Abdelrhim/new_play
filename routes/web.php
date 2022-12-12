<?php

use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\Comments\CommentsController;
use App\Http\Controllers\LearnController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PaymentController;
use App\Models\PaymentPlatform;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlayController;
use App\Http\Controllers\CustomLoginController;
use App\Http\Controllers\ProblemsController;
use App\Http\Controllers\Files\ImagesController;
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
//Auth::routes();
Route::get('not-found-page', [PlayController::class, 'errorPage'])->name('error');
//Route::get('s3',function (){
//    return view('s3');
//});

Route::get('/', function () {
    return view('welcome');
});
Route::get('play/{id}', [PlayController::class, 'play']);
Route::get('solve',[BlogPostController::class,'problemSolving']);

Route::group(['middleware' => 'guest:author'], function () {
    Route::get('login', [CustomLoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [CustomLoginController::class, 'login'])->name('signIn')->middleware('guest');
    Route::post('logout', [CustomLoginController::class, 'logout']);
    Route::get('register/now', [CustomLoginController::class, 'showRegisterForm'])->name('register');
    Route::post('register/To/Login', [CustomLoginController::class, 'register'])->name('register.post');
});


Route::get('play/{id}', [PlayController::class, 'play']);


Route::group(['middleware' => 'auth:author'], function () {
    Route::post('logout', [CustomLoginController::class, 'logout'])->name('logout');
    Route::get('/home', [HomeController::class, 'index'])->name('home');


    Route::get('payment', [PaymentController::class, 'showPaymentForm'])->name('pay');
    Route::get('restore/post/{id}', [PlayController::class, 'restoreBlogPosts']);
    Route::get('all/posts', [PlayController::class, 'showAllPosts'])->name('blog_posts');
    Route::get('posts/{id}', [PlayController::class, 'showPosts'])->name('show.blog_post.by.id');

    Route::get('show/dataTables/blogposts',[LearnController::class,'showDataTablesIndex'])->name('dataTables');
    Route::get('get/dataTables/blogposts/all',[LearnController::class,'getDataTablesIndex'])->name('dataTables.all');


    Route::get('add/blogPost', [PlayController::class, 'showBlogPostForm'])->name('add.blog_post');
    Route::get('adding/blogPost', [PlayController::class, 'addBlogPost'])->name('create.blogPost');
    Route::get('update/post/{id}', [PlayController::class, 'updateBlogPostForm'])->name('update.post.form');
    Route::post('update/post/{id}', [PlayController::class, 'storeBlogPost'])->name('update.post');
    Route::get('delete/post/{id}', [PlayController::class, 'destroy'])->name('delete.post');

    Route::get('test', function () {
        return view('test');
    });
    Route::get('test/test', [])->name('stripe.post');

    Route::get('email-send',[MailController::class,'viewSendEmailForm'])->name('sending-email');
    Route::post('send/message', [MailController::class, 'sendEmail'])->name('send.gmail');
    Route::get('check-verified-code',[MailController::class,'checkVerificationCodeForm'])->name('check.verification.code');
    Route::post('check-mobile-number',[MailController::class,'checkMobileNumber'])->name('check.mobile_no');
    Route::post('check/verification/code',[MailController::class,'checkVerificationCode'])->name('check.code');

    Route::get('play/with/livewire', function () {
        return view('play');
    })->name('livewire');

    Route::get('callback', function () {
        return 'Success';
    });
    Route::get('error', function () {
        return 'Error';
    });

    Route::get('show/upload', [PlayController::class, 'uploadForm'])->name('upload.form');
    Route::post('upload', [PlayController::class, 'upload'])->name('upload');

    Route::get('user/profile', [PlayController::class, 'viewProfilePage'])->name('profile');
    Route::post('save/profile/data', [PlayController::class, 'storeUserProfileData'])->name('post.profile.data');


    ################### Custom Play  ###################

    Route::get('all-posts',[BlogPostController::class,'index'])->name('all-posts');
    Route::get('show/{id}',[BlogPostController::class,'show'])->name('only.show');
    Route::post('update/{id}',[BlogPostController::class,'update'])->name('only.update');

    Route::get('add/comment',[CommentsController::class,'addCommentForm'])->name('add.comment');
    Route::post('store/comment',[CommentsController::class,'storeComment'])->name('store.comment');

    Route::get('excel',[LearnController::class,'playWithExcel']);

    Route::get('playy',[LearnController::class,'play'])->middleware('can:play');
    Route::get('problem',[ProblemsController::class,'solveFirst']);

    Route::get('many',[ImagesController::class,'uploadForm']);

    Route::post('upload-multiple',[ImagesController::class,'uploadMultipleImages'])->name('multiple.images');

});
Route::get('hash', function () {
    return bcrypt('12345678');
});

Route::get('sweet',[ImagesController::class,'sweet']);

Route::get('most/active/last/month', [PlayController::class, 'activeLastMonthAuthor'])->name('most.active.last.month');

    Route::get('send/gmail',[MailController::class,'sendMailForm']);
Route::post('send/gmail/msg',[MailController::class,'send'])->name('email.send');



Route::get('send/sms',[MailController::class,'sendSms'])->name('send.sms');

// another dll
// CAENRFIDLibraryPocketPC.dll
// registering all dll files => for %1 in (*.dll) do regsvr32 /s %1

// composer install --ignore-platform-reqs

// AxInterop.FP_CLOCKLib.dll
// regsvr32 "C:\Windows\SysWOW64\AxInterop.FP_CLOCKLib.dll"
// REGSVR32 /S CAENRFIDLibraryPocketPC.dll or REGSVR32 /S CAENRFIDLibraryPocketPC
// regsvr32 "C:\Windows\System32\AxInterop.FP_CLOCKLib.dll"

// regsvr32.exe /s C:\Windows\system32\AxInterop.FP_CLOCKLib.dll

//Route::get('pp/{id}', function ($id) {
//    $post = \App\Models\BlogPost::find($id);
//    if ($post->images) {
//        return $posts = $post->images()->get();
//        return $posts[0]->src;
//    }
//    return 'false';
//});


// npm run watch
// npm run development --watch
// 173704761160


// MAIL_ENCRYPTION=null From .env file to send mails to smtp.mailtrap.io

// https://uoplaod-laravel-files.s3.amazonaws.com/thumbnails/https%3A//uoplaod-laravel-files.s3.amazonaws.com/profiles/1666814035.jpg
// https://uoplaod-laravel-files.s3.amazonaws.com/profiles/1666814035.jpg



//AJAX
//var formData = new FormData( JQuery('')[0] );
//=> will give all the information from the form
//$.ajax({
//	url : "{{ route('') }}",
//	type: 'POST',
//	data: formData,
//	contentType: false,
//	processData: false,
//	success: function(data) {},
//	error: function(xhr,status,errors) {
//		errors here inside => xhr.responseJSON.errors
//		$.each(xhr.responseJSON.errors , function(key,item){
//				$('.errors').append('<p class="alert alert-danger" >' + item '</p>');
//			})
//	}
//});



// TO Determine What To Buy
// Request Buy For Example
// Firs Is QR By Email
// Send Email TO Server And Server Respond With Response , I Need TO Make An Integration
// Because Every Thing Has Integration Alone  time is : 3:31 pm. and it's passing very slowly and mo:sab doesn't
// Need TO Go TO His Home Play
// He Is Searching for help . he needs anyone to help him . he is telling him the story now to give him an answer
// determine the product and the parking way . he doesn't need the website anymore .
// he needs every thing through when it comes 4 o'clock
//
