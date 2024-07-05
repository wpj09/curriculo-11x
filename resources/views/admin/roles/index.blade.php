@extends('admin.master.master')

@section('content')
    <section class="dash_content_app">

        <header class="dash_content_app_header">
            <h2 class="icon-search">Filtro</h2>

            <div class="dash_content_app_header_actions">
                <nav class="dash_content_app_breadcrumb">
                    <ul>
                        <li><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="{{ route('admin.role.index') }}" class="text-green">Perfis</a></li>
                    </ul>
                </nav>
                @can('Cadastrar Perfil')
                    <a href="{{ route('admin.role.create') }}" class="btn btn-orange icon-pencil-square-o ml-1">
                        Criar Perfil
                    </a>
                @endcan
            </div>
        </header>

        @if($errors->all())
            @foreach($errors->all() as $error)
                <x-alert color="orange" message="{{ $error }}"/>
            @endforeach
        @endif

        @if(session()->exists('message'))
            <x-alert color="{{ session()->get('color') }}" message="{{ session()->get('message') }}"/>
        @endif

        <div class="dash_content_app_box">
            <div class="dash_content_app_box_stage">
                <table id="dataTable" class="nowrap stripe" width="100" style="width: 100% !important;">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Perfil</th>
                        @can('Editar Perfil')
                            <th>Ações</th>
                        @endcan
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td> {{ $role->id }}</td>
                            <td> {{ $role->name }}</td>
                            @can('Editar Perfil')
                                <td class="d-flex">
                                    <a class="mr-1 btn btn-green"
                                       href="{{ route('admin.role.edit', ['role' => $role->id]) }}"> Editar
                                    </a>
                                    <a class="mr-1 btn btn-green"
                                       href="{{ route('admin.role.permissions', ['role' => $role->id]) }}"> Permissões
                                    </a>
                                </td>
                            @endcan
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
