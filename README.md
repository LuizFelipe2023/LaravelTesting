
# Testes para o `PessoaController`

Este repositório contém testes automatizados para o controlador `PessoaController`, que implementa as operações CRUD (Create, Read, Update, Delete) para o modelo `Pessoa`. Os testes foram escritos utilizando o framework de testes PHPUnit no Laravel.

## Estrutura do CRUD

O controlador `PessoaController` permite as seguintes operações básicas:

1. **Criar uma Pessoa (Create)**:
   - Criação de um novo registro de pessoa no banco de dados com informações como nome e idade.

2. **Listar Pessoas (Read - Index)**:
   - Exibição de uma lista de todas as pessoas cadastradas.

3. **Visualizar Pessoa (Read - Show)**:
   - Exibição de detalhes de uma pessoa específica com base no seu ID.

4. **Atualizar uma Pessoa (Update)**:
   - Atualização dos dados de uma pessoa existente.

5. **Deletar uma Pessoa (Delete)**:
   - Exclusão de uma pessoa do banco de dados.

## Testes Implementados

### Testes de Funcionalidade CRUD

1. **Testar a Exibição da Página Inicial (`test_index_exists`)**
   - Verifica se a rota `/pessoas` está acessível e retorna o status 200.

2. **Testar Exibição da Lista de Pessoas (`test_index_shows_pessoas`)**
   - Verifica se a página de listagem de pessoas exibe corretamente os dados de uma pessoa criada no banco de dados.

3. **Testar a Exibição de Pessoa Específica (`test_find_pessoa`)**
   - Cria uma pessoa no banco de dados e verifica se ao acessar a rota para exibir os detalhes dessa pessoa, o sistema retorna o status 200 e exibe corretamente o nome e idade da pessoa.

4. **Testar a Exibição de Pessoa Não Encontrada (`test_find_pessoa_not_found`)**
   - Verifica o comportamento do sistema quando se tenta acessar uma pessoa que não existe (ID inexistente). O sistema deve retornar o status 404.

5. **Testar Criação de Pessoa (`test_create_pessoa`)**
   - Testa a criação de uma nova pessoa no banco de dados e verifica se o redirecionamento ocorre para a página de listagem de pessoas após a criação.

6. **Testar Validação ao Criar Pessoa (`test_create_pessoa_validation`)**
   - Verifica se o sistema valida os campos obrigatórios na criação de uma nova pessoa. Caso os campos `nome` e `idade` estejam vazios, o sistema deve retornar erros de validação.

7. **Testar Atualização de Pessoa (`test_update_pessoa`)**
   - Testa a atualização de uma pessoa existente. Verifica se os dados da pessoa são atualizados corretamente no banco de dados após a atualização.

8. **Testar Validação ao Atualizar Pessoa (`test_update_pessoa_validation`)**
   - Verifica se o sistema valida os dados ao tentar atualizar uma pessoa com valores inválidos (por exemplo, nome vazio ou idade inválida).

9. **Testar Deletação de Pessoa (`test_delete_pessoa`)**
   - Testa a exclusão de uma pessoa do banco de dados e verifica se a pessoa foi realmente removida após a requisição de exclusão.



