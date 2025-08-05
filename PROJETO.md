# 🎯 Portfolio TALL Stack - Especificação do Projeto

## 👨‍💻 Sobre o Desenvolvedor
**Perfil**: Desenvolvedor Full Stack .NET + Angular (4 anos)  
**Objetivo**: Criar portfolio moderno usando TALL Stack para mostrar projetos e atrair oportunidades  
**Meta**: Demonstrar versatilidade técnica além do stack Microsoft  

---

## 🏗️ Arquitetura Técnica

### Stack Principal
- **T**ailwind CSS - Framework CSS utility-first
- **A**lpine.js - JavaScript reativo minimalista  
- **L**aravel 10 - Framework PHP robusto
- **L**ivewire 3 - Componentes dinâmicos server-side
- **PostgreSQL 15** - Banco relacional avançado
- **Redis** - Cache e sessões
- **Docker** - Containerização completa

### Estrutura de Pastas Planejada
```
portfolio/
├── docker/
│   ├── nginx/default.conf
│   ├── php/
│   │   ├── Dockerfile
│   │   ├── php.ini
│   │   └── opcache.ini
│   └── postgres/init.sql
├── src/ (código Laravel)
├── docker-compose.yml
├── .env
└── README.md
```

---

## 🎨 Funcionalidades Principais

### 🌐 Área Pública
- **Hero Section**: Apresentação animada com typed.js
- **Sobre**: Timeline de experiência profissional
- **Projetos**: Grid com filtros dinâmicos (tecnologia, tipo, ano)
- **Modal Detalhado**: Screenshots, tech stack, links dos projetos
- **Blog Técnico**: Artigos sobre desenvolvimento (opcional)
- **Contato**: Formulário com validação real-time
- **Theme**: Dark/Light mode persistente
- **Animações**: Transições suaves com Alpine.js

### 🔐 Área Administrativa (CMS)
- **Dashboard**: Analytics e estatísticas
- **Gestão de Projetos**: CRUD completo com upload de imagens
- **Editor Markdown**: Para descrições dos projetos
- **Analytics**: Visualizações, contatos, métricas
- **Skills**: Gerenciamento de tecnologias e competências

---

## 📊 Database Schema (PostgreSQL)

### Tabelas Principais
```sql
-- Projetos com recursos avançados do Postgres
projects (
    id UUID PRIMARY KEY,
    title VARCHAR,
    slug VARCHAR UNIQUE,
    description TEXT,
    tech_stack JSONB,        -- Array de tecnologias
    metadata JSONB,          -- Dados flexíveis
    github_url VARCHAR,
    live_url VARCHAR,
    featured BOOLEAN,
    views INTEGER,
    created_at TIMESTAMP
)

-- Tecnologias categorizadas
technologies (
    id UUID,
    name VARCHAR,
    icon VARCHAR,
    category VARCHAR        -- frontend, backend, database, etc
)

-- Imagens dos projetos
project_images (
    id UUID,
    project_id UUID,
    path VARCHAR,
    alt_text VARCHAR,
    order INTEGER
)

-- Contatos do formulário
contacts (
    id UUID,
    name VARCHAR,
    email VARCHAR,
    message TEXT,
    metadata JSONB,         -- IP, user agent, etc
    created_at TIMESTAMP
)

-- Analytics flexível
analytics (
    id UUID,
    event_type VARCHAR,     -- page_view, project_view, contact
    data JSONB,             -- Dados do evento
    created_at TIMESTAMP
)
```

### Recursos Avançados do PostgreSQL
- **JSONB**: Para tech_stack e metadata flexíveis
- **Full-text Search**: Busca nativa em projetos
- **UUIDs**: Primary keys mais seguras
- **Índices Parciais**: Performance otimizada
- **Window Functions**: Analytics avançados

---

## 📅 Roadmap de Desenvolvimento

### 🚀 Fase 1: Setup Inicial (Dia 1)
- [x] Docker Compose completo
- [ ] Instalação Laravel + Jetstream
- [ ] Configuração PostgreSQL
- [ ] Teste do ambiente

### 🏗️ Fase 2: Estrutura Base (Dias 2-3)
- [ ] Migrations com recursos PostgreSQL
- [ ] Models eloquent otimizados
- [ ] Layout principal e navigation
- [ ] Footer e theme switcher

### 🎨 Fase 3: Componentes Públicos (Dias 4-7)
- [ ] Hero section com animações
- [ ] Grid de projetos com filtros
- [ ] Modal detalhado dos projetos
- [ ] Formulário de contato
- [ ] Seção "Sobre"

### 🔐 Fase 4: Área Admin (Dias 8-10)
- [ ] Dashboard com estatísticas
- [ ] CRUD de projetos
- [ ] Upload de imagens
- [ ] Sistema de analytics

### ⚡ Fase 5: Performance (Dias 11-13)
- [ ] Cache com Redis
- [ ] Otimização de queries
- [ ] Lazy loading
- [ ] CDN para imagens
- [ ] SEO completo

### 🚁 Fase 6: Deploy (Dia 14)
- [ ] Configuração de produção
- [ ] CI/CD pipeline
- [ ] Monitoramento
- [ ] Backup automatizado

---

## 🎯 Diferenciais Técnicos

### Performance
- OPcache configurado
- Redis para cache e sessões
- Lazy loading de componentes
- Queries otimizadas com EXPLAIN ANALYZE

### SEO & Analytics
- Meta tags dinâmicas
- Schema.org para projetos
- Sitemap.xml automático
- Analytics customizado

### User Experience
- Responsivo mobile-first
- Animações fluidas
- Loading states
- Error handling elegante

### Developer Experience
- Docker ambiente completo
- Makefile com comandos úteis
- Hot reload frontend/backend
- Logs centralizados

---

## 🛠️ Comandos de Desenvolvimento

```bash
# Ambiente
make build          # Construir containers
make up             # Iniciar serviços
make down           # Parar serviços
make install        # Instalar Laravel + Jetstream

# Desenvolvimento
make shell          # Acessar container
make logs           # Ver logs
make migrate        # Executar migrations
make fresh          # Migration fresh + seed

# Frontend
make npm-dev        # Dev server Vite
make npm-build      # Build produção

# Manutenção  
make cache-clear    # Limpar caches
make optimize       # Otimizar produção
make test           # Executar testes
```

---

## 📝 Notas de Implementação

### Aproveitando Experiência .NET
- **Conceitos similares**: Eloquent ORM ≈ Entity Framework
- **Dependency Injection**: Service Container Laravel
- **Middleware**: Pipeline similar ao ASP.NET Core
- **Validation**: Request validation similar ao .NET

### Transição Angular → Livewire
- **Componentes**: Conceito similar, mas server-side
- **Data binding**: Two-way binding mantido
- **Eventos**: Similar ao EventEmitter
- **Lifecycle**: Hooks familiares (mount, hydrate, etc)

### PostgreSQL vs SQL Server
- **JSON**: JSONB vs JSON nativo
- **Full-text**: Built-in vs Search Service
- **Performance**: Comparable para aplicações web
- **Syntax**: Pequenas diferenças em funções

---

*Este documento será atualizado conforme o projeto evolui*