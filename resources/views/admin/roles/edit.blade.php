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
            </div>
        </header>

        @if($errors->all())
            @foreach($errors->all() as $error)
                <x-alert color="red" message="{{ $error }}"/>
            @endforeach
        @endif

        @if(session()->exists('message'))
            <x-alert color="{{ session()->get('color') }}" message="{{ session()->get('message') }}"/>
        @endif

        <div class="dash_content_app_box">
            <div class="dash_content_app_box_stage">
                <form action="{{ route('admin.role.update', ['role' => $role->id]) }}" method="post" class="app_form"
                      autocomplete="off">
                    @csrf
                    @method('PUT')

                    <label class="label">
                        <label for="name" class="legend">Nome do Perfil:</label>
                        <input type="text" class="form-control" id="name" placeholder="Insira o nome do Perfil"
                               name="name" value="{{ old('name') ?? $role->name }}">
                    </label>

                    <div class="text-right mt-2">
                        <button class="btn btn-large btn-green icon-pencil-square-o" type="submit">
                            Editar Perfil
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
