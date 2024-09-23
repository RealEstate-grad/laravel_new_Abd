<?php

use App\Http\Controllers\AdmenController;
use App\Http\Controllers\AgeantController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\HomebageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
/////////////////////admen/////////////
Route::post('login', [AdmenController::class, 'login']);
Route::post('register_User', [AdmenController::class, 'register_User']);
Route::get('number_estate_user_company_agent_city', [AdmenController::class, 'number_estate_user_company_agent_city']);
Route::get('get_all_user', [AdmenController::class, 'get_all_user']);
Route::post('freez/{id}', [AdmenController::class, 'freez']);
Route::get('get_all_company', [AdmenController::class, 'get_all_company']);
Route::get('get_all_company_pending', [AdmenController::class, 'get_all_company_pending']);
Route::post('remove_freez/{id}', [AdmenController::class, 'remove_freez']);
Route::get('get_all_cities', [AdmenController::class, 'get_all_cities']);
Route::post('add_city', [AdmenController::class, 'add_city']);
Route::post('update_city/{id}', [AdmenController::class, 'update_city']);
Route::post('delete_city/{id}', [AdmenController::class, 'delete_city']);
Route::post('add_places', [AdmenController::class, 'add_places']);
Route::get('get_all_places/{id}', [AdmenController::class, 'get_all_places']);
Route::post('update_places/{id}', [AdmenController::class, 'update_places']);
Route::post('delete_places/{id}', [AdmenController::class, 'delete_places']);
Route::get('show_one_places/{id}', [AdmenController::class, 'show_one_places']);
Route::get('show_one_city/{id}', [AdmenController::class, 'show_one_city']);
Route::get('show_one_company/{id}', [AdmenController::class, 'show_one_company']);
Route::post('update_user/{id}', [AdmenController::class, 'update_user']);
Route::get('show_one_user/{id}', [AdmenController::class, 'show_one_user']);
Route::post('update_company_aaa/{id}', [AdmenController::class, 'update_company_aaa']);
/////////////company////////////////////
Route::post('update_user_token', [CompanyController::class, 'update_user_token'])->middleware('auth:sanctum');
Route::post('update_company_token', [CompanyController::class, 'update_company_token'])->middleware('auth:sanctum');
Route::get('get_user_with_company', [CompanyController::class, 'get_user_with_company'])->middleware('auth:sanctum');
Route::get('show_estate/{id}', [CompanyController::class, 'show_estate']);
Route::post('edit_estate/{id}', [CompanyController::class, 'edit_estate']);
Route::post('delete_estate/{id}', [CompanyController::class, 'delete_estate']);
Route::get('get_all_estate', [CompanyController::class, 'get_all_estate'])->middleware('auth:sanctum');
Route::post('add_agents', [CompanyController::class, 'add_agents'])->middleware('auth:sanctum');
Route::post('add_estate', [CompanyController::class, 'add_estate']);
Route::post('delete_agent/{id}', [CompanyController::class, 'delete_agent']);
Route::get('get_agents', [CompanyController::class, 'get_agents'])->middleware('auth:sanctum');
Route::get('get_one_agent', [CompanyController::class, 'get_one_agent']);
Route::post('edit_agent/{id}', [CompanyController::class, 'edit_agent']);
Route::post('add_favorite_estate', [CompanyController::class, 'add_favorite_estate']);
Route::get('show_favorite_estate', [CompanyController::class, 'show_favorite_estate'])->middleware('auth:sanctum');
Route::post('add_favorite_agents', [CompanyController::class, 'add_favorite_agents']);
Route::get('show_favorite_agents', [CompanyController::class, 'show_favorite_agents'])->middleware('auth:sanctum');
Route::post('delete_favorite_estate', [CompanyController::class, 'delete_favorite_estate'])->middleware('auth:sanctum');
Route::post('delete_favorite_agents', [CompanyController::class, 'delete_favorite_agents'])->middleware('auth:sanctum');
/////////////////////homebage//////////////////
Route::get('get_city_palaces/{id}', [HomebageController::class, 'get_city_palaces']);
Route::get('get_12_new_estate', [HomebageController::class, 'get_12_new_estate']);
Route::get('get_12_new_company', [HomebageController::class, 'get_12_new_company']);
Route::get('get_12_new_ageant', [HomebageController::class, 'get_12_new_ageant']);
///////////////////////ageant///////////////////////////////////
Route::get('get_user_with_ageant', [AgeantController::class, 'get_user_with_ageant'])->middleware('auth:sanctum');
Route::post('update_social_media', [AgeantController::class, 'update_social_media'])->middleware('auth:sanctum');
Route::post('update_user_auth', [AgeantController::class, 'update_user_auth'])->middleware('auth:sanctum');
Route::post('edit_agent_auth', [AgeantController::class, 'edit_agent_auth'])->middleware('auth:sanctum');
Route::get('get_all_estate', [AgeantController::class, 'get_all_estate'])->middleware('auth:sanctum');
Route::post('add_estate_auth', [AgeantController::class, 'add_estate_auth'])->middleware('auth:sanctum');
Route::post('edit_estate_auth', [AgeantController::class, 'edit_estate_auth'])->middleware('auth:sanctum');
Route::post('delete_estate_auth', [AgeantController::class, 'delete_estate_auth'])->middleware('auth:sanctum');
Route::post('add_favorite_estate', [AgeantController::class, 'add_favorite_estate']);
Route::post('delete_favorite_estate', [AgeantController::class, 'delete_favorite_estate']);
Route::post('delete_favorite_agents', [AgeantController::class, 'delete_favorite_agents']);
Route::post('add_favorite_agents', [AgeantController::class, 'add_favorite_agents']);
