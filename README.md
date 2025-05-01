# 📘 API de Gestão de Aluguéis de Veículos

Esta API fornece recursos completos para o gerenciamento de uma frota de veículos, cadastro de clientes, controle de reservas e fluxo de alugueis, com autenticação baseada em token.

---

## 📌 Sumário

- [Autenticação](#autenticação)
- [Veículos](#veículos)
- [Clientes](#clientes)
- [Aluguéis](#aluguéis)
- [Instalação](#instalação)
- [Execução](#execução)
- [Licença](#licença)

---

## 🔐 Autenticação

A API utiliza autenticação baseada em token. Após login, o cliente recebe um token de acesso que deve ser utilizado nos endpoints protegidos (via `Authorization: Bearer {token}`).

| Endpoint       | Método | Descrição                     |
|----------------|--------|-------------------------------|
| `/api/register` | POST   | Criar conta de usuário        |
| `/api/login`    | POST   | Autenticar e obter token      |
| `/api/logout`   | POST   | Invalidar token atual         |

```json
// POST /api/register
{
  "name": "João da Silva",
  "email": "joao@email.com",
  "password": "senhaSegura123",
  "password_confirmation": "senhaSegura123"
}

// POST /api/login
{
  "email": "joao@email.com",
  "password": "senhaSegura123"
}
```

---

## 🚗 Veículos

Permite o gerenciamento da frota com operações de CRUD.

**Campos:**
- `plate` (string): Placa do veículo
- `make` (string): Fabricante
- `model` (string): Modelo
- `daily_rate` (decimal): Valor diário de aluguel

| Endpoint             | Método | Descrição                      |
|----------------------|--------|--------------------------------|
| `/api/vehicles`      | GET    | Listar veículos (paginação)    |
| `/api/vehicles/{id}` | GET    | Obter detalhes de um veículo   |
| `/api/vehicles`      | POST   | Criar novo veículo             |
| `/api/vehicles/{id}` | PUT    | Atualizar veículo existente    |
| `/api/vehicles/{id}` | DELETE | Remover veículo                |

```json
// POST ou PUT /api/vehicles
{
  "plate": "ABC1234",
  "make": "Volkswagen",
  "model": "Gol G5",
  "daily_rate": 120.00
}
```

---


## 👤 Clientes

Gerencia os dados de clientes que alugam os veículos.

**Campos:**
- `name` (string)
- `email` (string)
- `phone` (string)
- `cnh` (string): Número da CNH

| Endpoint              | Método | Descrição                       |
|-----------------------|--------|---------------------------------|
| `/api/customers`      | GET    | Listar clientes (paginação)     |
| `/api/customers/{id}` | GET    | Detalhar cliente específico     |
| `/api/customers`      | POST   | Criar novo cliente              |
| `/api/customers/{id}` | PUT    | Atualizar dados de cliente      |
| `/api/customers/{id}` | DELETE | Excluir cliente                 |

```json
// POST ou PUT /api/customers
{
  "name": "Maria Oliveira",
  "email": "maria@email.com",
  "phone": "(41) 99999-9999",
  "cnh": "12345678900"
}
```

---

## 📆 Aluguéis

Controle de fluxo de reservas e alugueis, com cálculo automático do valor total com base nas datas e no valor diário.

**Campos:**
- `vehicle_id` (integer)
- `customer_id` (integer)
- `start_date` (date)
- `end_date` (date)
- `total_amount` (decimal) – calculado automaticamente

| Endpoint                    | Método | Descrição                                         |
|-----------------------------|--------|---------------------------------------------------|
| `/api/rentals`              | POST   | Criar reserva (sem data de início)               |
| `/api/rentals/{id}/start`   | POST   | Iniciar aluguel (define `start_date`)            |
| `/api/rentals/{id}/end`     | POST   | Encerrar aluguel (define `end_date` e calcula `total_amount`) |
| `/api/rentals`              | GET    | Listar todas as reservas/alugueis                |
| `/api/rentals/{id}`         | GET    | Detalhar dados de um aluguel específico          |

```json
// POST /api/rentals
{
  "vehicle_id": 1,
  "customer_id": 2
}
```

As rotas de start e end são rotas que irão realizar a ação com base na data atual.

---

## ⚙️ Instalação

Para rodar esse projeto, temos que instalar outros dois projetos, sendo eles:
- ElasticSearch
- RevenueAPI (https://github.com/KauanValle/flask_revenue_api.git)

O tutorial de instalação de ambos os projetos estão no README

Primeiro passo iremos clonar esse projeto
```bash
git clone https://github.com/KauanValle/rent_vehicle_api.git
```

Logo depois iremos subir o docker do projeto
```bash
docker-compose up -d
```

Iremos acessar o container
```bash
docker exec -it rent_vehicle_app bash
```

Agora vamos executar a instalação das dependencias
```bash
composer install
php artisan key:generate
php artisan jwt:secret
```

E logo depois de instalar as dependencias iremos sair do terminal
```bash
exit
```

E agora vamos dar as permissões para a pasta do projeto com os seguintes comandos
```bash
cd ..
chmod -R 777 rent_vehicle_app/*
```

E agora iremos dar um clone do arquivo .env.example e mudar o nome dele para .env

E agora o projeto está pronto para ser utilizado.
