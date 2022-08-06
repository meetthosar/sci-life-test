<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::prefix('leads')->group(function (){
        Route::get('/', [\App\Http\Controllers\LeadController::class, 'index'])->name('leads.index');
        Route::get('/import', [\App\Http\Controllers\LeadController::class, 'upload'])->name('leads.upload');
        Route::post('/import', [\App\Http\Controllers\LeadController::class, 'import'])->name('leads.import');
        Route::post('/proceed', [\App\Http\Controllers\LeadController::class, 'proceed'])->name('leads.proceed');
        Route::get('/proceed', [\App\Http\Controllers\LeadController::class, 'index'])->name('leads.proceed.refresh');
    });

});

Route::get('/categories', function (){


     $sql = "WITH RECURSIVE tree_view AS (
    SELECT category_id, name, parent,
           1 AS level,
           concat(category_id) as order_sequence

    FROM category
    WHERE category.parent IS NULL

    UNION ALL

    SELECT parent.category_id,
           parent.name,
           parent.parent,
           level + 1 AS level,
            concat(order_sequence,'_',parent.category_id) as order_sequence

    FROM category parent
    JOIN tree_view tv
    ON parent.parent = tv.category_id
)
SELECT
        name, parent, level, order_sequence
FROM tree_view";

     $result = DB::getPdo()->prepare($sql);
     $result->execute();

     $categories = $result->fetchAll();

     return Inertia::render('Categories',['categories' => $categories]);
})->name('categories');

