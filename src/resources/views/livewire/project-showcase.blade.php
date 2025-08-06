<div>
    <!-- Search and Filter Section -->
    <div class="mb-8" x-data="{ showFilters: false }">
        <!-- Search Bar -->
        <div class="flex flex-col md:flex-row gap-4 mb-4">
            <div class="flex-1">
                <input 
                    type="text" 
                    wire:model.live.debounce.300ms="searchTerm"
                    placeholder="Buscar projetos..."
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white"
                >
            </div>
            <button 
                @click="showFilters = !showFilters"
                class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors"
            >
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                </svg>
                Filtros
            </button>
        </div>

        <!-- Technology Filters -->
        <div x-show="showFilters" x-transition class="mb-6">
            <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-lg">
                <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Filtrar por tecnologia:</h4>
                <div class="flex flex-wrap gap-2">
                    <button 
                        wire:click="filterByCategory('all')"
                        class="px-3 py-1 text-xs rounded-full transition-colors {{ $selectedCategory === 'all' ? 'bg-blue-500 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-300 dark:hover:bg-gray-600' }}"
                    >
                        Todos
                    </button>
                    @foreach($technologies as $category => $techs)
                        <div class="flex flex-wrap gap-1">
                            @foreach($techs as $tech)
                                <button 
                                    wire:click="filterByCategory('{{ $tech->slug }}')"
                                    class="px-3 py-1 text-xs rounded-full transition-colors {{ $selectedCategory === $tech->slug ? 'bg-blue-500 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-300 dark:hover:bg-gray-600' }}"
                                >
                                    {{ $tech->name }}
                                </button>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Projects Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @php
            $displayProjects = $showAll ? $projects : $featuredProjects;
        @endphp

        @forelse($displayProjects as $project)
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 border border-gray-200 dark:border-gray-700">
                <!-- Project Image Placeholder -->
                <div class="h-48 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-t-lg flex items-center justify-center cursor-pointer"
                     wire:click="showProjectDetails('{{ $project->id }}')"
                >
                    <div class="text-white text-center">
                        <svg class="w-12 h-12 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                        </svg>
                        <p class="text-sm opacity-75">Ver detalhes</p>
                    </div>
                </div>
                
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">
                        {{ $project->title }}
                    </h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-4 text-sm">
                        {{ $project->short_description }}
                    </p>
                    
                    <!-- Tech Stack -->
                    <div class="flex flex-wrap gap-2 mb-4">
                        @foreach(array_slice($project->tech_stack, 0, 4) as $tech)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                {{ ucfirst($tech) }}
                            </span>
                        @endforeach
                        @if(count($project->tech_stack) > 4)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200">
                                +{{ count($project->tech_stack) - 4 }}
                            </span>
                        @endif
                    </div>
                    
                    <!-- Actions -->
                    <div class="flex justify-between items-center">
                        <div class="flex space-x-3">
                            @if($project->github_url)
                                <a href="{{ $project->github_url }}" target="_blank" class="inline-flex items-center text-sm text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 0C4.477 0 0 4.484 0 10.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0110 4.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.203 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.942.359.31.678.921.678 1.856 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0020 10.017C20 4.484 15.522 0 10 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    GitHub
                                </a>
                            @endif
                            @if($project->live_url)
                                <a href="{{ $project->live_url }}" target="_blank" class="inline-flex items-center text-sm text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                    </svg>
                                    Demo
                                </a>
                            @endif
                        </div>
                        <button 
                            wire:click="showProjectDetails('{{ $project->id }}')"
                            class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 text-sm font-medium"
                        >
                            Ver mais →
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.468-.881-6.08-2.33M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">Nenhum projeto encontrado</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Tente ajustar os filtros ou termos de busca.</p>
            </div>
        @endforelse
    </div>

    <!-- Show All/Less Button -->
    @if(!$showAll && $projects->count() > 3)
        <div class="text-center mt-8">
            <button 
                wire:click="showAllProjects"
                class="inline-flex items-center px-6 py-3 border border-gray-300 dark:border-gray-600 text-base font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors"
            >
                Ver Todos os Projetos ({{ $projects->count() }})
                <svg class="ml-2 -mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
        </div>
    @endif

    <!-- Project Detail Modal -->
    @if($selectedProject)
        <div class="fixed inset-0 z-50 overflow-y-auto" wire:ignore.self>
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Background overlay -->
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" wire:click="closeProjectModal"></div>

                <!-- Modal content -->
                <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                    <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <!-- Modal Header -->
                        <div class="sm:flex sm:items-start">
                            <div class="w-full">
                                <div class="flex justify-between items-start mb-4">
                                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
                                        {{ $selectedProject->title }}
                                    </h3>
                                    <button wire:click="closeProjectModal" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>

                                <!-- Project Image Placeholder -->
                                <div class="h-64 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg mb-6 flex items-center justify-center">
                                    <div class="text-white text-center">
                                        <svg class="w-16 h-16 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                                        </svg>
                                        <p class="text-lg opacity-75">Screenshot do projeto</p>
                                    </div>
                                </div>

                                <!-- Project Details -->
                                <div class="space-y-4">
                                    <div>
                                        <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Descrição</h4>
                                        <p class="text-gray-600 dark:text-gray-300">{{ $selectedProject->description }}</p>
                                    </div>

                                    <!-- Tech Stack -->
                                    <div>
                                        <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Tecnologias</h4>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach($selectedProject->tech_stack as $tech)
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                                    {{ ucfirst($tech) }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- Metadata -->
                                    @if($selectedProject->metadata)
                                        <div>
                                            <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Detalhes</h4>
                                            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                                @if(isset($selectedProject->metadata['development_time']))
                                                    <p class="text-sm text-gray-600 dark:text-gray-300">
                                                        <strong>Tempo de desenvolvimento:</strong> {{ $selectedProject->metadata['development_time'] }}
                                                    </p>
                                                @endif
                                                @if(isset($selectedProject->metadata['highlights']))
                                                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">
                                                        <strong>Destaques:</strong> {{ implode(', ', $selectedProject->metadata['highlights']) }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <!-- Actions -->
                                <div class="flex space-x-4 mt-6">
                                    @if($selectedProject->github_url)
                                        <a href="{{ $selectedProject->github_url }}" target="_blank" 
                                           class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors">
                                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 0C4.477 0 0 4.484 0 10.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0110 4.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.203 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.942.359.31.678.921.678 1.856 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0020 10.017C20 4.484 15.522 0 10 0z" clip-rule="evenodd"></path>
                                            </svg>
                                            Ver no GitHub
                                        </a>
                                    @endif
                                    @if($selectedProject->live_url)
                                        <a href="{{ $selectedProject->live_url }}" target="_blank" 
                                           class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                            </svg>
                                            Ver Demo
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
