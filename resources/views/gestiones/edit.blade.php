<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Planificación Académica') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('gestiones.update', $gestion_academica) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Nombre de la Gestión -->
                        <div>
                            <x-input-label for="nombre" :value="__('Nombre de la Convocatoria / Gestión')" />
                            <x-text-input id="nombre" name="nombre" type="text" class="mt-1 block w-full" :value="old('nombre', $gestion_academica->nombre)" required autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('nombre')" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Año -->
                            <div>
                                <x-input-label for="año" :value="__('Año Académico')" />
                                <x-text-input id="año" name="año" type="number" class="mt-1 block w-full" :value="old('año', $gestion_academica->año)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('año')" />
                            </div>

                            <!-- Periodo -->
                            <div>
                                <x-input-label for="periodo" :value="__('Periodo')" />
                                <x-text-input id="periodo" name="periodo" type="text" class="mt-1 block w-full" :value="old('periodo', $gestion_academica->periodo)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('periodo')" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Fecha Inicio -->
                            <div>
                                <x-input-label for="fecha_ini" :value="__('Fecha de Inicio')" />
                                <x-text-input id="fecha_ini" name="fecha_ini" type="date" class="mt-1 block w-full" :value="old('fecha_ini', $gestion_academica->fecha_ini)" />
                                <x-input-error class="mt-2" :messages="$errors->get('fecha_ini')" />
                            </div>

                            <!-- Fecha Fin -->
                            <div>
                                <x-input-label for="fecha_fin" :value="__('Fecha de Cierre')" />
                                <x-text-input id="fecha_fin" name="fecha_fin" type="date" class="mt-1 block w-full" :value="old('fecha_fin', $gestion_academica->fecha_fin)" />
                                <x-input-error class="mt-2" :messages="$errors->get('fecha_fin')" />
                            </div>
                        </div>

                        <!-- Estado -->
                        <div>
                            <x-input-label for="estado" :value="__('Estado')" />
                            <select id="estado" name="estado" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="Activo" {{ old('estado', $gestion_academica->estado) == 'Activo' ? 'selected' : '' }}>Activo</option>
                                <option value="Inactivo" {{ old('estado', $gestion_academica->estado) == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('estado')" />
                        </div>

                        <!-- Postulante Asociado (Opcional) -->
                        <div>
                            <x-input-label for="id_postulante" :value="__('Persona/Postulante Asignado (Opcional)')" />
                            <select id="id_postulante" name="id_postulante" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">-- Seleccionar Persona --</option>
                                @foreach($postulantes as $postulante)
                                    <option value="{{ $postulante->id }}" {{ old('id_postulante', $gestion_academica->id_postulante) == $postulante->id ? 'selected' : '' }}>
                                        {{ $postulante->nombre }} {{ $postulante->paterno }} (CI: {{ $postulante->ci }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('id_postulante')" />
                        </div>

                        <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-100">
                            <a href="{{ route('gestiones.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                Cancelar
                            </a>
                            <x-primary-button>
                                {{ __('Actualizar Planificación') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
