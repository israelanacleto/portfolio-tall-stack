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

### Fase 1: Estrutura Laravel + Jetstream ⏳
- [ ] Instalação Laravel com Jetstream + Livewire
- [ ] Configuração PostgreSQL
- [ ] Primeiro deploy do ambiente

### Fase 2: Models e Migrations 📋
- [ ] Migration projects com JSONB
- [ ] Model Project com relationships
- [ ] Full-text search setup
- [ ] Seeds iniciais

### Fase 3: Frontend Base 🎨
- [ ] Layout principal
- [ ] Navigation component
- [ ] Theme switcher (Dark/Light)
- [ ] Hero section

---

## 📝 Regras de Documentação Estabelecidas

1. **Toda mudança definitiva** deve ser documentada antes do commit
2. **Usar conventional commits**: feat, fix, docs, style, refactor, test, chore
3. **Documentar breaking changes** que afetem outros desenvolvedores
4. **Incluir comandos de migration** quando necessário
5. **Atualizar este CHANGELOG.md** a cada feature concluída