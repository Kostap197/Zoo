@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h1 class="text-center text-success mb-4">Редактировать клетку</h1>
        <form action="{{ route('cages.update', $cage) }}" method="POST" class="bg-light p-4 rounded shadow-lg">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label text-success">Название клетки</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $cage->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="capacity" class="form-label text-success">Емкость</label>
                <input type="number" class="form-control" id="capacity" name="capacity" value="{{ old('capacity', $cage->capacity) }}" required>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-success">Обновить</button>
                <a href="{{ route('cages.index') }}" class="btn btn-secondary">Отмена</a>
            </div>
        </form>
    </div>


@endsection
