<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registrar Nueva Aula') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('aulas.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Número de Aula -->
                        <div>
                            <x-input-label for="aula_nro" :value="__('Número de Aula / Identificador')" />
                            <x-text-input id="aula_nro" name="aula_nro" type="text" class="mt-1 block w-full" :value="old('aula_nro')" required autofocus placeholder="Ej. A-101, Laboratorio 2" />
                            <x-input-error class="mt-2" :messages="$errors->get('aula_nro')" />
                        </div>

                        <!-- Capacidad -->
                        <div>
                            <x-input-label for="capacidad" :value="__('Capacidad Máxima')" />
                            <x-text-input id="capacidad" name="capacidad" type="number" class="mt-1 block w-full" :value="old('capacidad')" required min="1" placeholder="Ej. 40" />
                            <p class="text-xs text-gray-500 mt-1">Debe ser un número entero positivo mayor a cero.</p>
                            <x-input-error class="mt-2" :messages="$errors->get('capacidad')" />
                        </div>

                        <!-- Tipo de Aula -->
                        <div>
                            <x-input-label for="tipo_aula" :value="__('Tipo de Aula (Opcional)')" />
                            <x-text-input id="tipo_aula" name="tipo_aula" type="text" class="mt-1 block w-full" :value="old('tipo_aula')" placeholder="Ej. Teórica, Laboratorio, Auditorio" />
                            <x-input-error class="mt-2" :messages="$errors->get('tipo_aula')" />
                        </div>

                        <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-100">
                            <a href="{{ route('aulas.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                Cancelar
                            </a>
                            <x-primary-button>
                                {{ __('Guardar Aula') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
