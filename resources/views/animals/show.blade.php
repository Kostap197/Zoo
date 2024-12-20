@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h1 class="text-center text-success mb-4">Животное: {{ $animal->name }} ({{ $animal->species }})</h1>

        <div class="card animal-card shadow-sm" style="border-radius: 12px; overflow: hidden; transition: transform 0.3s ease, box-shadow 0.3s ease;">
            <div class="card-img-wrapper" style="position: relative; height: 400px; overflow: hidden;">
                <img src="{{ asset('../storage/app/public/' . $animal->image) }}" alt="Фото животного" class="card-img-top" style="object-fit: cover; width: 100%; height: 100%; transition: transform 0.3s ease;">
            </div>
            <div class="card-body">
                <h5 class="card-title text-success mb-2">{{ $animal->name }} ({{ $animal->species }})</h5>
                <p class="card-text">
                    <strong>Возраст:</strong> {{ $animal->age }} лет<br>
                    <strong>Описание:</strong> {{ $animal->description }}<br>
                    <strong>Клетка:</strong> {{ $animal->cage->name }}<br>
                    <strong>Вместимость клетки:</strong> {{ $animal->cage->capacity }}<br>
                </p>

                @auth
                    <div class="d-flex justify-content-between mt-3">
                        <a href="{{ route('animals.edit', $animal->id) }}" class="btn btn-warning btn-sm">Редактировать</a>
                        <form action="{{ route('animals.destroy', $animal->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                        </form>
                    </div>
                @endauth
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('animals.index') }}" class="btn btn-success">Назад к списку животных</a>
        </div>
    </div>

    <script>
        document.querySelector('.animal-card').addEventListener('click', () => {
            document.querySelector('.animal-card').classList.toggle('shadow-lg');
        });
    </script>
@endsection
