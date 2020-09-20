<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Application\Admin\AdminController;
use App\Http\Controllers\Application\Admin\SectionController;
use App\Http\Controllers\Application\Admin\CategoryController;
use App\Http\Controllers\Application\Admin\MasterproductController;
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

Route::prefix('admin')->group(function(){
	Route::match(['get','post'],'/',[AdminController::class ,'login']);
        Route::group(['middleware'=>['CheckAdminLogin']],function(){
            Route::get('/dashboard',[AdminController::class ,'dashboard']);
            Route::get('/update-admin-password',[AdminController::class ,'editAdminPassword']);
            Route::get('/logout',[AdminController::class ,'logout']);
            Route::post('check-current-pwd',[AdminController::class ,'chkCurrentPassword']);
            Route::post('update-current-pwd',[AdminController::class ,'updateCurrentPassword']);
            Route::match(['get','post'],'update-admin-details',[AdminController::class ,'updateAdminDetails']);
            
             /**************************************************************************************
    Route::any('admin-stores-new','application\admin\CategoryController@admin_store_new');
    Route::get('admin-stores','application\admin\CategoryController@admin_store_get');
    Route::get('admin-stores-edit-{id}', 'application\admin\CategoryController@admin_store_edit');
    Route::post('admin-stores-edit-post','application\admin\CategoryController@admin_store_edit_post');
    Route::get('admin-stores-delete-{id}', 'application\admin\CategoryController@admin_store_delete');
     /****************************************Sections**********************************************/     
            Route::get('/sections',[SectionController::class,'sections']);
            Route::post('update-section-status',[SectionController::class,'updateSectionStatus']);
            Route::match(['get','post'],'add-section',[SectionController::class,'addSection']);
            Route::get('/edit-section-{id}',[SectionController::class,'editSection']);
            Route::post('/edit-section',[SectionController::class,'updateSection']);
            Route::get('section-delete-{id}', [SectionController::class,'deleteSection']);
    /****************************************Categories**********************************************/     
            Route::get('/categories',[CategoryController::class,'categories']);
            Route::post('update-category-status',[CategoryController::class,'updateCategoryStatus']);
            Route::match(['get','post'],'add-edit-category/{id?}',[CategoryController::class,'addEditCategory']);
            Route::post('append-categories-level',[CategoryController::class,'appendCategoriesLevel']);
            Route::get('delete-category-image-{id}',[CategoryController::class,'deleteCategoriesImage']);
            Route::get('delete-category-{id}', [CategoryController::class,'deleteCategories']);
/****************************************MasterProduct**********************************************/     
            Route::get('/master-product',[MasterproductController::class,'masterproduct']);
            Route::post('update-masterproduct-status',[MasterproductController::class,'updateMasterproductStatus']);
            Route::match(['get','post'],'add-edit-masterproduct/{id?}',[MasterproductController::class,'addEditMasterproduct']);
            Route::get('delete-masterproduct-image-{id}', [MasterproductController::class,'deleteMasterproductImage']);
            Route::get('delete-masterproduct-{id}', [MasterproductController::class,'deleteMasterproduct']);
            
        });
        
        });