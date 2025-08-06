@extends('layouts.admin')

@section('title', 'Visualizar Projeto')
@section('page-title', $project->title)

@section('breadcrumbs')
    <nav class="text-sm font-medium text-gray-500 dark:text-gray-400 mt-1">
        <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-700 dark:hover:text-gray-300">Dashboard</a>
        <span class="mx-2">›</span>
        <a href="{{ route('admin.projects.index') }}" class="hover:text-gray-700 dark:hover:text-gray-300">Projetos</a>
        <span class="mx-2">›</span>
        <span>{{ $project->title }}</span>
    </nav>
@endsection

@section('content')
    <div class="space-y-8">
        <!-- Actions -->
        <div class="flex justify-end space-x-3">
            <a href="{{ route('admin.projects.edit', $project) }}" 
               class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Editar Projeto
            </a>
            <form method="POST" action="{{ route('admin.projects.destroy', $project) }}" class="inline" 
                  onsubmit="return confirm('Tem certeza que deseja excluir este projeto? Esta ação não pode ser desfeita.')">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    Excluir Projeto
                </button>
            </form>
        </div>

        <!-- Project Information -->
        <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <h3 class="text-2xl leading-6 font-bold text-gray-900 dark:text-white mb-2">
                            {{ $project->title }}
                        </h3>
                        
                        <div class="flex items-center space-x-4 mb-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $project->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $project->is_active ? 'Ativo' : 'Inativo' }}
                            </span>
                            @if($project->featured)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                    Em Destaque
                                </span>
                            @endif
                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                Criado em {{ $project->created_at->format('d/m/Y') }}
                            </span>
                        </div>
                        
                        <p class="text-lg text-gray-600 dark:text-gray-300 mb-4">
                            {{ $project->short_description }}
                        </p>
                        
                        <div class="prose dark:prose-invert max-w-none">
                            {!! nl2br(e($project->description)) !!}
                        </div>
                    </div>
                    
                    @if($project->thumbnail)
                        <div class="ml-6 flex-shrink-0">
                            <img src="{{ asset('storage/' . $project->thumbnail->path) }}" 
                                 alt="{{ $project->thumbnail->alt_text }}" 
                                 class="h-32 w-32 object-cover rounded-lg shadow-sm">
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Tech Stack -->
        @if($project->tech_stack && count($project->tech_stack) > 0)
        <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white mb-4">
                    Tecnologias Utilizadas
                </h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($project->tech_stack as $tech)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 dark:bg-blue-800 dark:text-blue-100">
                            {{ ucfirst($tech) }}
                        </span>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <!-- Links -->
        @if($project->github_url || $project->live_url)
        <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white mb-4">
                    Links do Projeto
                </h3>
                <div class="space-y-3">
                    @if($project->github_url)
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 0C4.477 0 0 4.484 0 10.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0110 4.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.203 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.942.359.31.678.921.678 1.856 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0020 10.017C20 4.484 15.522 0 10 0z" clip-rule="evenodd"></path>
                            </svg>
                            <a href="{{ $project->github_url }}" target="_blank" 
                               class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 font-medium">
                                Ver no GitHub
                            </a>
                        </div>
                    @endif
                    
                    @if($project->live_url)
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                            <a href="{{ $project->live_url }}" target="_blank" 
                               class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-500 font-medium">
                                Ver Demo/Site
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @endif

        <!-- Images Gallery -->
        @if($project->images->count() > 0)
        <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white mb-4">
                    Galeria de Imagens ({{ $project->images->count() }} imagens)
                </h3>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($project->images as $image)
                        <div class="relative group cursor-pointer" onclick="openImageModal('{{ asset('storage/' . $image->path) }}', '{{ $image->alt_text }}')">
                            <img src="{{ asset('storage/' . $image->path) }}" 
                                 alt="{{ $image->alt_text }}" 
                                 class="w-full h-48 object-cover rounded-lg shadow-sm group-hover:shadow-md transition-shadow">
                            
                            <div class="absolute top-2 left-2">
                                <span class="bg-{{ $image->type === 'thumbnail' ? 'indigo' : 'gray' }}-600 text-white text-xs px-2 py-1 rounded">
                                    {{ $image->type === 'thumbnail' ? 'Thumbnail' : 'Galeria' }}
                                </span>
                            </div>
                            
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 rounded-lg transition-all duration-200 flex items-center justify-center">
                                <svg class="w-8 h-8 text-white opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                                </svg>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <!-- Project Stats -->
        <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white mb-4">
                    Estatísticas do Projeto
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">
                            {{ $project->views }}
                        </div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Visualizações</div>
                    </div>
                    
                    <div class="text-center">
                        <div class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">
                            {{ $project->sort_order }}
                        </div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Ordem de Exibição</div>
                    </div>
                    
                    <div class="text-center">
                        <div class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">
                            {{ $project->images->count() }}
                        </div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Imagens</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Modal -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 z-50 hidden items-center justify-center p-4" onclick="closeImageModal()">
        <div class="max-w-4xl max-h-full">
            <img id="modalImage" src="" alt="" class="max-w-full max-h-full object-contain rounded-lg">
        </div>
    </div>

    <script>
        function openImageModal(src, alt) {
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            modalImage.src = src;
            modalImage.alt = alt;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeImageModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Close modal on Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeImageModal();
            }
        });
    </script>
@endsection