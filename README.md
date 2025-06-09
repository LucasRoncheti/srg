# SRG - Sistema de Cadastros e Relatórios

## Descrição
O SRG é uma aplicação web desenvolvida em PHP que auxilia no controle de cadastros, pedidos, relatórios e outras etapas do processo produtivo. Utiliza MySQL para armazenar os dados e é composto por módulos para diferentes áreas (Cadastros, Pedidos, Relatórios, Inspeção, Pré-embarque e Packing List).

## Pré-requisitos
* PHP 7.4 ou superior
* Servidor Web (Apache ou equivalente) com suporte a PHP
* MySQL 5.7 ou superior

## Instalação e Configuração
1. Clone este repositório: `git clone <repositório>`
2. Configure o banco de dados em `generalPhp/conection.php` com suas credenciais.
3. Importe o esquema inicial do banco (se disponível).
4. Em um terminal, execute `php -S localhost:8000` ou configure a aplicação em seu servidor web.
5. Acesse `http://localhost:8000/index.php` e realize o login.

## Estrutura de Diretórios
```
assets/         Recursos estáticos (imagens, ícones)
cadastros/      Telas de cadastro de produtos, clientes, usuários etc.
generalPhp/     Arquivos PHP de suporte (ex.: conexão com BD)
generalScripts/ Scripts JavaScript gerais
index/          Estilos e scripts da página de login
inspessao/      Módulo de inspeção
mobileMenu/     Componentes de menu responsivo
onLoad/         Scripts e estilos de animação de carregamento
packingList/    Cadastro de packing list
pedidos/        Gerenciamento de pedidos
preEmbarque/    Operações de pré-embarque
relatorios/     Geração de relatórios
```

Para iniciar a aplicação localmente:
```bash
php -S localhost:8000
```
Então abra `http://localhost:8000/main.php` após efetuar o login.

---

# Alterações 




