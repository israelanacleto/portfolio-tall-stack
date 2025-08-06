# 📋 Changelog - Portfolio TALL Stack

Todas as mudanças significativas do projeto serão documentadas neste arquivo.

## 🎯 Padrão de Documentação

### Para cada mudança definitiva, documentar:
- **Data**: Quando foi implementada
- **Tipo**: [FEAT|FIX|REFACTOR|DOCS|STYLE|TEST|CHORE]
- **Descrição**: O que foi feito
- **Impacto**: Como afeta o projeto
- **Breaking Changes**: Se quebra compatibilidade
- **Migration**: Comandos necessários para aplicar

---

## [Não Versionado] - 2025-08-06

### FEAT - Seeders com Dados Iniciais
**Descrição**: Criação de seeders completos para popular o banco com dados de desenvolvimento

**Implementado**:
- TechnologySeeder com 13 tecnologias organizadas por categorias
- ProjectSeeder com 5 projetos de exemplo representativos
- DatabaseSeeder configurado para criar usuário admin
- Dados realistas baseados no perfil de desenvolvedor .NET/Angular migrando para TALL Stack

**Categorias de Tecnologias**:
- **Backend**: PHP, Laravel, C#
- **Frontend**: Livewire, Tailwind CSS, Alpine.js, JavaScript, Angular, Vite
- **Database**: PostgreSQL, Redis
- **DevOps**: Docker, Git

**Projetos de Exemplo**:
- Portfolio TALL Stack (projeto atual com metadados)
- Sistema E-commerce .NET (experiência anterior)
- Dashboard Angular Analytics (competência em frontend)
- API REST Laravel JWT (conhecimento de APIs)
- Sistema Gestão Escolar (projeto complexo)

**Para executar**:
```bash
docker compose exec app php artisan migrate:fresh --seed
```

**Resultado**: 13 tecnologias + 5 projetos + 1 admin user inseridos com sucesso

---

## [Não Versionado] - 2025-08-06

### FEAT - Jetstream com Livewire e Schema PostgreSQL Completo
**Descrição**: Instalação completa do Laravel Jetstream com Livewire e criação de schema otimizado para PostgreSQL

**Implementado**:
- Laravel Jetstream 5.5 com Livewire 3 para autenticação
- Dark mode configurado no Tailwind CSS (`darkMode: 'class'`)
- 4 migrations otimizadas para PostgreSQL com UUIDs:
  * **projects** - JSONB tech_stack, full-text search, índices GIN
  * **technologies** - categorias, cores, ícones organizados
  * **contacts** - sistema de status e metadata JSONB
  * **project_images** - relacionamento com projetos, tipos de imagem
- Models configurados com HasUuids trait e relacionamentos
- Assets compilados com Vite (CSS + JS)

**Features Funcionais**:
- ✅ Sistema de registro/login funcionando
- ✅ Dashboard após autenticação
- ✅ Dark mode toggle disponível
- ✅ Conexão PostgreSQL 15.13 estabelecida
- ✅ Full-text search configurado nos projetos
- ✅ Relacionamentos entre Project ↔ ProjectImage
- ✅ Scopes úteis (active, featured, search)

**Configuração Técnica**:
- UUIDs como chaves primárias em todas as tabelas
- Índices otimizados para performance no PostgreSQL
- JSONB para metadados flexíveis
- Casts apropriados para arrays e objetos
- Accessors para URLs de imagens

**Aplicação Disponível**:
- 🌐 **http://localhost:8000** - Aplicação principal
- 📧 **http://localhost:8025** - Mailhog para testes de email

**Para aplicar**:
```bash
docker compose up -d
docker compose exec app php artisan migrate
docker compose exec app npm run build
```

---

## [Não Versionado] - 2025-01-05

### FEAT - Laravel Instalado e Configurado
**Descrição**: Laravel instalado com sucesso na pasta `src` e configurado para PostgreSQL

**Implementado**:
- Laravel 12.21.0 instalado via Composer
- Configuração .env atualizada para PostgreSQL
- Conexão com banco postgres funcionando (migrations executadas)
- Cache e sessões configurados para Redis
- Email configurado para Mailhog
- Permissões de storage configuradas

**Testes realizados**:
- ✅ Migrations executaram com sucesso no PostgreSQL
- ✅ Laravel Tinker funcionando
- ✅ Artisan commands funcionando
- ⚠️  Nginx/Supervisor precisam ser ajustados

**Configuração atual**:
- PostgreSQL na porta 5432
- Redis na porta 6379  
- Mailhog UI na porta 8025
- Aplicação será na porta 8000 (após ajuste Nginx)

---

### REFACTOR - Reorganização da Estrutura do Projeto
**Descrição**: Reestruturação completa dos diretórios conforme especificação do projeto

**Mudanças**:
- Dockerfile movido para `docker/php/Dockerfile`
- nginx.conf renomeado para `default.conf`
- supervisord.conf movido para `docker/php/`
- opcache.ini criado separadamente
- Diretório `src/` criado para código Laravel
- docker-compose.yml atualizado com novas referências

**Impacto**: Estrutura agora segue exatamente a especificação planejada

**Para aplicar**: `make build` (rebuild necessário por mudança no Dockerfile)

---

### FEAT - Setup Inicial do Ambiente
**Descrição**: Configuração completa do ambiente de desenvolvimento Docker para TALL Stack

**Implementado**:
- Docker Compose com serviços completos (App, PostgreSQL, Redis, Mailhog, Node)
- Dockerfile otimizado com PHP 8.2-FPM e Alpine Linux
- Configurações Nginx para Laravel
- Scripts de automação (Makefile, install-laravel.sh)
- Configuração inicial do .env

**Arquivos Criados**:
- `Dockerfile` - Container PHP 8.2 otimizado
- `docker-compose.yml` - Orquestração de serviços
- `docker/nginx/nginx.conf` - Configuração Nginx
- `docker/php/php.ini` - Configurações PHP otimizadas
- `docker/supervisord.conf` - Gerenciamento de processos
- `Makefile` - Commands utilitários
- `install-laravel.sh` - Script de instalação automatizada
- `.dockerignore` - Otimização de build

**Impacto**: Base sólida para desenvolvimento com hot-reload e todos os serviços necessários

**Para aplicar**:
```bash
make build
make up  
make install
```

---

## 🚀 Próximas Etapas Planejadas

### Fase 1: Estrutura Laravel + Jetstream ✅ 
- [x] Instalação Laravel com Jetstream + Livewire
- [x] Configuração PostgreSQL
- [x] Primeiro deploy do ambiente

### Fase 2: Models e Migrations ✅
- [x] Migration projects com JSONB
- [x] Model Project com relationships
- [x] Full-text search setup
- [ ] Seeds iniciais

### Fase 3: Frontend Base 🎨
- [x] Layout principal (Jetstream)
- [x] Navigation component (Jetstream)
- [x] Theme switcher (Dark/Light)
- [ ] Hero section personalizada
- [ ] Portfolio components
- [ ] Project showcase layout

### Fase 4: CMS Admin 📋 (Próximo)
- [ ] Admin dashboard para projetos
- [ ] CRUD de projetos com Livewire
- [ ] Upload de imagens
- [ ] Gerenciamento de tecnologias
- [ ] Sistema de contato funcionando

---

## 📝 Regras de Documentação Estabelecidas

1. **Toda mudança definitiva** deve ser documentada antes do commit
2. **Usar conventional commits**: feat, fix, docs, style, refactor, test, chore
3. **Documentar breaking changes** que afetem outros desenvolvedores
4. **Incluir comandos de migration** quando necessário
5. **Atualizar este CHANGELOG.md** a cada feature concluída