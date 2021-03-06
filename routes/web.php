<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InstitucionalController;


//---- ROTAS
Route::get('/',                                             [HomeController::class, 'index']);
Route::get('/home',                                         [HomeController::class, 'index'])->name('home');
Route::get('lojavirtual',                                   [StoreController::class, 'index'])->name('lojavirtual');


Route::get('jewelry/collection/{collection}',               [StoreController::class, 'collection'])->name('store.collection');
Route::get('jewelry/collections/123',                       [StoreController::class, 'collections'])->name('store.collections');
Route::get('jewelry/all_collections/123',                   [StoreController::class, 'all_collections'])->name('store.all_collections');

Route::get('jewelry/category/{category}',                   [StoreController::class, 'category'])->name('store.category');
Route::get('jewelry/product/{product}',                     [StoreController::class, 'product'])->name('store.product');
Route::get('jewelry/topic/{topic}',                         [StoreController::class, 'topic'])->name('store.topic');
Route::get('jewelry/cart',                                  [StoreController::class, 'cart'])->name('store.cart');
Route::get('jewelry/order',                                 [StoreController::class, 'order'])->name('store.order');
Route::get('jewelry/checkout/{order}/{operadora?}',         [StoreController::class, 'checkout'])->name('store.checkout');
Route::post('jewelry/exception/{order_data}',               [StoreController::class, 'exception'])->name('store.exception');
Route::post('jewelry/success/{order_data}',                 [StoreController::class, 'success'])->name('store.success');



Route::get('cart/get_session',                              [CartController::class, 'get_session'])->name('cart.get.session');
Route::get('cart/add/{product}/{redirect}',                 [CartController::class, 'add'])->name('cart.add');
Route::get('cart/remove/{id}',                              [CartController::class, 'remove'])->name('cart.remove');
Route::get('cart/aro/{aro}/{tamanho}',                      [CartController::class, 'aro'])->name('cart.aro');
Route::get('cart/aro/destruir/{aro}',                       [CartController::class, 'aro_destruir'])->name('cart.aro_destruir');




Route::get('/dashboard',                                    [DashBoardController::class, 'index'])->name('dashboard')->middleware(['auth', 'verified']);
Route::get('/dashboard/index',                              [DashBoardController::class, 'index'])->name('dashboard')->middleware(['auth', 'verified']);


Route::get('user/index',                                    [UserController::class, 'index'])->name('user.index')->middleware(['auth', 'verified']);
Route::get('user/create',                                   [UserController::class, 'create'])->name('user.create')->middleware(['auth', 'verified']);
Route::get('user/store',                                    [UserController::class, 'store'])->name('user.store')->middleware(['auth', 'verified']);
Route::get('user/edit/{user}',                              [UserController::class, 'edit'])->name('user.edit')->middleware(['auth', 'verified']);
Route::post('user/update/{user}',                           [UserController::class, 'update'])->name('user.update')->middleware(['auth', 'verified']);
Route::get('user/destroy/{user}',                           [UserController::class, 'destroy'])->name('user.destroy')->middleware(['auth', 'verified']);
Route::get('user/password/{user}',                          [UserController::class, 'password'])->name('user.password')->middleware(['auth', 'verified']);
Route::get('user/update_password/{user}',                   [UserController::class, 'update_password'])->name('user.update.password')->middleware(['auth', 'verified']);


Route::get('institutional/garantia',                        [InstitucionalController::class, 'garantia'])->name('institutional.garantia');
Route::get('institutional/devolucao_reembolso',             [InstitucionalController::class, 'devolucao_reembolso'])->name('institutional.devolucao.reembolso');
Route::get('institutional/privacy',                         [InstitucionalController::class, 'privacy'])->name('institutional.privacy');
Route::get('institutional/terms',                           [InstitucionalController::class, 'terms'])->name('institutional.terms');

Route::get('institutional/designer/123',                    [InstitucionalController::class, 'designer'])->name('institutional.designer');
Route::get('institutional/enderecos/123',                   [InstitucionalController::class, 'enderecos'])->name('institutional.enderecos');
Route::get('institutional/clipping/123',                    [InstitucionalController::class, 'clipping'])->name('institutional.clipping');
Route::get('institutional/clip/{clip}',                     [InstitucionalController::class, 'clip'])->name('institutional.clip');
Route::get('institutional/events',                          [InstitucionalController::class, 'events'])->name('institutional.events');
Route::get('institutional/event/{event}}',                  [InstitucionalController::class, 'event'])->name('institutional.event');
Route::get('institutional/peoples',                         [InstitucionalController::class, 'peoples'])->name('institutional.peoples');
Route::get('institutional/people/{pessoa}',                 [InstitucionalController::class, 'people'])->name('institutional.people');
Route::get('institutional/highlight/{highlight}',           [InstitucionalController::class, 'highlight'])->name('institutional.highlight');


Route::get('image/download/{id}',                                   [ImageController::class, 'download'])->name('image.download');

require __DIR__.'/auth.php';
