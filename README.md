# Carteira_tech - Aplicação de Organização Financeira

## Tópicos

* [O Projeto](#O-Projeto)
* [Desenvolvedor](#Desenvolvedor)
* [Estrutura do Software](#Estrutura-do-Software)
  * [Diagrama do Banco de Dados](#Diagrama-do-Banco-de-Dados)
* [Tecnologias](#Tecnologias)
  * [Instalar e utilizar](#Como-instalar-e-utilizar)
* [Endpoints](#Endpoints-e-Telas

## O Projeto

Esse projeto tem como objetivo praticar e aprimorar habilidades e conhecimentos em desenvolvimento Back-End e Front-End. Para isso foi construído um projeto de aplicação em ambiente WEB para organização financeira adicionando transações especificando sua categoria entre as contas do usuário com seus respectivos tipos, e visualização de relatórios e gráficos dos dados e transações inseridas. Esse projeto foi desenvolvido com as funcionalidades de registrar todas receitas e despesas, visualizar os dados de forma rápida e fácil e assim ajudar a analisar todas as suas finanças.

## Desenvolvedor

Projeto desenvolvido individualmente para uso pessoal e desenvolver habilidades.

<table>
  <tr>
      <td align="center"><a href="https://github.com/zecarlos558"><img style="border-radius: 50%;" src="https://avatars.githubusercontent.com/zecarlos558" width="100px;" alt=""/><br /><sub><b>José Carlos</b></sub></a><br /><a href="https://github.com/hellomp" title="José Carlos"></a></td>
    </tr>
</table>


## Estrutura do Software

O sistema consiste nas funcionalidades de CRUD para Usuários, Contas, Tipos de Conta, Transações, Categoria da Transação, Grupo da Categoria e geração de relatórios e gráficos. As funcionalidades são acessadas através de páginas WEB para a listagem/cadastro/edição/deleção de todas as funciolidades acima descritas, as páginas devem ter navegação entre elas, e uma página para exibir os relatório de receitas e despesas. O sistema possui transações de retirada e suprimento, precisando ser selecionada a conta que vai ser movimentada e a categoria da transação para caracteriza-la. Sendo as categorias das transações definidas por grupo. O projeto foi desenvolvido dentro do Padrão da Arquitetura MVC. O sistema possui autenticação do usuário para acessar as funcionalidades do CRUD e relatório. Também possui integração com o [Laravel Telescope](https://laravel.com/docs/9.x/telescope) para facilitar a depuração e análise de informações da aplicação.


### Diagrama do Banco de Dados

Apresentação do Diagrama de Entidade Relacionamento desenvolvido no projeto.

![Diagrama do Banco de Dados](https://raw.githubusercontent.com/zecarlos558/Carteira_tech/docs/imagens/DER_carteira_tech.png)

## Tecnologias

- PHP 8.0
- MySQL 8.0.27
- Laravel 9.0
- Bootstrap 5
- Git

### Como instalar e utilizar

  - Baixar ou clonar o projeto do Github. 

  - Instalar o PHP (Versão 8.0 ou superior).

  - Instalar uma base de dados MySQL([MySQL Workbench](https://dev.mysql.com/downloads/workbench/)) para armazenamento dos dados (Ou uma base de dados de sua preferência).

  - Configurar o arquivo .env, alterando as informações do banco de dados como o modelo a seguir feito para MySQL

      - ```php
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=laravel
        DB_USERNAME=root
        DB_PASSWORD=
        ```
        
  - Abra o terminal na pasta do projeto e digite o comando para baixar as dependências do laravel através do composer (É necessário ter instalado o composer para realizar esses passos)

      - ```less
        composer install
        ```
        
  - Continuando no terminal na pasta do projeto digite o comando para criar as tabelas no banco

      - ```less
        php artisan migrate
        ```

  - Por fim no terminal na pasta do projeto digite o comando para iniciar o servidor

      - ```less
        php artisan serve
        ```

  - Pronto, a aplicação está rodando!

  - Vá ao navegador e digite a url:

      - ```http
        http://127.0.0.1:8000/
        ```
        
## Endpoints e Telas

Aqui está listado exemplo de Endpoints da aplicação em um servidor web online gratuito, para melhor orientação e visualização na utilização do sistema. A página inicial é a única que não precisa de autenticação do usuário, para acessar todas as outras páginas é necessário o Login para confirmar a autenticação do usuário. Possui um menu fixo para navegador desktop(lg) e com opção de expandir barra lateral para dispositivos menores(sm) que permitirá navegação entre as páginas do sistema.

##### Página Inicial

Tela de apresentação, possui acesso ao cadastro de conta e login do sistema

```http
http://localhost/
```

![HOME](https://raw.githubusercontent.com/zecarlos558/Carteira_tech/dosc/imagens/HOME.png)

##### Painel do Usuário - Dashboard

Tela de DASHBOARD, possui acesso as principais funcionalidades e relatórios simplificados do sistema em seu corpo.

```http
http://localhost/usuario/inicial
```

![DASHBOARD](https://raw.githubusercontent.com/zecarlos558/Carteira_tech/docs/imagens/DASHBOARD.png)
