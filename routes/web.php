<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'is_admin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('/home', [App\Http\Controllers\Admin\HomeController::class, 'index'])
            ->name('home');

        Route::get('/articles/edit/{id}', [App\Http\Controllers\ArticlesController::class, 'edit_view'])
            ->name('article.edit.view');
        Route::post('/articles/update/{id}', [App\Http\Controllers\ArticlesController::class, 'edit_store'])
            ->name('article.edit.update');

        Route::post('/body/image/store', [App\Http\Controllers\ArticlesController::class, 'uploadfiles'])
            ->name('upload.image');

        Route::get('/articles/create', [App\Http\Controllers\ArticlesController::class, 'create_view'])
            ->name('article.create.view');
        Route::post('/articles/store', [App\Http\Controllers\ArticlesController::class, 'store'])
            ->name('article.create.store');
    });


    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
Route::get('/article/detail/{id}', [App\Http\Controllers\ArticlesController::class, 'showdetail'])->name('detail');