@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4 text-success">🐾 Все клетки зоопарка 🐾</h1>
        <div class="alert alert-success text-center">
            <strong>Общее количество животных в зоопарке:</strong> {{ $totalAnimals }}
        </div>

        <table class="table table-hover table-bordered shadow mt-3">
            <thead style="background-color: #4caf50; color: white;" class="text-center">
            <tr>
                <th>Название</th>
                <th>Вместимость</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cages as $cage)
                <tr class="align-middle" style="background-color: #f9f5e6;">
                    <td class="text-success"><strong>{{ $cage->name }}</strong></td>
                    <td class="text-center">{{ $cage->capacity }}</td>
                    <td class="text-center">
                        <button class="btn btn-sm text-white" style="background-color: #388e3c;" onclick="toggleAnimals({{ $cage->id }})">
                            <i class="bi bi-eye"></i> Просмотр
                        </button>
                        @auth
                            <a href="{{ route('cages.edit', $cage) }}" class="btn btn-warning btn-sm me-2">
                                <i class="bi bi-pencil"></i> Редактировать
                            </a>
                            <form action="{{ route('cages.destroy', $cage) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Вы уверены?')">
                                    <i class="bi bi-trash"></i> Удалить
                                </button>
                            </form>
                        @endauth
                    </td>
                </tr>
                <tr>
                    <td colspan="3" class="p-0">
                        <div id="animals-{{ $cage->id }}" class="animals-list bg-light rounded p-3">
                            @if($cage->animals->isEmpty())
                                <p class="text-center text-muted">В этой клетке нет животных.</p>
                            @else
                                <div class="row g-3">
                                    @foreach($cage->animals as $animal)
                                        <div class="col-md-4">
                                            <div class="card shadow-sm" style="border: none; background-color: #e8f5e9;">
                                                <img src="{{ asset('../storage/app/public/' . $animal->image) }}" alt="{{ $animal->name }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                                                <div class="card-body">
                                                    <h5 class="card-title text-center text-success">{{ $animal->name }}</h5>
                                                    <p class="card-text">
                                                        <strong>Вид:</strong> {{ $animal->species }}<br>
                                                        <strong>Возраст:</strong> {{ $animal->age }}<br>
                                                        <strong>Описание:</strong> {{ $animal->description }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <style>
        body {
            background-color: #f1f8e9; /* Светло-зелёный фон */
            color: #2e7d32; /* Тёмно-зелёный текст */
        }

        .animals-list {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s ease, opacity 0.5s ease-in-out;
            opacity: 0;
        }

        .animals-list.open {
            max-height: 1000px; /* Достаточно для отображения содержимого */
            opacity: 1;
        }

        .card {
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .table-bordered {
            border-color: #a5d6a7; /* Светло-зелёная рамка для таблицы */
        }

        .btn-info {
            background-color: #4caf50; /* Зелёная кнопка */
            border-color: #388e3c;
        }

        .btn-info:hover {
            background-color: #388e3c; /* Более тёмный зелёный при наведении */
        }
    </style>

    <script>
        function toggleAnimals(cageId) {
            const element = document.getElementById(`animals-${cageId}`);
            if (element.classList.contains('open')) {
                element.classList.remove('open');
            } else {
                element.classList.add('open');
            }
        }
    </script>
@endsection
