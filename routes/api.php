<?php

use Illuminate\Http\Request;


Route::group(['middleware' => ['auth:api', 'admin'], 'namespace' => 'Api'], function () {
    Route::resources(['users' => 'UsersController']);
    Route::resources(['roles' => 'RolesController']);
    Route::get('trackings', 'TrackingsController@all');
    Route::get('permissions', 'PermissionsController@index');
});
Route::group(['middleware' => 'auth:api', 'namespace' => 'Api'], function () {
    Route::resources(['users.trackings' => 'TrackingsController']);
    Route::get('/trackings/{tracking}', 'TrackingsController@show');
    Route::get('/me', function (Request $request) {
        return $request->user()->load('notifications', 'trackings');
    });

    Route::post('/markNotificationsAsRead', function (Request $request) {
        $request->user()->unreadNotifications()->update(['read_at' => \Carbon\Carbon::now()]);
    });
});
