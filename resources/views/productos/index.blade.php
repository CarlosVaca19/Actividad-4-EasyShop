<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Productos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <a type="button" href="{{ route('productos.create') }}" class="bg-blue-500 hover:bg-blue-400 text-black font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded" >Crear</a>
                <table class="table-fixed w-full">
                    <thead>
                        <tr class="bg-gray-800 text-white">
                            <th style="display: none">ID</th>
                            <th class="border px-4 py-2">NOMBRE</th>
                            <th class="border px-4 py-2">PRECIO</th>
                            <th class="border px-4 py-2">DESCRIPCION</th>
                            <th class="border px-4 py-2">STOCK</th>
                            <th class="border px-4 py-2">IMAGEN</th>
                            <th class="border px-4 py-2">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productos as $producto)
                        <tr>
                            <td style="display: none">{{$producto->id}}</td>
                            <td align="center">{{$producto->nombre}}</td>
                            <td align="center">{{$producto->precio}}</td>
                            <td align="center">{{$producto->descripcion}}</td>
                            <td align="center">{{$producto->stock}}</td>
                            <td class="border px-14 py-1">
                                <img src="/imagen/{{$producto->imagen}}" width="60%">
                            </td>
                            <td class="border px-4 py-2">
                                <div class="flex justify-center rounded-lg text-lg" role="group">
                                    <a href="{{ route('productos.edit', $producto->id) }}" class="bg-gray-500 hover:bg-blue-400 text-black font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">Editar</a>

                                    <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" class="formEliminar">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-gray-500 hover:bg-blue-400 text-black font-bold py-2 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">Borrar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                    <div>
                        {!! $productos->links() !!}
                    </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    (function () {
  'use strict'

  var forms = document.querySelectorAll('.formEliminar')
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
          event.preventDefault()
          event.stopPropagation()
          Swal.fire({
                title: '¿Confirma la eliminación del registro?',
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#20c997',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Confirmar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                    Swal.fire('¡Eliminado!', 'El registro ha sido eliminado exitosamente.', 'success');
                }
            })
      }, false)
    })
})()
</script>