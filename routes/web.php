<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderLineController;
use Illuminate\Support\Facades\Route;


/*
    Rutas de Usuarios
*/
Route::get('/', [UserController::class, 'home'])->name('home');
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register', [UserController::class, 'registerPost'])->name('registerPost');
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'loginPost'])->name('loginPost');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/user/edit/{user}', [UserController::class, 'edit'])->name('userEdit');
Route::put('/user/editName/{user}', [UserController::class, 'editNamePut'])->name('userEditNamePut');
Route::put('/user/editEmail/{user}', [UserController::class, 'editEmailPut'])->name('userEditEmailPut');
Route::put('/user/editPassword/{user}', [UserController::class, 'editPasswordPut'])->name('userEditPasswordPut');
Route::put('/user/editIsAdmin/{user}', [UserController::class, 'editIsAdminPut'])->name('userEditIsAdminPut');
Route::get('/user/list', [UserController::class, 'list'])->name('userList');
Route::delete('/user/delete/{user}', [UserController::class, 'delete'])->name('userDelete');

/*
    Rutas de Categorías
*/
Route::get('/categories', [CategoryController::class, 'list'])->name('categoryList');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categoryCreate');
Route::post('/categories/create', [CategoryController::class, 'createPost'])->name('categoryCreatePost');
Route::get('/categories/edit/{category}', [CategoryController::class, 'edit'])->name('categoryEdit');
Route::put('/categories/edit/{category}', [CategoryController::class, 'editPut'])->name('categoryEditPut');
Route::delete('/categories/delete/{category}', [CategoryController::class, 'delete'])->name('categoryDelete');

/*
    Rutas de Productos
*/
Route::get('/products', [ProductController::class, 'list'])->name('productList');
Route::get('/products/create', [ProductController::class, 'create'])->name('productCreate');
Route::post('/products/create', [ProductController::class, 'createPost'])->name('productCreatePost');
Route::get('/products/edit/{product}', [ProductController::class, 'edit'])->name('productEdit');
Route::put('/products/edit/{product}', [ProductController::class, 'editPut'])->name('productEditPut');
Route::delete('/products/delete/{product}', [ProductController::class, 'delete'])->name('productDelete');
Route::get('/products/{category}', [ProductController::class, 'listByCategory'])->name('productListByCategory');

/*
    Rutas de Carrito
*/
Route::get('/cart', [CartController::class, 'list'])->name('cartList');
Route::get('/cart/add/{product}', [CartController::class, 'addItem'])->name('cartAdd');
Route::delete('/cart/delete/{item}', [CartController::class, 'deleteItem'])->name('cartItemDelete');
Route::put('/cart/change/{item}/{amount}', [CartController::class, 'changeAmountItem'])->name('changeAmountItem');
Route::delete('/cart/delete/', [CartController::class, 'deleteAll'])->name('cartDeleteAll');

/*
    Rutas de Pedidos
*/
Route::get('/orders', [OrderController::class, 'list'])->name('orderList');
Route::get('/orders/create', [OrderController::class, 'create'])->name('orderCreate');
Route::post('/orders/create', [OrderController::class, 'createPost'])->name('orderCreatePost');

/*
    Rutas de Lineas de Pedido
*/
Route::get('/order/lines/{order}', [OrderLineController::class, 'list'])->name('orderLineList');