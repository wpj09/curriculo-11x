<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    @vite([
    "resources/views/admin/assets/css/reset.css",
    "resources/views/admin/assets/css/boot.css",
    "resources/views/admin/assets/css/login.css",
    ])
    <link rel="icon" type="image/png" href="{{ asset('resources/views/admin/assets/images/favicon.png') }}"/>

{{--    <link rel="stylesheet" href="{{ url(mix('backend/assets/css/reset.css')) }}"/>--}}
{{--    <link rel="stylesheet" href="{{ url(mix('backend/assets/css/boot.css')) }}"/>--}}
{{--    <link rel="stylesheet" href="{{ url(mix('backend/assets/css/login.css')) }}"/>--}}
{{--    <link rel="icon" type="image/png" href="{{ url(asset('backend/assets/images/favicon.png')) }}"/>--}}

    <title>{{ env('CLIENT_DATA_IMOB') }} - Site Control</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

<div class="ajax_response"></div>

<div class="dash_login">
    <div class="dash_login_left">
        <article class="dash_login_left_box">
            <header class="dash_login_box_headline">
                <div class="dash_login_box_headline_logo icon-imob icon-notext"></div>
                <h1>Login</h1>
            </header>

            <form name="login" action="{{ route('admin.login.do') }}" method="post" autocomplete="off">
                <label>
                    <span class="field icon-envelope">E-mail:</span>
                    <input type="email" name="email" placeholder="Informe seu e-mail" required/>
                </label>

                <label>
                    <span class="field icon-unlock-alt">Senha:</span>
                    <input type="password" name="password_check" placeholder="Informe sua senha" required/>
                </label>

                <button class="gradient gradient-orange radius icon-sign-in">Entrar</button>
            </form>

            <footer>
                <p>Desenvolvido por <a href="https://www.williandev.com.br">www.<b>williandev</b>.com.br</a></p>
                <p>&copy; <?= date("Y"); ?> - Todos os Direitos Reservados</p>
                <p class="dash_login_left_box_support">
                    <a target="_blank"
                       class="icon-whatsapp transition text-green"
                       href="https://api.whatsapp.com/send?phone={{ env("TELL_IMOB") }}&text=Olá, preciso de ajuda com o login."
                    >Precisa de Suporte?</a>
                </p>
            </footer>
        </article>
    </div>

    <div class="dash_login_right"></div>

</div>

@vite([
    "resources/views/admin/assets/js/jquery.min.js",
    "resources/views/admin/assets/js/login.js"
])
{{--<script src="{{ url(mix('backend/assets/js/jquery.js')) }}"></script>--}}
{{--<script src="{{ url(mix('backend/assets/js/login.js')) }}"></script>--}}


</body>
</html>
