<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class AdminUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => env('APP_NAME'),
            'email' => env('ADMIN_EMAIL'),
            'email_verified_at' => now(),
            'password' => bcrypt(env('ADMIN_PASS')),
            'remember_token' => Str::random(10),
            'document' => '',
            'admin' => 1
        ]);

        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // permissions
        Permission::create(['name' => 'Listar Permissões']);
        Permission::create(['name' => 'Cadastrar Permissão']);
        Permission::create(['name' => 'Editar Permissão']);
        Permission::create(['name' => 'Remover Permissão']);

        // roles
        Permission::create(['name' => 'Listar Perfis']);
        Permission::create(['name' => 'Cadastrar Perfil']);
        Permission::create(['name' => 'Editar Perfil']);
        Permission::create(['name' => 'Remover Perfil']);
        Permission::create(['name' => 'Atribuir Permissões']);

        // users
        Permission::create(['name' => 'Cadastrar Usuário']);
        Permission::create(['name' => 'Editar Usuário']);
        Permission::create(['name' => 'Listar Usuários']);
        Permission::create(['name' => 'Listar Usuários - Equipe']);

        // curriculum
        Permission::create(['name' => 'Cadastrar Currículo']);
        Permission::create(['name' => 'Editar Currículo']);
        Permission::create(['name' => 'Listar Currículos']);

        // companies
        Permission::create(['name' => 'Listar Empresas']);
        Permission::create(['name' => 'Cadastrar Empresa']);
        Permission::create(['name' => 'Editar Empresa']);

        // role create
        $role = Role::create(['name' => 'SuperAdmin']);

        // set all permissions in role
        $role->givePermissionTo(Permission::all());

        $user = User::where('email', env('ADMIN_EMAIL'))->first();
        $user->assignRole('SuperAdmin');
    }
}
