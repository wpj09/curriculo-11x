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
                        <li><a href="{{ route('admin.permission.index') }}" class="text-green">Permissões</a></li>
                    </ul>
                </nav>
                @can('Cadastrar Permissão')
                    <a href="{{ route('admin.permission.create') }}" class="btn btn-orange icon-pencil-square-o ml-1">
                        Criar Permissão
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
                        <th>Permissão</th>
                        @can('Editar Permissão')
                            <th>Ações</th>
                        @endcan
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($permissions as $permission)
                        <tr>
                            <td> {{ $permission->id }}</td>
                            <td> {{ $permission->name }}</td>
                            @can('Editar Permissão')
                                <td class="d-flex">
                                    <a class="mr-1 btn btn-green"
                                       href="{{ route('admin.permission.edit', ['permission' => $permission->id]) }}">Editar
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
