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
                        <li><a href="{{ route('admin.users.create') }}">Clientes</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="{{ route('admin.companies.index') }}" class="text-{{ env('COLOR_SITE') }}">
                                Empresas
                            </a>
                        </li>
                    </ul>
                </nav>
                @can('Cadastrar Empresa')
                    <a href="{{ route('admin.companies.create') }}" class="btn btn-orange icon-building-o ml-1">
                        Criar Empresa
                    </a>
                @endcan
            </div>
        </header>

        <div class="dash_content_app_box">
            <div class="dash_content_app_box_stage">
                <table id="dataTable" class="nowrap hover stripe" width="100" style="width: 100% !important;">
                    <thead>
                    <tr>
                        <th>Razão Social</th>
                        <th>Nome Fantasia</th>
                        <th>CNPJ</th>
                        <th>IE</th>
                        <th>Responsável</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($companies as $company)
                        <tr>
                            <td>
                                @can('Editar Empresa')
                                    <a href="{{ route('admin.companies.edit', ['company' => $company->id]) }}"
                                       class="text-{{ env('COLOR_SITE') }}">{{ $company->social_name }}</a>
                                @else
                                     {{$company->social_name }}
                                @endif
                            </td>
                            <td>{{ $company->alias_name }}</td>
                            <td>{{ $company->document_company }}</td>
                            <td>{{ $company->document_company_secondary }}</td>
                            <td>
                                @can('Editar Usuário')
                                    <a href="{{ route('admin.users.edit', ['user' => $company->owner->id]) }}"
                                       class="text-{{ env('COLOR_SITE') }}">{{ $company->owner->name }}</a>
                                @else
                                    {{ $company->owner->name }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
