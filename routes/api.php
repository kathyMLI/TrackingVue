<?php

use Illuminate\Http\Request;


Route::group(['middleware' => ['auth:api', 'admin'], 'namespace' => 'Api'], function () {
    Route::resource('announcements', 'AnnouncementsController', ['only' => [
        'store', 'update', 'destroy'
    ]]);
    Route::resources(['users' => 'UsersController']);
    Route::resources(['roles' => 'RolesController']);
    Route::get('trackings', 'TrackingsController@index');
    Route::get('permissions', 'PermissionsController@index');
});

Route::group(['middleware' => 'auth:api', 'namespace' => 'Api'], function () {
    Route::resource('trackings', 'TrackingsController', ['only' => [
        'store', 'update', 'destroy', 'show'
    ]]);
    Route::get('/me', function (Request $request) {
        return $request->user()->load('notifications');
    });
    Route::get('me/trackings', function (Request $request) {
        return $request->user()->trackings()->paginate();
    });
    Route::post('/markNotificationsAsRead', function (Request $request) {
        $request->user()->unreadNotifications()->update(['read_at' => \Carbon\Carbon::now()]);
    });
    Route::get('announcements', 'AnnouncementsController@index');
});
