<h1 align="center">Curriculum</h1>

## O que é

Curriculum é uma aplicação que visa melhorar e centralizar empregados e empregadores

## Requisitos

- [GIT](https://git-scm.com/).
- [PHP](https://php.net/downloads.php).
- [Composer](https://getcomposer.org/download/).
- [Xampp](https://www.apachefriends.org/index.html)/[Wamp](https://www.wampserver.com/).
- [NODE](https://nodejs.org/en/).

## Instalação

```bash
git clone https://github.com/wpj09/curriculum.git
composer install
php -r "file_exists('.env') || copy('.env.example', '.env');"
php artisan key:generate
php artisan storage:link
npm install
mix
```

## Contributing

Desenvolvido por **[wpj09](https://www.instagram.com/wpj009/)**.

## Licença

Este projeto está licenciado nos termos da licença **Proprietária**.
