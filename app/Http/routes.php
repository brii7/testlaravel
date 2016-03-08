<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/





/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {

    Route::get('/', function () {

        if(Auth::guest()) {
            return view('welcome');
        }
        else {
            return Redirect::route('dashboard');
        }
    });

    Route::get('/home',['as' => 'dashboard', function() {
        if(Auth::guest()) {
            return view('welcome');
        }
        else {
            return view('home');
        }
    }]);

    Route::group(['prefix' => 'messages'], function () {
        Route::get('/', ['as' => 'messages', 'uses' => 'MessagesController@index']);
        Route::get('create', ['as' => 'messages.create', 'uses' => 'MessagesController@create']);
        Route::post('/', ['as' => 'messages.store', 'uses' => 'MessagesController@store']);
        Route::get('{id}', ['as' => 'messages.show', 'uses' => 'MessagesController@show']);
        Route::put('{id}', ['as' => 'messages.update', 'uses' => 'MessagesController@update']);
    });


    Route::auth();
    Route::post('/register', array('as' => 'register', 'uses' => 'Auth\AuthController@postRegister'));
    Route::get('/notifications', ['as' => 'notifications', 'uses' => 'NotificationsController@index']);

    // Profile
    Route::get('/profile', array('as' => 'profile', 'uses' => 'UserController@showProfile'));
    Route::get('/profile/edit', array('as' => 'profile.edit', 'uses' => 'UserController@updateProfile'));
    Route::get('/profile/changepass', array('as' => 'profile.changepass', 'uses' => 'UserController@changePass'));
    Route::post('/profile/changepass/do', array('as' => 'profile.updatepass', 'uses' => 'UserController@updatePass'));

    // Tasks
    Route::get('/tasks', array('as' => 'tasks', 'uses' => 'TaskController@index'));
    Route::post('/task', 'TaskController@store');
    Route::get('/task/{task}/finish', array ('as' => 'tasks.finish', 'uses' => 'TaskController@finish'));
    Route::delete('/task/{task}', array('as' => 'tasks.delete', 'uses' => 'TaskController@destroy'));

    // Users
    Route::get('/users', array('as' => 'users', 'uses' => 'UserController@userList'));
    Route::get('/users/notify/{user}', array('as' => 'users.addnotification', 'uses' => 'NotificationsController@add'));
    Route::post('/users/notify/{user}', array('as' => 'users.notify', 'uses' => 'NotificationsController@notify'));

    //Datatables
    Route::controller('datatables', 'DatatablesController', [
        'anyData'  => 'datatables.data',
        'getIndex' => 'datatables',
    ]);

    //Notifications
    Route::get('/notifications', array('as' => 'notifications', 'uses' => 'NotificationsController@index'));
    Route::get('/notifications/{notification}', array('as' => 'notifications.see','uses' => 'NotificationsController@see'));
    Route::get('/notifications/readAll', array('as' => 'notifications.readAll','uses' => 'NotificationsController@readAll'));

    //Assignments
    Route::get('/assignments', array('as' => 'assignments', 'uses' => 'AssignmentController@index'));
    Route::get('/assignments/add', array('as' => 'assignments.add', 'uses' => 'AssignmentController@addForm'));
    Route::post('/assignments/add', array('as' => 'assignments.add', 'uses' => 'AssignmentController@add'));

});




