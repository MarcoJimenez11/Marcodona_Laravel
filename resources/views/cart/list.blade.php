<?php
use App\Models\Product;
?>


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


    @if (!is_null($cartItems))
        <h2>Lista de productos</h2>

        <table>
            <thead>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio unidad</th>
                <th>Precio total</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                @forelse ($cartItems as $key => $item)
                    <tr>
                        <td>{{ Product::find($item['id'])->name }}</td>
                        <td>{{ $item['amount'] }}</td>
                        <td>{{ Product::find($item['id'])->price }}</td>
                        <td>{{ Product::find($item['id'])->price * $item['amount'] }}</td>

                        <td>
                            <form method="POST" action="{{ route('changeAmountItem', ['item' => $key, 'amount' => -1]) }}">
                                @csrf
                                @method('PUT')
                                <button type="submit">Reducir</button>
                            </form>
                            <form method="POST" action="{{ route('changeAmountItem', ['item' => $key, 'amount' => 1]) }}">
                                @csrf
                                @method('PUT')
                                <button type="submit">Añadir</button>
                            </form>
                            <form method="POST" action="{{ route('cartItemDelete', $key) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    No hay ningún producto en el carrito
                @endforelse
            </tbody>

        </table>
        <form method="POST" action="{{ route('cartDeleteAll') }}">
            @csrf
            @method('DELETE')
            <button type="submit">Vaciar carrito</button>
        </form>
        @auth
            <a href="{{ route('orderCreate') }}">Confirmar pedido</a>
        @endauth
        @guest
            <a href="{{ route('login') }}">Inicia sesión para confirmar pedido</a>
        @endguest
    @else
        No hay ningún producto en el carrito
    @endif


@endsection
