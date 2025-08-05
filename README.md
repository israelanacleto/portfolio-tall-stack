# 🚀 Portfolio TALL Stack

> Portfolio profissional moderno construído com TALL Stack para desenvolvedor Full Stack .NET/Angular

Um projeto que demonstra versatilidade técnica além do stack Microsoft, criado para atrair novas oportunidades de carreira.

## 🚀 Stack Tecnológica

- **Laravel 10** - Framework PHP
- **Livewire 3** - Componentes dinâmicos
- **Alpine.js** - JavaScript reativo
- **Tailwind CSS** - Framework CSS
- **Jetstream** - Scaffolding de autenticação
- **PostgreSQL** - Banco de dados
- **Redis** - Cache e sessões
- **Docker** - Containerização

## 📋 Pré-requisitos

- Docker
- Docker Compose
- Make (opcional)

## 🛠️ Instalação

### 1. Clone e configure

```bash
git clone <seu-repo>
cd portfolio-tall-stack
cp .env.example .env
```

### 2. Construa os containers

```bash
make build
# ou
docker-compose build
```

### 3. Inicie os serviços

```bash
make up
# ou
docker-compose up -d
```

### 4. Instale o Laravel com Jetstream

```bash
make install
# ou
docker-compose exec app bash install-laravel.sh
```

## 🎯 Comandos Úteis

```bash
# Visualizar status dos containers
make status

# Acessar shell do container
make shell

# Executar migrações
make migrate

# Limpar caches
make cache-clear

# Executar testes
make test

# Iniciar dev server (Vite)
make npm-dev
```

## 🌐 Acesso

- **Aplicação**: http://localhost:8000
- **Mailhog**: http://localhost:8025
- **PostgreSQL**: localhost:5432
- **Redis**: localhost:6379

## 📁 Estrutura

```
portfolio-tall-stack/
├── docker/
│   ├── nginx/nginx.conf
│   ├── php/php.ini
│   └── postgres/init/
├── docker-compose.yml
├── Dockerfile
├── Makefile
└── install-laravel.sh
```

## 🔧 Desenvolvimento

1. **Frontend**: Use `make npm-dev` para desenvolvimento com hot-reload
2. **Backend**: Modifique arquivos PHP - mudanças são refletidas automaticamente
3. **Database**: Use Tinker: `docker-compose exec app php artisan tinker`

## 📦 Produção

```bash
# Otimizar para produção
make optimize

# Build de assets
make npm-build
```

## 📚 Documentação

- **[PROJETO.md](PROJETO.md)** - Especificação completa e roadmap
- **[CHANGELOG.md](CHANGELOG.md)** - Histórico de mudanças
- **[Dockerfile](Dockerfile)** - Container PHP 8.2 otimizado

## 🐛 Troubleshooting

- **Permissões**: `docker-compose exec app chown -R sail:sail storage bootstrap/cache`
- **Cache**: `make cache-clear`
- **Logs**: `make logs`

## 🤝 Desenvolvimento

Este projeto segue as **regras de documentação** estabelecidas:
- Toda mudança definitiva deve ser documentada no CHANGELOG.md
- Usar conventional commits (feat, fix, docs, etc.)
- Documentar breaking changes e comandos de migration

## 🎯 Próximos Passos

1. **Fazer setup inicial**: `make build && make up && make install`
2. **Verificar documentação**: Ler `PROJETO.md` para entender a visão completa
3. **Iniciar Fase 2**: Criar migrations e models otimizados para PostgreSQL