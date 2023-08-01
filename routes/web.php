<?php

use App\Http\Controllers\FeedbacksController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Authenticate;

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

// Route::get('/', function () {
//     return view('/home');
// });

Route::get('home', [App\Http\Controllers\Frontend\HomeController::class, 'home'])->name('home');
Route::get('template', [App\Http\Controllers\Frontend\HomeController::class, 'template'])->name('template');
Route::get('get-category-products/{id}', [App\Http\Controllers\Frontend\HomeController::class, 'getCategoryProducts'])->name('getCategoryProducts');

Route::get('detail', [App\Http\Controllers\Frontend\HomeController::class, 'detail'])->name('detail');
Route::get('/', [App\Http\Controllers\Frontend\HomeController::class, 'home'])->name('home');
Route::get('product-detail/{id}', [App\Http\Controllers\Frontend\HomeController::class, 'productDetail'])->name('productDetail');
Route::get('about', [App\Http\Controllers\Frontend\HomeController::class, 'about'])->name('about');
Route::get('contact', [App\Http\Controllers\Frontend\HomeController::class, 'contact'])->name('contact');
Route::get('lang/{lang}', [App\Http\Controllers\LanguageController::class, 'switchLang'])->name('switchLang');

Route::middleware([Authenticate::class])->group(function () {
    Route::any('update-apk-password', [App\Http\Controllers\HomeController::class, 'updateApkPassword'])->name('updateApkPassword');
    Route::get('admin', [App\Http\Controllers\HomeController::class, 'index'])->name('admin');
    Route::get('sync-data', [App\Http\Controllers\HomeController::class, 'syncData'])->name('syncData');
    Route::get('add-categories-default-ordering', [App\Http\Controllers\CategoryController::class, 'addCategoriesDefaultOrdering'])->name('addCategoriesDefaultOrdering');
    Route::any('category/create', [App\Http\Controllers\CategoryController::class, 'createCategory'])->name('createCategory');
    Route::get('categories', [App\Http\Controllers\CategoryController::class, 'allCategories'])->name('allCategories');
    Route::get('sub-categories/{id}', [App\Http\Controllers\CategoryController::class, 'getSubcategories'])->name('getSubcategories');
    Route::any('category/edit/{id}', [App\Http\Controllers\CategoryController::class, 'editCategory'])->name('editCategory');
    Route::any('update-category-order', [App\Http\Controllers\CategoryController::class, 'updateOrder'])->name('updateOrder');
    Route::any('categories/update-order', [App\Http\Controllers\CategoryController::class, 'updateCatOrder'])->name('updateCatOrder');
    Route::any('category/add-language/{id}', [App\Http\Controllers\CategoryController::class, 'addTranslatedCategory'])->name('addTranslatedCategory');
    Route::any('category/edit-language/{id}', [App\Http\Controllers\CategoryController::class, 'editTranslatedCategory'])->name('editTranslatedCategory');
    Route::get('category/delete/{id}', [App\Http\Controllers\CategoryController::class, 'deleteCategory'])->name('deleteCategory');
    
    Route::get('devices', [App\Http\Controllers\DeviceController::class, 'allDevices'])->name('allDevices');
    Route::get('feedbacks/export', [FeedbacksController::class, 'exportFeedback'])->name('feedbacks.export');
    Route::get('export-feedback-excel-2', [App\Http\Controllers\FeedbacksController::class, 'feedbacks2'])->name('exportFeedback2');
    Route::any('feedbacks', [App\Http\Controllers\FeedbacksController::class, 'allFeedbacks'])->name('allFeedbacks');
    Route::any('save-average', [App\Http\Controllers\FeedbacksController::class, 'saveAverage'])->name('saveAverage');
    Route::get('sliders', [App\Http\Controllers\SliderController::class, 'allSliders'])->name('allSliders');
    Route::any('slider/create', [App\Http\Controllers\SliderController::class, 'createSlider'])->name('createSlider');
    Route::any('slider/add-language/{id}', [App\Http\Controllers\SliderController::class, 'addTranslatedSlider'])->name('addTranslatedSlider');
    Route::any('slider/edit-language/{id}', [App\Http\Controllers\SliderController::class, 'editTranslatedSlider'])->name('editTranslatedSlider');
    Route::any('slider/edit/{id}', [App\Http\Controllers\SliderController::class, 'editSlider'])->name('editSlider');
    Route::get('slider/delete/{id}', [App\Http\Controllers\SliderController::class, 'deleteSlider'])->name('deleteSlider');
    
    Route::resource('tags', TagController::class);
    
    Route::any('products/update-order', [App\Http\Controllers\ProductController::class, 'updateProductsOrder'])->name('updateProductsOrder');
    Route::get('products', [App\Http\Controllers\ProductController::class, 'allProducts'])->name('allProducts');
    Route::any('ordering/products', [App\Http\Controllers\ProductController::class, 'orderedProducts'])->name('orderedProducts');
    Route::get('add-products-default-ordering', [App\Http\Controllers\ProductController::class, 'addProductsDefaultOrdering'])->name('addProductsDefaultOrdering');
    Route::any('update-order', [App\Http\Controllers\ProductController::class, 'updateProductOrder'])->name('updateProductOrder');
    Route::any('status-change/product/{id}', [App\Http\Controllers\ProductController::class, 'activeInactiveProduct'])->name('activeInactiveProduct');
    Route::post('update/product', [App\Http\Controllers\ProductController::class, 'updateProduct'])->name('updateProduct');
    Route::any('product/create', [App\Http\Controllers\ProductController::class, 'createProduct'])->name('createProduct');
    Route::any('product/add-language/{id}', [App\Http\Controllers\ProductController::class, 'addTranslatedProduct'])->name('addTranslatedProduct');
    Route::any('product/edit-language/{id}', [App\Http\Controllers\ProductController::class, 'editTranslatedProduct'])->name('editTranslatedProduct');
    Route::any('product/edit/{id}', [App\Http\Controllers\ProductController::class, 'editProduct'])->name('editProduct');
    Route::any('product/view/{id}', [App\Http\Controllers\ProductController::class, 'viewProduct'])->name('viewProduct');
    Route::get('product/delete/{id}', [App\Http\Controllers\ProductController::class, 'deleteProduct'])->name('deleteProduct');
    Route::get('product/delete-image/{id}', [App\Http\Controllers\ProductController::class, 'deleteProductImage'])->name('deleteProductImage');
    Route::get('product/cover-image/{image}/{id}', [App\Http\Controllers\ProductController::class, 'coverProductImage'])->name('coverProductImage');
});

//Auth::routes();
Auth::routes(['register' => false]);
