<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PhaseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskHistoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

Route::get('task/{uuid}', [ClientController::class, 'previewTask'])->name('task.client.preview');

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'prevent-back-history']
    ], function () {
    Route::group([
        'controller' => LoginController::class,
        'middleware' => ['guest']
    ], function () {
        Route::get('/login', 'login')->name('login-page');
        Route::post('/login', 'loginProcess')->name('login');
        Route::post('/logout', 'logout')->name('logout')->withoutMiddleware('guest')->middleware('auth');
    });

    Route::group
    (
        [
            'middleware' => ['auth']
        ],
        function () {
            // home
            Route::group(
                [
                    'controller' => HomeController::class,
                ], function () {
                Route::get('/', 'index')->name('home');
            });

            // profile
            Route::group(
                [
                    'prefix' => 'profile',
                    'as' => 'profile.',
                    'controller' => ProfileController::class,
                ], function () {
                Route::get('/', 'index')->name('index');
                Route::post('/change-password', 'changePassword')->name('change-password');
            });
            //admins
            Route::group(
                [
                    'prefix' => 'admins',
                    'as' => 'admin.',
                    'middleware' => ['isAdmin'],
                    'controller' => UserController::class,
                ], function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/{user}/edit', 'edit')->name('edit');
                Route::put('/{user}', 'update')->name('update');
                Route::delete('/{user}', 'destroy')->name('destroy');
            });

            // status
            Route::group(
                [
                    'prefix' => 'status',
                    'as' => 'status.',
                    'middleware' => ['isAdmin'],
                    'controller' => StatusController::class,
                ], function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/{status}/edit', 'edit')->name('edit');
                Route::put('/{status}', 'update')->name('update');
            });

            // phase
            Route::group(
                [
                    'prefix' => 'phases',
                    'as' => 'phase.',
                    'middleware' => ['isAdmin'],
                    'controller' => PhaseController::class,
                ], function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/{phase}/edit', 'edit')->name('edit');
                Route::put('/{phase}', 'update')->name('update');
            });

            // tasks

            Route::group(
                [
                    'prefix' => 'tasks',
                    'as' => 'task.',
                    'middleware' => ['isAdmin'],
                    'controller' => TaskController::class,
                ], function () {
                Route::get('/', 'index')->name('index')->withoutMiddleware('isAdmin');
                Route::get('/create', 'create')->name('create');
                Route::get('/{task}/show', 'show')->name('show')->withoutMiddleware('isAdmin');
                Route::put('/{task}/change-task', 'changeStatusPhaseAndEmployeeOfTask')
                    ->name('updateStatusPhaseAndEmployee')->withoutMiddleware('isAdmin');
                Route::post('/store', 'store')->name('store');
                Route::get('/{task}/edit', 'edit')->name('edit')->withoutMiddleware('isAdmin');
                Route::put('/{task}', 'update')->name('update')->withoutMiddleware('isAdmin');
                Route::delete('/{task}', 'destroy')->name('destroy');
                Route::get('/{user}/employee-tasks', 'getEmployeeTasks')->name('employeeTasks');
                Route::get('/get-status-phase-of-task/{task}', 'getPhaseStatusAndEmployeeOfTask')
                    ->name('getPhaseStatusAndEmployeeOfTask');
            });

            // Task History
            Route::group(
                [
                    'prefix' => 'task-history',
                    'as' => 'task-history.',
                    'controller' => TaskHistoryController::class,
                ], function () {
                Route::get('/', 'index')->name('index');
            });
            // clients
            Route::get('/client-search', [ClientController::class, 'search'])->name('client.search')->middleware('isAdmin');
            Route::get('clients/phases', [ClientController::class, 'clientsPhases'])->name('client.phases')->middleware('isAdmin');
            // filter
            Route::get('/filter/index', [FilterController::class, 'index'])->name('filter.index')->middleware('isAdmin');
        });


});
