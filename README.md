Projeto Yii API
Este modelo de projeto contém a estrutura de diretório para seu projeto de API. Todo o código é gerado a partir de um arquivo de descrição da API OpenAPI. Quando trabalhar com este modelo, você segue a abordagem centrada no design de API (Design-First Approach).

Introdução
Este projeto é uma estrutura de projeto para desenvolver uma API usando o framework PHP Yii. Inclui os arquivos de configuração, dependências, migrações e controllers para criar uma API totalmente funcional.

Arquitetura
Este projeto segue a arquitetura padrão do Yii. Ao nível raiz, temos:

config/: Pasta contendo arquivos de configuração para o aplicativo, tais como db.php, params.php e main.php.
controllers/: Pasta contendo os controllers da sua API, cada um responsável por lidar com uma rota específica.
migrations/: Pasta contendo as migrações do seu banco de dados.
models/: Pasta contendo os models de banco de dados, que servem como objetos de transferência de dados (DTOs) para a sua API.
runtime/: Pasta contendo arquivos de logs e caches temporários.


./yii migrate/up
Executar a aplicação
A API está disponível em http://localhost:8000.

Documentação
A documentação da guia pode ser encontrada no diretório docs/guide.

make docker-run
A API estará disponível em http://localhost:8000.

Dependências
As principais dependências do projeto são:

PHP
Yii Framework 2.0
Composer
Extensão OpenSSL
Extensão PDO


Configuração
Para configurar esse projeto, você precisará definir as configurações do seu banco de dados acessando o arquivo config/db.php e substituindo as dsn, username e password pelos dados apropriados.