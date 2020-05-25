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


// Route::get('/', function () {
//     return view('welcome');
// });


//line bot
Route::get('rd/test', 'Rd\RdController@index');
Route::get('/rd/gentbimg', 'Rd\GenTbImgController@index');
Route::get('rd/genacc', 'Rd\RdController@genacc');

//首頁member
// Route::group(['prefix' => ''], function($router) {
  	// Route::get('/warning', 'Auth\AuthAgeController@warning');//首頁  
// });
Route::get('/{id?}', 'Index\IndexController@index')->where('id', '[0-9]+');//走分頁
// Route::get('/getmore/{id?}', 'Index\IndexController@loadmore');//影片 JSON 格式

//文章內頁

  
//測試頁
// Route::get('/pt/{id}', 'Index\IndexController@postviewtest')->where('id', '[0-9]+');
// Route::get('/pv/{id}', 'Index\IndexController@postviewapp')->where('id', '[0-9]+');

// Route::group(['middleware' => 'web'], function () {
   	Route::auth();


	Route::get('login', 'Auth\LoginController@index')->name('login');
	Route::post('loginPost', 'Auth\LoginController@loggedIn');
	Route::get('homeIndex','Auth\LoginController@home')->middleware('auth');
	Route::get('logout', 'Auth\LoginController@logout');

	Route::get('/p/{id}', 'Index\IndexController@postview')->where('id', '[0-9]+');
	// Route::get('/category/{cat}/{id?}', 'Index\IndexController@category')->where('cat', '[A-Za-z]+')->where('id', '[0-9]+'); 
	Route::get('/tag/{id}/{page?}', 'Index\IndexController@tag')->where('id', '[0-9]+');
	Route::get('/tag/hot/{page?}', 'Index\IndexController@hot');
	Route::post('thumbsup', 'Index\IndexController@thumbsup');
	Route::post('thumbsdown', 'Index\IndexController@thumbsdown');
	Route::get('/search/{search}/{page?}/', 'Index\IndexController@searchVideo')->where('page', '[0-9]+');

	// Route::get('/tag/{id}/{page?}', 'Index\IndexController@tag')->where('id', '[0-9]+');
// });
//發文頁面
Route::group(['middleware' => ['auth:web']], function () {
			Route::get('/article/post', 'Index\IndexController@postpage');
});
//發文
Route::post('/upload/request', 'Article\UploadController@store');

// //getvideo
Route::get('/getvideo/{id}', 'Index\GetVideoController@index');
// Route::get('/getvideoapp/{id}', 'Index\GetVideoAppController@index');

// //getvideo
Route::get('/clickAd/{id}', 'Index\IndexController@clickAd')->where('id', '[0-9]+');
//交換連結
// Route::get('/linkex', 'Service\PageController@linkexchange');


//登入頁面

// Route::group(['prefix' => 'member'], function($router) {
//	Route::get('/login', 'Member\MemberController@login')->name('login'); 		//登入
//	Route::get('/logout', 'Member\MemberController@logout');	//登出
// });



//openid

// Route::group(['prefix' => 'openid'], function ($router) {
// 	Route::get('/facebook/login', 'Member\FbOpenidController@redirectToProvider');
// 	Route::get('/facebook/callback', 'Member\FbOpenidController@handleProviderCallback');
// 	Route::get('/google/login', 'Member\GgOpenidController@redirectToProvider');
// 	Route::get('/google/callback', 'Member\GgOpenidController@handleProviderCallback');	
// 	Route::get('/twitter/login', 'Member\TwitterOpenidController@redirectToProvider');
// 	Route::get('/twitter/callback', 'Member\TwitterOpenidController@handleProviderCallback');
// 	Route::get('/ig/login', 'Member\IgOpenidController@redirectToProvider');
// 	Route::get('/ig/callback', 'Member\IgOpenidController@handleProviderCallback');
// 	Route::get('/line/login', 'Member\LineOpenidController@redirectToProvider');
// 	Route::get('/line/callback', 'Member\LineOpenidController@handleProviderCallback');	
// });


//sns ckick
//Route::post('/sns/ev/request', 'Article\SnsController@snsclick');
//Route::post('/sns/evapp/request', 'Article\SnsAppController@snsclick');


//reply
/*
Route::post('/sns/reply/request', 'Article\CmtController@store');
Route::post('/sns/appreply/request', 'Article\CmtAppController@store');
Route::get('/comm/reply/loadmore', 'Article\CmtController@loadreply');
*/


// //PR頁面
// Route::get('/pr/{adid}', 'Pr\Type1Controller@view')->where('adid', '[0-9]+');


// //service
// Route::group(['prefix' => 'service'], function ($router) {
// 	Route::get('/dmca', 'Service\PageController@dmca');
// 	Route::get('/privacy', 'Service\PageController@privacy');
// 	Route::get('/important', 'Service\PageController@important');
// 	Route::get('/report/{id}', 'Service\PageController@report')->where('id', '[0-9]+');
// });

// //app api
// Route::group(['prefix' => 'api'], function ($router) {
// 	Route::get('/allarticle', 'Index\AppController@allArticle');
// });

//sitemap
//Route::get('/sitemap', 'Rd\SitemapController@generate');

//api
// Route::get('/api/getlist/{id?}', 'Api\PostController@index')->where('id', '[0-9]+');
// Route::get('/api/hotlist/{id?}', 'Api\PostController@hotlist')->where('id', '[0-9]+');

// Route::get('/api/tag/{id}/{page?}', 'Api\PostController@tag')->where('id', '[0-9]+');
// Route::get('/api/getTagList', 'Api\PostController@getTagList');
// Route::get('/api/getrelate/{id}', 'Api\PostController@getRelate');

// Route::get('/api/auth/bindauth', 'Api\AuthController@bindcards');
// Route::get('/api/auth/varify', 'Api\AuthController@varify');

// Route::get('/api/auth/getauthcode', 'Api\AuthController@getauthcode');
// Route::get('/api/auth/chklicence', 'Api\AuthController@chklicence');
// Route::get('/api/auth/coupon', 'Api\AuthController@coupon');

/*
Route::get('/api/getpost/{id}', 'Api\PostController@show_api')->where('id', '[0-9]+');
Route::get('/api/getad/{id}', 'Api\PostController@ad')->where('id', '[0-9]+');

Route::get('/api/getreply/{id}/{page}', 'Api\PostController@getreply')->where('id', '[0-9]+');
Route::get('/api/mypost/{userid}/{page?}', 'Api\PostController@mypost')->where('userid', '[0-9]+');
Route::get('/api/myreply/{userid}/{page?}', 'Api\PostController@myreplyart')->where('userid', '[0-9]+');
Route::get('/api/mylike/{userid}/{page?}', 'Api\PostController@mylikeart')->where('userid', '[0-9]+');


Route::get('/api/appconfig', 'Api\AppConfigController@getconfig');
*/
// Route::get('/api/apk/appcadconfig', 'Api\AppConfigController@getconfigAndroid');
// Route::get('/api/ios/appcadconfig', 'Api\AppConfigController@getconfigIos');
// Route::get('/api/ad/detailbnconfig/{type}', 'Api\AppConfigController@getconfigBn');

// Route::get('/api/getver', 'Api\AppConfigController@getVersion');

// Route::get('/api/payment/request', 'Api\AuthController@paymentrequest');
// Route::post('/api/payment/varify', 'Api\AuthController@paymentvarify');

//paypal
// Route::get('/api/payment/paypal/webhook', function() {
// 	return 'hi';
// });


/*
Route::post('/api/formupload', 'Api\FormUpload@getData');
Route::get('/api/user/chk', 'Member\AppOpenidController@loginchk');
Route::post('/api/user/reg', 'Member\AppOpenidController@register');
Route::post('/api/user/update', 'Member\AppOpenidController@infoupdate');
*/

//spider
// Route::get('/spyder/getText', 'Rd\GetTextController@getext');
// Route::get('/spyder/clawpost', 'Rd\GetTextController@clawpost');





// //avdb 爬蟲
// Route::get('/avdb/clawinfo', 'Avdb\ClawController@index');
// Route::get('/avdb/clawavdetail', 'Avdb\ClawController@clawavdetail');

// //javhihi 爬蟲
// Route::get('/avdb/clawjavbuzz', 'Avdb\ClawController@clawjavbuzz');


//avdb page
// Route::get('/censord/{id?}', 'Avdb\IndexController@index')->where('id', '[0-9]+');
// Route::get('/uncensord/{id?}', 'Avdb\IndexController@uncensord')->where('id', '[0-9]+');
// Route::get('/avdbview/{id?}', 'Avdb\IndexController@avdbpostview')->where('id', '[0-9]+');


//event page
// Route::get('/event/dl', 'Event\IndexController@download');
// Route::get('/event/apk/download', 'Event\IndexController@apkdownload');

// Route::get('/event/app/en', 'Event\IndexController@download');
// Route::get('/event/app/tw', 'Event\IndexController@downloadtw');

// Route::get('/event/app/payment/paypal', 'Event\PaymentController@index');
// Route::get('/event/app/payment/paypal/request', 'Event\PaymentController@request');
// Route::post('/event/app/payment/paypal/ipn', 'Event\PaymentController@ipn');
// Route::get('/event/app/payment/paypal/success', 'Event\PaymentController@success');
// Route::get('/event/app/payment/paypal/finish', 'Event\PaymentController@finish');







Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
