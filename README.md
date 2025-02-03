# Sistema de Gestão de Biblioteca com Symfony e Twig

Este projeto é um Sistema FullStack para gestar livros, construído com **Symfony**, **Twig** e banco de dados **MySQL**.  

## Requisitos **
Tenha Instalado na máquina:
- **PHP 8.1+**
- **Composer**
- **Symfony CLI**
- **MySQL** 

1. Clone o repositório:
   ```bash
   git clone https://github.com/Void654/biblioteca1.git
   ```

2. Instale as dependências do projeto:
    ```bash
    composer install
    ```

3. Configure o arquivo .env com suas credenciais do banco de dados:

    ```bash
    DATABASE_URL="mysql://usuario:senha@127.0.0.1:3306/nome_do_banco"
    ```

4. Crie o banco de dados e execute as migrações:

    ```bash
    php bin/console doctrine:database:create
    php bin/console doctrine:migrations:migrate
    ```

5. Se necessário, carregue dados iniciais (opcional):

    ```bash
    php bin/console doctrine:fixtures:load
    ```

##  **Rodando o Servidor**

1. Inicie o servidor local com:

    ```bash
    symfony server:start
    ```

2. A aplicação estará disponível em:
    ```bash
      http://127.0.0.1:8000
    ```

##  **Lista de Endpoints**

  | Método  | Rota              | Descrição                  |
  |---------|------------------|-----------------------------|
  | GET     | `/api/books`      | Listar todos os livros     |
  | GET     | `/api/books/{id}` | Obter detalhes de um livro |
  | POST    | `/api/books`      | Adicionar um novo livro    |
  | PUT     | `/api/books/{id}` | Atualizar um livro         |
  | DELETE  | `/api/books/{id}` | Remover um livro           |

### **Exemplo de JSON para Criar um Livro (POST `/api/books`)**
  ```json
    {
      "title": "Harry Potter",
      "author": "J. K. Rowling",
      "description": "Harry Potter e a Pedra Filosofal",
      "year": 1998
    }
  ```
