<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PartenaireController;
use App\Http\Controllers\ArticleAdminController;
use App\Http\Controllers\OrganisationController;
use App\Http\Controllers\CategorieArticleController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\TestController;
use Illuminate\Http\Request;

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
    return redirect()->route('home.index');
});

// Route::get('/activation', function () {
//     return view('paiement');
// })->name('paiement');

Route::resources([
    'home' => HomeController::class,
]);

Route::resources([
    'partenaire' => PartenaireController::class,
    'article' => ArticleController::class,
    'articleAdmin'=>ArticleAdminController::class,
    'categorie' => CategorieArticleController::class,
    'ticket' => TicketController::class,
    'paiement' => PaiementController::class,
    'organisation' => OrganisationController::class,
    'user' => UserController::class,
    'produit' => ProduitController::class,
    'commande' => CommandeController::class,
], ['middleware' => ['auth']]);


Route::post('article/{article}/featured_image', [ArticleController::class, 'featured_image'])->name('articleAdmin.featured_image');

Route::get('/login', [UserController::class, 'loginForm'])->name('auth.loginform');
Route::get('/register', [UserController::class, 'registerForm'])->name('auth.registerform');


Route::post('/login', [UserController::class, 'login'])->name('auth.login');
Route::post('/register', [UserController::class, 'register'])->name('auth.register');


Route::get('disconnect', [UserController::class, 'disconnect'])->name('disconnect');

Route::get('/dashbord', [DashboardController::class, 'index'])->name('dashboard');

Route::get('detail', [ProduitController::class, 'detail'])->name('detail');

Route::get('article/{article}/admin/approuve', [ArticleAdminController::class, 'approuved'])->name('articleAdmin.approuved');
