@extends('layouts.portfolio')

@section('title', 'Home')
@section('description', 'Portfolio profissional - Desenvolvedor Full Stack especializado em TALL Stack e .NET')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-gray-900 dark:to-gray-800 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold text-gray-900 dark:text-white mb-6">
                    Desenvolvedor 
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600">
                        Full Stack
                    </span>
                </h1>
                <p class="text-xl text-gray-600 dark:text-gray-300 mb-8 max-w-3xl mx-auto">
                    Especializado em <strong>TALL Stack</strong> (Tailwind, Alpine.js, Laravel, Livewire) e <strong>.NET</strong>. 
                    4 anos de experiência criando soluções web modernas e eficientes.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="#projects" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                        Ver Projetos
                        <svg class="ml-2 -mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </a>
                    <a href="#contact" class="inline-flex items-center px-6 py-3 border-2 border-gray-300 dark:border-gray-600 text-base font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        Entre em Contato
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Projects Showcase Section -->
    <section id="projects" class="py-20 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                    Projetos
                </h2>
                <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                    Explore meus principais trabalhos com filtros interativos e visualização detalhada de cada projeto.
                </p>
            </div>

            <!-- Livewire Project Showcase Component -->
            @livewire('project-showcase')
        </div>
    </section>

    <!-- Technologies Section -->
    <section id="technologies" class="py-20 bg-gray-50 dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                    Tecnologias & Ferramentas
                </h2>
                <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                    Principais tecnologias que domino e utilizo no desenvolvimento de soluções modernas.
                </p>
            </div>

            @foreach($technologies as $category => $techs)
                <div class="mb-12">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-6 capitalize">
                        {{ $category }}
                    </h3>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                        @foreach($techs as $tech)
                            <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300 text-center group">
                                <div class="text-3xl mb-2" style="color: {{ $tech->color }}">
                                    <i class="{{ $tech->icon }}"></i>
                                </div>
                                <h4 class="text-sm font-medium text-gray-900 dark:text-white mb-1">
                                    {{ $tech->name }}
                                </h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ $tech->description }}
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 bg-white dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                    Vamos Trabalhar Juntos?
                </h2>
                <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                    Interessado em conversar sobre oportunidades ou projetos? Entre em contato!
                </p>
            </div>

            <!-- Livewire Contact Form Component -->
            @livewire('contact-form')
        </div>
    </section>
@endsection

