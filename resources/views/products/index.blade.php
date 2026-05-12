@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold mb-6">Наши товары</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    @foreach($products as $product)
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <img src="{{ $product->image ?? 'https://picsum.photos/id/20/300/300' }}" 
                 alt="{{ $product->name }}" class="w-full h-48 object-cover">
            <div class="p-4">
                <h3 class="font-bold text-xl mb-2">{{ $product->name }}</h3>
                <p class="text-gray-600 mb-2">{{ Str::limit($product->description, 100) }}</p>
                <div class="flex justify-between items-center">
                    <span class="text-2xl font-bold text-green-600">{{ number_format($product->price) }} ₽</span>
                    <a href="{{ route('products.show', $product->id) }}" 
                       class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        Подробнее
                    </a>
                </div>
                <p class="text-sm text-gray-500 mt-2">В наличии: {{ $product->stock }} шт.</p>
            </div>
        </div>
    @endforeach
</div>
@endsection