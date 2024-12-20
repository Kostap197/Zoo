@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h1 class="text-center text-success mb-4">Список животных</h1>

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach($animals as $animal)
                <div class="col">
                    <div class="card animal-card shadow-sm" data-animal-id="{{ $animal->id }}" style="border-radius: 12px; overflow: hidden; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                        <img src="{{ asset('../storage/app/public/' . $animal->image) }}" alt="Фото животного" class="card-img-top" style="height: 200px; object-fit: cover; transition: transform 0.3s ease;">
                        <div class="card-body">
                            <h5 class="card-title text-success mb-2">{{ $animal->name }} ({{ $animal->species }})</h5>
                            <p class="card-text">
                                <strong>Возраст:</strong> {{ $animal->age }} лет<br>
                                <strong>Описание:</strong> {{ Str::limit($animal->description, 150) }}<br>
                                <strong>Клетка:</strong> {{ $animal->cage->name }}
                            </p>

                            <div class="d-flex justify-content-between mt-3">
                                <a href="{{ route('animals.show', $animal->id) }}" class="btn btn-success">Посмотреть</a>
                                @auth
                                    <a href="{{ route('animals.edit', $animal->id) }}" class="btn btn-warning btn-sm">Редактировать</a>
                                    <form action="{{ route('animals.destroy', $animal->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                                    </form>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        document.querySelectorAll('.animal-card').forEach(card => {
            card.addEventListener('click', () => {
                card.classList.toggle('shadow-lg');
            });
        });
    </script>
@endsection
