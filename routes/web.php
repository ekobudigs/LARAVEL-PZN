<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\InputController;
use App\Http\Controllers\CookieController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\URL;

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
    return view('welcome');
});


Route::get('/pzn', function () {
    return "Eko Budi S";
});

Route::redirect('/youtube', '/pzn');

Route::fallback(function () {
    return "404 By Eko Budi S";
});

Route::view('/hello', 'hello', ["name" => "Eko"]);

Route::get('/hello-again', function() {
    return view('hello', ["name" => "Budi"]);
});


Route::get('/hello-world', function() {
    return view('hello.world', ["name" => "Budi"]);
});

// nama id di url tidak perlu sama dengan yg ada di function / parameter tidak apa" 
Route::get('/products/{id}', function ($productId) {
    return "Product $productId";
})->name('product.detail');


// jika product parameter pertama nanti akan urut ke productId, dan seterusnya
Route::get('/products/{product}/items/{item}', function ($productId, $itemId) {
    return "Product $productId, Item $itemId";
})->name('product.item.detail');

Route::get('/categories/{id}', function($categoryId) {
    return "Category $categoryId";
})->where('id', '[0-9]+');


Route::get('/users/{id?}', function ($userId = '404') {
    return "User $userId";
});


// ini adalah route conflict dibawah ini harus di dahulukan daripada yg ada parameternya 
Route::get('/conflict/eko', function () {
    return "Conflict Eko Budi";
});

Route::get('/conflict/{name}', function ($name) {
    return "Conflict $name";
});

Route::get('/produk/{id}', function($id){
    $link = route('product.detail', ['id' => $id]);
    return "Link $link";
});

Route::get('/produk-redirect/{id}', function($id){
    return redirect()->route('product.detail', ['id' => $id]);
});

Route::prefix('/controller')->controller(HelloController::class)->group(function() {
    Route::get('/hello/request', 'request');
    Route::get('/hello/{name}', 'hello');
});


Route::prefix('/input')->controller(InputController::class)->group(function() {
    Route::get('/hello', 'hello');
    Route::post('/hello', 'hello');
    Route::post('/hello/first', 'hellofirstname');
    Route::post('/hello/input', 'helloinput');
    Route::post('/hello/array', 'helloarray');
    Route::post('/type', 'inputtype');
    Route::post('/filter/only', 'filterOnly');
    Route::post('/filter/except', 'filterExcept');
    Route::post('/filter/merge', 'filterMerge');
});



//Route::post('/file/upload', [FileController::class, 'upload'])->whiteoutMiddleware([VerifyCsrfToken::class]);
Route::prefix('/response')->controller(ResponseController::class)->group(function() {
    Route::get('/hello', 'response');
    Route::get('/header', 'header');
});


Route::prefix('/response/type')->controller(ResponseController::class)->group(function () {
    Route::get('/view',  'responseView');
    Route::get('/json', 'responseJson');
    Route::get('/file', 'responseFile');
    Route::get('/download', 'responseDownload');
});


Route::controller(CookieController::class)->group(function() {
    Route::get('/cookie/set', 'createCookie');
    Route::get('/cookie/get', 'getCookie');
    Route::get('/cookie/clear', 'clearCookie');
});

Route::prefix('/redirect')->controller(RedirectController::class)->group(function() {
    Route::get('/to', 'redirectTo');
    Route::get('/from','redirectFrom');
    Route::get('/name', 'redirectName');
    Route::get('/name/{name}', 'redirectHello')->name('redirect-hello');
    Route::get('/action', 'redirectAction');
    Route::get('/away', 'redirectAway');
});



Route::get('/redirect/named', function() {
    // return route('redirect-hello', ['name' => 'eko']);
    return URL::route('redirect-hello', ['name' => 'eko']);
});



Route::get('middleware/api', function() {
    return "OK";
})->middleware(['contoh']);


Route::middleware(['pzn', 'sample:PZN,401'])->prefix('/middleware')->group(function () {
    Route::get('/group', function() {
        return "GROUP";
    });
    
    Route::get('/params', function() {
        return "OK";
    });
});

// Route::get('middleware/group', function() {
//     return "GROUP";
// })->middleware(['pzn']);

// Route::get('middleware/params', function() {
//     return "OK";
// })->middleware(['sample:PZN,401']);

Route::get('/url/action', function() {
    return URL::action([FormController::class, 'form'], []);
});
Route::controller(FormController::class)->group(function() {
    Route::get('/form', 'form');
    Route::post('/form', 'submitform');
});



Route::get('/url/current', function () {
    return URL::full();
});

Route::prefix('/session')->controller(SessionController::class)->group(function() {
    Route::get('/create', 'createSession');
    Route::get('/get', 'getSession');
});

Route::get('/error/sample', function() {
    throw new Exception("Sample Error");
});