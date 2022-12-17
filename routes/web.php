<?php

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

use App\Product;

Route::get('/', 'HomeController@index')->name('home');
Route::get('/product/{slug}', 'HomeController@single')->name('product.single');
Route::get('/category/{slug}', 'CategoryController@index')->name('category.single');
Route::get('/store/{slug}', 'StoreController@index')->name('store.single');

Route::prefix('cart')->name('cart.')->group(function(){
    Route::get('/', 'CartController@index')->name('index');
    Route::post('add', 'CartController@add')->name('add');

    Route::get('remove/{slug}', 'CartController@remove')->name('remove');
    Route::get('cancel', 'CartController@cancel')->name('cancel');

});

Route::prefix('checkout')->name('checkout.')->group(function(){
    Route::get('/', 'CheckoutController@index')->name('index');
    Route::post('/proccess', 'CheckoutController@proccess')->name('proccess');
    Route::get('/thanks', 'CheckoutController@thanks')->name('thanks');

    Route::post('/notification', 'CheckoutController@notification')->name('notification');


});

Route::get('my-orders', 'UserOrderController@index')->name('user.orders')->middleware('auth');

Route::group(['middleware' => ['auth', 'access.control.store.admin']], function(){

    Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function(){        
        Route::get('notifications', 'NotificationController@notifications')->name('notifications.index');
        Route::get('notifications/read-all', 'NotificationController@readAll')->name('notifications.read.all');
        Route::get('notifications/read/{notification}', 'NotificationController@read')->name('notifications.read');

        Route::resource('stores', 'StoreController');
        Route::resource('products', 'ProductController');
        Route::resource('categories', 'CategoryController');

        Route::post('photos/remove', 'ProductPhotoController@removePhoto')->name('photo.remove');
         
        Route::get('orders/my', 'OrdersController@index')->name('orders.my');
    });
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/model', function () {
    // $products = \App\Product::all();

    // ACTIVE RECORD
    // \App\User::all(); --> retorna todos os usuários
    // \App\User::find(3); --> retorna usuário com base no id
    // \App\User::paginate(10); paginar dados

    // MASS ASSIGNMENT
    // $user = \App\User::create([
    //     'name' => 'Hermeson',
    //     'email' => 'hermeson@gmail.com',
    //     'password' => bcrypt('123456678')
    // ]);
    // MASS UPDATE
    // $user = \App\User::find(40);
    // $user = $user->update([
    //     'name' => 'Atualizando com mass update'
    // ]);
    // dd($user);

    //Como pegar a loja de um usuario?
    // $user = \App\User::find(4);
    // $user->store;

    //Como pegar os produtos de uma loja?
    // $loja= \app\Store::find(1);
    // return $loja->products; 

    // Como pegar as lojas de uma categoria?
    // $categoria= \App\Category::find(1);
    // $categoria->products;

    //Como criar uma loja para um usuario?
    // $user = \App\User::find(10);
    // $store = $user ->store()->create([
    //     'name' =>'Loja Teste',
    //     'description' => 'Loja Teste de Produtos de Informatica',
    //     'mobile_phone' => 'XX-XXXXX-XXXX',
    //     'phone' => 'XX-XXXXX-XXXX',
    //     'slug' => 'loja-teste'
    // ]);
    // dd($store);

    //Como criar um produto parauma loja?
    // $store =\App\Store::find(41);
    // $product = $store->products()->create([
    //     'name' => 'Notebook Dell',
    //     'description' => 'CORE I5 10GB',
    //     'body' => 'Qualquer coisa...',
    //     'price' => 2999.99,
    //     'slug' => 'notebook-dell',
    // ]);
    // dd($product);

    //Como criar uma categoria?
    // \App\Category::create([
    //     'name' => 'Games',
    //     'description' => null,
    //     'slug' => 'games',
    // ]);
    // \App\Category::create([
    //     'name' => 'Notebooks',
    //     'description' => null,
    //     'slug' => 'notebooks',
    // ]);
    // return \App\Category::all();

    //Como adicionar um produto para uma categoria ou vice-versa
    // $product = \App\Product::find(41);
    // $product->categories()->detach([1]); //adicionar
    // $product->categories()->attach([1]); //remover
    // $product->categories()->sync([2]); //adiciona e remove

    $product = \App\Product::find(41);
    
    return $product->categories;
});

Route::get('not', function(){
    // $user = \App\User::find(41);
    // $user->notify(new \App\Notifications\StoreReceiveNewOrder());

    // $notification = $user->notifications->first();
    // $notification->markAsRead();

    // return $user->notifications->count();
});
