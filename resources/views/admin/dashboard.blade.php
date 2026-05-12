@extends('layouts.app')

@section('content')
<div class="space-y-8">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold">Админ панель</h1>
        <a href="{{ route('admin.products.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
            + Добавить товар
        </a>
    </div>

    <!-- Товары -->
    <div>
        <h2 class="text-2xl font-bold mb-4">Управление товарами</h2>
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left">ID</th>
                        <th class="px-6 py-3 text-left">Название</th>
                        <th class="px-6 py-3 text-left">Цена</th>
                        <th class="px-6 py-3 text-left">В наличии</th>
                        <th class="px-6 py-3 text-left">Действия</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($products as $product)
                        <tr>
                            <td class="px-6 py-4">{{ $product->id }}</td>
                            <td class="px-6 py-4">{{ $product->name }}</td>
                            <td class="px-6 py-4">{{ number_format($product->price) }} ₽</td>
                            <td class="px-6 py-4">{{ $product->stock }}</td>
                            <td class="px-6 py-4 space-x-2">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="text-blue-500 hover:text-blue-700">Редактировать</a>
                                <form action="{{ route('admin.products.delete', $product->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Удалить товар?')">Удалить</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Заявки -->
    <div>
        <h2 class="text-2xl font-bold mb-4">Управление заявками</h2>
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left">ID</th>
                        <th class="px-6 py-3 text-left">Пользователь</th>
                        <th class="px-6 py-3 text-left">Товар</th>
                        <th class="px-6 py-3 text-left">Кол-во</th>
                        <th class="px-6 py-3 text-left">Сумма</th>
                        <th class="px-6 py-3 text-left">Статус</th>
                        <th class="px-6 py-3 text-left">Действия</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($orders as $order)
                        <tr>
                            <td class="px-6 py-4">{{ $order->id }}</td>
                            <td class="px-6 py-4">{{ $order->user->name }}<br><small>{{ $order->user->email }}</small></td>
                            <td class="px-6 py-4">{{ $order->product->name }}</td>
                            <td class="px-6 py-4">{{ $order->quantity }}</td>
                            <td class="px-6 py-4">{{ number_format($order->product->price * $order->quantity) }} ₽</td>
                            <td class="px-6 py-4">
                                <form action="{{ route('admin.orders.status', $order->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" onchange="this.form.submit()" class="px-2 py-1 border rounded">
                                        <option value="pending" @if($order->status == 'pending') selected @endif>В обработке</option>
                                        <option value="approved" @if($order->status == 'approved') selected @endif>Подтвержден</option>
                                        <option value="completed" @if($order->status == 'completed') selected @endif>Выполнен</option>
                                        <option value="cancelled" @if($order->status == 'cancelled') selected @endif>Отменен</option>
                                    </select>
                                </form>
                            </td>
                            <td class="px-6 py-4">
                                <form action="{{ route('admin.orders.delete', $order->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Удалить заявку?')">Удалить</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection