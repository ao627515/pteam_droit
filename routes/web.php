<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\DomaineController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PartenaireController;
use App\Http\Controllers\PrestationController;
use App\Http\Controllers\TypeCompteController;
use App\Http\Controllers\ArticleAdminController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrganisationController;
use App\Http\Controllers\ProduitAdminController;
use App\Http\Controllers\PartenaireAdminController;
use App\Http\Controllers\CategorieArticleController;

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


// Redirect root URL to 'home.index'
Route::redirect('/', 'home');

// Route accesible en tout temps
Route::resource('home', HomeController::class)->only('index');
Route::get('organisation/{organisation}', [OrganisationController::class, 'show'])->name('organisation.show');
Route::resource('produit', ProduitController::class)->only(['index']);
Route::resource('partenaire', PartenaireController::class)->only('index');
Route::resource('categorieArticle', CategorieArticleController::class)->only('show')->parameter('categorieArticle', 'categorie');

// Routes for authenticated users
Route::middleware(['auth'])->group(function () {
    // Resource routes
    Route::resources([
        'partenaireAdmin' => PartenaireAdminController::class,
        'article' => ArticleController::class,
        'articleAdmin' => ArticleAdminController::class,
        'categorie' => CategorieController::class,
        'ticket' => TicketController::class,
        'paiement' => PaiementController::class,
        // 'organisation' => OrganisationController::class,
        'user' => UserController::class,
        'produitAdmin' => ProduitAdminController::class,
        'commande' => CommandeController::class,
        'prestation' => PrestationController::class,
        'typeCompte' => TypeCompteController::class,
        'domaine' => DomaineController::class,
    ]);

    // Custom routes
    Route::resource('organisation', OrganisationController::class)->except('show');
    Route::get('partenaire/{partenaire}', [PartenaireController::class, 'show'])->name('partenaire.show');
    Route::get('produit/{produit}', [ProduitController::class, 'show'])->name('produit.show');
    Route::post('article/{article}/featured_image', [ArticleController::class, 'featured_image'])->name('articleAdmin.featured_image');
    Route::post('produit/{produit}/featured_image', [ArticleController::class, 'featured_image'])->name('produitAdmin.featured_image');
    Route::post('article/{article}/admin/approuved', [ArticleAdminController::class, 'approuved'])->name('articleAdmin.approuved');
    Route::post('produit/{produit}/admin/approuved', [ProduitAdminController::class, 'approuved'])->name('produitAdmin.approuved');
    Route::post('partenaire/{partenaire}/admin/approuved', [ProduitAdminController::class, 'approuved'])->name('partenaireAdmin.approuved');
    Route::post('produit/{produit}/admin/declined', [ProduitAdminController::class, 'declined'])->name('produitAdmin.declined');
    Route::post('article/{article}/admin/declined', [ArticleAdminController::class, 'declined'])->name('articleAdmin.declined');
    Route::post('partenaire/{partenaire}/admin/declined', [PartenaireAdminController::class, 'declined'])->name('partenaireAdmin.declined');
    Route::delete('prestation/{prestation}/detach', [PrestationController::class, 'detach'])->name('prestation.detach');
    Route::post('domaine/change', [DomaineController::class, 'change'])->name('domaine.change');
    Route::post('article/{article}/publish', [ArticleAdminController::class, 'publish'])->name('articleAdmin.publish');
    Route::post('produit/{produit}/publish', [ProduitAdminController::class, 'publish'])->name('produitAdmin.publish');
    Route::get('user/change/password', [UserController::class, 'update_password'])->name('user.update_password');
    Route::get('disconnect', [UserController::class, 'disconnect'])->name('disconnect');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('notification', [NotificationController::class, 'index'])->name('notifications');
});

// Routes for guests (not authenticated users)
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [UserController::class, 'loginForm'])->name('auth.loginform');
    Route::get('/register', [UserController::class, 'registerForm'])->name('auth.registerform');
    Route::post('/login', [UserController::class, 'login'])->name('auth.login');
    Route::post('/register', [UserController::class, 'register'])->name('auth.register');
});
