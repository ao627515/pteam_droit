<?php

use App\Models\Domaine;
use App\Models\TypeCompte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PartenaireController;
use App\Http\Controllers\PrestationController;
use App\Http\Controllers\ArticleAdminController;
use App\Http\Controllers\OrganisationController;
use App\Http\Controllers\ProduitAdminController;
use App\Http\Controllers\CategorieArticleController;
use App\Http\Controllers\DomaineController;
use App\Http\Controllers\TypeCompteController;

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
    'categorie' => CategorieController::class,
    'categorieArticle' => CategorieArticleController::class,
    'ticket' => TicketController::class,
    'paiement' => PaiementController::class,
    'organisation' => OrganisationController::class,
    'user' => UserController::class,
    'produit' => ProduitController::class,
    'produitAdmin' => ProduitAdminController::class,
    'commande' => CommandeController::class,
    'prestation' => PrestationController::class,
    'typeCompte' => TypeCompteController::class,
    'domaine' => DomaineController::class,
], ['middleware' => ['auth']]);


Route::post('article/{article}/featured_image', [ArticleController::class, 'featured_image'])->name('articleAdmin.featured_image');

Route::post('produit/{produit}/featured_image', [ArticleController::class, 'featured_image'])->name('produitAdmin.featured_image');

Route::get('/login', [UserController::class, 'loginForm'])->name('auth.loginform');
Route::get('/register', [UserController::class, 'registerForm'])->name('auth.registerform');
Route::get('user/change/password', [UserController::class, 'update_password'])->name('user.update_password');


Route::post('/login', [UserController::class, 'login'])->name('auth.login');
Route::post('/register', [UserController::class, 'register'])->name('auth.register');


Route::get('disconnect', [UserController::class, 'disconnect'])->name('disconnect');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('detail', [ProduitController::class, 'detail'])->name('detail');

Route::post('article/{article}/admin/approuved', [ArticleAdminController::class, 'approuved'])->name('articleAdmin.approuved');
Route::post('produit/{produit}/admin/approuved', [ProduitAdminController::class, 'approuved'])->name('produitAdmin.approuved');

Route::post('article/{article}/admin/declined', [ArticleAdminController::class, 'declined'])->name('articleAdmin.declined');
Route::post('produit/{produit}/admin/declinded', [ProduitAdminController::class, 'declined'])->name('produitAdmin.declined');

Route::delete('prestation/{prestation}/detach', [PrestationController::class, 'detach'])->name('prestation.detach');
