<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::view('/menu', 'menu')->name('menu');

Route::get('/images/Menu.png', function () {
	$candidates = [
		public_path('images/Menu.png'),
		base_path('images/Menu.png'),
		resource_path('assets/Menu.png'),
	];

	foreach ($candidates as $path) {
		if (file_exists($path)) {
			return response()->file($path);
		}
	}

	abort(404);
})->name('menu.image');
