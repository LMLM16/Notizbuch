<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ToDoController;
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

Route::post('/auth/login', [AuthController::class,'login']);
Route::get('/notes', [NoteController::class, 'index']);
Route::get('/notes/rating/{rating}', [NoteController::class, 'findByRating']);
Route::get('/notes/search/{searchTerm}', [NoteController::class, 'findBySearchTerm']);
//Route::get('notes/checkisbn/{isbn}', [\App\Http\Controllers\BookController::class, 'checkISBN']);



Route::group(['middleware' => ['api','auth.jwt','auth.admin']], function() {
});
    Route::get('/notes/{id}', [NoteController::class, 'show']);
    Route::get('/notes', [NoteController::class, 'index']);
    Route::post('notes', [NoteController::class,'save']);
    Route::put('/notes/{noteId}', [NoteController::class, 'update']);
    //Route::put('/notes/search/{searchTerm}', [NoteController::class,'update']); //MAL WAS GEÄNDERT; eventuelle auswirkungen
    //Route::delete('/notes/search/{searchTerm}', [NoteController::class,'delete']);
    Route::delete('/notes/{noteId}', [NoteController::class, 'delete']);
    Route::post('auth/logout', [AuthController::class,'logout']);


Route::group(['middleware' => ['api','auth.jwt']], function() {
});
    Route::get('/lists/{id}', [ListController::class, 'getById']);
    Route::get('/lists', [ListController::class, 'index']);
    Route::get('/user/{userId}/lists', [ListController::class, 'getByUserId']);
    Route::post('/lists', [ListController::class, 'create']);
    Route::put('/lists/{id}', [ListController::class, 'update']);
    Route::delete('/lists/{id}', [ListController::class, 'delete']);


// Routes for TagController
Route::group(['middleware' => ['api','auth.jwt']], function() {
});


    Route::get('/note/tag/{id}', [TagController::class, 'getNotesbyTag']);
    Route::post('/tags', [TagController::class, 'create']);
    Route::get('/tags', [TagController::class, 'getAllTags']);
    Route::put('/tags/{id}', [TagController::class, 'update']);
    Route::delete('/tags/{id}', [TagController::class, 'delete']);
    Route::get('/notes/{id}/tags', [TagController::class, 'showNoteTags']);
    Route::get('/todos/{id}/tags', [TagController::class, 'showTodoTags']);

// Routes for ToDoController
Route::group(['middleware' => ['api','auth.jwt']], function() {
});
Route::get('/todos', [ToDoController::class, 'index']);
    Route::get('/todos/{id}', [ToDoController::class, 'show']);
    Route::post('/todos', [ToDoController::class, 'create']);
    Route::put('/todos/{id}', [ToDoController::class, 'update']);
    Route::delete('/todos/{id}', [ToDoController::class, 'delete']);

