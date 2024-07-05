@extends('admin.master.master')

@section('content')
    <div style="flex-basis: 100%;">
        <section class="dash_content_app">
            <header class="dash_content_app_header">
                <h2 class="icon-tachometer">Dashboard</h2>
            </header>

            <div class="dash_content_app_box">
                <section class="app_dash_home_stats">
                    <article class="control radius">
                        <h4 class="icon-users">Usuários</h4>
                        <p><b>Administradores:</b> {{ $team }}</p>
                        <p><b>Usuários:</b> {{ $clients }}</p>
                    </article>

                    <article class="blog radius">
                        <h4 class="icon-home">Empresas</h4>
                        <p><b>Cadastradas:</b> {{ $companiesTotal }}</p>
                    </article>

                    <article class="users radius">
                        <h4 class="icon-file-text">Currículos</h4>
                        <p><b>Cadastrados:</b> {{ $curriculumsTotal }}</p>
                    </article>
                </section>
            </div>
        </section>

        <section class="dash_content_app" style="margin-top: 40px;">
            <header class="dash_content_app_header">
                <h2 class="icon-tachometer">Últimos Currículos Cadastrados</h2>
            </header>

            <div class="dash_content_app_box">
                <div class="dash_content_app_box_stage">
                    @if(!empty($curriculums))
                        <table id="dataTable" class="nowrap hover stripe" width="100" style="width: 100% !important;">
                            <thead>
                            <tr>
                                <th>Usuário</th>
                                <th>Nome</th>
                                <th>Cargo Desejado</th>
                                <th>Data Cadastro</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($curriculums as $curriculum)
                                <tr>
                                    <td>
                                        <a href="{{ route('curriculums.edit', ['curriculum' => $curriculum->id]) }}"
                                           class="text-{{ env('COLOR_SITE') }}">{{ $curriculum->id }}</a></td>
                                    <td>
                                        <a href="{{ route('users.edit', ['user' => $curriculum->curriculumObject->id]) }}"
                                           class="text-{{ env('COLOR_SITE') }}">{{ $curriculum->curriculumObject->name }}</a>
                                    </td>
                                    <td>{{ $curriculum->desired_occupation }}</td>
                                    <td>{{ $curriculum->created_at }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                </div>
                @else
                    <div class="no-content">Não foram encontrados registros!</div>
                @endif
            </div>
        </section>

        <section class="dash_content_app" style="margin-top: 40px;">
            <header class="dash_content_app_header">
                <h2 class="icon-tachometer">Últimas Empresas Cadastradas</h2>
            </header>

            <div class="dash_content_app_box">
                <div class="dash_content_app_box_stage">
                    <div class="companies_list">
                        @if(count($companies))
                            @foreach($companies as $company)
                                <div class="companies_list_item mb-2">
                                    <p><b>Razão Social:</b> {{ $company->social_name }}</p>
                                    <p><b>Nome Fantasia:</b> {{ $company->alias_name }}</p>
                                    <p><b>CNPJ:</b> {{ $company->document_company }} -
                                        <b>Inscrição
                                            Estadual:</b>{{ $company->document_company_secondary }}
                                    </p>
                                    <p><b>Endereço:</b> {{ $company->street }}, {{ $company->number }}
                                        {{ $company->complement }}</p>
                                    <p><b>CEP:</b> {{ $company->zipcode }}
                                        <b>Bairro:</b> {{ $company->neighborhood }}
                                        <b>Cidade/Estado:</b>
                                        {{ $company->city }}/{{ $company->state }}</p>
                                </div>
                            @endforeach
                        @else
                            <div class="no-content">Não foram encontrados registros!</div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
