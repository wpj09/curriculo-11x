<?php

use App\Http\Controllers\Admin\ACL\PermissionController;
use App\Http\Controllers\Admin\ACL\RoleController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CurriculumController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CurriculumController::class, 'index'])->name('cur.show');

Route::prefix('admin')->name('admin.')->group(function () {
    /** Formulário de Login */
    Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.do');

    Route::get('/contact', [ContactController::class, 'contact'])->name('contact');
    Route::post('/sendEmail', [ContactController::class, 'sendEmail'])->name('sendEmail');
    Route::get('/sendEmail/success', [ContactController::class, 'sendEmailSuccess'])->name('sendEmailSuccess');

    /** Rotas Protegidas */
    Route::group(['middleware' => ['auth']], function () {
        /** Dashboard Home */
        Route::get('home', [AuthController::class, 'home'])->name('home');

        /** Usuários */
        Route::get('users/team', [UserController::class, 'team'])->name('users.team');
        Route::resource('users', UserController::class);

        /** Permissões*/
        Route::resource('permission', PermissionController::class);

        /** Perfis */
        Route::get('role/{role}/permission', [RoleController::class, 'permissions'])->name('role.permissions');
        Route::put('role/{role}/permission/Sync', [RoleController::class, 'permissionsSync'])->name(
            'role.permissionsSync'
        );
        Route::resource('role', RoleController::class);

        /** Empresas */
        Route::resource('companies', CompanyController::class);

        /** Currículos */
        Route::resource('curriculums', CurriculumController::class);

    });
    /** Logout */
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});
