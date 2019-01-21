<?php

	Route::group([
		'namespace' => 'Jdsf\MiniForum\Api\Controller',
		'prefix' => 'api',
	], function () {
		Route::resource('posts', 'PostController',['only' => ['index']]);
	});


	Route::group([
		'namespace' => 'Jdsf\MiniForum\Api\Controller',
		'prefix' => 'api',
		'middleware' => 'auth:api',
	], function () {
		Route::resource('posts', 'PostController',['except' => ['index']]);
		Route::resource('comments', 'CommentController');
		Route::resource('zans', 'ZanController');
		Route::post('zans/cancel', 'ZanController@cancelZan');

	});
