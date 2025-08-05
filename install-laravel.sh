#!/bin/bash

# Script para instalar Laravel com Jetstream e Livewire

echo "🚀 Instalando Laravel..."
cd /var/www/html
composer create-project laravel/laravel . --prefer-dist

echo "📦 Instalando Jetstream com Livewire..."
composer require laravel/jetstream

echo "🎨 Publicando Jetstream com stack Livewire..."
php artisan jetstream:install livewire

echo "📦 Instalando dependências NPM..."
npm install

echo "🏗️ Compilando assets..."
npm run build

echo "🔑 Gerando chave da aplicação..."
php artisan key:generate

echo "📊 Executando migrações..."
php artisan migrate --force

echo "🎯 Publicando assets do Jetstream..."
php artisan vendor:publish --tag=jetstream-views

echo "✨ Instalação concluída!"
echo "🌐 Acesse: http://localhost:8000"
echo "📧 Mailhog: http://localhost:8025"