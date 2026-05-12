@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6">
    <h1 class="text-2xl font-bold mb-6">Редактировать товар</h1>
    
    <form method="POST" action="{{ route('admin.products.update', $product->id) }}">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Название</label>
            <input type="text" name="name" value="{{ $product->name }}" required class="w-full px-3 py-2 border rounded-lg">
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Описание</label>
            <textarea name="description" rows="5" required class="w-full px-3 py-2 border rounded-lg">{{ $product->description }}</textarea>
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Цена (₽)</label>
            <input type="number" name="price" step="0.01" value="{{ $product->price }}" required class="w-full px-3 py-2 border rounded-lg">
        </div>
        
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Количество на складе</label>
            <input type="number" name="stock" value="{{ $product->stock }}" required class="w-full px-3 py-2 border rounded-lg">
        </div>
        
        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">URL изображения</label>
            <input type="url" name="image" value="{{ $product->image }}" class="w-full px-3 py-2 border rounded-lg">
        </div>
        
        <div class="flex space-x-3">
            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">
                Обновить
            </button>
            <a href="{{ route('admin.dashboard') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">
                Отмена
            </a>
        </div>
    </form>
</div>
@endsection