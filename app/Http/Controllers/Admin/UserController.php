<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Curriculum;
use App\Models\User;
use App\Support\Cropper;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\User as UserRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        if(!Auth::user()->hasPermissionTo('Listar Usuários')){
            throw new UnauthorizedException('403', 'You do not have the required authorization.');
        }

        $users = User::all();

        return view('admin.users.index', [
            'users' => $users
        ]);
    }

    public function team()
    {
        if(!Auth::user()->hasPermissionTo('Listar Usuários - Equipe')){
            throw new UnauthorizedException('403', 'You do not have the required authorization.');
        }

        $users = User::where('admin', 1)->get();
        return view('admin.users.team', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        if(!Auth::user()->hasPermissionTo('Cadastrar Usuário')){
            throw new UnauthorizedException('403', 'You do not have the required authorization.');
        }

        $roles = Role::all();

        foreach($roles as $role) {
            $role->can = false;
        }

        return view('admin.users.create', [
            'roles' => $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserRequest $request
     * @return RedirectResponse
     */
    public function store(UserRequest $request)
    {
        if(!Auth::user()->hasPermissionTo('Cadastrar Usuário')){
            throw new UnauthorizedException('403', 'You do not have the required authorization.');
        }

        $userCreate = User::create($request->all());

        if (!empty($request->file('cover'))) {
            $userCreate->cover = $request->file('cover')->storeAs('user', Str::slug($request->name)  . '-' .
                str_replace('.', '', microtime(true)) . '.' . $request->file('cover')->extension());
            $userCreate->save();
        }

        $rolesRequest = $request->all();
        $roles = null;
        foreach($rolesRequest as $key => $value) {
            if(Str::is('acl_*', $key) == true){
                $roles[] = Role::where('id', ltrim($key, 'acl_'))->first();
            }
        }

        if(!empty($roles)){
            $userCreate->syncRoles($roles);
        } else {
            $userCreate->syncRoles(null);
        }

        return redirect()->route('admin.users.edit', [
            'user' => $userCreate->id
        ])->with(['color' => 'green', 'message' => 'Cliente cadastrado com sucesso!']);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
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
//        se o id do usuario logado for = ao editaso passa se n para
        if(Auth::id() == $id){
        }
        elseif(!Auth::user()->hasPermissionTo('Editar Usuário')){
            throw new UnauthorizedException('403', 'You do not have the required authorization.');
        }

        $curriculum = Curriculum::find($id);
        $user = User::where('id', $id)->first();
        $roles = Role::all();

        foreach($roles as $role) {
            if ($user->hasRole($role->name)){
                $role->can = true;
            } else {
                $role->can = false;
            }
        }

        return view('admin.users.edit', [
            'user' => $user,
            'roles' => $roles,
            'curriculum' => $curriculum
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(UserRequest $request, $id)
    {
        if(Auth::id() == $id){
        }
        elseif(!Auth::user()->hasPermissionTo('Editar Usuário')){
            throw new UnauthorizedException('403', 'You do not have the required authorization.');
        }

        $user = User::where('id', $id)->first();

        $user->setAdminAttribute($request->admin);
        $user->setCompanyAttribute($request->company);
        $user->setClientAttribute($request->client);
        $user->setStatusAttribute($request->status);

        if(!empty($request->file('cover'))){
            Storage::delete($user->cover);
            Cropper::flush($user->cover);
            $user->cover = '';
        }

        $user->fill($request->all());

        if(!empty($request->file('cover'))){
            $user->cover = $request->file('cover')->storeAs('user', Str::slug($request->name)  . '-' .
                str_replace('.', '', microtime(true)) . '.' . $request->file('cover')->extension());
        }

        if (!$user->save()) {
            return redirect()->back()->withInput()->withErrors();
        }

        $rolesRequest = $request->all();
        $roles = null;
        foreach($rolesRequest as $key => $value) {
            if(Str::is('acl_*', $key) == true){
                $roles[] = Role::where('id', ltrim($key, 'acl_'))->first();
            }
        }

        if(!empty($roles)){
            $user->syncRoles($roles);
        } else {
            $user->syncRoles(null);
        }

        return redirect()->route('admin.users.edit', [
            'user' => $user->id
        ])->with(['color' => 'green', 'message' => 'Cliente atualizado com sucesso!']);
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
}
