@extends('layout')

@section('content')

    @if ($errors->any())
        <section class="errorList">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </section>
    @endif

    <h2>Lista de pedidos</h2>

    <table>
        <thead>
            <th>Provincia</th>
            <th>Localidad</th>
            <th>Dirección</th>
            <th>Coste total</th>
            <th>Estado</th>
            <th>Fecha de creación</th>
            <th>Acciones</th>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->province }}</td>
                    <td>{{ $order->locality }}</td>
                    <td>{{ $order->direction }}</td>
                    <td>{{ $order->getTotalCost() }} €</td>
                    <td>{{ $order->status }}</td>
                    <td>{{ $order->created_at }}</td>

                    <td><button><a href="{{ route('orderLineList', $order) }}">Ver detalles</a></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Esta sección añade la paginación. El parámetro de links, por alguna razón, me permite dar estilos propios(sin él no funcionan) --}}
    <section class="pagination">
        {{ $orders->links('pagination::bootstrap-4') }}
    </section>

@endsection
