<h2 align="center">
    CRUD de clientes com Laravel 9
</h2>

## Sobre
Esta aplicação gerencia um formulário público para novos **clientes cadastrarem-se** e conta com uma área de administrador autenticada para gerenciar os **cadastros recebidos**.

Os recursos em foco aqui são:
- Integração com a api do [viacep](https://viacep.com.br/) para facilitar experiência de usuário nos formulários relacionados a endereço
- Experiência de **usuário administrador pré existente** para gerenciar os **usuários clientes** 

## Acesso para administrar o CRUD
A área de administração pode ser acessada através do caminho `/dashboard`

#### Login para demonstração
email: `master@admin.com`

password: `password`

## Requisitos do sistema
- PHP 8 ou superior
- MySQL

## Frameworks
- Laravel 9
- InertiaJS
- Vue3
- Bootstrap 5

## Instalação e configuração

1. Instale as dependências do composer
`composer install`

2. Crie o arquivo `.env` na raíz seguindo o `.env.example`
3. Informe as variáveis de conexão com o banco (env file)
4. Execute o comando `php artisan key:generate` para gerar a chave (env file)
5. Execute o comando `php artisan migrate:fresh --seed` para povoar o banco

## Execução Local

Após instalar e configurar, basta rodar o `php artisan serve` para subir o servidor local do php

## Front-end

O front-end deste projeto é configurado sob o laravel-mix que utiliza o webpack.

Instale as dependências com o comando: `yarn install`

Para compilar em desenvolvimento: `yarn dev`

Para compilar em produção: `yarn production`

Dev server: `yarn watch` (com browserSync)

#### Sobre o browserSync

O proxy padrão para atualizações automáticas é para `http://127.0.0.1:8000/`, altere no `webpack.mix.js` se necessário.

**Obs importante**: Mesmo em ambiente de desenvolvimento, lembre-se sempre de executar a aplicação no endereço principal (ex: `http://127.0.0.1:8000/`) e não no servidor de proxy gerado pelo browser sync, para evitar os conflitos de cors com o **InertiaJS**... A atualização automática é providenciada no endereço principal por meio de script.

## Laravel
https://laravel.com/docs/