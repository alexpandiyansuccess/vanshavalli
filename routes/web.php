<?php

use App\Http\Controllers\ManagechartController;
use App\Http\Controllers\UserDetailController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\OrgController;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Support\Facades\Route;

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
Route::post('/org/create', [App\Http\Controllers\OrgController::class, 'create']);
Route::post('/org/manage', [App\Http\Controllers\OrgController::class, 'getchart']);
Route::post('/org/delete', [App\Http\Controllers\OrgController::class, 'delete']);
Route::post('/org/multi-delete', [App\Http\Controllers\OrgController::class, 'multi_delete']);
Route::post("/org/addparent", [OrgController::class, 'addparent']);
Route::get('/org/export/{id}', [App\Http\Controllers\OrgController::class, 'exportchart'])->middleware("auth");
Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('create-chart', App\Http\Controllers\CreatechartController::class);
Route::get("manage-chart", [ManagechartController::class, 'index']);
Route::patch("manage-chart/update/{id}", [ManagechartController::class, 'update']);
Route::patch("manage-chart/update-second-profile/{id}", [ManagechartController::class, 'update_second_profile']);
Route::patch("manage-chart/update-image/{id}", [ManagechartController::class, 'updateImage']);

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
Route::POST('/createprofile', [App\Http\Controllers\UserDetailController::class, 'createprofile'])->name('createprofile');
Route::get('/addprofile', [App\Http\Controllers\UserDetailController::class, 'addprofile'])->name('addprofile');
Route::get('/editprofile', [App\Http\Controllers\UserDetailController::class, 'editprofile'])->name('editprofile');
Route::POST('/updateprofile', [App\Http\Controllers\UserDetailController::class, 'updateprofile'])->name('updateprofile');

Route::POST('/createNode', [App\Http\Controllers\UserDetailController::class, 'createNode'])->name('createNode');
Route::get('/familyTree', [App\Http\Controllers\UserDetailController::class, 'familyTree'])->name('familyTree');
Route::POST('/onUpdateNodeData', [App\Http\Controllers\UserDetailController::class, 'onUpdateNodeData'])->name('onUpdateNodeData');
Route::get('/manageTree', [App\Http\Controllers\UserDetailController::class, 'manageTree'])->name('manageTree');
Route::get('/deletetree', [App\Http\Controllers\UserDetailController::class, 'deletetree'])->name('deletetree');
Route::get('/forum', [App\Http\Controllers\ForumController::class, 'forum'])->name('forum');
Route::POST('/create-forum', [App\Http\Controllers\ForumController::class, 'createForum'])->name('create-forum');
Route::get('/delete-post/{id}', [App\Http\Controllers\ForumController::class, 'deletePost'])->name('delete-post');
Route::get('/like/{id}', [App\Http\Controllers\ForumController::class, 'like'])->name('like');
Route::get('/invite/{id}', [App\Http\Controllers\UserDetailController::class, 'invite'])->name('invite');


Route::POST('/onUpdateNodeDataInvite', [App\Http\Controllers\UserDetailController::class, 'onUpdateNodeDataInvite'])->name('onUpdateNodeDataInvite');

Route::post('/upload-image', [UserDetailController::class, 'uploadImage'])->name('upload.image');



Route::get('/search', [UserDetailController::class, 'searchUserByMailId'])->name('search');

Route::get('/invite-user', [UserDetailController::class, 'inviteUser'])->name('invite-user');

Route::get('/invites', [UserDetailController::class, 'invites'])->name('invites');
Route::get('/invitesbyyou', [UserDetailController::class, 'invitesbyyou'])->name('invitesbyyou');
Route::get('/accept', [UserDetailController::class, 'accept'])->name('accept');
Route::get('/remove-access', [UserDetailController::class, 'removeAccess'])->name('remove-access');

Route::get('/left-from-family', [UserDetailController::class, 'leftFromFamily'])->name('left-from-family');







