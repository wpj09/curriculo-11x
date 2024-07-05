@extends('admin.master.master')

@section('content')
    <section class="dash_content_app">

        <header class="dash_content_app_header">
            <h2 class="icon-user-plus">Editar Cliente</h2>

            <div class="dash_content_app_header_actions">
                <nav class="dash_content_app_breadcrumb">
                    <ul>
                        <li><a href="{{ route('admin.home') }}">Dashboard</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="{{ route('admin.users.index') }}">Clientes</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="{{ route('admin.users.create') }}" class="text-{{ env('COLOR_SITE') }}">
                                Novo Cliente
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>

        <div class="dash_content_app_box">
            <div class="nav">

                @if($errors->all())
                    @foreach($errors->all() as $error)
                        <x-alert color="red" message="{{ $error }}"/>
                    @endforeach
                @endif

                @if(session()->exists('message'))
                    <x-alert color="{{ session()->get('color') }}" message="{{ session()->get('message') }}"/>
                @endif

                <ul class="nav_tabs">
                    <li class="nav_tabs_item">
                        <a href="#data" class="nav_tabs_item_link active">Dados Cadastrais</a>
                    </li>
                    <li class="nav_tabs_item">
                        <a href="#complementary" class="nav_tabs_item_link">Dados Complementares</a>
                    </li>
                    <li class="nav_tabs_item">
                        <a href="#realties" class="nav_tabs_item_link">Currículo</a>
                    </li>
                    @can('Atribuir Permissões')
                        <li class="nav_tabs_item">
                            <a href="#management" class="nav_tabs_item_link">Administrativo</a>
                        </li>
                    @endcan
                </ul>

                <form class="app_form" action="{{ route('admin.users.update', ['user' => $user->id]) }}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $user->id }}">

                    <div class="nav_tabs_content">
                        <div id="data">
                            <div class="label_g2">
                                <label class="label">
                                    <span class="legend">*Nome:</span>
                                    <input type="text" name="name" placeholder="Nome Completo"
                                           value="{{ old('name') ?? $user->name }}"/>
                                </label>

                                <label class="label">
                                    <span class="legend">*Nacionalidade:</span>
                                    <input type="text" name="nationality" placeholder="Nacionalidade Ex.: Brasileira"
                                           value="{{ old('nationality') ?? $user->nationality }}"/>
                                </label>
                            </div>
                            <div class="label_g2">
                                <label class="label">
                                    <span class="legend">*Genero:</span>
                                    <select name="genre">
                                        <option value="">Selecione...</option>
                                        <option value="masculino"
                                            {{ (old('genre') == 'masculino' ? 'selected' : ($user->genre == 'masculino' ? 'selected' : '')) }}>
                                            Masculino
                                        </option>
                                        <option value="feminino"
                                            {{ (old('genre') == 'feminino' ? 'selected' : ($user->genre == 'feminino' ? 'selected' : '')) }}>
                                            Feminino
                                        </option>
                                        <option value="outros"
                                            {{ (old('genre') == 'outros' ? 'selected' : ($user->genre == 'outros' ? 'selected' : '')) }}>
                                            Outros
                                        </option>
                                    </select>
                                </label>

                                <label class="label">
                                    <span class="legend">*CPF:</span>
                                    <input type="tel" class="mask-doc" name="document" placeholder="CPF do Cliente"
                                           value="{{ old('document') ?? $user->document }}"/>
                                </label>
                            </div>

                            <div class="label_g2">
                                <label class="label">
                                    <span class="legend">*RG:</span>
                                    <input type="text" name="document_secondary" placeholder="RG do Cliente"
                                           value="{{ old('document_secondary') ?? $user->document_secondary }}"/>
                                </label>

                                <label class="label">
                                    <span class="legend">Órgão Expedidor:</span>
                                    <input type="text" name="document_secondary_complement" placeholder="Expedição"
                                           value="{{ old('document_secondary_complement') ?? $user->document_secondary_complement }}"/>
                                </label>
                            </div>

                            <div class="label_g2">
                                <label class="label">
                                    <span class="legend">*Data de Nascimento:</span>
                                    <input type="tel" name="date_of_birth" class="mask-date"
                                           placeholder="Data de Nascimento"
                                           value="{{ old('date_of_birth') ?? $user->date_of_birth }}"/>
                                </label>

                                <label class="label">
                                    <span class="legend">*Naturalidade:</span>
                                    <input type="text" name="place_of_birth" placeholder="Cidade de Nascimento"
                                           value="{{ old('place_of_birth') ?? $user->place_of_birth }}"/>
                                </label>
                            </div>

                            <div class="label_g2">
                                <label class="label">
                                    <span class="legend">*Estado Civil:</span>
                                    <select name="civil_status">
                                        <option value="">Selecione...</option>
                                        <option
                                            value="Casado"
                                            {{ (old('civil_status') == 'Casado' ? 'selected' : ($user->civil_status == 'Casado' ? 'selected' : '')) }}>
                                            Casado
                                        </option>
                                        <option value="Separado/Desquitado"
                                            {{ (old('civil_status') == 'Separado/Desquitado' ? 'selected' : ($user->civil_status == 'Separado/Desquitado' ? 'selected' : '')) }}>
                                            Separado/Desquitado
                                        </option>
                                        <option value="Solteiro"
                                            {{ (old('civil_status') == 'Solteiro' ? 'selected' : ($user->civil_status == 'Solteiro' ? 'selected' : '')) }}>
                                            Solteiro
                                        </option>
                                        <option value="União Estável"
                                            {{ (old('civil_status') == 'União Estável' ? 'selected' : ($user->civil_status == 'União Estável' ? 'selected' : '')) }}>
                                            União Estável
                                        </option>
                                        <option value="União Homoafetiva"
                                            {{ (old('civil_status') == 'União Homoafetiva' ? 'selected' : ($user->civil_status == 'União Homoafetiva' ? 'selected' : '')) }}>
                                            União Homoafetiva
                                        </option>
                                        <option value="Divorciado"
                                            {{ (old('civil_status') == 'Divorciado' ? 'selected' : ($user->civil_status == 'Divorciado' ? 'selected' : '')) }}>
                                            Divorciado
                                        </option>
                                        <option value="Separado Judicialmente"
                                            {{ (old('civil_status') == 'Separado Judicialmente' ? 'selected' : ($user->civil_status == 'Separado Judicialmente' ? 'selected' : '')) }}>
                                            Separado Judicialmente
                                        </option>
                                        <option value="Viúvo"
                                            {{ (old('civil_status') == 'Viúvo' ? 'selected' : ($user->civil_status == 'Viúvo' ? 'selected' : '')) }}>
                                            Viúvo
                                        </option>
                                    </select>
                                </label>

                                <label class="label">
                                    <span class="legend">Foto</span>
                                    <input type="file" name="cover">
                                </label>
                            </div>

                            <label class="label">
                                <span class="legend">*Profissão:</span>
                                <input type="text" name="occupation" placeholder="Profissão do Cliente"
                                       value="{{ old('occupation') ?? $user->occupation }}"/>
                            </label>

                            <div class="app_collapse mt-2">
                                <div class="app_collapse_header collapse">
                                    <h3>Endereço</h3>
                                    <span class="icon-plus-circle icon-notext"></span>
                                </div>

                                <div class="app_collapse_content d-none">
                                    <div class="label_g2">
                                        <label class="label">
                                            <span class="legend">*CEP:</span>
                                            <input type="tel" name="zipcode" class="mask-zipcode zip_code_search"
                                                   placeholder="Digite o CEP"
                                                   value="{{ old('zipcode') ?? $user->zipcode }}"/>
                                        </label>
                                    </div>

                                    <label class="label">
                                        <span class="legend">*Endereço:</span>
                                        <input type="text" name="street" class="street"
                                               placeholder="Endereço Completo"
                                               value="{{ old('street') ?? $user->street }}"/>
                                    </label>

                                    <div class="label_g2">
                                        <label class="label">
                                            <span class="legend">*Número:</span>
                                            <input type="text" name="number" placeholder="Número do Endereço"
                                                   value="{{ old('number') ?? $user->number }}"/>
                                        </label>

                                        <label class="label">
                                            <span class="legend">Complemento:</span>
                                            <input type="text" name="complement" placeholder="Completo (Opcional)"
                                                   value="{{ old('complement') ?? $user->complement }}"/>
                                        </label>
                                    </div>

                                    <label class="label">
                                        <span class="legend">*Bairro:</span>
                                        <input type="text" name="neighborhood" class="neighborhood"
                                               placeholder="Bairro"
                                               value="{{ old('neighborhood') ?? $user->neighborhood }}"/>
                                    </label>

                                    <div class="label_g2">
                                        <label class="label">
                                            <span class="legend">*Estado:</span>
                                            <input type="text" name="state" class="state" placeholder="Estado"
                                                   value="{{ old('state') ?? $user->state }}"/>
                                        </label>

                                        <label class="label">
                                            <span class="legend">*Cidade:</span>
                                            <input type="text" name="city" class="city" placeholder="Cidade"
                                                   value="{{ old('city') ?? $user->city }}"/>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="app_collapse mt-2">
                                <div class="app_collapse_header collapse">
                                    <h3>Contato</h3>
                                    <span class="icon-plus-circle icon-notext"></span>
                                </div>

                                <div class="app_collapse_content d-none">
                                    <div class="label_g2">
                                        <label class="label">
                                            <span class="legend">*Celular:</span>
                                            <input type="tel" name="cell" class="mask-cell"
                                                   placeholder="Número do Telefone com DDD"
                                                   value="{{ old('cell') ?? $user->cell }}"/>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="app_collapse mt-2">
                                <div class="app_collapse_header collapse">
                                    <h3>Acesso</h3>
                                    <span class="icon-plus-circle icon-notext"></span>
                                </div>

                                <div class="app_collapse_content d-none">
                                    <div class="label_g2">
                                        <label class="label">
                                            <span class="legend">*E-mail:</span>
                                            <input type="email" name="email" placeholder="Melhor e-mail"
                                                   value="{{ old('email') ?? $user->email }}"/>
                                        </label>

                                        <label class="label">
                                            <span class="legend">Senha:</span>
                                            <input type="password" name="password" placeholder="Senha de acesso"
                                                   value=""/>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="complementary" class="d-none">
                            <div class="app_collapse">
                                <div class="app_collapse_header collapse">
                                    <h3>Cônjuge</h3>
                                    <span class="icon-plus-circle icon-notext"></span>
                                </div>

                                <div class="app_collapse_content d-none content_spouse">

                                    <label class="label">
                                        <span class="legend">Tipo de Comunhão:</span>
                                        <select name="type_of_communion" class="select2">
                                            <option value="">Selecione...</option>
                                            <option
                                                value="Comunhão Parcial de Bens"
                                                {{ (old('type_of_communion') == 'Comunhão Parcial de Bens' ? 'selected' : ($user->type_of_communion == 'Comunhão Parcial de Bens' ? 'selected' : '')) }}>
                                                Comunhão Parcial de Bens
                                            </option>
                                            <option value="Comunhão Universal de Bens"
                                                {{ (old('type_of_communion') == 'Comunhão Universal de Bens' ? 'selected' : ($user->type_of_communion == 'Comunhão Universal de Bens' ? 'selected' : '')) }}>
                                                Comunhão Universal de Bens
                                            </option>
                                            <option value="Participação Final de Aquestos"
                                                {{ (old('type_of_communion') == 'Participação Final de Aquestos' ? 'selected' : ($user->type_of_communion == 'Participação Final de Aquestos' ? 'selected' : '')) }}>
                                                Participação Final de Aquestos
                                            </option>
                                            <option value="Separação Convencional de Bens"
                                                {{ (old('type_of_communion') == 'Separação Convencional de Bens' ? 'selected' : ($user->type_of_communion == 'Separação Convencional de Bens' ? 'selected' : '')) }}>
                                                Separação Convencional de Bens
                                            </option>
                                            <option value="Separação Total de Bens"
                                                {{ (old('type_of_communion') == 'Separação Total de Bens' ? 'selected' : ($user->type_of_communion == 'Separação Total de Bens' ? 'selected' : '')) }}>
                                                Separação Total de Bens
                                            </option>
                                            <option value="Separação Obrigatória de Bens"
                                                {{ (old('type_of_communion') == 'Separação Obrigatória de Bens' ? 'selected' : ($user->type_of_communion == 'Separação Obrigatória de Bens' ? 'selected' : '')) }}>
                                                Separação Obrigatória de Bens
                                            </option>
                                        </select>
                                    </label>

                                </div>
                            </div>

                            <div class="app_collapse mt-2">
                                <div class="app_collapse_header collapse">
                                    <h3>Empresa</h3>
                                    <span class="icon-minus-circle icon-notext"></span>
                                </div>

                                <div class="app_collapse_content">

                                    <div class="companies_list">
                                        @if(count($user->companies()->get()))
                                            @foreach($user->companies()->get() as $company)
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
                                            <div class="no-content mb-2">Não foram encontrados registros!</div>
                                        @endif
                                    </div>

                                    <p class="text-right">
                                        @can('Cadastrar Empresa')
                                            <a href="{{ route('admin.companies.create', ['user' => $user->id]) }}"
                                               class="btn btn-green icon-building-o">
                                                Cadastrar Nova Empresa
                                            </a>
                                        @endcan
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div id="realties" class="d-none">
                            @if(!empty($curriculum->id))
                                <a href="{{ route('admin.curriculums.show', ['curriculum' => $curriculum->id]) }}"
                                   class="text-{{ env('COLOR_SITE') }}" target="_blank">Visualizar Currículo</a>
                            @else
                                <div class="no-content mb-2">Não foram encontrados registros!</div>
                            @endif
                        </div>

                        @can('Atribuir Permissões')
                            <div id="management" class="d-none">
                                <div class="label_gc">
                                    <span class="legend">Conceder:</span>
                                    <label class="label">
                                        <input type="checkbox" name="admin"
                                            {{ (old('admin') == 'on' || old('admin') == true ? 'checked' : ($user->admin == true ? 'checked' : '')) }}>
                                        <span>Administrativo</span>
                                    </label>

                                    <label class="label">
                                        <input type="checkbox" name="client"
                                            {{ (old('client') == 'on' || old('client') == true ? 'checked' : ($user->client == true ? 'checked' : '')) }}>
                                        <span>Cliente</span>
                                    </label>

                                    <label class="label">
                                        <input type="checkbox" name="company"
                                            {{ (old('company') == 'on' || old('company') == true ? 'checked' : ($user->company == true ? 'checked' : '')) }}>
                                        <span>Empresa</span>
                                    </label>
                                    @if($user->status == true)
                                        <label class="label">
                                            <input type="checkbox" name="status"
                                                {{ (old('status') == 'on' || old('status') == true ? 'checked' : ($user->status == true ? 'checked' : '')) }}>
                                            <span>Ativo</span>
                                        </label>
                                    @else
                                        <label class="label">
                                            <input type="checkbox" name="status"
                                                {{ (old('status') == 'on' || old('status') == true ? 'checked' : ($user->status == true ? 'checked' : '')) }}>
                                            <span>Inativo</span>
                                        </label>
                                    @endif

                                </div>
                                @foreach($roles as $role)
                                    <label class="label">
                                        <input type="checkbox"
                                               name="acl_{{ $role->id }}" {{ ($role->can == 1 ? 'checked' : '') }}>
                                        <span>{{ $role->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        @endcan
                    </div>

                    <div class="text-right mt-2">
                        <button class="btn btn-large btn-green icon-check-square-o" type="submit">
                            Salvar Alterações
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
