<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Control Documental de Requisitos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Mensaje de éxito -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 rounded shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium text-gray-900">Requisitos Presentados por Postulantes</h3>
                        <a href="{{ route('requisitos.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-900 text-white text-xs font-semibold rounded-md uppercase tracking-widest transition ease-in-out duration-150 shadow-md">
                            Asignar Nuevo Requisito
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Postulante</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Documento</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descripción</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Último Evaluador (Admin)</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado Actual</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Cambio Rápido</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                @forelse($requisitos as $requisito)
                                    <tr class="hover:bg-gray-50 transition duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                            {{ $requisito->postulante->nombre }} {{ $requisito->postulante->paterno }}
                                            <span class="block text-xs text-gray-500">CI: {{ $requisito->postulante->ci }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-semibold">{{ $requisito->nombre }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate">{{ $requisito->descripcion ?? 'Sin comentarios' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            @if($requisito->abministrador)
                                                {{ $requisito->abministrador->nombre }} {{ $requisito->abministrador->paterno }}
                                            @else
                                                <span class="text-gray-400 italic">No evaluado</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                {{ $requisito->estado === 'Entregado' ? 'bg-green-100 text-green-800' : '' }}
                                                {{ $requisito->estado === 'Pendiente' ? 'bg-amber-100 text-amber-800' : '' }}
                                                {{ $requisito->estado === 'Rechazado' ? 'bg-rose-100 text-rose-800' : '' }}">
                                                {{ $requisito->estado }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                            <!-- Formulario de Cambio Rápido de Estado -->
                                            <form action="{{ route('requisitos.status', $requisito) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('PATCH')
                                                <select name="estado" onchange="this.form.submit()" class="text-xs rounded-md border-gray-300 py-1 pl-2 pr-8 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50 hover:bg-white transition cursor-pointer">
                                                    <option value="Pendiente" {{ $requisito->estado === 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                                                    <option value="Entregado" {{ $requisito->estado === 'Entregado' ? 'selected' : '' }}>Entregado</option>
                                                    <option value="Rechazado" {{ $requisito->estado === 'Rechazado' ? 'selected' : '' }}>Rechazado</option>
                                                </select>
                                            </form>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                            <div class="flex justify-center space-x-3">
                                                <a href="{{ route('requisitos.edit', $requisito) }}" class="text-indigo-600 hover:text-indigo-900 transition">Editar</a>
                                                <form action="{{ route('requisitos.destroy', $requisito) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este registro de requisito?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-rose-600 hover:text-rose-900 transition">Eliminar</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-8 text-center text-gray-500">No se encontraron requisitos asignados a postulantes.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $requisitos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
