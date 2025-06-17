=================================================
 PROJETO: SISTEMA DE CADASTRO DE LIVROS PESSOAIS
=================================================

--------------------
1. TEMA ESCOLHIDO
--------------------

O tema escolhido para o sistema é um "Gerenciador de Biblioteca Pessoal", permitindo que usuários cadastrem e organizem sua coleção de livros.


--------------------------
2. RESUMO DO FUNCIONAMENTO
--------------------------

O sistema permite o gerenciamento completo de uma coleção de livros por usuário, com as seguintes funcionalidades:

- Cadastro de Usuários: Novos usuários podem se cadastrar no sistema criando um login, e-mail e senha.
- Autenticação Segura: O acesso à área de gerenciamento de livros é protegido por um sistema de login. A senha é armazenada de forma segura (hash).
- Gerenciamento de Livros (CRUD): Após o login, o usuário pode realizar as quatro operações básicas:
    - Criar: Adicionar novos livros à sua coleção, informando título, autor e uma descrição.
    - Ler: Visualizar todos os livros que ele mesmo cadastrou.
    - Atualizar: Editar as informações de um livro existente.
    - Deletar: Remover um livro de sua coleção.
- Privacidade: O sistema garante que um usuário só possa visualizar, editar e deletar os seus próprios livros, não tendo acesso aos livros de outros usuários.


------------------------
3. USUÁRIOS DE TESTE
------------------------

Para testar o sistema, os seguintes usuários foram pré-cadastrados no banco de dados.

Usuário 1:
Login: Tuntakamon
Senha: 1861

Usuário 2:
Login: jooj
Senha: 123


---------------------------------------
4. PASSOS PARA INSTALAÇÃO DO PROJETO
---------------------------------------

Para executar o projeto localmente, siga os passos abaixo.

Passo 4.1: Configuração dos Arquivos
   - Coloque a pasta completa do projeto no diretório raiz do seu servidor local (ex: /htdocs no XAMPP).
   - Verifique o arquivo /includes/conexao.php e, se necessário, ajuste os dados de acesso ao seu banco de dados MySQL (servidor, usuário, senha).

Passo 4.2: Importação do Banco de Dados (via phpMyAdmin)
   a) Crie um banco de dados vazio:
      - Acesse o phpMyAdmin.
      - No menu lateral, clique em "Novo".
      - Dê um nome ao banco, por exemplo: "meus_livros".
      - Clique em "Criar".

   b) Importe o arquivo SQL:
      - Após criar o banco, clique no nome dele na lista da esquerda para selecioná-lo.
      - No menu superior, clique na aba "Importar".
      - Na seção "Arquivo a importar", clique em "Escolher arquivo".
      - Navegue até a pasta do projeto e selecione o arquivo que está em: meus_livros/sql/meus_livros.sql.
      - Role a página até o final e clique no botão "Importar".

   c) Verificação:
      - Uma mensagem de sucesso deve aparecer.
      - As tabelas "usuarios" e "livros", já com os dados de teste, estarão visíveis dentro do seu banco de dados.

O sistema agora está pronto para ser acessado pelo navegador.
