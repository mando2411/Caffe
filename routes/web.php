<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::view('/menu', 'menu')->name('menu');
Route::view('/qr', 'qr')->name('qr.landing');
Route::redirect('/inside', '/qr');

Route::get('/language/{locale}', function (string $locale) {
	$supportedLocales = ['ar_SA', 'en'];

	if (in_array($locale, $supportedLocales, true)) {
		session(['app_locale' => $locale]);
	}

	return redirect()->back();
})->name('language.switch');

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

Route::get('/assets/app.css', function () {
	$candidates = [
		...glob(public_path('build/assets/app-*.css')),
		public_path('fallback/app.css'),
	];

	foreach ($candidates as $path) {
		if ($path && file_exists($path)) {
			return response(file_get_contents($path), 200, [
				'Content-Type' => 'text/css; charset=UTF-8',
				'Cache-Control' => 'public, max-age=3600',
			]);
		}
	}

	abort(404);
})->name('asset.app.css');

Route::get('/assets/app.js', function () {
	$candidates = [
		...glob(public_path('build/assets/app-*.js')),
		public_path('fallback/app.js'),
	];

	foreach ($candidates as $path) {
		if ($path && file_exists($path)) {
			return response(file_get_contents($path), 200, [
				'Content-Type' => 'application/javascript; charset=UTF-8',
				'Cache-Control' => 'public, max-age=3600',
			]);
		}
	}

	abort(404);
})->name('asset.app.js');
