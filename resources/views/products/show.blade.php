@extends('layouts.app')

@section('content')
<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <div class="md:flex">
        <div class="md:w-1/2">
            <img src="{{ $product->image ?? 'https://picsum.photos/id/20/600/400' }}" 
                 alt="{{ $product->name }}" class="w-full h-96 object-cover">
        </div>
        
        <div class="md:w-1/2 p-6">
            <h1 class="text-3xl font-bold mb-4">{{ $product->name }}</h1>
            <p class="text-gray-600 mb-4">{{ $product->description }}</p>
            <div class="text-3xl font-bold text-green-600 mb-4">{{ number_format($product->price) }} ₽</div>
            <p class="text-gray-500 mb-6">В наличии: {{ $product->stock }} шт.</p>
            
            @auth
                <form method="POST" action="{{ route('products.order', $product->id) }}">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Количество</label>
                        <input type="number" name="quantity" min="1" max="{{ $product->stock }}" value="1" 
                               class="w-32 px-3 py-2 border rounded-lg" required>
                        @error('quantity')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Комментарий к заказу</label>
                        <textarea name="comment" rows="3" class="w-full px-3 py-2 border rounded-lg"></textarea>
                    </div>
                    
                    <button type="submit" class="bg-green-500 text-white font-bold py-2 px-6 rounded-lg hover:bg-green-600">
                        Оформить заказ
                    </button>
                </form>
            @else
                <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded">
                    <a href="{{ route('login') }}" class="font-bold">Войдите</a>, чтобы оформить заказ
                </div>
            @endauth
        </div>
    </div>
</div>
@endsection