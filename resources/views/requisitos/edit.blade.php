<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Requisito de Postulante') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('requisitos.update', $requisito) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Postulante -->
                        <div>
                            <x-input-label for="id_postulante" :value="__('Postulante')" />
                            <select id="id_postulante" name="id_postulante" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                @foreach($postulantes as $postulante)
                                    <option value="{{ $postulante->id }}" {{ old('id_postulante', $requisito->id_postulante) == $postulante->id ? 'selected' : '' }}>
                                        {{ $postulante->nombre }} {{ $postulante->paterno }} (CI: {{ $postulante->ci }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('id_postulante')" />
                        </div>

                        <!-- Nombre del Requisito -->
                        <div>
                            <x-input-label for="nombre" :value="__('Documento / Requisito')" />
                            <x-text-input id="nombre" name="nombre" type="text" class="mt-1 block w-full" :value="old('nombre', $requisito->nombre)" required />
                            <x-input-error class="mt-2" :messages="$errors->get('nombre')" />
                        </div>

                        <!-- Descripción -->
                        <div>
                            <x-input-label for="descripcion" :value="__('Observaciones / Descripción')" />
                            <textarea id="descripcion" name="descripcion" rows="3" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('descripcion', $requisito->descripcion) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('descripcion')" />
                        </div>

                        <!-- Estado -->
                        <div>
                            <x-input-label for="estado" :value="__('Estado de la Entrega')" />
                            <select id="estado" name="estado" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="Pendiente" {{ old('estado', $requisito->estado) == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                                <option value="Entregado" {{ old('estado', $requisito->estado) == 'Entregado' ? 'selected' : '' }}>Entregado</option>
                                <option value="Rechazado" {{ old('estado', $requisito->estado) == 'Rechazado' ? 'selected' : '' }}>Rechazado</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('estado')" />
                        </div>

                        <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-100">
                            <a href="{{ route('requisitos.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                Cancelar
                            </a>
                            <x-primary-button>
                                {{ __('Actualizar Requisito') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
