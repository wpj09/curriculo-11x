<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite([
        "resources/views/admin/assets/css/reset.css",
        "resources/views/admin/assets/css/boot.css",
        "resources/views/admin/assets/css/login.css",
        "resources/views/admin/assets/images/favicon.png",
    ])

{{--    <link rel="stylesheet" href="{{ url(mix('backend/assets/css/reset.css')) }}"/>--}}
{{--    <link rel="stylesheet" href="{{ url(mix('backend/assets/css/libs.css')) }}">--}}
{{--    <link rel="stylesheet" href="{{ url(mix('backend/assets/css/boot.css')) }}"/>--}}
{{--    <link rel="stylesheet" href="{{ url(mix('backend/assets/css/style.css')) }}"/>--}}
    <link rel="icon" type="image/png" href="{{ url(asset('resources/views/admin/assets/images/favicon.png')) }}"/>

    @hasSection('css')
        @yield('css')
    @endif

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ env('CLIENT_DATA_IMOB') }} - Site Control</title>
</head>
<body>

<div class="ajax_load">
    <div class="ajax_load_box">
        <div class="ajax_load_box_circle"></div>
        <p class="ajax_load_box_title">Aguarde, carregando...</p>
    </div>
</div>

<div class="ajax_response"></div>

{{--@php--}}
{{--    if(\Illuminate\Support\Facades\File::exists(public_path() . '/storage/' . \Illuminate\Support\Facades\Auth::user()->cover)) {--}}
{{--        $cover = \Illuminate\Support\Facades\Auth::user()->url_cover;--}}
{{--    } else {--}}
{{--        $cover = url(asset('backend/assets/images/avatar.jpg'));--}}
{{--    }--}}
{{--@endphp--}}

{{--@php--}}
{{--    if(\Illuminate\Support\Facades\File::exists(public_path() . '/storage/' . \Illuminate\Support\Facades\Auth::user()->cover)) {--}}
{{--        $cover = url(asset('backend/assets/images/avatar.jpg'));--}}
{{--    } else {--}}
{{--        $cover = \Illuminate\Support\Facades\Auth::user()->url_cover;--}}
{{--    }--}}
{{--@endphp--}}

@php
    if(!empty(\Illuminate\Support\Facades\Auth::user()->cover) && \Illuminate\Support\Facades\File::exists(public_path() . '/storage/' . \Illuminate\Support\Facades\Auth::user()->cover)) {
        $cover = \Illuminate\Support\Facades\Auth::user()->url_cover;
    } else {
        $cover = url(asset('backend/assets/images/avatar.jpg'));
    }
@endphp

<div class="dash">
    <aside class="dash_sidebar">
        <article class="dash_sidebar_user">
            <img class="dash_sidebar_user_thumb" src="{{ $cover }}"
                 alt="Seja bem-vindo(a) {{ \Illuminate\Support\Facades\Auth::user()->name }}"
                 title="Seja bem-vindo(a) {{ \Illuminate\Support\Facades\Auth::user()->name }}"/>

            <h1 class="dash_sidebar_user_name">
                @can('Editar Usuário')
                    <a href="{{ route('admin.users.edit', ['user' => \Illuminate\Support\Facades\Auth::user()->id]) }}">
                        {{ \Illuminate\Support\Facades\Auth::user()->name }}</a>
                @else
                    <a>{{ \Illuminate\Support\Facades\Auth::user()->name }}</a>
                @endif
            </h1>
        </article>

        <ul class="dash_sidebar_nav">
            <li class="dash_sidebar_nav_item active {{ isActive('admin.home') }}">
                <a class="icon-tachometer" href="{{ route('admin.home') }}">Dashboard</a>
            </li>
            {{-- Menu Clientes --}}
            @can('Listar Usuários')
                <li class="dash_sidebar_nav_item {{ isActive('admin.users') }}  {{ isActive('admin.companies') }}">
                    <a class="icon-users" href="javascript:void(0)">Usuários</a>
                    <ul class="dash_sidebar_nav_submenu">


                        <li class="{{ isActive('admin.users.index') }}">
                            <a href="{{ route('admin.users.index') }}">Ver Todos</a>
                        </li>
                        @endcan

                        @can('Listar Empresas')
                            <li class="{{ isActive('admin.companies.index') }}">
                                <a href="{{ route('admin.companies.index') }}">Empresas</a>
                            </li>
                        @endcan

                        @can('Listar Usuários - Equipe')
                            <li class="{{ isActive('admin.users.team') }}">
                                <a href="{{ route('admin.users.team') }}">Time</a>
                            </li>
                        @endcan

                        @can('Cadastrar Usuário')
                            <li class="{{ isActive('admin.users.create') }}">
                                <a href="{{ route('admin.users.create') }}">Criar Novo</a>
                            </li>


                    </ul>
                </li>
            @endcan

            {{-- Menu Currículos --}}
            @can('Listar Currículos')
                <li class="dash_sidebar_nav_item {{ isActive('admin.curriculums') }}">
                    <a class="icon-file-text" href="javascript:void(0)">Currículos</a>
                    <ul class="dash_sidebar_nav_submenu">
                        <li class="{{ isActive('admin.curriculums.index') }}">
                            <a href="{{ route('admin.curriculums.index') }}">Ver Todos</a>
                        </li>
                        @endcan

                        @can('Cadastrar Currículo')
                            <li class="{{ isActive('admin.curriculums.create') }}">
                                <a href="{{ route('admin.curriculums.create') }}">Criar Novo</a>
                            </li>
                    </ul>
                </li>
            @endcan

            {{-- Menu Configurações --}}
            @can('Listar Perfis')
                <li class="dash_sidebar_nav_item {{ isActive('admin.permission') }} {{ isActive('admin.role') }}">
                    <a class="icon-cogs" href="javascript:void(0)">Configurações</a>
                    <ul class="dash_sidebar_nav_submenu">
                        <li class="{{ isActive('admin.role.index') }}">
                            <a href="{{ route('admin.role.index') }}">Perfis</a>
                        </li>
                        @endcan

                        @can('Listar Permissões')
                            <li class="{{ isActive('admin.permission.index') }}">
                                <a href="{{ route('admin.permission.index') }}">Permissões</a>
                            </li>
                    </ul>
                </li>
            @endcan

            <li class="dash_sidebar_nav_item">
                <a class="icon-reply" href="#" target="_blank">Ver Site</a>
            </li>

            <li class="dash_sidebar_nav_item">
                <a class="icon-sign-out on_mobile" href="{{ route('admin.logout') }}">Sair</a>
            </li>
        </ul>

    </aside>

    <section class="dash_content">

        <div class="dash_userbar">
            <div class="dash_userbar_box">
                <div class="dash_userbar_box_content">
                    <span class="icon-align-justify icon-notext mobile_menu transition btn btn-green"></span>
                    <h1 class="transition">
                        <i class="icon-imob text-orange"></i><a href="">{{ env('CLIENT_DATA_IMOB') }}<b>ADM</b></a>
                    </h1>
                    <div class="dash_userbar_box_bar no_mobile">
                        <a class="text-red icon-sign-out" href="{{ route('admin.logout') }}">Sair</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="dash_content_box">
            @yield('content')
        </div>
    </section>
</div>

{{--<script src="{{ url(mix('backend/assets/js/jquery.js')) }}"></script>--}}
{{--<script src="{{ url(asset('backend/assets/js/tinymce/tinymce.min.js')) }}"></script>--}}
{{--<script src="{{ url(mix('backend/assets/js/libs.js')) }}"></script>--}}
{{--<script src="{{ url(mix('backend/assets/js/scripts.js')) }}"></script>--}}

@vite([
    'resources/views/admin/assets/js/jquery.min.js',
    'resources/views/admin/assets/js/tinymce/tinymce.min.js',
    'resources/views/admin/assets/js/datatables/js/jquery.dataTables.min.js',
    'resources/views/admin/assets/js/datatables/js/dataTables.responsive.min.js',
    'resources/views/admin/assets/js/select2/js/select2.min.js',
    'resources/views/admin/assets/js/select2/js/i18n/pt-BR.js',
    'resources/views/admin/assets/js/jquery.form.js',
    'resources/views/admin/assets/js/jquery.mask.js',
    'resources/views/admin/assets/js/scripts.js'
    ])

@hasSection('js')
    @yield('js')
@endif

</body>
</html>
