# Teste de API de vendas da Adoorei
Este repositório contém testes automatizados desenvolvidos com o Pest para garantir o correto funcionamento de um CRUD (Create, Read, Update, Delete) para entidades de produtos/vendas em uma API.

## Pré-requisitos
Certifique-se de ter o ambiente de desenvolvimento configurado com o Laravel e o Pest. Para instalar as dependências, execute:
```bash
composer install
```

Para executar os testes em uma instância de banco de dados isolada do ambiente de desenvolvimento/produção:
```bash
# Criação do usuário 'root_testing' com senha 'root_testing'
CREATE USER 'root_testing'@'localhost' IDENTIFIED BY 'root_testing';

# Criação do banco de dados 'adoorei_api_sales_testing'
CREATE DATABASE adoorei_api_sales_testing;

# Concessão de todas as permissões para o usuário 'root_testing' no banco de dados 'adoorei_api_sales_testing'
GRANT ALL ON adoorei_api_sales_testing.* TO 'root_testing'@'localhost';

# Crie o arquivo de variáveis de ambiente de testing
cp .env.example .env.testing
```

Edite o arquivo .env.testing com as credenciais que foram criadas:
```bash
APP_ENV=testing

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=adoorei_api_sales_testing
DB_USERNAME=root_testing
DB_PASSWORD=root_testing
```

## Execução
Execute o comando para inicializar os testes:
```bash
php artisan test
```
<img src="https://i.ibb.co/9gqdjQr/Sem-t-tulo1234.png">

## Endpoints
Importe os endpoints para o Insomnia
```
./Insomnia_2024-02-29.json (dentro dos arquivos do projeto)
```
