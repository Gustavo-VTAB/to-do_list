# 📋 Sistema de Gerenciamento de Tarefas

Um sistema simples de gerenciamento de tarefas (To-Do List) com autenticação de usuários, integração com API de clima, e animação de chuva. Desenvolvido em PHP, JavaScript e PostgreSQL.

## 🚀 Funcionalidades

- Autenticação de usuários (cadastro e login)
- CRUD de tarefas com:
  - Descrição
  - Data limite
  - Status (Pendente, Em andamento, Concluída)
- Filtro por status e data
- Marcar tarefa como concluída com checkbox
- Integração com OpenWeatherMap para exibir clima
- Efeito de chuva animado com JavaScript

## 🛠️ Tecnologias usadas

- PHP
- PostgreSQL
- HTML + CSS + Bootstrap
- JavaScript + jQuery
- Font Awesome
- OpenWeatherMap API

## 📦 Estrutura do projeto

📁 src/ │
├── styles/ │ 
  │ └── style.css │ 
  │ └── style-login.css 
│ └── javascript/ 
  │ └── script.js 
  │ └── script-login.js 
  │ └── script-cad.js 
📁 database/ 
  │ └── conn.php 
📁 actions/ 
  │ └── create.php 
  │ └── delete.php 
  │ └── update.php 
📄 index.php 
📄 criar-conta.php 
📄 tarefas.php 
📄 README.md


## 🧪 Como rodar localmente

1. Clone o projeto:
   ```bash
   git clone https://github.com/Gustavo-VTAB/listador-de-tarefas.git

-- Veja a seção "📄 Banco"
