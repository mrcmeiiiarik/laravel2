@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold mb-6">Мои заказы</h1>

@if($orders->count() > 0)
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left">Товар</th>
                    <th class="px-6 py-3 text-left">Количество</th>
                    <th class="px-6 py-3 text-left">Сумма</th>
                    <th class="px-6 py-3 text-left">Статус</th>
                    <th class="px-6 py-3 text-left">Дата</th>
                    <th class="px-6 py-3 text-left">Комментарий</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($orders as $order)
                    <tr>
                        <td class="px-6 py-4">{{ $order->product->name }}</td>
                        <td class="px-6 py-4">{{ $order->quantity }}</td>
                        <td class="px-6 py-4">{{ number_format($order->product->price * $order->quantity) }} ₽</td>
                        <td class="px-6 py-4">
                            @php
                                $statuses = [
                                    'pending' => 'В обработке',
                                    'approved' => 'Подтвержден',
                                    'completed' => 'Выполнен',
                                    'cancelled' => 'Отменен'
                                ];
                                $colors = [
                                    'pending' => 'yellow',
                                    'approved' => 'blue',
                                    'completed' => 'green',
                                    'cancelled' => 'red'
                                ];
                            @endphp
                            <span class="px-2 py-1 rounded text-xs bg-{{ $colors[$order->status] }}-100 text-{{ $colors[$order->status] }}-800">
                                {{ $statuses[$order->status] }}
                            </span>
                        </td>
                        <td class="px-6 py-4">{{ $order->created_at->format('d.m.Y H:i') }}</td>
                        <td class="px-6 py-4">{{ $order->comment ?: '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <div class="bg-white rounded-lg shadow-md p-6 text-center">
        <p class="text-gray-500">У вас пока нет заказов</p>
        <a href="{{ route('products.index') }}" class="text-blue-500 hover:underline mt-2 inline-block">Перейти к товарам</a>
    </div>
@endif
@endsection