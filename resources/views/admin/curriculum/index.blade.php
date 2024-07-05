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
                            <a href="{{ route('admin.curriculums.index') }}" class="text-{{ env('COLOR_SITE') }}">
                                Currículos</a>
                        </li>
                    </ul>
                </nav>

                @can('Cadastrar Currículo')
                    <a href="{{ route('admin.curriculums.create') }}" class="btn btn-orange icon-user ml-1">Criar
                        Currículo</a>
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
                        <th>Dada Cadastro</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($curriculums as $curriculum)
                        <tr>
                            <td>
                                @can('Editar Currículo')
                                    <a href="{{ route('admin.curriculums.edit', ['curriculum' => $curriculum->id]) }}"
                                       class="text-{{ env('COLOR_SITE') }}"> {{ $curriculum->id }}</a>
                                @else
                                    {{ $curriculum->id }}
                                @endif
                            </td>
                            <td>
                                @can('Editar Currículo')
                                    <a href="{{ route('admin.curriculums.show', ['curriculum' => $curriculum->id]) }}"
                                       class="text-{{ env('COLOR_SITE') }}"> {{ $curriculum->curriculumObject->name }}</a>
                                @else
                                    {{ $curriculum->name }}
                                @endif
                            </td>
                            <td> {{ $curriculum->created_at }}</td>


                            @if($curriculum->status == true)
                                <td>Desempregado</td>
                            @elseif($curriculum->status == false)
                                <td>Empregado</td>
                            @endif


                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
