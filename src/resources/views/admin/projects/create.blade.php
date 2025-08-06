@extends('layouts.admin')

@section('title', 'Novo Projeto')
@section('page-title', 'Criar Projeto')

@section('breadcrumbs')
    <nav class="text-sm font-medium text-gray-500 dark:text-gray-400 mt-1">
        <a href="{{ route('admin.dashboard') }}" class="hover:text-gray-700 dark:hover:text-gray-300">Dashboard</a>
        <span class="mx-2">›</span>
        <a href="{{ route('admin.projects.index') }}" class="hover:text-gray-700 dark:hover:text-gray-300">Projetos</a>
        <span class="mx-2">›</span>
        <span>Novo</span>
    </nav>
@endsection

@section('content')
    <form method="POST" action="{{ route('admin.projects.store') }}" class="space-y-8" enctype="multipart/form-data">
        @csrf
        
        <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white mb-4">
                    Informações Básicas
                </h3>
                
                <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                    <!-- Title -->
                    <div class="sm:col-span-4">
                        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Título *
                        </label>
                        <div class="mt-1">
                            <input type="text" name="title" id="title" value="{{ old('title') }}" required
                                   class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-white @error('title') border-red-300 @enderror">
                        </div>
                        @error('title')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Short Description -->
                    <div class="sm:col-span-6">
                        <label for="short_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Descrição Curta *
                        </label>
                        <div class="mt-1">
                            <input type="text" name="short_description" id="short_description" value="{{ old('short_description') }}" required
                                   class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-white @error('short_description') border-red-300 @enderror">
                        </div>
                        @error('short_description')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="sm:col-span-6">
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Descrição Completa *
                        </label>
                        <div class="mt-1">
                            <textarea name="description" id="description" rows="4" required
                                      class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-white @error('description') border-red-300 @enderror">{{ old('description') }}</textarea>
                        </div>
                        @error('description')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tech Stack -->
                    <div class="sm:col-span-6">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Tecnologias Utilizadas *
                        </label>
                        <div class="mt-2 grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4">
                            @foreach($technologies->groupBy('category') as $category => $techs)
                                <div>
                                    <h4 class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-2">{{ $category }}</h4>
                                    @foreach($techs as $tech)
                                        <label class="flex items-center mb-1">
                                            <input type="checkbox" name="tech_stack[]" value="{{ $tech->slug }}"
                                                   class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 dark:border-gray-600 rounded dark:bg-gray-700"
                                                   {{ in_array($tech->slug, old('tech_stack', [])) ? 'checked' : '' }}>
                                            <span class="ml-2 text-sm text-gray-900 dark:text-white">{{ $tech->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                        @error('tech_stack')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white mb-4">
                    Imagens do Projeto
                </h3>
                
                <div class="grid grid-cols-1 gap-y-6">
                    <!-- Image Upload -->
                    <div class="sm:col-span-6">
                        <label for="images" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Upload de Imagens (máx. 5 imagens)
                        </label>
                        <div class="mt-1">
                            <input type="file" 
                                   name="images[]" 
                                   id="images" 
                                   multiple 
                                   accept="image/*"
                                   class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-white @error('images') border-red-300 @enderror">
                        </div>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                            Formatos aceitos: JPEG, PNG, JPG, GIF, WebP. Tamanho máximo: 2MB por imagem.
                            A primeira imagem será usada como thumbnail principal.
                        </p>
                        @error('images')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                        @error('images.*')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Preview Area -->
                    <div id="image-preview" class="hidden">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Pré-visualização
                        </label>
                        <div id="preview-container" class="grid grid-cols-2 md:grid-cols-3 gap-4"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white mb-4">
                    Links e Configurações
                </h3>
                
                <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                    <!-- GitHub URL -->
                    <div class="sm:col-span-3">
                        <label for="github_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            URL do GitHub
                        </label>
                        <div class="mt-1">
                            <input type="url" name="github_url" id="github_url" value="{{ old('github_url') }}"
                                   class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-white @error('github_url') border-red-300 @enderror">
                        </div>
                        @error('github_url')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Live URL -->
                    <div class="sm:col-span-3">
                        <label for="live_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            URL do Demo/Site
                        </label>
                        <div class="mt-1">
                            <input type="url" name="live_url" id="live_url" value="{{ old('live_url') }}"
                                   class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-white @error('live_url') border-red-300 @enderror">
                        </div>
                        @error('live_url')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Sort Order -->
                    <div class="sm:col-span-2">
                        <label for="sort_order" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Ordem de Exibição
                        </label>
                        <div class="mt-1">
                            <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', 0) }}" min="0"
                                   class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-white @error('sort_order') border-red-300 @enderror">
                        </div>
                        @error('sort_order')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Checkboxes -->
                    <div class="sm:col-span-4 space-y-4">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input type="checkbox" name="featured" id="featured" value="1" {{ old('featured') ? 'checked' : '' }}
                                       class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 dark:border-gray-600 rounded dark:bg-gray-700">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="featured" class="font-medium text-gray-700 dark:text-gray-300">Projeto em Destaque</label>
                                <p class="text-gray-500 dark:text-gray-400">Este projeto aparecerá na seção de projetos em destaque.</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                                       class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 dark:border-gray-600 rounded dark:bg-gray-700">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="is_active" class="font-medium text-gray-700 dark:text-gray-300">Projeto Ativo</label>
                                <p class="text-gray-500 dark:text-gray-400">Projetos inativos não aparecerão no portfolio público.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex justify-end space-x-3">
            <a href="{{ route('admin.projects.index') }}" 
               class="bg-white dark:bg-gray-600 py-2 px-4 border border-gray-300 dark:border-gray-500 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Cancelar
            </a>
            <button type="submit" 
                    class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Criar Projeto
            </button>
        </div>
    </form>

    <script>
        document.getElementById('images').addEventListener('change', function(e) {
            const files = e.target.files;
            const previewDiv = document.getElementById('image-preview');
            const container = document.getElementById('preview-container');
            
            // Clear previous previews
            container.innerHTML = '';
            
            if (files.length > 0) {
                previewDiv.classList.remove('hidden');
                
                // Limit to 5 files
                const maxFiles = Math.min(files.length, 5);
                
                for (let i = 0; i < maxFiles; i++) {
                    const file = files[i];
                    
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        
                        reader.onload = function(e) {
                            const div = document.createElement('div');
                            div.className = 'relative group';
                            div.innerHTML = `
                                <img src="${e.target.result}" 
                                     class="w-full h-32 object-cover rounded-lg shadow-sm" 
                                     alt="Preview ${i + 1}">
                                <div class="absolute top-2 left-2 bg-indigo-600 text-white text-xs px-2 py-1 rounded">
                                    ${i === 0 ? 'Thumbnail' : 'Galeria'}
                                </div>
                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 transition-all duration-200 rounded-lg"></div>
                            `;
                            container.appendChild(div);
                        };
                        
                        reader.readAsDataURL(file);
                    }
                }
                
                if (files.length > 5) {
                    const warningDiv = document.createElement('div');
                    warningDiv.className = 'col-span-full mt-2 p-3 bg-yellow-50 border border-yellow-200 rounded-md';
                    warningDiv.innerHTML = `
                        <p class="text-sm text-yellow-800">
                            <strong>Atenção:</strong> Apenas as primeiras 5 imagens serão utilizadas.
                        </p>
                    `;
                    container.appendChild(warningDiv);
                }
            } else {
                previewDiv.classList.add('hidden');
            }
        });
    </script>
@endsection