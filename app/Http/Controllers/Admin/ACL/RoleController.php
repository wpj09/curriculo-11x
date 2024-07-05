<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        if (!Auth::user()->hasPermissionTo('Listar Perfis')) {
            throw new UnauthorizedException('403', 'You do not have the required authorization.');
        }

        $roles = Role::all();

        return view('admin.roles.index', [
            'roles' => $roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        if (!Auth::user()->hasPermissionTo('Cadastrar Perfil')) {
            throw new UnauthorizedException('403', 'You do not have the required authorization.');
        }

        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        if (!Auth::user()->hasPermissionTo('Cadastrar Perfil')) {
            throw new UnauthorizedException('403', 'You do not have the required authorization.');
        }

        $role = Role::where('name', $request->name)->get();

        if ($role->count() > 0) {
            return redirect()->back()->withInput()->with(
                ['color' => 'orange', 'message' => 'Ooops, o nome desse perfil já está em uso!']
            );
        }

        $role = new Role();
        $role->name = $request->name;
        $role->save();

        return redirect()->route('admin.role.index')->with(
            ['color' => 'green', 'message' => 'Perfil cadastrado com sucesso!']
        );
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Void
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        if (!Auth::user()->hasPermissionTo('Editar Perfil')) {
            throw new UnauthorizedException('403', 'You do not have the required authorization.');
        }

        $role = Role::where('id', $id)->first();

        return view('admin.roles.edit', [
            'role' => $role
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        if (!Auth::user()->hasPermissionTo('Editar Perfil')) {
            throw new UnauthorizedException('403', 'You do not have the required authorization.');
        }

        $role = Role::where('name', $request->name)->where('id', '!=', $id)->get();

        if ($role->count() > 0) {
            return redirect()->back()->withInput()->with(
                ['color' => 'orange', 'message' => 'Ooops, o nome desse perfil já está em uso!']
            );
        }

        $role = Role::where('id', $id)->first();

        $role->name = $request->name;
        $role->save();

        return redirect()->route('admin.role.index')->with(
            ['color' => 'green', 'message' => 'Perfil atualizado com sucesso!']
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return void
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param $role
     * @return Application|Factory|View
     */
    public function permissions($role)
    {
        $role = Role::where('id', $role)->first();

        $permissions = Permission::all();

        foreach ($permissions as $permission) {
            if ($role->hasPermissionTo($permission->name)) {
                $permission->can = true;
            } else {
                $permission->can = false;
            }
        }

        return view('admin.roles.permissions', [
            'role' => $role,
            'permissions' => $permissions
        ]);
    }

    /**
     * @param Request $request
     * @param $role
     * @return RedirectResponse
     */
    public function permissionsSync(Request $request, $role)
    {
        $permissionsRequest = $request->except(['_token', '_method']);

        foreach ($permissionsRequest as $key => $value) {
            $permissions[] = Permission::where('id', $key)->first();
        }

        $role = Role::where('id', $role)->first();
        if (!empty($permissions)) {
            $role->syncPermissions($permissions);
        } else {
            $role->syncPermissions(null);
        }

        return redirect()->route('admin.role.permissions', [
            'role' => $role->id
        ])->with(['color' => 'green', 'message' => 'Perfil atualizado com sucesso!']);
    }
}
