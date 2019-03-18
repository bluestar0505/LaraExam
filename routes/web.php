<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', ['uses' => 'HomeController@index', 'as' => 'web.index']);


Route::group(['middleware' => 'auth'], function () {

    Route::group(['middleware' => 'logincheck'], function () {

//        Route::group(['middleware' => 'paid'], function () {
        Route::get('/home', ['as' => 'home', 'uses' => 'CategoryCtrl@index']);

        Route::get('/SFEngineering', ['as' => 'categoryQA.show', 'uses' => 'CategoryCtrl@categoriesQA']);
        Route::get('/JFMathematics', ['as' => 'categoryMA.show', 'uses' => 'CategoryCtrl@categoriesMA']);

        Route::get('category', ['as' => 'category.index', 'uses' => 'CategoryCtrl@index']);
        Route::get('category/{id}', ['as' => 'category.show', 'uses' => 'CategoryCtrl@show']);

        Route::get('categoriesQA/{id}', ['as' => 'categoriesQA.show', 'uses' => 'CategoryCtrl@showQA']);

        Route::get('/DefaultTab', ['as' => 'DefaultTab', 'uses' => 'CategoryCtrl@DefaultTab']);
        Route::get('/suggestion', ['as' => 'suggestion', 'uses' => 'CategoryCtrl@suggestion']);
        Route::get('/suggestion/papererror', ['as' => 'suggestion', 'uses' => 'CategoryCtrl@paperError']);
        Route::get('/deletesuggestion', ['as' => 'deletesuggestion', 'uses' => 'CategoryCtrl@deletesuggestion']);
        Route::get('/deletenotification', ['as' => 'deletenotification', 'uses' => 'CategoryCtrl@deletenotification']);
        Route::get('/addnotify', ['as' => 'addnotify', 'uses' => 'CategoryCtrl@addnotify']);
        Route::get('/getnotifications', ['as' => 'getnotifications', 'uses' => 'CategoryCtrl@getnotifications']);
        Route::get('/unseennotifications', ['as' => 'unseennotifications', 'uses' => 'CategoryCtrl@unseennotifications']);
        Route::get('/Updateunseennotifications', ['as' => 'Updateunseennotifications', 'uses' => 'CategoryCtrl@Updateunseennotifications']);

        Route::get('paper/{id}', ['as' => 'paper.show', 'uses' => 'PaperCtrl@show']);
        Route::get('paperQA/{id}', ['as' => 'paper.qa.index', 'uses' => 'QuestionsCtrl@index']);
        Route::post('paperQA/{id}/ask', ['as' => 'paper.qa.new', 'uses' => 'QuestionsCtrl@postNewQuestion']);
        Route::get('paperQA/question/{id}/view', ['as' => 'paper.qa.view', 'uses' => 'QuestionsCtrl@view']);
        Route::get('paperQA/question/{id}/delete', ['as' => 'paper.qa.delete', 'uses' => 'QuestionsCtrl@delete']);
        Route::get('paperQA/answer/{id}/delete', ['as' => 'paper.answer.delete', 'uses' => 'QuestionsCtrl@answerDelete']);
        Route::post('paperQA/answer', ['as' => 'paper.qa.answer.post', 'uses' => 'QuestionsCtrl@postNewAnswer']);
//        });

        Route::get('QuestionDetail/{id}', ['as' => 'QuestionDetail.show', 'uses' => 'PaperCtrl@QuestionDetail']);
        Route::get('AskQuestion/{id}', ['as' => 'AskQuestion.show', 'uses' => 'PaperCtrl@AskQuestion']);
        Route::resource('profile', 'ProfileCtrl', ['only' => ['index', 'store']]);

        Route::post('search', ['uses' => 'SearchCtrl@submit', 'as' => 'search.submit']);
        Route::get('search/{keyword}', ['uses' => 'SearchCtrl@show', 'as' => 'search.show']);

        // admin
        Route::post('admin/dropzone/upload', ['uses' => 'Admin\UploadsManagerController@submit', 'as' => 'dropzone.upload']);
        Route::post('admin/dropzone/delete', ['uses' => 'Admin\UploadsManagerController@delete', 'as' => 'dropzone.delete']);
        Route::post('admin/notify/create', ['uses' => 'Admin\NotifyController@create', 'as' => 'notify.create']);
        Route::get('admin/purchases', ['uses' => 'Admin\PurchaseHistoryController@index', 'as' => 'admin.purchases']);


        Route::get('paperQA/question/{questionId}/subscribe-toggle', ['as' => 'paper.qa.subscribe-toggle', 'uses' => 'QuestionsCtrl@xhrQuestionSubscribeToggle']);
        Route::get('paperQA/question/{questionId}/vote', ['as' => 'paper.qa.vote', 'uses' => 'QuestionsCtrl@xhrVoteQuestion']);
        Route::get('paperQA/answer/{answerId}/vote', ['as' => 'paper.answer.vote', 'uses' => 'QuestionsCtrl@xhrVoteAnswer']);

        Route::get('/dopay', 'PayPalController@dopay');

        Route::get('buy-more', ['uses' => 'PayPalController@buyMoreTokens', 'as' => 'buy-more.index']);
        Route::get('catalogue', ['uses' => 'CatalogueCtrl@index', 'as' => 'catalogue.index']);
        Route::get('favorites', ['uses' => 'CatalogueCtrl@favorites', 'as' => 'catalogue.favorites']);
        Route::get('buy-paper', ['uses' => 'CatalogueCtrl@buyPaper', 'as' => 'catalogue.buy']);
        Route::get('xhr/buy-paper', ['uses' => 'CatalogueCtrl@xhrBuyPaper', 'as' => 'xhr.catalogue.buy']);
        Route::get('toggle-fav', ['uses' => 'CatalogueCtrl@favToggle', 'as' => 'catalogue.fav']);

        Route::get('paper/{id}/like', ['uses' => 'CatalogueCtrl@like', 'as' => 'paper.like']);
        Route::get('paper/{id}/unlike', ['uses' => 'CatalogueCtrl@unlike', 'as' => 'paper.unlike']);
        Route::get('paper/{id}/dislike', ['uses' => 'CatalogueCtrl@dislike', 'as' => 'paper.dislike']);
        Route::get('paper/{id}/undislike', ['uses' => 'CatalogueCtrl@undislike', 'as' => 'paper.undislike']);
    });

    Route::group(['prefix' => 'paypal'], function () {
        Route::post('create', ['as' => 'pp:create', 'uses' => 'PayPalController@postCreate']);
        Route::post('done', ['as' => 'pp:done', 'uses' => 'PayPalController@getDone']); //excluded from middleware csrf
        Route::get('cancel', ['as' => 'pp:cancel', 'uses' => 'PayPalController@getCancel']);
    });
    Route::get('logout', 'UsersController@logout');
    Route::get('/CheckUserStatus', 'UsersController@CheckUserStatus');
});

Auth::routes();
Route::get('user/activation/{token}', 'Auth\ActivationController@activateUser')->name('user.activate');

Route::get('login', 'HomeController@index');
Route::get('register', 'HomeController@index');
Route::get('/paypal', 'PayPalController@index');

