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
                        <li>
                            <a href="{{ route('admin.users.index') }}" class="text-{{ env('COLOR_SITE') }}">Clientes</a>
                        </li>
                    </ul>
                </nav>

                @can('Cadastrar Usuário')
                    <a href="{{ route('admin.users.create') }}" class="btn btn-orange icon-user ml-1">Criar Cliente</a>
                @endcan
            </div>
        </header>

        <div class="dash_content_app_box">
            <div class="dash_content_app_box_stage">
                <table id="dataTable" class="nowrap stripe" width="100" style="width: 100% !important;">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome Completo</th>
                        <th>CPF</th>
                        <th>E-mail</th>
                        <th>Nascimento</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td> {{ $user->id }}</td>
                            <td>
                                @can('Editar Usuário')
                                    <a href="{{ route('admin.users.edit', ['user' => $user->id]) }}"
                                       class="text-{{ env('COLOR_SITE') }}"> {{ $user->name }}</a>
                                @else
                                     {{ $user->name }}
                                @endif
                            </td>
                            <td> {{ $user->document }}</td>
                            <td><a href="mailto: {{ $user->email }}"
                                   class="text-{{ env('COLOR_SITE') }}"> {{ $user->email }}</a></td>
                            <td> {{ $user->date_of_birth }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
